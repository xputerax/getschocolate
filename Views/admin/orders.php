{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/orders' }}" method="post">
        
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
                        <th>Customer</th>
                        <th>Invoice</th>
                        <th>Date Paid</th>
                        <th>Status</th>
                        <th>Approval Date</th>
                        <th>Action</th>
                    </thead>
                    
                    <tbody>
                    <check if="{{ @orders->count() }}">
                    
                        <true>
                            <repeat group="{{ @orders }}" value="{{ @order }}">
                                <tr id="{{ @order.id }}">
                                    <td>{{ @order.id }}</td>
                                    <td><a href="{{ @BASE.'/admin/customers/'.@order.customer.id }}">{{ @order.customer.fname.' '.@order.customer.lname }}</a></td>
                                    
                                    <check if="{{ @order.invoice.paid == 'Y'}}">
                                        <true>
                                            <td><a href="{{ @BASE.'/admin/invoices/'.@order.invoice.id }}">Paid</a></td>
                                            <td>{{ @order.invoice.paid_date }}</td>
                                        </true>
                                        
                                        <false>
                                            <td><a href="{{ @BASE.'/admin/invoices/'.@order.invoice.id }}">Unpaid</a></td>
                                            <td>-</td>
                                        </false>
                                    </check>
                                    
                                    <check if="{{ @order.approved == 'Y' }}">
                                        <true>
                                            <td><span id="{{ 'label_approved'.@order.id }}">Approved</span></td>
                                            <td>{{ @order.approval_date }}</td>
                                            <td>
                                                <button type="button" id="{{ 'btn_unapprove_'.@order.id }}" class="btn btn-danger btn-sm">Unapprove</button>
                                            </td>
                                        </true>
                                        
                                        <false>
                                            <td><span id="{{ 'label_unapproved_'.@order.id }}">Not Approved</td>
                                            <td><span id="{{ 'label_appdate_'.@order.id }}">-</span></td>
                                            <td>
                                                <button type="button" id="{{ 'btn_approve_'.@order.id }}" class="btn btn-primary btn-sm">Approve</button>
                                                <button type="button" id="{{ 'btn_cancel_'.@order.id }}" class="btn btn-warning btn-sm">Cancel</button>
                                            </td>
                                        </false>
                                    </check>

                                </tr>
                            </repeat>

                        </true>
                        
                        <false>
                            <tr> <td colspan="7">no data.</td> </tr>
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
    
    $("button[id^='btn_approve_']").click(function(){
        
        console.log('order '+id+' approved');
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/approveorder/'+id,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    
                    $("#label_unapproved_"+id).text('Approved');
                    $("#label_appdate_"+id).text(data.data.approval_date.date);
                    //$("#btn_approve_"+id).remove();
                    $("#btn_approve_"+id).replaceWith('<button type="button" id="btn_unapprove_'+id+'" class="btn btn-danger btn-sm">Unapprove</button>');
                    
                } else {
                    
                    alertbox += '<div class="alert alert-danger">';
                    
                }
                
                alertbox += data.message + '</div>';
                
                $("#alert").html(alertbox);
            }
        });
    });
    
    $("button[id^='btn_unapprove_']").click(function(){
        
        console.log('order '+id+' unapproved');
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/unapproveorder/'+id,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    
                    $("#label_approved_"+id).text('Not Approved');
                    $("#label_appdate_"+id).text('-');
                    $("#btn_unapprove_"+id).replaceWith('<button type="button" id="btn_approve_'+id+'" class="btn btn-primary btn-sm">Approve</button>');
                    $("#label_appdate_"+id).text('-');
                    
                } else {

                    alertbox += '<div class="alert alert-danger">';
                
                }
                
                alertbox += data.message + '</div>';

                $("#alert").html(alertbox);
            }
            
        });
        
    });
    
    
    $("button[id^='btn_cancel_']").click(function(){
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/cancelorder/'+id,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    $("tr#"+id).remove();
                    
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
