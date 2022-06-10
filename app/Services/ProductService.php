<?php

namespace App\Service;

use App\Repositories\productRepository;

class ProductService
{
    protected $ProductService;

    public function __construct(productRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }
}