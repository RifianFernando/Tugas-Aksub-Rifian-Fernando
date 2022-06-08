<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;

class ProductController extends Controller
{
    //
    public function index()
    {
        return view('index', ['products' => Products::all()]);
    }

    public function addProduct()
    {
        return view('add-product');
    }

    public function addNewProduct(Request $request){
        $validate = validator()->make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'details' => 'required|numeric',
        ]);


        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Products::create([
            'name' => $request->title,
            'quantity' => $request->details,
        ]);


        return redirect(route('index'));
    }

    public function editProduct($id)
    {
        $product = Products::find($id);

        return view('edit-product', ['product' => $product]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Products::find($id);

        $validate = validator()->make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'details' => 'required|numeric',
        ]);


        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $product->update([
            'name' => $request->title,
            'quantity' => $request->details,
        ]);

        return redirect(route('index'));
    }

    public function deleteProduct($id){
        $product = Products::find($id);

        $product->delete();

        return redirect(route('index'));
    }
}
