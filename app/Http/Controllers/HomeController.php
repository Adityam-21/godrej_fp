<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserManual;
use App\Models\Video;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Models\CustomerSupport;
use App\Models\Cms;

class HomeController extends Controller
{

    public function index($category, $subcategory)
    {
        $products = Product::where('subcategory', $subcategory)->where('status', 1)->firstOrFail();
        $contacts = CustomerSupport::where('status', 1)->orderBy('id')->get();
        $manuals = UserManual::where('product_id', $products->id)->where('status', 1)->get();
        $videos = Video::where('product_id', $products->id)->where('status', 1)->get();
        $cmsSections = Cms::where('status', 1)->orderBy('section_order')->get();
        return view('index', [
            'contacts' => $contacts,
            'manuals' => $manuals,
            'videos' => $videos,
            'cmsSections' => $cmsSections,
        ]);
    }

    public function show($slug)
    {
        $contacts = CustomerSupport::where('status', 1)->orderBy('id')->get();
        return view('show', compact('contacts'));
    }
}
