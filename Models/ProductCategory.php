<?php
namespace Models;

class ProductCategory extends \Illuminate\Database\Eloquent\Model
{
    
    protected $table = 'productcategories';
    
    /*public function products()
    {
        return $this->hasMany('\Models\Product', 'id', 'product_id');
    }
    
    public function categories()
    {
        return $this->hasMany('\Models\Category', 'id', 'category_id');
    }*/
    
}