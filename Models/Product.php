<?php
namespace Models;

class Product extends Model //Model
{
    public $timestamps = false;
    
    /*public function categories()
    {
        return $this->hasMany('\Models\Category', 'id', 'category_id');
    }*/
    
    public function category()
    {
        return $this->hasOne('\Models\Category', 'id', 'category_id');
    }

    public function thumbnail()
    {
        return $this->hasOne('\Models\ProductThumbnail', 'product_id', 'id');
    }
    
    public function images()
    {
        return $this->hasMany('\Models\ProductImage', 'product_id', 'id');
    }
    
}