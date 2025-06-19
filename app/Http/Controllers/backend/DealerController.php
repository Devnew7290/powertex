<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Dealers;
use App\Models\Provinces;
use App\Models\Amphures;
use App\Models\Districts;

class DealerController extends Controller
{
    private function stripLeadingVowel($string)
    {
        $leadingVowels = ['เ', 'แ', 'โ', 'ใ', 'ไ'];

        $firstChar = mb_substr($string, 0, 1, 'UTF-8');
        if (in_array($firstChar, $leadingVowels)) {
            return mb_substr($string, 1, null, 'UTF-8');
        }

        return $string;
    }

    public function dealer_index(){
        $dealer = Dealers::get();
        $Provinces = Provinces::get();
        $Amphures = Amphures::get();
        $Districts = Districts::get();
        return view('backend.dealer.index', compact('dealer', 'Provinces', 'Amphures', 'Districts'));
    }

    public function dealer_form(){
        $province = Provinces::all()->sortBy(function ($item) {
            return $this->stripLeadingVowel($item->name_th);
        }, SORT_STRING)->values();
        
        return view('backend.dealer.add', compact('province'));
    }

    public function dealer_create(Request $request){
        // dd($request);

        $status = $request->dealer_status ? "show" : "hide";

        $dealer = new Dealers;
        $dealer->dealer_name         = $request->dealer_name;
        $dealer->dealer_address       = $request->dealer_address_number;
        $dealer->FK_province_id     = $request->provinces;
        $dealer->FK_amphures_id  = $request->amphures;
        $dealer->FK_districts_id          = $request->districts;
        $dealer->dealer_address_code          = $request->dealer_address_code;
        $dealer->dealer_day_open          = $request->dealer_day_open;
        $dealer->dealer_time_open          = $request->dealer_time_open;
        $dealer->dealer_time_close          = $request->dealer_time_close;
        $dealer->dealer_phone          = $request->dealer_phone;
        $dealer->dealer_map          = $request->dealer_map;
        $dealer->dealer_line          = $request->dealer_line;
        $dealer->dealer_facebook          = $request->dealer_facebook;
        $dealer->dealer_show       = $status;
        $dealer->FK_user_id         = Auth::user()->id;
        $dealer->FK_user_name       = Auth::user()->name;

        if ($request->hasFile('dealer_logo_image')!=''){
            $filename = 'delaer_image_'.Str::random(12).".". $request->file('dealer_logo_image')->getClientOriginalExtension();
            $request->file('dealer_logo_image')->move(public_path().'/upload/dealer/', $filename);
            $dealer->dealer_image = 'upload/dealer/'.$filename;        
        }

        $dealer->save();

        $mes = 'Success';
        $yourURL= url('/backend/dealer');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function dealer_edit($id){
        $dealer = Dealers::where('dealer_id', $id)->first();
        $province = Provinces::get();
        $Amphures = Amphures::where('province_id', $dealer->FK_province_id)->get();
        $Districts = Districts::where('amphure_id', $dealer->FK_amphures_id)->get();
        return view('backend.dealer.edit', compact('id', 'dealer', 'province', 'Amphures', 'Districts'));
    }

    public function dealer_update(Request $request, $id){
        // dd($id, $request);

        $status = $request->dealer_status ? "show" : "hide";

        $dealer['dealer_name']         = $request->dealer_name;
        $dealer['dealer_address']       = $request->dealer_address_number;
        $dealer['FK_province_id']     = $request->provinces;
        $dealer['FK_amphures_id']  = $request->amphures;
        $dealer['FK_districts_id']          = $request->districts;
        $dealer['dealer_address_code']          = $request->dealer_address_code;
        $dealer['dealer_day_open']          = $request->dealer_day_open;
        $dealer['dealer_time_open']          = $request->dealer_time_open;
        $dealer['dealer_time_close']          = $request->dealer_time_close;
        $dealer['dealer_phone']          = $request->dealer_phone;
        $dealer['dealer_map']          = $request->dealer_map;
        $dealer['dealer_line']          = $request->dealer_line;
        $dealer['dealer_facebook']          = $request->dealer_facebook;
        $dealer['dealer_show']       = $status;
        $dealer['FK_user_id']         = Auth::user()->id;
        $dealer['FK_user_name']       = Auth::user()->name;

        if ($request->hasFile('dealer_logo_image')!=''){
            $filename = 'delaer_image_'.Str::random(12).".". $request->file('dealer_logo_image')->getClientOriginalExtension();
            $request->file('dealer_logo_image')->move(public_path().'/upload/dealer/', $filename);
            $dealer['dealer_image'] = 'upload/dealer/'.$filename;        
        }

        Dealers::where('dealer_id', $id)->update($dealer);

        $mes = 'Success';
        $yourURL= url('/backend/dealer');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function dealer_delete($id) {
        Dealers::where('dealer_id', $id)->delete();
    }

    public function dealer_change($id){
        $dealer = Dealers::where('dealer_id', $id)->first();
    
        if (!$dealer) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    
        $status = $dealer->dealer_show == "show" ? "hide" : "show";
    
        $dealer->update([
            'dealer_show' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);
    
        return response()->json(['success' => true, 'status' => $status]);
    }










    public function ajax_amphures(Request $request){
        $amphures = Amphures::where('province_id', $request->provinces)
            ->get() // ดึงมาเป็น Collection ก่อน
            ->sortBy(function ($item) {
                return $this->stripLeadingVowel($item->name_th);
            }, SORT_STRING)
            ->values();
        $html = '<option value="" hidden>กรุณาเลือก</option>';
        if(!empty($amphures)){
            foreach($amphures as $_data){
                $html .= '<option value="'.$_data->id.'">'.$_data->name_th.'</option>';
            }
        }
        $data["html"] = $html;
        return json_encode($data);
    }

    public function ajax_districts(Request $request){
        $districts = Districts::where('amphure_id', $request->amphures)
            ->get() // ดึงมาเป็น Collection ก่อน
            ->sortBy(function ($item) {
                return $this->stripLeadingVowel($item->name_th);
            }, SORT_STRING)
            ->values();
        $html = '<option value="" hidden>กรุณาเลือก</option>';
        if(!empty($districts)){
            foreach($districts as $_data){
                $html .= '<option value="'.$_data->id.'">'.$_data->name_th.'</option>';
            }
        }
        $data["html"] = $html;
        return json_encode($data);
    }
}
