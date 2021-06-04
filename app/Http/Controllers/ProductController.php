<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts(Product $products)
    {
        return $products->getAllProducts();
    }

    public function getBestSellers(Product $products){
        return $products->getBestSellers();
    }

    public function testquery(Product $products, Request $request){
        return $products->testquery($request);
    }

    public function getBestDeals(Product $products){
        return $products->getBestDeals();
    }

    public function getNewProducts(Product $products){
        return $products->getNewProducts();
    }

    public function getCustomerReviews(Product $products){
        return $products->getCustomerReviews();
    }

    public function getCategories(Product $products){
        return $products->getCategories();
    }

    public function getSearch(Product $products, Request $request){
        return $products->getSearch($request);
    }

    public function getProductById(Product $products, Request $request){
        return $products->getProductById($request);
    }
}
