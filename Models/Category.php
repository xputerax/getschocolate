<?php
namespace Models;

class Category extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = ['name'];
    
    public function products()
    {
        return $this->hasMany('\Models\Product', 'category_id', 'id');
    }

}