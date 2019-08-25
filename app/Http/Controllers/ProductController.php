<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Faker\Provider\Uuid;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'products' => Product::active()->get()
        ];

        return view('product.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = Uuid::uuid();
        $productName = $request->name;
        $productModal = intval(str_replace(',', '', $request->modal));
        $productPrice = intval(str_replace(',', '', $request->price));


        \App\Product::insert([
            'id' => $productId,
            'name' => $productName,
            'modal' => $productModal,
            'price' => $productPrice,
            'is_active' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);


        return redirect('/product');
    }

    public function detailProduct($id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = [
            'product' => $product
        ];

        return view('product.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $productName = $request->name;
        $productModal = intval(str_replace(',', '', $request->modal));
        $productPrice = intval(str_replace(',', '', $request->price));

//            update Product
        $product->update(['name' => $productName, 'modal' => $productModal, 'price' => $productPrice, 'updated_at' => Carbon::now()]);

        return redirect('/product');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->update(['is_active' => 0]);
        return redirect('/product');
    }
}
