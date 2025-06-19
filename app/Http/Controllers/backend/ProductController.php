<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Brand;
use App\Models\BrandsImage;
use App\Models\CategoryMain;
use App\Models\CategorySub;
use App\Models\CategoryThird;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Catalog;

class ProductController extends Controller
{
    // LOGO BRAND PRODUCT
    public function product_index(){
        $product = Product::join('brands', 'brands.brand_id', 'products.FK_brand')->orderBy('products_code','asc')->get();
        return view('backend.product.detail.index', compact('product'));
    }
    
    public function product_form(){
        $brand = Brand::where('brand_status','show')->get();
        $main = CategoryMain::where('cm_status','show')->get();
        return view('backend.product.detail.add', compact('brand', 'main'));
    }

    public function product_create(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $request->product_status ? "show" : "hide";

            $prduct = new Product;
            $prduct->products_name              = $request->product_name;
            $prduct->products_code              = $request->product_code;
            $prduct->FK_brand                   = $request->product_brand;
            $prduct->FK_category_mains          = $request->product_type_main;
            $prduct->FK_category_sub            = $request->product_sub;
            $prduct->FK_category_third          = $request->product_third;
            $prduct->products_price_full        = $request->product_price_full;
            $prduct->products_price_promotion   = $request->product_price_promotion;
            $prduct->products_note              = $request->product_note;
            $prduct->products_send              = $request->product_send;
            $prduct->products_quantity          = $request->product_quantity;
            $prduct->products_detail            = $request->product_detail;
            $prduct->products_guarantee         = $request->products_guarantee;
            $prduct->products_vdo               = $request->product_vdo;
            $prduct->products_index             = $request->product_index;
            $prduct->products_status            = $status;
            $prduct->products_keywords          = $request->product_keyword;
            $prduct->products_description       = $request->product_description;
            $prduct->products_url               = $request->product_url;
            $prduct->FK_user_id                 = Auth::user()->id;
            $prduct->FK_user_name               = Auth::user()->name;

            if ($request->hasFile('products_manual')) {
                $filename = 'products_manual_' . Str::random(12) . "." . $request->file('products_manual')->getClientOriginalExtension();
                $request->file('products_manual')->move(public_path('/upload/product/'), $filename);
                $prduct->products_manual = 'upload/product/' . $filename;
            }

            if ($request->hasFile('products_manual_two')) {
                $filename = 'products_manual_two_' . Str::random(12) . "." . $request->file('products_manual_two')->getClientOriginalExtension();
                $request->file('products_manual_two')->move(public_path('/upload/product/'), $filename);
                $prduct->products_manual_two = 'upload/product/' . $filename;
            }

            $prduct->save();

            if ($request->hasFile('product_image')) {
                $files = $request->file('product_image');
            
                if (!is_array($files)) { 
                    $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
                }
            
                foreach ($files as $file) {
                    $fileName = 'product_image'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                    $filePath = 'upload/product/' . $fileName;
            
                    // ตรวจสอบประเภทไฟล์
                    $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                    if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                        $file->move(public_path('/upload/product/'), $fileName);
            
                        // ✅ บันทึกลงฐานข้อมูล
                        $productImage = new ProductImage;
                        $productImage->pi_image         = $filePath; 
                        $productImage->FK_pi_product    = $prduct->products_id ;
                        $productImage->FK_user_id       = Auth::user()->id;
                        $productImage->FK_user_name     = Auth::user()->name;
                        $productImage->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/product/detail/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
    
    public function product_edit($id){
        $product = Product::where('products_id', $id)->first();
        $image = ProductImage::where('FK_pi_product', $id)->get();
        $brand = Brand::where('brand_status','show')->get();
        $main = CategoryMain::where('cm_status','show')->get();
        $Sub = CategorySub::where('FK_category_main', $product->FK_category_mains)->get();
        $Third = CategoryThird::where('FK_category_sub', $product->FK_category_sub)->get();
        return view('backend.product.detail.edit', compact('id', 'product', 'image', 'brand', 'main', 'Sub', 'Third'));
    }

    public function product_update(Request $request, $id)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $status = $request->product_status ? "show" : "hide";

            $product['products_name']              = $request->product_name;
            $product['products_code']              = $request->product_code;
            $product['FK_brand']                   = $request->product_brand;
            $product['FK_category_mains']          = $request->product_type_main;
            $product['FK_category_sub']            = $request->product_sub;
            $product['FK_category_third']          = $request->product_third;
            $product['products_price_full']        = $request->product_price_full;
            $product['products_price_promotion']   = $request->product_price_promotion;
            $product['products_note']              = $request->product_note;
            $product['products_send']              = $request->product_send;
            $product['products_quantity']          = $request->product_quantity;
            $product['products_detail']            = $request->product_detail;
            $product['products_guarantee']         = $request->products_guarantee;
            $product['products_vdo']               = $request->product_vdo;
            $product['products_index']             = $request->product_index;
            $product['products_status']            = $status;
            $product['products_keywords']          = $request->product_keyword;
            $product['products_description']       = $request->product_description;
            $product['products_url']               = $request->product_url;
            $product['FK_user_id']                 = Auth::user()->id;
            $product['FK_user_name']               = Auth::user()->name;

            if ($request->hasFile('products_manual')) {
                $filename = 'products_manual_' . Str::random(12) . "." . $request->file('products_manual')->getClientOriginalExtension();
                $request->file('products_manual')->move(public_path('/upload/product/'), $filename);
                $product['products_manual'] = 'upload/product/' . $filename;
            }

            if ($request->hasFile('products_manual_two')) {
                $filename = 'products_manual_two_' . Str::random(12) . "." . $request->file('products_manual_two')->getClientOriginalExtension();
                $request->file('products_manual_two')->move(public_path('/upload/product/'), $filename);
                $product['products_manual_two'] = 'upload/product/' . $filename;
            }

            Product::where('products_id', $id)->update($product);

            if ($request->hasFile('product_image')) {
                $files = $request->file('product_image');
            
                if (!is_array($files)) { 
                    $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
                }
            
                foreach ($files as $file) {
                    $fileName = 'product_image'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                    $filePath = 'upload/product/' . $fileName;
            
                    // ตรวจสอบประเภทไฟล์
                    $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                    if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                        $file->move(public_path('/upload/product/'), $fileName);
            
                        // ✅ บันทึกลงฐานข้อมูล
                        $productImage = new ProductImage;
                        $productImage->pi_image         = $filePath; 
                        $productImage->FK_pi_product    = $id ;
                        $productImage->FK_user_id       = Auth::user()->id;
                        $productImage->FK_user_name     = Auth::user()->name;
                        $productImage->save();
                    }
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/product/detail/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function product_image_delete($id) {
        ProductImage::where('pi_id', $id)->delete();
    }

    public function product_change($id) {
        $product = Product::where('products_id', $id)->first();
    
        if (!$product) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    
        $status = $product->products_status == "show" ? "hide" : "show";
    
        $product->update([
            'products_status' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);
    
        return response()->json(['success' => true, 'status' => $status]);
    }

    public function product_delete($id) {
        $product = Product::where('products_id', $id)->delete();
    }

    



    // LOGO BRAND PRODUCT
    public function brand_index(){
        $brand = Brand::orderBy('brand_number','asc')->get();
        return view('backend.product.brand.index', compact('brand'));
    }

    public function brand_form(){
        $brand = Brand::get();
        return view('backend.product.brand.add', compact('brand'));
    }

    public function brand_create(Request $request){

        $status = $request->brand_status ? "show" : "hide";

        $banner = new Brand;
        $banner->brand_name         = $request->brand_name;
        $banner->brand_number       = $request->brand_number;
        $banner->brand_keywords     = $request->brand_keyword;
        $banner->brand_description  = $request->brand_description;
        $banner->brand_url          = $request->brand_url;
        $banner->brand_status       = $status;
        $banner->FK_user_id         = Auth::user()->id;
        $banner->FK_user_name       = Auth::user()->name;

        if ($request->hasFile('brand_logo_image')!=''){
            $filename = $request->banner_product_type.'_logo'.Str::random(12).".". $request->file('brand_logo_image')->getClientOriginalExtension();
            $request->file('brand_logo_image')->move(public_path().'/upload/product/', $filename);
            $banner->brand_logo = 'upload/product/'.$filename;        
        }

        if ($request->hasFile('brand_banner_image')!=''){
            $filename = $request->banner_product_type.'_banner'.Str::random(12).".". $request->file('brand_banner_image')->getClientOriginalExtension();
            $request->file('brand_banner_image')->move(public_path().'/upload/product/', $filename);
            $banner->brand_banner = 'upload/product/'.$filename;        
        }

        $banner->save();

        if ($request->hasFile('brand_image')) {
            $files = $request->file('brand_image');
        
            if (!is_array($files)) { 
                $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
            }
        
            foreach ($files as $file) {
                $fileName = 'Brands_Banner_'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                $filePath = 'upload/product/' . $fileName;
        
                // ตรวจสอบประเภทไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                    $file->move(public_path('/upload/product/'), $fileName);
        
                    // ✅ บันทึกลงฐานข้อมูล
                    $BrandsBanner = new BrandsImage;
                    $BrandsBanner->bi_image         = $filePath; 
                    $BrandsBanner->FK_bi_id         = $banner->brand_id ;
                    $BrandsBanner->FK_user_id       = Auth::user()->id;
                    $BrandsBanner->FK_user_name     = Auth::user()->name;
                    $BrandsBanner->save();
                }
            }
        } 
        

        $mes = 'Success';
        $yourURL= url('/backend/product/brand');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function brand_edit($id){
        $brand = Brand::where('brand_id', $id)->first();
        $image = BrandsImage::where('FK_bi_id', $id)->get();
        return view('backend.product.brand.edit', compact('brand', 'image'));
    }

    public function brand_update(Request $request, $id){
        $status = $request->brand_status ? "show" : "hide";

        $brand = Brand::where('brand_id', $id)->first();
        
        if ($request->hasFile('brand_logo_image')!=''){
            $filename = $brand->banner_type.'_logo'.Str::random(12).".". $request->file('brand_logo_image')->getClientOriginalExtension();
            $request->file('brand_logo_image')->move(public_path().'/upload/product/', $filename);
            $data['brand_logo'] = 'upload/product/'.$filename;        
        }

        if ($request->hasFile('brand_banner_image')!=''){
            $filename = $brand->banner_type.'_banner'.Str::random(12).".". $request->file('brand_banner_image')->getClientOriginalExtension();
            $request->file('brand_banner_image')->move(public_path().'/upload/product/', $filename);
            $data['brand_banner'] = 'upload/product/'.$filename;        
        }

        $data['brand_name']         = $request->brand_name;
        $data['brand_number']       = $request->brand_number;
        $data['brand_keywords']     = $request->brand_keyword;
        $data['brand_description']  = $request->brand_description;
        $data['brand_url']          = $request->brand_url;
        $data['brand_status']       = $status;
        $data['FK_user_id']         = Auth::user()->id;
        $data['FK_user_name']       = Auth::user()->name;

        Brand::where('brand_id', $id)->update($data);

        if ($request->hasFile('brand_image')) {
            $files = $request->file('brand_image');
        
            if (!is_array($files)) { 
                $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
            }
        
            foreach ($files as $file) {
                $fileName = 'Brands_Banner_'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                $filePath = 'upload/product/' . $fileName;
        
                // ตรวจสอบประเภทไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                    $file->move(public_path('/upload/product/'), $fileName);
        
                    // ✅ บันทึกลงฐานข้อมูล
                    $BrandsBanner = new BrandsImage;
                    $BrandsBanner->bi_image         = $filePath; 
                    $BrandsBanner->FK_bi_id         = $id ;
                    $BrandsBanner->FK_user_id       = Auth::user()->id;
                    $BrandsBanner->FK_user_name     = Auth::user()->name;
                    $BrandsBanner->save();
                }
            }
        }

        $mes = 'Update Success';
        $yourURL= url('/backend/product/brand');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function brand_delete($id) {
        Brand::where('brand_id', $id)->delete();
        BrandsImage::where('FK_bi_id', $id)->delete();
    }

    public function brand_image_delete($id) {
        BrandsImage::where('bi_id', $id)->delete();
    }

    public function brand_change($id){
        $brand = Brand::where('brand_id', $id)->first();
    
        if (!$brand) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    
        $status = $brand->brand_status == "show" ? "hide" : "show";
    
        $brand->update([
            'brand_status' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);
    
        return response()->json(['success' => true, 'status' => $status]);
    }









    // Type Main
    public function product_type_index(){
        $main = CategoryMain::orderBy('cm_number', 'desc')->get();
        return view('backend.product.type.main.index', compact('main'));
    }

    public function product_type_form(){
        $main = CategoryMain::get();
        return view('backend.product.type.main.add', compact('main'));
    }

    public function product_type_create(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $request->main_status ? "show" : "hide";

            $Main               = new CategoryMain;
            $Main->cm_name      = $request->main_topic;
            $Main->cm_number    = $request->main_number;
            $Main->cm_status    = $status;
            $Main->FK_user_id   = Auth::user()->id;
            $Main->FK_user_name = Auth::user()->name;
            $Main->save();

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/product/type/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function product_type_edit($id){
        $main = CategoryMain::where('cm_id', $id)->first();
        return view('backend.product.type.main.edit', compact('id', 'main'));
    }

    public function product_type_update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $status = $request->main_status ? "show" : "hide";

            $Main['cm_name']      = $request->main_topic;
            $Main['cm_number']    = $request->main_number;
            $Main['cm_status']    = $status;
            $Main['FK_user_id']   = Auth::user()->id;
            $Main['FK_user_name'] = Auth::user()->name;
            CategoryMain::where('cm_id', $id)->update($Main);

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/product/type/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function product_type_delete($id) {
        CategoryMain::where('cm_id', $id)->delete();
        CategorySub::where('FK_category_main', $id)->delete();
        CategoryThird::where('FK_category_main', $id)->delete();
    }

    public function product_type_change($id) {
        $Main = CategoryMain::where('cm_id', $id)->first();
    
        if (!$Main) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    
        $status = $Main->cm_status == "show" ? "hide" : "show";
    
        $Main->update([
            'cm_status' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);
    
        return response()->json(['success' => true, 'status' => $status]);
    }

    








    // Type sub
    public function product_type_sub_index($id){
        $main = CategoryMain::where('cm_id', $id)->first();
        $sub = CategorySub::where('FK_category_main', $id)->orderBy('cs_number', 'asc')->get();
        $third = CategoryThird::where('FK_category_main', $id)->orderBy('ct_number', 'asc')->get();
        return view('backend.product.type.sub.index', compact('id', 'main', 'sub', 'third'));
    }

    public function product_type_sub_form($id){
        $main = CategoryMain::where('cm_id', $id)->first();
        $sub = CategorySub::where('FK_category_main', $id)->get();
        return view('backend.product.type.sub.add', compact('id', 'main', 'sub'));
    }

    public function product_type_sub_create(Request $request, $id)
    {
        // dd($id, $request);
        DB::beginTransaction();
        try {
            $status = $request->sub_status ? "show" : "hide";

            $Sub                    = new CategorySub;
            $Sub->cs_name           = $request->sub_topic;
            $Sub->cs_number         = $request->sub_number;
            $Sub->FK_category_main  = $id;
            $Sub->cs_status         = $status;
            $Sub->FK_user_id        = Auth::user()->id;
            $Sub->FK_user_name      = Auth::user()->name;
            $Sub->save();

            foreach ($request->type_sub_topic as $index => $type_sub_topic){
                $type_sub_number = $request->type_sub_number[$index] ?? null;
                $type_sub_status = $request->type_sub_status[$index] ?? null;
                $status = $type_sub_status ? "show" : "hide";
    
                $categoryThird                      = new CategoryThird();
                $categoryThird->ct_name             = $type_sub_topic;
                $categoryThird->ct_number           = $type_sub_number;
                $categoryThird->FK_category_main    = $id;
                $categoryThird->FK_category_sub     = $Sub->cs_id;
                $categoryThird->ct_status           = $status;
                $categoryThird->FK_user_id          = Auth::user()->id;
                $categoryThird->FK_user_name        = Auth::user()->name;
                $categoryThird->save();
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/product/type/sub/'.$id);
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function product_type_sub_edit($type, $id){
        $main = CategoryMain::where('cm_id', $type)->first();
        $sub = CategorySub::where('cs_id', $id)->first();
        $third = CategoryThird::where('FK_category_sub', $id)->orderBy('ct_number', 'asc')->get();
        return view('backend.product.type.sub.edit', compact('type', 'id', 'main', 'sub', 'third'));
    }

    public function product_type_sub_update(Request $request, $type, $id)
    {
        // dd($id, $request);
        DB::beginTransaction();
        try {
            $status = $request->sub_status ? "show" : "hide";

            $Sub['cs_name']           = $request->sub_topic;
            $Sub['cs_number']         = $request->sub_number;
            $Sub['FK_category_main']  = $type;
            $Sub['cs_status']         = $status;
            $Sub['FK_user_id']        = Auth::user()->id;
            $Sub['FK_user_name']      = Auth::user()->name;
            CategorySub::where('cs_id', $id)->update($Sub);

            foreach ($request->type_sub_topic as $index => $type_sub_topic){
                $type_sub_id = $request->type_sub_id[$index] ?? null;
                $type_sub_number = $request->type_sub_number[$index] ?? null;
                $type_sub_status = $request->type_sub_status[$index] ?? null;
                $status = $type_sub_status ? "show" : "hide";
    
                if($type_sub_id){
                    $categoryThirdUpdate['ct_name']             = $type_sub_topic;
                    $categoryThirdUpdate['ct_number']           = $type_sub_number;
                    $categoryThirdUpdate['FK_category_main']    = $type;
                    $categoryThirdUpdate['FK_category_sub']     = $id;
                    $categoryThirdUpdate['ct_status']           = $status;
                    $categoryThirdUpdate['FK_user_id']          = Auth::user()->id;
                    $categoryThirdUpdate['FK_user_name']        = Auth::user()->name;
                    CategoryThird::where('ct_id', $type_sub_id)->update($categoryThirdUpdate);
                }else{
                    $categoryThird                      = new CategoryThird();
                    $categoryThird->ct_name             = $type_sub_topic;
                    $categoryThird->ct_number           = $type_sub_number;
                    $categoryThird->FK_category_main    = $type;
                    $categoryThird->FK_category_sub     = $id;
                    $categoryThird->ct_status           = $status;
                    $categoryThird->FK_user_id          = Auth::user()->id;
                    $categoryThird->FK_user_name        = Auth::user()->name;
                    $categoryThird->save();
                }
            }

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/product/type/sub/'.$type);
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function product_type_third_delete($id){
        CategoryThird::where('ct_id', $id)->delete();
    }

    public function product_type_sub_change($id){
        $Main = CategorySub::where('cs_id', $id)->first();
    
        if (!$Main) {
            return response()->json(['error' => 'Banner not found'], 404);
        }
    
        $status = $Main->cm_status == "show" ? "hide" : "show";
    
        $Main->update([
            'cs_status' => $status,
            'FK_user_id' => Auth::id(),
            'FK_user_name' => Auth::user()->name
        ]);
    
        return response()->json(['success' => true, 'status' => $status]);
    }

    public function product_type_sub_delete($id){
        CategorySub::where('cs_id', $id)->delete();
        CategoryThird::where('FK_category_sub', $id)->delete();
    }









    
    public function catalog_index(){
        $catalog = Catalog::orderBy('created_at', 'desc')->get();
        return view('backend.catalog.index', compact('catalog'));
    }

    public function catalog_form(){
        return view('backend.catalog.add');
    }

    public function catalog_create(Request $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $catalog                    = new Catalog;
            $catalog->FK_user_id        = Auth::user()->id;
            $catalog->FK_user_name      = Auth::user()->name;

            if ($request->hasFile('file_catalog')!=''){
                $filename = 'catalog_'.Str::random(12).".". $request->file('file_catalog')->getClientOriginalExtension();
                $request->file('file_catalog')->move(public_path().'/upload/catalog/', $filename);
                $catalog->catalog_pdf = 'upload/catalog/'.$filename;        
            }

            $catalog->save();

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/catalog/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function catalog_edit($id){
        $catalog = Catalog::where('catalog_id', $id)->first();
        return view('backend.catalog.edit', compact('catalog', 'id'));
    }

    public function catalog_update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $catalog['FK_user_id']        = Auth::user()->id;
            $catalog['FK_user_name']      = Auth::user()->name;

            if ($request->hasFile('file_catalog')!=''){
                $filename = 'catalog_'.Str::random(12).".". $request->file('file_catalog')->getClientOriginalExtension();
                $request->file('file_catalog')->move(public_path().'/upload/catalog/', $filename);
                $catalog['catalog_pdf'] = 'upload/catalog/'.$filename;        
            }

            Catalog::where('catalog_id', $id)->update($catalog);

            DB::commit();

            $mes = 'Success';
            $yourURL = url('/backend/catalog/');
            echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function catalog_delete($id)
    {
        Catalog::where('catalog_id', $id)->delete();
    }
    









    public function ajax_sub_category(Request $request){
        $Sub = CategorySub::where('FK_category_main',$request->product_type_main)
            ->orderBy('cs_number', 'asc')->where('cs_status', 'show')->get();
        $html = '<option value="" hidden>กรุณาเลือก</option>';
        if(!empty($Sub)){
            foreach($Sub as $_data){
                $html .= '<option value="'.$_data->cs_id.'">'.$_data->cs_name.'</option>';
            }
        }
        $data["html"] = $html;
        return json_encode($data);
    }

    public function ajax_third_category(Request $request){
        $third = CategoryThird::where('FK_category_sub',$request->product_sub)
            ->orderBy('ct_number', 'asc')->where('ct_status', 'show')->get();
        $html = '<option value="" hidden>กรุณาเลือก</option>';
        if(!empty($third)){
            foreach($third as $_data){
                $html .= '<option value="'.$_data->ct_id.'">'.$_data->ct_name.'</option>';
            }
        }
        $data["html"] = $html;
        return json_encode($data);
    }
}
