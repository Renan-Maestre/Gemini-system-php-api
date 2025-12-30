<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;


class ProductController extends Controller
{
    //    Create
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $product = Product::create($data);

        return new ProductResource($product);

    }

//    List all
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

//    List by id
    public function show($id)
    {

        return new ProductResource(Product::findOrFail($id));
    }

//    Update
    public function update(UpdateProductRequest $request, $id)
    {
        $produto = Product::FindOrFail($id);

        Gate::authorize('update', $produto);

        $produto->update($request->validated());

        return new ProductResource($produto);


    }

//    Delete
    public function destroy($id)
    {
        $produto = Product::FindOrFail($id);
        $produto->delete();
        return "Produto deletado";
    }
}
