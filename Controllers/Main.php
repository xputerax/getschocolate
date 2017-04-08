<?php
use \Illuminate\Database\Eloquent\Model;

namespace Controllers;

class Main extends Controller
{
    
    public function afterRoute()
    {
        echo \Template::instance()->render('frontend.php');
    }
    
    public function index()
    {
        $products = \Models\Product::all();
        
        $this->base->mset([
            'title' => 'Home',
            'content' => 'main.php',
            'products' => $products
        ]);
    }
    
    public function products($f3, $param)
    {
        
        if(isset($param['product_id'])){
            
            $product = \Models\Product::find($param['product_id']);
            
            if(!$product){
                $this->base->error(404);
            }
            
            $this->base->mset([
                'title' => 'View product: '.$product->name,
                'content' => 'product.php',
                'product' => $product
                
            ]);
            
        } else {
            
            $products = new \Models\Product;
            $paginator = new \Kilte\Pagination\Pagination($products->count(), $this->page, $this->per_page);
            $products = $products->limit($paginator->limit())->offset($paginator->offset())->get();
            $pages = $paginator->build();
            
            $this->base->mset([
                'title' => 'Products',
                'content' => 'products.php',
                'products' => $products,
                'pages' => $pages
            ]);
            
            
        }
    }
    
    public function categories($f3, $param)
    {
        
        if(isset($param['category_id'])){
            
            $category = \Models\Category::find($param['category_id']);
            
            if(!$category){
                $this->base->error(404);
            }
            
            $products = \Models\Product::where('category_id', $param['category_id']);            
            $paginator = new \Kilte\Pagination\Pagination($products->count(), $this->page, $this->per_page);
            $products = $products->limit($paginator->limit())->offset($paginator->offset())->get();
            $pages = $paginator->build();
            
            $this->base->mset([
                'title' => 'Category: '.$category->name,
                'content' => 'products.php',
                'category' => $category,
                'products' => $products,
                'pages' => $pages
            ]);
            
        } else {
            
            $categories = new \Models\Category;
            $paginator = new \Kilte\Pagination\Pagination($categories->count(), $this->page, $this->per_page);
            $categories = $categories->limit($paginator->limit())->offset($paginator->offset())->get();
            $pages = $paginator->build();
            
            $this->base->mset([
                'title' => 'Categories',
                'content' => 'categories.php',
                'categories' => $categories,
                'pages' => $pages
                
            ]);
            
            
        }
    }
    
}