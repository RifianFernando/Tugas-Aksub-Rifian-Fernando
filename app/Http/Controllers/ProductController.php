<?php

namespace App\Http\Controllers;

use App\Service\ProductService;//ini buat ngeimport class ProductService
use Exception;//ini yang diperlukan untuk menangkap error dari ProductService
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Auth\Events\Validated;

class ProductController extends Controller
{
    // protected $productService;
    // public function __construct(ProductService $productRepository)
    // {
    //     $this->productRepository = $productRepository;
    // }

    // /**
    //  * Display a listing of the resource.
    //  * 
    //  * @return \Illuminate\Http\Response
    //  */

    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function index()
    {
        $products = $this->productRepository->getAll();
        //dd($products[0]->category);

        return view('index', compact('products'));
    }

    public function addProduct()
    {
        $categories = $this->productRepository->getAllCategories();

        return view('add-product', compact('categories'));
    }

    public function addNewProduct(Request $request)
    {
        $validate = $this->productRepository->validate($request);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        
        $this->productRepository->create($request);

        return redirect(route('index'));
    }

    public function editProduct($id)
    {
        $categories = $this->productRepository->getAllCategories();
        $product = $this->productRepository->getById($id);

        return view('edit-product', compact('categories', 'product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $validate = $this->productRepository->validate($request);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $this->productRepository->update($request, $id);

        return redirect(route('index'));
    }

    public function deleteProduct($id){
        $product = $this->productRepository->getById($id);

        $product->delete();

        return redirect(route('index'));
    }
}
