<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent 
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    protected $primaryKey = '_id';

    public function getAllProducts(){
        return Product::get();
    }

    public function getBestSellers(){
        // return Product
        // ::where('nb_sold', '>', '4.7')
        // ->get();
        return Product
        ::where('nb_sold', '>', '1000')
        ->get();
    }

    public function testquery(){
        // return Product
        // ::where('nb_sold', '>', 1000)
        // ->get();

        // return Product
        // ::orderBy('price', 'desc')
        // ->get();

        // return Product
        // ::max('price');

        return Product
        ::get(['reviews']);
    }

}