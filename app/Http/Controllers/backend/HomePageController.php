<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\banner;
use App\Models\AboutUsIndex;
use App\Models\WhyUs;
use App\Models\Guarantee;
use App\Models\TextHaeder;

class HomePageController extends Controller
{
    // LOGIN
    // public function back_login(){
    //     // C:\xampp\htdocs\powertex\resources\views\auth\login.blade.php
    //     return view('auth.login');
    // }










    // BANNER
    public function banner_index(){
        $bannerAll = banner::get();
        return view('backend.home_page.banner.index', compact('bannerAll'));
    }

    public function banner_form(){
        $bannerAll = banner::get();
        return view('backend.home_page.banner.add', compact('bannerAll'));
    }

    public function banner_create(Request $request)
    {
        $status = $request->banner_status ? "show" : "hide";

        $banner = new Banner;
        $banner->banner_number  = $request->banener_number;
        $banner->banner_show  = $status;
        $banner->FK_user_id   = Auth::user()->id;
        $banner->FK_user_name   = Auth::user()->name;

        // ตรวจสอบว่ามีการอัปโหลดไฟล์ banner_image และไฟล์ถูกต้อง
        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $image = $request->file('banner_image');

            // ใช้ getimagesize() เพื่อตรวจสอบขนาดรูปภาพ
            $imageInfo = getimagesize($image->getPathname()); // ใช้ getPathname() เพื่อให้ได้พาธของไฟล์ชั่วคราว
            $width = $imageInfo[0]; // ความกว้าง
            $height = $imageInfo[1]; // ความสูง

            // ตรวจสอบขนาดรูปภาพที่ต้องการ (กว้าง 1600px, ยาว 690px)
            if ($width != 1600 || $height != 690) {
                $mes = 'ขนาดรูปภาพไม่ถูกต้อง! กรุณาอัปโหลดรูปภาพที่มีขนาดกว้าง 1600px และยาว 690px เท่านั้น';
                $yourURL = url('/backend/home/banner');
                echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
                return; // หยุดการทำงานถ้าขนาดไม่ถูกต้อง
            }

            // ถ้าขนาดถูกต้อง ให้ดำเนินการบันทึกไฟล์
            $filename = 'home_page_banner' . Str::random(12) . "." . $image->getClientOriginalExtension();
            $image->move(public_path() . '/upload/homepage/', $filename);
            $banner->banner_image = 'upload/homepage/' . $filename;
        }

        $banner->save();

        $mes = 'บันทึกแบนเนอร์สำเร็จ!';
        $yourURL = url('/backend/home/banner');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function banner_edit($id){
        $banner = banner::where('banner_id', $id)->first();
        return view('backend.home_page.banner.edit', compact('banner'));
    }

    public function banner_update(Request $request, $id){
        $status = $request->banner_status ? "show" : "hide";

        if ($request->hasFile('banner_image')!=''){
            $filename = 'home_page_banner'.Str::random(12).".". $request->file('banner_image')->getClientOriginalExtension();
            $request->file('banner_image')->move(public_path().'/upload/homepage/', $filename);
            $data['banner_image'] = 'upload/homepage/'.$filename;
        }

        $data['banner_number']      = $request->banener_number;
        $data['banner_show']    = $status;
        $data['FK_user_id']        = Auth::user()->id;
        $data['FK_user_name']      = Auth::user()->name;

        banner::where('banner_id', $id)->update($data);

        $mes = 'Update Success';
        $yourURL= url('/backend/home/banner');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function banner_delete($id) {
        $banner = banner::where('banner_id', $id)->delete();
    }

    public function banner_change($id) {
        $banner = banner::where('banner_id', $id)->first();

        if (!$banner) {
            return response()->json(['error' => 'Banner not found'], 404);
        }

        $status = $banner->banner_show == "show" ? "hide" : "show";

        $banner->update([
            'banner_show' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);

        return response()->json(['success' => true, 'status' => $status]);
    }










    // ABOUT US POWERTEX
    public function powertex_index(){
        $aboutUs = AboutUsIndex::get();
        return view('backend.home_page.about_us.index', compact('aboutUs'));
    }

    public function powertex_form(){
        return view('backend.home_page.about_us.add');
    }

    public function powertex_create(Request $request){
        $aboutUs = new AboutUsIndex;
        $aboutUs->about_us_topic    = $request->about_topic;
        $aboutUs->about_us_detail   = $request->about_detail;
        $aboutUs->FK_user_id        = Auth::user()->id;
        $aboutUs->FK_user_name      = Auth::user()->name;

        if ($request->hasFile('about_image_front')!=''){
            $filename = 'about_us_image_front_'.Str::random(12).".". $request->file('about_image_front')->getClientOriginalExtension();
            $request->file('about_image_front')->move(public_path().'/upload/homepage/', $filename);
            $aboutUs->about_us_image_front = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_image_back')!=''){
            $filename = 'about_us_image_back_'.Str::random(12).".". $request->file('about_image_back')->getClientOriginalExtension();
            $request->file('about_image_back')->move(public_path().'/upload/homepage/', $filename);
            $aboutUs->about_us_image_back = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_powertex')!=''){
            $filename = 'about_us_powertex'.Str::random(12).".". $request->file('about_powertex')->getClientOriginalExtension();
            $request->file('about_powertex')->move(public_path().'/upload/homepage/', $filename);
            $aboutUs->about_us_powertex = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('aobut_hugong')!=''){
            $filename = 'about_us_hugong'.Str::random(12).".". $request->file('aobut_hugong')->getClientOriginalExtension();
            $request->file('aobut_hugong')->move(public_path().'/upload/homepage/', $filename);
            $aboutUs->about_us_hugong = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_sunflower')!=''){
            $filename = 'about_us_sunflower'.Str::random(12).".". $request->file('about_sunflower')->getClientOriginalExtension();
            $request->file('about_sunflower')->move(public_path().'/upload/homepage/', $filename);
            $aboutUs->about_us_sunflower = 'upload/homepage/'.$filename;
        }

        $aboutUs->save();

        $mes = 'Success';
        $yourURL= url('/backend/home/powertex');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function powertex_edit($id){
        $aboutUs = AboutUsIndex::where('about_us_id', $id)->first();
        return view('backend.home_page.about_us.edit', compact('aboutUs'));
    }

    public function powertex_update(Request $request, $id){

        if ($request->hasFile('about_image')!=''){
            $filename = 'about_us_image'.Str::random(12).".". $request->file('about_image')->getClientOriginalExtension();
            $request->file('about_image')->move(public_path().'/upload/homepage/', $filename);
            $data['about_us_image'] = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_powertex')!=''){
            $filename = 'about_us_powertex'.Str::random(12).".". $request->file('about_powertex')->getClientOriginalExtension();
            $request->file('about_powertex')->move(public_path().'/upload/homepage/', $filename);
            $data['about_us_powertex'] = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('aobut_hugong')!=''){
            $filename = 'about_us_hugong'.Str::random(12).".". $request->file('aobut_hugong')->getClientOriginalExtension();
            $request->file('aobut_hugong')->move(public_path().'/upload/homepage/', $filename);
            $data['about_us_hugong'] = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_sunflower')!=''){
            $filename = 'about_us_sunflower'.Str::random(12).".". $request->file('about_sunflower')->getClientOriginalExtension();
            $request->file('about_sunflower')->move(public_path().'/upload/homepage/', $filename);
            $data['about_us_sunflower'] = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_image_front')!=''){
            $filename = 'about_us_image_front_'.Str::random(12).".". $request->file('about_image_front')->getClientOriginalExtension();
            $request->file('about_image_front')->move(public_path().'/upload/homepage/', $filename);
            $data['about_us_image_front'] = 'upload/homepage/'.$filename;
        }

        if ($request->hasFile('about_image_back')!=''){
            $filename = 'about_us_image_back_'.Str::random(12).".". $request->file('about_image_back')->getClientOriginalExtension();
            $request->file('about_image_back')->move(public_path().'/upload/homepage/', $filename);
            $data['about_us_image_back'] = 'upload/homepage/'.$filename;
        }

        $data['about_us_topic']     = $request->about_topic;
        $data['about_us_detail']    = $request->about_detail;
        $data['about_us_keyword']    = $request->about_keyword;
        $data['about_us_description']    = $request->about_description;
        $data['FK_user_id']         = Auth::user()->id;
        $data['FK_user_name']       = Auth::user()->name;

        AboutUsIndex::where('about_us_id', $id)->update($data);

        $mes = 'Update Success';
        $yourURL= url('/backend/home/powertex');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }





    // why us
    public function why_index(){
        $whyUs = WhyUs::get();
        return view('backend.home_page.why_us.index', compact('whyUs'));
    }

    public function why_form(){
        return view('backend.home_page.why_us.add');
    }

    public function why_create(Request $request){
        // dd($request);
        $whyUs                  = new WhyUs;
        $whyUs->why_us_vdo      = $request->why_us_vdo;
        $whyUs->why_us_topic    = $request->why_us_topic;
        $whyUs->why_us_detail   = $request->why_us_detail;
        $whyUs->FK_user_id      = Auth::user()->id;
        $whyUs->FK_user_name    = Auth::user()->name;
        $whyUs->save();

        foreach ($request->guarantee_topic as $index => $guarantee_topic){
            $guarantee_detail = $request->guarantee_detail[$index] ?? null;
            $guarantee_image = $request->guarantee_image[$index] ?? null;

            $imageGuarantee = '';
            if ($guarantee_image != ''){
                $filename = 'about_us_image_front_'.Str::random(12).".". $guarantee_image->getClientOriginalExtension();
                $guarantee_image->move(public_path().'/upload/homepage/', $filename);
                $imageGuarantee = 'upload/homepage/'.$filename;
            }

            $data_Timeline = new Guarantee();
            $data_Timeline->guarantees_icon     = $imageGuarantee;
            $data_Timeline->guarantees_topic    = $guarantee_topic;
            $data_Timeline->guarantees_detail   = $guarantee_detail;
            $data_Timeline->FK_user_id          = Auth::user()->id;
            $data_Timeline->FK_user_name        = Auth::user()->name;
            $data_Timeline->save();
        }

        $mes = 'Success';
        $yourURL= url('backend/home/why');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function why_edit($id){
        $whyUs = WhyUs::where('why_us_id', $id)->first();
        $guarantee = Guarantee::orderBy('guarantees_number', 'asc')->get();
        return view('backend.home_page.why_us.edit', compact('whyUs', 'guarantee'));
    }

    public function why_update(Request $request, $id){
        // dd($request);

        $whyUs['why_us_vdo']      = $request->why_us_vdo;
        $whyUs['why_us_topic']    = $request->why_us_topic;
        $whyUs['why_us_detail']   = $request->why_us_detail;
        $whyUs['FK_user_id']      = Auth::user()->id;
        $whyUs['FK_user_name']    = Auth::user()->name;

        WhyUs::where('why_us_id', $id)->update($whyUs);

        foreach ($request->guarantee_topic as $index => $guarantee_topic){
            $guarantee_id = $request->guarantee_id[$index] ?? null;
            $guarantee_detail = $request->guarantee_detail[$index] ?? null;
            $image = $request->guarantee_image[$index] ?? null;
            $number = $request->guarantee_number[$index] ?? null;

            if($guarantee_id){

                if(!empty($image)){
                    $filename = 'about_us_image_front_'.Str::random(12).".". $image->getClientOriginalExtension();
                    $image->move(public_path().'/upload/homepage/', $filename);
                    $updateGuarantee['guarantees_icon'] = 'upload/homepage/'.$filename;
                }else{
                    $guaranteeSearch = Guarantee::where('guarantees_id', $guarantee_id)->first();
                    $updateGuarantee['guarantees_icon'] = $guaranteeSearch->guarantees_icon;
                }

                $updateGuarantee['guarantees_topic']    = $guarantee_topic;
                $updateGuarantee['guarantees_detail']   = $guarantee_detail;
                $updateGuarantee['guarantees_number']   = $number;
                $updateGuarantee['FK_user_id']          = Auth::user()->id;
                $updateGuarantee['FK_user_name']        = Auth::user()->name;
                Guarantee::where('guarantees_id', $guarantee_id)->update($updateGuarantee);

            }else{
                $imageGuarantee = '';
                if ($image != ''){
                    $filename = 'about_us_image_front_'.Str::random(12).".". $image->getClientOriginalExtension();
                    $image->move(public_path().'/upload/homepage/', $filename);
                    $imageGuarantee = 'upload/homepage/'.$filename;
                }

                $data_Timeline = new Guarantee();
                $data_Timeline->guarantees_icon     = $imageGuarantee;
                $data_Timeline->guarantees_topic    = $guarantee_topic;
                $data_Timeline->guarantees_detail   = $guarantee_detail;
                $data_Timeline->guarantees_number   = $number;
                $data_Timeline->FK_user_id          = Auth::user()->id;
                $data_Timeline->FK_user_name        = Auth::user()->name;
                $data_Timeline->save();
            }
        }

        $mes = 'Success';
        $yourURL= url('backend/home/why');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function why_warranty_delete($id){
        Guarantee::where('guarantees_id', $id)->delete();
    }











    public function text_index(){
        $textheader = TextHaeder::get();
        return view('backend.home_page.text-header.index', compact('textheader'));
    }

    public function text_form(){
        return view('backend.home_page.text-header.add');
    }

    public function text_create(Request $request){
        // dd($request);
        $status = $request->text_header_status ? "show" : "hide";
        $textHeader                  = new TextHaeder;
        $textHeader->texth_text      = $request->text_header_tex;
        $textHeader->texth_link    = $request->text_header_link;
        $textHeader->texth_status   = $status;
        $textHeader->FK_user_id      = Auth::user()->id;
        $textHeader->FK_user_name    = Auth::user()->name;
        $textHeader->save();

        $mes = 'Success';
        $yourURL= url('backend/home/text-header');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function text_edit($id){
        $textheader = TextHaeder::where('texth_id', $id)->first();
        return view('backend.home_page.text-header.edit', compact('textheader', 'id'));
    }

    public function text_update(Request $request, $id){
        // dd($request);
        $status = $request->text_header_status ? "show" : "hide";

        $textHeader['texth_text']      = $request->text_header_tex;
        $textHeader['texth_link']    = $request->text_header_link;
        $textHeader['texth_status']   = $status;
        $textHeader['FK_user_id']      = Auth::user()->id;
        $textHeader['FK_user_name']    = Auth::user()->name;

        TextHaeder::where('texth_id', $id)->update($textHeader);

        $mes = 'Success';
        $yourURL= url('backend/home/text-header');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function text_change($id) {
        $textHeader = TextHaeder::where('texth_id', $id)->first();

        if (!$textHeader) {
            return response()->json(['error' => 'Banner not found'], 404);
        }

        $status = $textHeader->texth_status == "show" ? "hide" : "show";

        $textHeader->update([
            'texth_status' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);

        return response()->json(['success' => true, 'status' => $status]);
    }
}
