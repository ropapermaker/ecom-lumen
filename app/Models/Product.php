<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

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

    public function testquery()
    {
        // return Product
        // ::where('nb_sold', '>', 1000)
        // ->get();

        // return Product
        // ::orderBy('price', 'desc')
        // ->get();

        // return Product
        // ::max('price');

        return Product
            ::take(1)
            ->get(['reviews']);
    }
}
