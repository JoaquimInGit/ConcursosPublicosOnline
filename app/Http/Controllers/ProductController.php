<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateProductRequest;
//use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('products.index');
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $product = new Product();
        $product->loadDefaultValues();
        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateForm($request);

        if(($model = Product::create($validatedAttributes)) ) {
            //flash(Product saved successfully.');
            //Flash::success('Product saved successfully.');
            return redirect(route('products.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified Product.
     *
     * @param  Product  $product
     * @return Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  Request  $request
     * @param  Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedAttributes = $this->validateForm($request, $product);
        $product->fill($validatedAttributes);
        if($product->save()) {
            //flash('Product updated successfully.');
            //Flash::success('Product updated successfully.');
            return redirect(route('products.show', $product));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified Product from storage.
      *
      * @param  \App\Models\Product  $product
      * @return Response
      */
    public function destroy(Product $product)
    {
        $product->delete();
        //Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, Product $model = null): array
    {

        $validate_array = Product::$rules;

        return $request->validate($validate_array, [], Product::attributeLabels());
    }
}
