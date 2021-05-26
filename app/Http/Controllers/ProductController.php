<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function getAllProducts(Product $products)
    {
        return $products->getAllProducts();
    }

    public function getBestSellers(Product $products){
        return $products->getBestSellers();
    }

    public function testquery(Product $products){
        return $products->testquery();
    }
}
