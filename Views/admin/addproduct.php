<include href="admin/menu.php">

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/addProduct' }}" method="post" enctype="multipart/form-data">
        
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
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control">
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
                    <label>Description</label>
                    <textarea cols="80" rows="10" name="description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        
        <div class="row">
        
            <div class="col-md-4">
                <div class="form-group">
                    <label>Image 1</label>
                    <input type="file" name="image_1" class="form-control">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>Image 2</label>
                    <input type="file" name="image_2" class="form-control">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>Image 3</label>
                    <input type="file" name="image_3" class="form-control">
                </div>
            </div>
            
        </div>
        
        <input type="submit" name="add" value="Save" class="btn btn-primary">
        
    </form>

</div>

{{ Template::instance()->render('message.php') }}
{{ Template::instance()->render('error.php') }}