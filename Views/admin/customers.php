{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/customers' }}" method="post">

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
                    
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    
                    <tbody>
                    <check if="{{ @customers->count() }}">
                    
                        <true>
                            <repeat group="{{ @customers }}" value="{{ @customer }}">
                                
                                <tr id="{{ @customer.id }}">
                                    <td>{{ @customer.id }}</td>
                                    <td><a href="{{ @BASE.'/admin/customers/'.@customer.id }}">{{ @customer.fname.' '.@customer.lname }}</a></td>
                                    
                                    <check if="{{ @customer.active == 'Y' }}">
                                        
                                        <true>
                                            <td>Active</td>
                                            <td>
                                                <button type="button" id="{{ 'btn_suspend_'.@customer.id }}" class="btn btn-danger btn-sm">Suspend</button>
                                            </td>
                                        </true>
                                        
                                        <false>
                                            <td>Inactive</td>
                                            <td>
                                                <button type="button" id="{{ 'btn_unsuspend_'.@customer.id }}" class="btn btn-success btn-sm">Unsuspend</button>
                                            </td>
                                        </false>
                                        
                                    </check>
                                    
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

        {{ Template::instance()->render('pages.php') }}
        
    </form>

</div>

<script>
$(document).ready(function(){
    
    var id = 0;
    
    $("button").click(function(){
        var row = $(this).parent().parent();
        id = row.attr('id');
    });
    
    $("button[id^='btn_suspend_']").click(function(){
        
        $.ajax({
            
            url: '{{ @BASE }}/adminapi/suspendcustomer/'+id,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    
                } else {

                    alertbox += '<div class="alert alert-danger">';
                    
                }
                
                alertbox += data.message + '</div>';
                
                $("#alert").html(alertbox);
                
            }
        });
        
    });
    
    $("button[id^='btn_unsuspend_']").click(function(){
        
        $.ajax({
            
            url: '{{ @BASE }}/adminapi/unsuspendcustomer/'+id,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    
                } else {
                    
                    alertbox += '<div class="alert alert-danger">';                    
                    
                }
                
                alertbox += data.message + '</div>';
                $("#alert").html(alertbox);
                
            }
            
        });
        
    });
    
});
</script>