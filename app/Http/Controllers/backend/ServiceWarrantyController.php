<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Services;
use App\Models\ServiceWarranty;
use App\Models\Warranties;

class ServiceWarrantyController extends Controller
{
    public function repairs_index(){
        $service = Services::orderByRaw("
            CASE 
                WHEN service_new = 'new' THEN 0
                WHEN service_success = 'received' THEN 1
                WHEN service_success = 'success' THEN 2
                ELSE 3
            END
        ")->get();
        return view('backend.service.index', compact('service'));
    }

    public function repairs_data($id){
        $serviceUpdate['service_new'] = 'old';
        Services::where('service_id', $id)->update($serviceUpdate);

        $service = Services::where('service_id', $id)->first();
        $image = ServiceWarranty::where('swd_FK_id', $id)->where('swd_type', '!=', 'product')->get();
        return view('backend.service.data', compact('id', 'service', 'image'));
    }

    public function repairs_update(Request $request, $id){
        // dd($request);
        $serviceUpdate['service_new']       = 'old';
        $serviceUpdate['service_success']   = $request->service_status;
        Services::where('service_id', $id)->update($serviceUpdate);

        $mes = 'Success';
        $yourURL = url('/backend/repairs');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function warranty_index(){
        $warranty = Warranties::orderByRaw("
            CASE 
                WHEN warranty_new = 'new' THEN 0
                WHEN warranty_new = 'received' THEN 1
                WHEN warranty_success = 'success' THEN 2
                ELSE 3
            END
        ")->get();
        return view('backend.warranty.index', compact('warranty'));
    }

    public function warranty_data($id){
        $warrantyUpdate['warranty_new'] = 'old';
        Warranties::where('warranty_id', $id)->update($warrantyUpdate);

        $warranty = Warranties::where('warranty_id', $id)->first();
        $image = ServiceWarranty::where('swd_FK_id', $id)->where('swd_type', 'product')->get();
        return view('backend.warranty.data', compact('id', 'warranty', 'image'));
    }

    public function warranty_update(Request $request, $id){
        // dd($request);
        $warrantyUpdate['warranty_new']       = 'old';
        $warrantyUpdate['warranty_success']   = $request->warranty_status;
        Warranties::where('warranty_id', $id)->update($warrantyUpdate);

        $mes = 'Success';
        $yourURL = url('/backend/warranty');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }
}
