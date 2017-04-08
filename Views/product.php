<form action="#" method="post">
    
    {{ Template::instance()->render('title.php') }}
    
    <div class="row">
        
        <div class="col-md-12">
        
            <check if="{{ @product.image_1 }}">
                <a href="{{ @BASE.'/assets/images/'.@product.image_1 }}">
                <img src="{{ @BASE.'/assets/images/cache/'.@product.image_1_thumb }}" class="img-responsive img-thumbnail">
                </a>
            </check>
            
            <check if="{{ @product.image_2 }}">
                <a href="{{ @BASE.'/assets/images/'.@product.image_2 }}">
                <img src="{{ @BASE.'/assets/images/cache/'.@product.image_2_thumb }}" class="img-responsive img-thumbnail">
                </a>
            </check>
            
            <check if="{{ @product.image_3 }}">
                <a href="{{ @BASE.'/assets/images/'.@product.image_3 }}">
                <img src="{{ @BASE.'/assets/images/cache/'.@product.image_3_thumb }}" class="img-responsive img-thumbnail">
                </a>
            </check>
            
        </div>
    
    </div>
    
    <br>
    
    <div class="row">
    
        <div class="col-md-12">
            
            <div class="form-group">
                
                <label for="category">Category:</label>
                <span><a href="{{ @BASE.'/categories/'.@product.category.id }}">{{ @product.category.name }}</a></span>
                <br>
                
                <label for="price">Price:</label>
                <span>RM{{ @product.price }}</span>
                <br>
                
                <label for="stock">Stock:</label>
                <span>{{ @product.stock }}</span>                
                <br>
                
                <label for="description">Description:</label>
                
                {{ @product.description }}

                <check if="{{ @product.stock }}">
                <div class="form-inline">
                <input type="number" name="quantity" id="qty" min="1" max="{{ @product.stock }}" class="form-control" value="1">
                <button type="button" name="add" id="btn_add" class="btn btn-primary">Add To Cart</button>
                </div>
                </check>
                
            </div>
            
        </div>
        
    </div>
    
    <br>
    
    <div class="row">
        <div class="col-md-12">
            <div id="alert"></div>
        </div>
    </div>
    
</form>

<script>
$(function(){
    
    var id = {{ @product.id }};
    var quantity = 0;
    
    $("#btn_add").click(function(){
        
        quantity = $("#qty").val();
        
        $.ajax({
            url: '{{ @BASE }}/api/addtocart/'+id+'/'+quantity,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    
                } else {
                    
                    alertbox += '<div class="alert alert-danger">';
                    
                }
                
                alertbox += data.message;
                
                $("#alert").html(alertbox);
                
            }
        });
        
    });
    
});
</script>