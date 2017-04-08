{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/products' }}" method="post">
        
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
            <div class="col-md-12">
            
                <table class="table">
            
                    <thead> <th>ID</th> <th>Name</th> <th>Category</th> <th>Action</th> </thead>
                    
                    <tbody>
                    
                    <check if="{{ @products->count() }}">
                    
                        <true>
                            <repeat group="{{ @products }}" value="{{ @product }}">
                                <tr id="{{ @product.id }}">
                                    <td>{{ @product.id }}</td>
                                    <td>{{ @product.name }}</td>
                                    <td>{{ (@product.category_id ? @product.category.name : '-') }}</td>
                                    <td>
                                        <a href="{{ @BASE.'/admin/products/'.@product.id }}" class="btn btn-primary btn-sm">Edit</a>
                                        <button type="button" id="{{ 'btn_delete_'.@product.id }}" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            </repeat>
                        </true>
                        
                        <false>
                        <tr> <td colspan="4">no data.</td> </tr>
                        </false>
                        
                    </check>
                    
                        
                    </tbody>
                
                </table>
                
            </div>    
        </div>
        
        <a href="{{ @BASE.'/admin/addProduct' }}" class="btn btn-primary">Add</a>

        {{ Template::instance()->render('pages.php') }}
        
    </form>

</div>

<script>
$(document).ready(function(){
    
    var id = 0;
    
    $("button[id^='btn_delete_']").click(function(){
        
        var row = $(this).parent().parent();
        id = row.attr('id');
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/deleteproduct/' + id,
            dataType: 'json',
            success: function(data){
                
                console.log(data);
                
                var alertbox = '';
                
                if(data.success){
                    
                    $("tr#"+id).remove();
                    alertbox += '<div class="alert alert-success alert-dismissable">';
                    
                } else {
                    
                    alertbox += '<div class="alert alert-danger alert-dismissable">';
                    
                }
                
                alertbox += data.message + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                
                $("#alert").html(alertbox);
                
            }
        });
    });
    
});
</script>