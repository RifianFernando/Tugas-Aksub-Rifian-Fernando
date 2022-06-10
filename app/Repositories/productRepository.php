<?php

namespace App\Repositories;
use App\Models\Products;


class ProductRepository
{
    // protected $product;

    // public function __construct(Products $product)
    // {
    //     $this->product = $product;
    // }

    public function getAll()
    {
        $getall = Products::orderBy('name')->get();

        return $getall;
    }

    public function getById($id)
    {
        $getById = Products::find($id);

        return $getById;
    }
    
    public function create($request){
        Products::create([
            'name' => $request->title,
            'quantity' => $request->details,
        ]);

        return;
    }

    public function update($request, $id){
        $product = $this->getById($id);
        
        $product->update([
            'name' => $request->title,
            'quantity' => $request->details,
        ]);

        return;
    }

    public function validate($request){
        $validate = validator()->make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'details' => 'required|numeric',
        ]);

        return $validate;
    }
}