<div id="alert"></div>

<div class="row">
    
    <repeat group="{{ @products }}" value="{{ @product }}">
    <div class="col-md-3">
        
        <table class="table table-condensed" id="{{ @product.id }}">
        
            <thead>
                <a href="{{ @BASE.'/products/'.@product.id }}">
                
                <check if="{{ @product.image_1_thumb }}">
                    
                    <true><img src="{{ @BASE.'/assets/images/cache/'.@product.image_1_thumb }}" class="img-thumbnail"></true>
                    
                    <false><img src="{{ @BASE.'/assets/images/placeholder.png' }}" class="img-thumbnail" height="200px" width="200px"></false>
                    
                </check>
                
                <br><br> </a>
            </thead>
            
            <tbody>
                <tr> <td>Name:</td> <td>{{ @product.name }}</td> </tr>
                <tr> <td>Price:</td> <td>RM{{ @product.price }}</td> </tr>
                <tr> <td>Stock:</td> <td><span id="{{ 'stock_'.@product.id }}">{{ @product.stock }}</td> </tr>
                
                <check if="{{ @product.stock == '0' }}">
                
                    <true>
                        <tr>
                            <td>Qty:</td>
                            <td><input type="text" name="quantity" value="0" class="form-control" disabled></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                            <button type="button" class="btn btn-primary btn-block" disabled>Add</button>
                            </td>
                        </tr>
                    </true>
                    
                    <false>
                        <tr> 
                            <td>Qty:</td> 
                            <td>
                            <input type="text" name="quantity" size="1" class="form-control" value="1" id="{{ 'input_quantity_'.@product.id }}">
                            </td> 
                        </tr>
                        
                        <tr> 
                            <td colspan="2">
                            <button type="button" class="btn btn-primary btn-block" id="{{ 'btn_add_'.@product.id }}">Add</button>
                            </td>
                        </tr>
                    </false>
                    
                </check>
                
            </tbody>
        </table>
    </div>
</repeat>
        
</div>

<script>
$(function(){
    
    var product_id = 0;
    var quantity = 0;
    
    $("button[id^='btn_add']").click(function(){
        
        var table = $(this).parent().parent().parent().parent();
        product_id = table.attr('id');
        quantity = $("input[id^='input_quantity_"+product_id+"']").val();
        
        $.ajax({
            
            // add to cart
            url: "{{ @BASE }}/api/addtocart/"+product_id+"/"+quantity,
            dataType: "json",
            success: function(data, status){
                
                var alertbox = '';
                
                if(data.success){
                    
                    // update stock label
                    $("span[id^='stock_"+product_id+"']").text(data.data.stock);
                    
                    alertbox += '<div class="alert alert-success alert-dismissible" role="alert">';
                    
                } else {
                    alertbox += '<div class="alert alert-danger alert-dismissible" role="alert">';
                }

                alertbox += data.message;
                alertbox += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                alertbox += '</div>';
                
                // show alert box
                $("#alert").html(alertbox);
            }
            
        });
    });
    
});
</script>