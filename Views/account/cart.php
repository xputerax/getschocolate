{{ Template::instance()->render('account/menu.php') }}

<form action="{{ @BASE.'/account/cart' }}" method="post">
    
    <div class="row text-center">
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
    
        <div class="col-md-12">
            <table class="table table-bordered">
            
                <thead>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price Per Unit (RM)</th>
                    <th>Quantity</th>
                    <th>Cost (RM)</th>
                </thead>
                
                <tbody>
                    
                    <check if="{{ count(@cartItems) }}">
                    
                        <true>
                            <repeat group="{{ @cartItems }}" value="{{ @cartItem }}">
                            
                            <set currentItemPrice="{{ number_format((@cartItem.quantity * @cartItem.product.price), 2) }}">
                            <set itemCounter="{{ (@itemCounter + @cartItem.quantity) }}">
                            <set priceCounter="{{ number_format((@priceCounter + @currentItemPrice), 2) }}">
                            
                            <tr id="{{ @cartItem.id }}">
                                <td>{{ @cartItem.product.id }}</td>
                                <td>{{ @cartItem.product.name }}</td>
                                <td>{{ @cartItem.product.price }}</td>
                                <td><input type="text" name="{{ 'quantity['.@cartItem.id.']' }}" value="{{ @cartItem.quantity }}" class="form-control" size="1"></td>
                                <td>{{ @currentItemPrice }}</td>
                            </tr>
                            
                            </repeat>
                        </true>
                        
                        <false>
                            <tr><td colspan="6">no data.</td></tr>
                        </false>
                        
                    </check>
                    
                    <tr style="border-top: 2px solid black;">
                        <td colspan="3"><label>Total</label></td>
                        <td>{{ @itemCounter }}</td>
                        <td>{{ @priceCounter }}</td>
                    </tr>
                    
                </tbody>

            </table>
        
        </div>
        
    </div>
    
    
    <div class="row">
    
        <div class="col-md-12">
            
            <div class="col-md-4">
                <div class="form-group text-left">
                    <select name="gateway" class="form-control">
                        <option value="billplz">Billplz</option>
                        <!--<option value="paypal">PayPal</option>-->
                    </select>
                </div>
            </div>
            
            <div class="col-md-offset-4 col-md-4">
                <div class="form-group text-right">
                    <input type="submit" name="save_cart" value="Save Cart" class="btn btn-primary">
                    <input type="submit" name="checkout" value="Checkout" class="btn btn-success">
                </div>
            </div>
            
        </div>
        
    </div>
                
</form>

<include href="message.php" with="message={{ @message }}" />
<include href="error.php" with="error={{ @error }}" />

<script>
$(function(){
    
    var id = 0;
    
    $("button[id^='edit_']").click(function(){
        
        id = $(this).parent().parent().attr('id');
        
        $(this).hide();
        $("#cancel_"+id).removeClass('hidden');
        
    });
    
    $("button[id^='cancel_']").click(function(){
        
        id = $(this).parent().parent().attr('id');
        $(this).addClass('hidden');
        $("#edit_"+id).show();
    });
    
});
</script>