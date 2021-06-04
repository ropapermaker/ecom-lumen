<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Http\Request;

class Product extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    protected $primaryKey = '_id';

    public function getAllProducts()
    {
        return Product::get();
    }

    public function getBestSellers()
    {
        // products with highest number sold
        return Product
            ::orderBy('nb_sold', 'desc')
            ->take(3)
            ->get();
    }

    public function getBestDeals()
    {
        return Product
            ::where('nb_sold', '>', 300)
            ->orderBy('review', 'desc')
            ->take(3)
            ->get();
    }

    public function getNewProducts()
    {
        return Product
            ::where('nb_sold', '<', 50)
            ->orderBy('nb_sold', 'desc')
            ->take(4)
            ->get();
    }

    public function getCustomerReviews()
    {
        return Product
            ::take(1)
            ->get(['reviews']);
    }

    public function getCategories()
    {
        return Product
            ::distinct()
            ->get(['category']);
    }

    public function getSearch(Request $request)
    {
        $search = $request->search;
        $category = $request->category;
        $brand = $request->brand;
        $rating = (float) $request->rating;
        $priceMin = (float) $request->priceMin;
        $priceMax  = (float) $request->priceMax;

        // if search is null
        if (!$search){
            $search = '%';
        }
        else{
            //all products which contain the words in the search form
            $searchArray = explode(' ', $search);
            $search = join('%', $searchArray);
            $search = '%' . $search . '%';
        }

        //if category is null
        if (!$category){
            $category = '%';
        }
        else{
            $category = '%' . $category . '%';
        }

        //if rating is null
        if (!$rating){
            $rating = 0;
        }

        //if priceMin priceMax are null
        if (!$priceMin){
            $priceMin = 0;
        }

        //if rating is null
        if (!$priceMax){
            $priceMax = 9999999999;
        }
 
        //if brand is null
        if (!$brand){
            $product = Product
            ::where('title', 'like', $search)
            ->where('category', 'like', $category)
            ->where('review', '>=', $rating)
            ->where('price', '>=', $priceMin)
            ->where('price', '<=', $priceMax)
            ->paginate(10);
        }
        else{
            $product = Product
            ::where('title', 'like', $search)
            ->where('category', 'like', $category)
            ->where('specifications.Brand Name:', 'like', $brand)
            ->where('review', '>=', $rating)
            ->where('price', '>=', $priceMin)
            ->where('price', '<=', $priceMax)
            ->paginate(10);
        }
        // returns product with specified parameters, if they are null they are not searched
        return $product;
    }

    public function getProductById(Request $request){
        $id = $request->id;

        return Product
                ::where('_id', $id)
                ->get();
    }

    public function testquery(Request $request)
    {

    }
}
