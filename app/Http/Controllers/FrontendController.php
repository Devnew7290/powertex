<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Str;
use DB;
use App\Models\banner;
use App\Models\BrandsImage;
use App\Models\AboutUsIndex;
use App\Models\Brand;
use App\Models\WhyUs;
use App\Models\Guarantee;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\CategoryMain;
use App\Models\CategorySub;
use App\Models\CategoryThird;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Promotions;
use App\Models\Dealers;
use App\Models\Provinces;
use App\Models\Amphures;
use App\Models\Districts;
use App\Models\Services;
use App\Models\ServiceWarranty;
use App\Models\Warranties;
use App\Models\Contact;

class FrontendController extends Controller
{
    public function index(){
        $dateFull = new DateTime();
        $date = $dateFull->format('Y-m-d');

        $banner = banner::where('banner_show', 'show')
            ->orderByRaw("CASE WHEN banner_number IS NULL OR banner_number = '' THEN 1 ELSE 0 END")
            ->orderBy('banner_number', 'asc')->orderBy('updated_at', 'desc')->get();

        $about = AboutUsIndex::first();
        $brand = Brand::get();
        $whyUs = WhyUs::first();
        $guarantee = Guarantee::orderByRaw("CASE WHEN guarantees_number IS NULL OR guarantees_number = '' THEN 1 ELSE 0 END")
            ->orderBy('guarantees_number', 'asc')->orderBy('updated_at', 'desc')->get();

        $article = News::where('news_type', 'article')->where('news_status', 'show')->orderBy('news_date', 'desc')->limit(6)->get();
        $news = News::where('news_type', 'news')->where('news_status', 'show')->orderBy('news_date', 'desc')->limit(3)->get();
        $promotion = Promotions::where('promotion_status', 'show')
            ->orderByRaw("CASE WHEN promotion_number IS NULL OR promotion_number = '' THEN 1 ELSE 0 END")->orderBy('promotion_number', 'asc')
            ->orderBy('updated_at', 'desc')->limit(3)->get();
            
        $category = CategoryMain::where('cm_status', 'show')->orderby('cm_number','asc')->orderby('updated_at','desc')->limit(5)->get();
        $productAll = Product::whereNotNull('products_index')->where('products_status', 'show')->orderBy('products_index', 'asc')->get();
        $productImg = ProductImage::get();
        $productNew = Product::where('products_status', 'show')->orderBy('created_at', 'desc')->limit(12)->get();

        return view('frontend.index', compact('banner', 'about', 'brand', 'whyUs', 'guarantee', 'article', 'news', 'promotion', 'category', 'productAll', 'productImg',
            'productNew'));
    }

    public function aboutUs(){
        $aboutUs = News::where('news_type', 'aboutUs')->first();
        $image = NewsImage::where('FK_news_id', $aboutUs->news_id)->get();
        return view('frontend.about', compact('aboutUs', 'image'));
    }

    public function news($type){
        if($type == 'article'){
            $article = News::where('news_type', 'article')->where('news_status', 'show')->orderBy('news_date', 'desc')
            ->paginate(12);
            // ->get();
            return view('frontend.articles', compact('article'));
        }else{
            $news = News::where('news_type', 'news')->where('news_status', 'show')->orderBy('news_date', 'desc')
            ->paginate(6);
            // ->get();
            $promotion = Promotions::where('promotion_status', 'show')->orderByRaw("CASE WHEN promotion_number IS NULL OR promotion_number = '' THEN 1 ELSE 0 END")
                ->orderBy('promotion_number', 'asc')
                ->orderBy('updated_at', 'desc')
                ->paginate(5);
                // ->get();
            return view('frontend.news-promotions', compact('news', 'promotion'));
        }
    }

    public function newsDetail($type, $id){
        if($type == 'promotion'){
            $data = Promotions::where('promotion_id', $id)->first();
            return view('frontend.promotion-detail', compact('data'));
        }else{
            $data = News::where('news_id', $id)->first();
            $image = NewsImage::where('FK_news_id', $id)->get();
            return view('frontend.detail', compact('data', 'image'));
        }
    }

    public function promotion_detail($id, $text_url){
        // dd($id, $text_url);
        $data = News::where('news_id', $id)->first();
        return view('frontend.promotion-detail', compact('data'));
    }

    public function product(Request $request, $id, $textUrl)
    {
        $brand = $request->query('brand');

        $mainArray = $request->query('main') ? explode(',', $request->query('main')) : [];
        $subArray = $request->query('sub') ? explode(',', $request->query('sub')) : [];
        $thirdArray = $request->query('third') ? explode(',', $request->query('third')) : [];

        // ดึง sub ที่สัมพันธ์กับ main ที่เลือก
        $subGroups = CategorySub::whereIn('cs_id', $subArray)
            ->get()
            ->groupBy('FK_category_main');

        // ดึง third ที่สัมพันธ์กับ sub ที่เลือก
        $thirdGroups = CategoryThird::whereIn('ct_id', $thirdArray)
            ->get()
            ->groupBy('FK_category_sub');

        $product = Product::where('FK_brand', $id);

        // เริ่มกรองแบบจับคู่ตามความสัมพันธ์
        if (!empty($mainArray)) {
            $product->where(function ($query) use ($mainArray, $subGroups, $thirdGroups) {
                foreach ($mainArray as $mainId) {
                    if (isset($subGroups[$mainId])) {
                        foreach ($subGroups[$mainId] as $subItem) {
                            $subId = $subItem->cs_id;

                            if (isset($thirdGroups[$subId])) {
                                // มี third → กรองสามชั้น
                                $query->orWhere(function ($q) use ($mainId, $subId, $thirdGroups) {
                                    $q->where('FK_category_mains', $mainId)
                                    ->where('FK_category_sub', $subId)
                                    ->whereIn('FK_category_third', $thirdGroups[$subId]->pluck('ct_id')->toArray());
                                });
                            } else {
                                // มีแค่ main + sub
                                $query->orWhere(function ($q) use ($mainId, $subId) {
                                    $q->where('FK_category_mains', $mainId)
                                    ->where('FK_category_sub', $subId);
                                });
                            }
                        }
                    } else {
                        // แค่ main อย่างเดียว
                        $query->orWhere('FK_category_mains', $mainId);
                    }
                }
            });
        }

        $product = $product->orderByRaw("products_name COLLATE utf8mb4_unicode_ci DESC")
            ->paginate(12);
            // ->get();
        // $product = $product->orderBy('products_code', 'DESC')->get();

        // dd($product);

        $brand = Brand::where('brand_id', $id)->first();
        $main = CategoryMain::where('cm_status','show')->orderby('cm_number', 'asc')->get();
        $Sub = CategorySub::where('cs_status','show')->orderby('cs_number', 'asc')->get();
        $Third = CategoryThird::where('ct_status','show')->orderby('ct_number', 'asc')->get();
        $image = ProductImage::get();
        $imageBrand = BrandsImage::where('FK_bi_id', $id)->get();
        return view('frontend.products', compact('brand', 'main', 'Sub', 'Third', 'product', 'image', 'imageBrand', 'mainArray', 'subArray', 'thirdArray'));
    }

    public function product_new_promotion(Request $request, $url)
    {
        $dateFull = new DateTime();
        $date = $dateFull->format('Y-m-d');
        $month = $dateFull->format('Y-m');
        // dd($month);

        $mainArray = $request->query('main') ? explode(',', $request->query('main')) : [];
        $subArray = $request->query('sub') ? explode(',', $request->query('sub')) : [];
        $thirdArray = $request->query('third') ? explode(',', $request->query('third')) : [];
        $searchProduct = $request->search_product;
        // dd($url, $searchProduct, $request);

        // ดึง sub ที่สัมพันธ์กับ main ที่เลือก
        $subGroups = CategorySub::whereIn('cs_id', $subArray)
            ->get()
            ->groupBy('FK_category_main');

        // ดึง third ที่สัมพันธ์กับ sub ที่เลือก
        $thirdGroups = CategoryThird::whereIn('ct_id', $thirdArray)
            ->get()
            ->groupBy('FK_category_sub');

        if($url == 'promotion'){
            $promotions = DB::table('promotions')
                ->where('promotion_status', 'show')
                ->where('promotion_date_start', '<=', $date)
                ->where('promotion_date_end', '>=', $date)
                ->pluck('promotion_product'); // ได้มาเป็น Collection ของ string เช่น ["2,4,8", "10,12"]

            $productIds = [];

            foreach ($promotions as $ids) {
                $productIds = array_merge($productIds, explode(',', $ids));
            }

            // ลบค่าซ้ำออก
            $productIds = array_unique($productIds);

            // ดึง product ที่เกี่ยวข้อง
            $product = DB::table('products')
                ->whereIn('products_id', $productIds);
        }else{
            $product = DB::table('products');
        }

        // เริ่มกรองแบบจับคู่ตามความสัมพันธ์
        if (!empty($mainArray)) {
            $product->where(function ($query) use ($mainArray, $subGroups, $thirdGroups) {
                foreach ($mainArray as $mainId) {
                    if (isset($subGroups[$mainId])) {
                        foreach ($subGroups[$mainId] as $subItem) {
                            $subId = $subItem->cs_id;

                            if (isset($thirdGroups[$subId])) {
                                // มี third → กรองสามชั้น
                                $query->orWhere(function ($q) use ($mainId, $subId, $thirdGroups) {
                                    $q->where('FK_category_mains', $mainId)
                                    ->where('FK_category_sub', $subId)
                                    ->whereIn('FK_category_third', $thirdGroups[$subId]->pluck('ct_id')->toArray());
                                });
                            } else {
                                // มีแค่ main + sub
                                $query->orWhere(function ($q) use ($mainId, $subId) {
                                    $q->where('FK_category_mains', $mainId)
                                    ->where('FK_category_sub', $subId);
                                });
                            }
                        }
                    } else {
                        // แค่ main อย่างเดียว
                        $query->orWhere('FK_category_mains', $mainId);
                    }
                }
            });
        }

        if($searchProduct){
            if($url == 'promotion'){
                $product = $product->orderByRaw("products_name COLLATE utf8mb4_unicode_ci DESC")
                    ->where(function ($query) use ($searchProduct) {
                        $query->where('products_name', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_code', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_price_full', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_note', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_quantity', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_detail', 'like', '%'.$searchProduct.'%');
                    })
                    ->paginate(12);
            }else{
                $product = $product->orderByRaw("products_name COLLATE utf8mb4_unicode_ci DESC")->where('created_at', 'like', $month.'%')
                    ->where(function ($query) use ($searchProduct) {
                        $query->where('products_name', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_code', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_price_full', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_note', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_quantity', 'like', '%'.$searchProduct.'%')
                            ->orWhere('products_detail', 'like', '%'.$searchProduct.'%');
                    })
                    ->paginate(12);
            }
        }else{
            if($url == 'promotion'){
                $product = $product->orderByRaw("products_name COLLATE utf8mb4_unicode_ci DESC")->paginate(12);
            }else{
                $product = $product->orderByRaw("products_name COLLATE utf8mb4_unicode_ci DESC")->where('created_at', 'like', $month.'%')
                    ->paginate(12);
            }
        }
        $brand = Brand::get();
        $main = CategoryMain::where('cm_status','show')->orderby('cm_number', 'asc')->get();
        $Sub = CategorySub::where('cs_status','show')->orderby('cs_number', 'asc')->get();
        $Third = CategoryThird::where('ct_status','show')->orderby('ct_number', 'asc')->get();
        $image = ProductImage::get();
        $imageBrand = BrandsImage::get();
        return view('frontend.products_new_promotion', compact('brand', 'main', 'Sub', 'Third', 'product', 'image', 'imageBrand', 'mainArray', 'subArray', 'thirdArray', 'url', 'searchProduct'));
    }

    public function product_detail($id, $textUrl){
        // dd($id, $textUrl);
        $dateFull = new DateTime();
        $date = $dateFull->format('Y-m-d');

        $product = Product::where('products_id', $id)->first();
        $image = ProductImage::where('FK_pi_product', $id)->get();
        $brand = Brand::where('brand_id', $product->FK_brand)->first();
        $category = CategoryMain::where('cm_id', $product->FK_category_mains)->first();
        $productOther = Product::where('FK_brand', $product->FK_brand)->where('FK_category_mains', $product->FK_category_mains)
            ->whereNotNull('products_index')->where('products_status', 'show')->where('products_id', '!=', $id)
            ->orderby('products_index', 'asc')->get();
            // dd($productOther);
        $imageOther = ProductImage::get();
        
        $PP = Promotions::where('promotion_status', 'show')
            ->where('promotion_date_start', '<=', $date)
            ->where('promotion_date_end', '>=', $date)
            ->where('promotion_status', 'show')
            ->whereRaw('FIND_IN_SET(?, promotion_product)', [$product->products_id])
            ->orderBy('promotion_number', 'asc')->first();
        // dd($PP);
        return view('frontend.product-detail', compact('product', 'image', 'brand', 'category', 'productOther', 'imageOther'));
    }

    public function service(){
        return view('frontend.one-stop-service');
    }

    public function service_create(Request $request){
        // dd($request);
        $service = new Services;
        $service->service_name  = $request->service_name;
        $service->service_repair    = $request->service_repair;
        $service->service_address   = $request->service_address;
        $service->service_note  = $request->service_note;
        $service->service_success   = 'received';
        $service->service_new   = 'new';
        $service->save();

        if ($request->hasFile('service_warranty')) {
            $files = $request->file('service_warranty');
        
            if (!is_array($files)) { 
                $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
            }
        
            foreach ($files as $file) {
                $fileName = 'service_warranty'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                $filePath = 'upload/one-stop-service/' . $fileName;
        
                // ตรวจสอบประเภทไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                    $file->move(public_path('/upload/one-stop-service/'), $fileName);
        
                    // ✅ บันทึกลงฐานข้อมูล
                    $serviceWarranty = new ServiceWarranty;
                    $serviceWarranty->swd_image    = $filePath; 
                    $serviceWarranty->swd_type     = 'warranty';
                    $serviceWarranty->swd_FK_id    = $service->service_id;
                    $serviceWarranty->save();
                }
            }
        }

        if ($request->hasFile('service_image_repair')) {
            $files = $request->file('service_image_repair');
        
            if (!is_array($files)) { 
                $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
            }
        
            foreach ($files as $file) {
                $fileName = 'service_repair'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                $filePath = 'upload/one-stop-service/' . $fileName;
        
                // ตรวจสอบประเภทไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                    $file->move(public_path('/upload/one-stop-service/'), $fileName);
        
                    // ✅ บันทึกลงฐานข้อมูล
                    $serviceWarranty = new ServiceWarranty;
                    $serviceWarranty->swd_image    = $filePath; 
                    $serviceWarranty->swd_type     = 'repair';
                    $serviceWarranty->swd_FK_id    = $service->service_id;
                    $serviceWarranty->save();
                }
            }
        }

        if ($request->hasFile('service_transport')) {
            $files = $request->file('service_transport');
        
            if (!is_array($files)) { 
                $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
            }
        
            foreach ($files as $file) {
                $fileName = 'service_transport'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                $filePath = 'upload/one-stop-service/' . $fileName;
        
                // ตรวจสอบประเภทไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                    $file->move(public_path('/upload/one-stop-service/'), $fileName);
        
                    // ✅ บันทึกลงฐานข้อมูล
                    $serviceWarranty = new ServiceWarranty;
                    $serviceWarranty->swd_image    = $filePath; 
                    $serviceWarranty->swd_type     = 'transport';
                    $serviceWarranty->swd_FK_id    = $service->service_id;
                    $serviceWarranty->save();
                }
            }
        }

        $mes = 'Success';
        $yourURL = url('/one-stop-service');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function distributor(Request $request){
        // dd($request);
        $proviceSearch = $request->provice;
        $aumphureSearch = $request->aumphure;
        $textSearch = $request->text;

        $dealer = Dealers::where('dealer_show', 'show')
            ->when($proviceSearch, function ($query) use ($proviceSearch) {
                return $query->where('FK_province_id', $proviceSearch);
            })
            ->when($aumphureSearch, function ($query) use ($aumphureSearch) {
                return $query->where('FK_amphures_id', $aumphureSearch);
            })
            ->when($textSearch, function ($query) use ($textSearch) {
                return $query->where(function ($q) use ($textSearch) {
                    $q->where('dealer_name', 'like', "%{$textSearch}%")
                    ->orWhere('dealer_address_code', 'like', "%{$textSearch}%")
                    ->orWhere('dealer_day_open', 'like', "%{$textSearch}%")
                    ->orWhere('dealer_time_open', 'like', "%{$textSearch}%")
                    ->orWhere('dealer_time_close', 'like', "%{$textSearch}%")
                    ->orWhere('dealer_phone', 'like', "%{$textSearch}%");
                });
            })
            ->orderBy('dealer_name', 'asc')
            ->paginate(12)->appends([
                'provice' => $request->provice,
                'aumphure' => $request->aumphure,
                'text' => $request->text,
            ]);
        $Provinces = Provinces::orderBy('name_th', 'asc')->get();
        $Amphures = Amphures::when($proviceSearch, function ($query) use ($proviceSearch) {
                return $query->where('province_id', $proviceSearch);
            })->orderBy('name_th', 'asc')->get();
        $Districts = Districts::orderBy('name_th', 'asc')->get();
        return view('frontend.distributor', compact('dealer', 'Provinces', 'Amphures', 'Districts', 'proviceSearch', 'aumphureSearch', 'textSearch'));
    }

    public function contact(){
        $contact = Contact::first();
        return view('frontend.contact', compact('contact'));
    }

    public function warranty(){
        return view('frontend.warranty');
    }

    public function warranty_create(Request $request){
        // dd($request);
        $warranty = new Warranties;
        $warranty->warranty_name            = $request->name;
        $warranty->warranty_product         = $request->product;
        $warranty->warranty_serial_number   = $request->serial_number;
        $warranty->warranty_number          = $request->warranty_number;
        $warranty->warranty_success         = 'received';
        $warranty->warranty_new             = 'new';
        $warranty->save();

        if ($request->hasFile('image_warranty')) {
            $files = $request->file('image_warranty');
        
            if (!is_array($files)) { 
                $files = [$files]; // ✅ ถ้ามีไฟล์เดียว ให้ทำเป็นอาร์เรย์
            }
        
            foreach ($files as $file) {
                $fileName = 'image_warranty'.Str::random(12) . '.' . $file->getClientOriginalExtension();
                $filePath = 'upload/one-stop-service/' . $fileName;
        
                // ตรวจสอบประเภทไฟล์
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                if (in_array(strtolower($file->getClientOriginalExtension()), $allowedTypes)) {
                    $file->move(public_path('/upload/one-stop-service/'), $fileName);
        
                    // ✅ บันทึกลงฐานข้อมูล
                    $warrantyWarranty = new ServiceWarranty;
                    $warrantyWarranty->swd_image    = $filePath; 
                    $warrantyWarranty->swd_type     = 'product';
                    $warrantyWarranty->swd_FK_id    = $warranty->warranty_id;
                    $warrantyWarranty->save();
                }
            }
        }

        $mes = 'Success';
        $yourURL = url('/warranty');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function login(){
        return view('frontend.login');
    }

    public function register(){
        return view('frontend.register');
    }

    public function member_order(){
        return view('frontend.member-order');
    }

    public function member_order_detail(){
        return view('frontend.member-order-detail');
    }

    public function member_address(){
        return view('frontend.member-address');
    }

    public function member_address_edit(){
        return view('frontend.member-address-edit');
    }

    public function member_change_password(){
        return view('frontend.member-change-password');
    }
    
}
