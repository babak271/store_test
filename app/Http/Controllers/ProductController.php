<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller implements ProductControllerInterface
{
    /**
     * Display a listing of the products.
     *
     * @return View
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'asc')->paginate(8);
        return view('welcome', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product)
    {
        $product->load('getCategories');
        return view('product.show', compact('product'));
    }
}
