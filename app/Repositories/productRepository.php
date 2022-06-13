<?php

namespace App\Repositories;

use App\Models\category;
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

    public function getAllCategories()
    {
        $getAllCategories = category::all();

        return $getAllCategories;
    }
    
    public function create($request){
        Products::create([
            'name' => $request->title,
            'quantity' => $request->details,
            'category_id' => $request->category_id,
        ]);

        return;
    }

    public function update($request, $id){
        $product = $this->getById($id);
        
        $product->update([
            'name' => $request->title,
            'quantity' => $request->details,
            'category_id' => $request->category_id,
        ]);

        return;
    }

    public function validate($request){
        $validate = validator()->make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'details' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);

        return $validate;
    }

    public function search($request){
        $search = Products::where('name', 'like', '%'.$request->search.'%')->get();

        return $search;
    }

    public function getSpesificCategories($categoryValue){
        $getSpesificCategories = Products::where('category_id', $categoryValue)->get();

        return $getSpesificCategories;
    }
}