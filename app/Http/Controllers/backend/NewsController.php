<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\NewsImage;
use App\Models\News;
use App\Models\Promotions;
use App\Models\ProductPromotion;
use App\Models\Product;
use App\Models\promocode;
use App\Models\ProductPromocode;

class NewsController extends Controller
{
    public function news_promotion_index($type){
        $data = News::where('news_type', $type)->orderBy('news_date', 'desc')->get();
        // dd($type);
        // C:\xampp\htdocs\powertex\resources\views\backend\news_promotion\index.blade.php
        return view('backend.news_promotion.index', compact('type', 'data'));
    }

    public function news_promotion_form($type){
        return view('backend.news_promotion.add', compact('type'));
    }
    
    public function news_promotion_create(Request $request, $type)
    {
        DB::beginTransaction();
        try {
            $status = $request->banner_status ? "show" : "hide";

            $News = new News;
            $News->news_topic       = $request->news_topic;
            $News->news_detail      = $request->news_detail;
            $News->news_date        = $request->news_date;
            $News->news_status      = $status;
            $News->news_type        = $type;
            $News->news_keywords    = $request->news_keyword;
            $News->news_description = $request->news_description;
            $News->news_url         = $request->news_url;
            $News->FK_user_id       = Auth::user()->id;
            $News->FK_user_name     = Auth::user()->name;

            // อัปโหลดรูปภาพหลัก
            if ($request->hasFile('news_cover')) {
                $filename = $type . '_cover_' . Str::random(12) . "." . $request->file('news_cover')->getClientOriginalExtension();
                $request->file('news_cover')->move(public_path('/upload/news/'), $filename);
                $News->news_image_cover = 'upload/news/' . $filename;
            }

            if ($request->hasFile('news_banner')) {
                $filename = $type . '_banner_' . Str::random(12) . "." . $request->file('news_banner')->getClientOriginalExtension();
                $request->file('news_banner')->move(public_path('/upload/news/'), $filename);
                $News->news_image_banner = 'upload/news/' . $filename;
            }

            $News->save(); // ✅ ต้องบันทึกก่อนใช้ $News->id

            // อัปโหลดรูปภาพเพิ่มเติม
            if ($request->hasFile('news_image_other')) {
                // dd($request->file('news_image_other'));
                $files = $request->file('news_image_other');
            
                if (!is_array($files)) { 
                    $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
                }
            
                foreach ($files as $file) {
                    $fileName = $type.'_image_other_'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                    $filePath = 'upload/news/' . $fileName;
            
                    // ตรวจสอบประเภทไฟล์
                    $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                    if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                        $file->move(public_path('/upload/news/'), $fileName);
            
                        // ✅ บันทึกลงฐานข้อมูล
                        $NewsImage = new NewsImage;
                        $NewsImage->news_image_other = $filePath; 
                        $NewsImage->FK_news_id  = $News->news_id;
                        $NewsImage->FK_user_id   = Auth::user()->id;
                        $NewsImage->FK_user_name = Auth::user()->name;
                        $NewsImage->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/news_promotion/' . $type);
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function news_promotion_edit($type, $id){
        // dd($type, $id);
        $data = News::where('news_id', $id)->first();
        $image = NewsImage::where('FK_news_id', $id)->get();
        return view('backend.news_promotion.edit', compact('type', 'data', 'image', 'id'));
    }

    public function news_promotion_update(Request $request, $type, $id)
    {
        // dd($id, $type, $request);
        DB::beginTransaction();
        try {
            $status = $request->banner_status ? "show" : "hide";

            $News['news_topic']         = $request->news_topic;
            $News['news_detail']        = $request->news_detail;
            $News['news_date']          = $request->news_date;
            $News['news_status']        = $status;
            $News['news_keywords']      = $request->news_keyword;
            $News['news_description']   = $request->news_description;
            $News['news_url']           = $request->news_url;
            $News['FK_user_id']         = Auth::user()->id;
            $News['FK_user_name']       = Auth::user()->name;

            // อัปโหลดรูปภาพหลัก
            if ($request->hasFile('news_cover')) {
                $filename = $type . '_cover_' . Str::random(12) . "." . $request->file('news_cover')->getClientOriginalExtension();
                $request->file('news_cover')->move(public_path('/upload/news/'), $filename);
                $News['news_image_cover'] = 'upload/news/' . $filename;
            }
            
            if ($request->hasFile('news_banner')) {
                $filename = $type . '_banner_' . Str::random(12) . "." . $request->file('news_banner')->getClientOriginalExtension();
                $request->file('news_banner')->move(public_path('/upload/news/'), $filename);
                $News['news_image_banner'] = 'upload/news/' . $filename;
            }

            News::where('news_id', $id)->update($News); // ✅ ต้องบันทึกก่อนใช้ $News->id

            // อัปโหลดรูปภาพเพิ่มเติม
            if ($request->hasFile('news_image_other')) {
                // dd($request->file('news_image_other'));
                $files = $request->file('news_image_other');
            
                if (!is_array($files)) { 
                    $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
                }
            
                foreach ($files as $file) {
                    $fileName = $type.'_image_other_'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                    $filePath = 'upload/news/' . $fileName;
            
                    // ตรวจสอบประเภทไฟล์
                    $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                    if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                        $file->move(public_path('/upload/news/'), $fileName);
            
                        // ✅ บันทึกลงฐานข้อมูล
                        $NewsImage = new NewsImage;
                        $NewsImage->news_image_other = $filePath; 
                        $NewsImage->FK_news_id  = $id;
                        $NewsImage->FK_user_id   = Auth::user()->id;
                        $NewsImage->FK_user_name = Auth::user()->name;
                        $NewsImage->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/news_promotion/' . $type);
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function news_promotion_delete($type, $id)
    {
        try {
            $news = News::where('news_id', $id)->first(); // ✅ ต้องบันทึกก่อนใช้ $News->id

            if (!$news) { // ถ้าไม่พบข้อมูล
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูลที่ต้องการลบ'
                ], 404);
            }

            // ลบข้อมูล
            $news->delete();

            return response()->json([
                'success' => true,
                'message' => 'ลบสำเร็จ'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    public function news_promotion_image_delete($type, $id)
    {
        try {
            $image = NewsImage::where('news_image_id', $id)->first(); // หา image ตาม ID

            if (!$image) { // ถ้าไม่พบข้อมูล
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูลภาพที่ต้องการลบ'
                ], 404);
            }

            // ลบข้อมูลภาพ
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'ลบภาพสำเร็จ'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }
    









    public function promotion_index(){
        $data = Promotions::orderBy('promotion_number', 'asc')->get();
        return view('backend.news_promotion.promotion.index', compact('data'));
    }

    public function promotion_form(){
        $data = Promotions::get();
        $product = Product::where('products_status', 'show')->orderby('products_code', 'asc')->get();
        return view('backend.news_promotion.promotion.add', compact('data', 'product'));
    }
    
    public function promotion_create(Request $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $status = $request->promotion_status ? "show" : "hide";

            $promotion = new Promotions;
            $promotion->promotion_topic   = $request->promotion_topic;
            $promotion->promotion_detail  = $request->promotion_detail;
            $promotion->promotion_date_start    = $request->promotion_date_start;
            $promotion->promotion_date_end    = $request->promotion_date_end;
            $promotion->promotion_price    = $request->promotion_price;
            $promotion->promotion_type    = $request->promotion_type;
            $promotion->promotion_number    = $request->promotion_number;
            $promotion->promotion_product    = $promotion->promotion_product;
            $promotion->promotion_status  = $status;
            $promotion->promotion_keyword  = $request->promotion_keyword;
            $promotion->promotion_description  = $request->promotion_description;
            $promotion->promotion_url  = $request->promotion_url;
            $promotion->FK_user_id   = Auth::user()->id;
            $promotion->FK_user_name = Auth::user()->name;

            if($request->promotion_product_all){
                $product = Product::where('products_status', 'show')->pluck('products_id')->toArray();
                $promotion->promotion_product = implode(',', $product);
            }else{
                if($request->promotion_product){
                    $promotionProductArray = $request->input('promotion_product');
                    $promotion->promotion_product = implode(',', $promotionProductArray);
                }
            }

            // อัปโหลดรูปภาพหลัก
            if ($request->hasFile('promotion_cover')) {
                $filename = 'promotion_cover_' . Str::random(12) . "." . $request->file('promotion_cover')->getClientOriginalExtension();
                $request->file('promotion_cover')->move(public_path('/upload/news/'), $filename);
                $promotion->promotion_image_cover = 'upload/news/' . $filename;
            }

            $promotion->save(); // ✅ ต้องบันทึกก่อนใช้ $News->id

            if($request->promotion_product_all){
                $allProducts = Product::where('products_status', 'show')->pluck('products_id')->toArray();

                foreach ($allProducts as $promotion_product) {
                    $product = new ProductPromotion;
                    $product->FK_pp_product   = $promotion_product;
                    $product->FK_pp_promotion = $promotion->promotion_id;
                    $product->FK_user_id      = Auth::user()->id;
                    $product->FK_user_name    = Auth::user()->name;
                    $product->save();
                }
            }else{
                if($request->promotion_product){
                    foreach ($request->promotion_product as $index => $promotion_product){
                        $product = new ProductPromotion;
                        $product->FK_pp_product   = $promotion_product;
                        $product->FK_pp_promotion  = $promotion->promotion_id;
                        $product->FK_user_id   = Auth::user()->id;
                        $product->FK_user_name = Auth::user()->name;
                        $product->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/promotion/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function promotion_edit($id){
        $data = Promotions::where('promotion_id', $id)->first();
        $product = Product::where('products_status', 'show')->orderby('products_code', 'asc')->get();
        return view('backend.news_promotion.promotion.edit', compact('data', 'id', 'product'));
    }

    public function promotion_update(Request $request, $id)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $status = $request->promotion_status ? "show" : "hide";

            $promotion['promotion_topic']   = $request->promotion_topic;
            $promotion['promotion_detail']  = $request->promotion_detail;
            $promotion['promotion_date_start']    = $request->promotion_date_start;
            $promotion['promotion_date_end']    = $request->promotion_date_end;
            $promotion['promotion_price']    = $request->promotion_price;
            $promotion['promotion_type']    = $request->promotion_type;
            $promotion['promotion_number']    = $request->promotion_number;
            $promotion['promotion_status']  = $status;
            $promotion['promotion_keyword']  = $request->promotion_keyword;
            $promotion['promotion_description']  = $request->promotion_description;
            $promotion['promotion_url']  = $request->promotion_url;
            $promotion['FK_user_id']   = Auth::user()->id;
            $promotion['FK_user_name'] = Auth::user()->name;

            if($request->promotion_product_all){
                $product = Product::where('products_status', 'show')->pluck('products_id')->toArray();
                $promotion['promotion_product'] = implode(',', $product);
            }else{
                if($request->promotion_product){
                    $promotionProductArray = $request->input('promotion_product');
                    $promotion['promotion_product'] = implode(',', $promotionProductArray);
                }
            }

            // อัปโหลดรูปภาพหลัก
            if ($request->hasFile('promotion_cover')) {
                $filename = 'promotion_cover_' . Str::random(12) . "." . $request->file('promotion_cover')->getClientOriginalExtension();
                $request->file('promotion_cover')->move(public_path('/upload/news/'), $filename);
                $promotion['promotion_image_cover'] = 'upload/news/' . $filename;
            }

            Promotions::where('promotion_id', $id)->update($promotion);

            ProductPromotion::where('FK_pp_promotion', $id)->delete();
            if($request->promotion_product_all){
                $allProducts = Product::where('products_status', 'show')->pluck('products_id')->toArray();

                foreach ($allProducts as $promotion_product) {
                    $product = new ProductPromotion;
                    $product->FK_pp_product   = $promotion_product;
                    $product->FK_pp_promotion = $id;
                    $product->FK_user_id      = Auth::user()->id;
                    $product->FK_user_name    = Auth::user()->name;
                    $product->save();
                }
            }else{
                if($request->promotion_product){
                    foreach ($request->promotion_product as $index => $promotion_product){
                        $product = new ProductPromotion;
                        $product->FK_pp_product   = $promotion_product;
                        $product->FK_pp_promotion  = $id;
                        $product->FK_user_id   = Auth::user()->id;
                        $product->FK_user_name = Auth::user()->name;
                        $product->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/promotion/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function promotion_delete($id)
    {
        try {
            $promotion = Promotions::where('promotion_id', $id)->first(); // ✅ ต้องบันทึกก่อนใช้ $News->id
            $product = ProductPromotion::where('FK_pp_promotion', $id)->delete();

            if (!$promotion) { // ถ้าไม่พบข้อมูล
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูลที่ต้องการลบ'
                ], 404);
            }

            // ลบข้อมูล
            $promotion->delete();

            return response()->json([
                'success' => true,
                'message' => 'ลบสำเร็จ'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    public function promotion_change($id) {
        $promotion = Promotions::where('promotion_id', $id)->first();
    
        if (!$promotion) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    
        $status = $promotion->promotion_status == "show" ? "hide" : "show";
    
        $promotion->update([
            'promotion_status' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);
    
        return response()->json(['success' => true, 'status' => $status]);
    }
    
    
    
    
    
    
    
    
    
    
    public function promocode_index(){
        $data = promocode::orderBy('promocode_date_start', 'asc')->get();
        return view('backend.pormocode.index', compact('data'));
    }

    public function promocode_form(){
        $product = Product::where('products_status', 'show')->orderby('products_code', 'asc')->get();
        return view('backend.pormocode.add', compact('product'));
    }

    public function promocode_create(Request $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $status = $request->promcode_status ? "show" : "hide";

            $promocode                          = new promocode;
            $promocode->promocode_code          = $request->promocode_code;
            $promocode->promocode_date_start    = $request->promocode_date_start;
            $promocode->promocode_date_end      = $request->promocode_date_end;
            $promocode->promocode_min_price     = $request->promocode_min_price;
            $promocode->promocode_price         = $request->promocode_price;
            $promocode->promocode_price_type    = $request->promotion_type;
            $promocode->promocode_type          = $request->promocode_type;
            $promocode->promocode_number        = $request->promocode_number;
            $promocode->promocode_user          = $request->promocoes_user_use;
            $promocode->promocode_user_use      = $request->promocode_user_number;
            $promocode->promocode_status        = $status;
            $promocode->FK_user_id              = Auth::user()->id;
            $promocode->FK_user_name            = Auth::user()->name;

            if($request->promocode_product_all){
                $product = Product::where('products_status', 'show')->pluck('products_id')->toArray();
                $promocode->promocode_product = implode(',', $product);
            }else{
                if($request->promocode_product){
                    $promocodeProductArray = $request->input('promocode_product');
                    $promocode->promocode_product = implode(',', $promocodeProductArray);
                }
            }

            // อัปโหลดรูปภาพหลัก
            if ($request->hasFile('promocode_cover')) {
                $filename = 'promocode_cover_' . Str::random(12) . "." . $request->file('promocode_cover')->getClientOriginalExtension();
                $request->file('promocode_cover')->move(public_path('/upload/news/'), $filename);
                $promocode->promocode_image = 'upload/news/' . $filename;
            }

            $promocode->save(); // ✅ ต้องบันทึกก่อนใช้ $News->id

            if($request->promocode_product_all){
                $allProducts = Product::where('products_status', 'show')->pluck('products_id')->toArray();

                foreach ($allProducts as $promotion_product) {
                    $product = new ProductPromocode;
                    $product->FK_ppc_product   = $promotion_product;
                    $product->FK_ppc_promocode = $promocode->promocode_id;
                    $product->FK_user_id      = Auth::user()->id;
                    $product->FK_user_name    = Auth::user()->name;
                    $product->save();
                }
            }else{
                if($request->promotion_product){
                    foreach ($request->promotion_product as $index => $promotion_product){
                        $product = new ProductPromocode;
                        $product->FK_ppc_product   = $promotion_product;
                        $product->FK_ppc_promocode  = $promocode->promocode_id;
                        $product->FK_user_id   = Auth::user()->id;
                        $product->FK_user_name = Auth::user()->name;
                        $product->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/promocode/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function promocode_edit($id){
        $data = promocode::where('promocode_id', $id)->first();
        $product = Product::where('products_status', 'show')->orderby('products_code', 'asc')->get();
        return view('backend.pormocode.edit', compact('data', 'product'));
    }

    public function promocode_update(Request $request, $id)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $status = $request->promcode_status ? "show" : "hide";

            $promocode['promocode_code']          = $request->promocode_code;
            $promocode['promocode_date_start']    = $request->promocode_date_start;
            $promocode['promocode_date_end']      = $request->promocode_date_end;
            $promocode['promocode_min_price']     = $request->promocode_min_price;
            $promocode['promocode_price']         = $request->promocode_price;
            $promocode['promocode_price_type']    = $request->promotion_type;
            $promocode['promocode_type']          = $request->promocode_type;
            $promocode['promocode_number']        = $request->promocode_number;
            $promocode['promocode_user']          = $request->promocoes_user_use;
            $promocode['promocode_user_use']      = $request->promocode_user_number;
            $promocode['promocode_status']        = $status;
            $promocode['FK_user_id']              = Auth::user()->id;
            $promocode['FK_user_name']            = Auth::user()->name;

            if($request->promocode_product_all){
                $product = Product::where('products_status', 'show')->pluck('products_id')->toArray();
                $promocode['promocode_product'] = implode(',', $product);
            }else{
                if($request->promocode_product){
                    $promocodeProductArray = $request->input('promocode_product');
                    $promocode['promocode_product'] = implode(',', $promocodeProductArray);
                }
            }

            // อัปโหลดรูปภาพหลัก
            if ($request->hasFile('promocode_cover')) {
                $filename = 'promocode_cover_' . Str::random(12) . "." . $request->file('promocode_cover')->getClientOriginalExtension();
                $request->file('promocode_cover')->move(public_path('/upload/news/'), $filename);
                $promocode['promocode_image'] = 'upload/news/' . $filename;
            }

            promocode::where('promocode_id', $id)->update($promocode);

            ProductPromocode::where('FK_ppc_promocode', $id)->delete();
            if($request->promocode_product_all){
                $allProducts = Product::where('products_status', 'show')->pluck('products_id')->toArray();

                foreach ($allProducts as $promotion_product) {
                    $product = new ProductPromocode;
                    $product->FK_ppc_product   = $promotion_product;
                    $product->FK_ppc_promocode = $id;
                    $product->FK_user_id      = Auth::user()->id;
                    $product->FK_user_name    = Auth::user()->name;
                    $product->save();
                }
            }else{
                if($request->promotion_product){
                    foreach ($request->promotion_product as $index => $promotion_product){
                        $product = new ProductPromocode;
                        $product->FK_ppc_product   = $promotion_product;
                        $product->FK_ppc_promocode  = $id;
                        $product->FK_user_id   = Auth::user()->id;
                        $product->FK_user_name = Auth::user()->name;
                        $product->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/promocode/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function promocode_image_delete($id){
        $promocode['promocode_image'] = null;
        promocode::where('promocode_id', $id)->update($promocode);
    }
}
