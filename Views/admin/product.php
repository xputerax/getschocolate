{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/products/'.@product.id }}" method="post" enctype="multipart/form-data">

        <div class="row">
            <div class="col-md-12">
            {{ Template::instance()->render('title.php') }}
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div id="alert"></div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ @product.name }}" class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" value="{{ @product.price }}" class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" value="{{ @product.stock }}" class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="stock">Category</label>
                    <check if="{{ @categories->count() }}">
                        
                        <select name="category_id" class="form-control">
                        
                        <repeat group="{{ @categories }}" value="{{ @category }}">
                            
                            <option value="{{ @category.id }}">{{ @category.name }}</option>
                            
                        </repeat>
                        
                        </select>
                    
                    </check>
                    
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea cols="80" rows="5" class="form-control">{{ @product.description }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="row">
        
            <div class="col-md-4">
                <check if="{{ @product.image_1 }}">
                    <true>
                        <img src="{{ @BASE.'/assets/images/cache/'.@product.image_1_thumb }}" class="img-thumbnail img-responsive"> <br>
                        <label>Remove:</label> <input type="checkbox" name="remove_image_1">
                    </true>
                </check>
                <input type="file" name="image_1" class="form-control">
            </div>

            <div class="col-md-4">
                <check if="{{ @product.image_2 }}">
                    <true>
                        <img src="{{ @BASE.'/assets/images/cache/'.@product.image_2_thumb }}" class="img-thumbnail img-responsive"> <br>
                        <label>Remove:</label> <input type="checkbox" name="remove_image_2">
                    </true>
                </check>
                <input type="file" name="image_2" class="form-control">
            </div>

            <div class="col-md-4">
                <check if="{{ @product.image_3 }}">
                    <true>
                        <img src="{{ @BASE.'/assets/images/cache/'.@product.image_3_thumb }}" class="img-thumbnail img-responsive"> <br>
                        <label>Remove:</label> <input type="checkbox" name="remove_image_3">
                    </true>
                </check>
                <input type="file" name="image_3" class="form-control">
            </div>
            
        </div>
        
        <br>
        
        <div class="row">
            <div class="col-md-1 col-xs-12">
                <div class="form-group">
                    <input type="submit" name="save" value="Save" class="btn btn-primary btn-block">
                </div>
            </div>
        </div>
            
    </form>

</div>