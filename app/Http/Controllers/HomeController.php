<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserManual;
use App\Models\Video;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class HomeController extends Controller
{
    // Main landing page with optional slug
    public function index($slug = null)
    {
        $products = Product::with(['manuals', 'videos'])->get();
        $selectedProduct = null;

        if ($slug) {
            $selectedProduct = Product::with(['manuals', 'videos'])
                ->where('page_slug', $slug)
                ->where('status', 1)
                ->first();
        }

        return view('index', compact('products', 'selectedProduct'));
    }

    // Product search
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with(['manuals', 'videos'])
            ->where('name', 'LIKE', "%{$query}%")
            ->get();

        return view('partials.product-section', compact('products'));
    }

    // ✅ Updated Excel import method
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return back()->with('success', 'Excel data imported successfully!');
    }

    // AJAX loader for manual/video sections by slug
    public function loadProductSection($slug)
    {
        $product = Product::with(['manuals', 'videos'])
            ->where('page_slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('partials.manual-section', compact('product'));
    }
}
