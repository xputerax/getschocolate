{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/invoices' }}" method="post">
        
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
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Paid Date</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </thead>
                    
                    <tbody>
                    
                    <check if="{{ @invoices->count() }}">
                        
                        <true>
                            <repeat group="{{ @invoices }}" value="{{ @invoice }}">
                                <tr id="{{ @invoice.id }}">
                                    <td><a href="{{ @BASE.'/admin/invoices/'.@invoice.id }}">{{ @invoice.id }}</a></td>
                                    <td>{{ @invoice.order_id }}</td>
                                    <td><a href="{{ @BASE.'/admin/customers/'.@invoice.customer.id }}">{{ @invoice.customer.fname.' '.@invoice.customer.lname }}</a></td>

                                    <check if="{{ @invoice.paid == 'Y' }}">
                                    
                                        <true>
                                            <td>Paid</td>
                                            <td>{{ @invoice.paid_date }}</td>
                                            <td>{{ @invoice.create_date }}</td>
                                            <td>-</td>
                                        </true>
                                        
                                        <false>
                                            <td>Unpaid</td>
                                            <td>
                                                <span id="{{ 'unpaid_'.@invoice.id }}">-</span>
                                                <input type="date" id="{{ 'new_paid_date_'.@invoice.id }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control hidden" size="3">
                                            </td>
                                            <td>{{ @invoice.create_date }}</td>
                                            <td>
                                                <button type="button" id="{{ 'btn_mark_'.@invoice.id }}" class="btn btn-success btn-sm">Mark as paid</button>
                                                <button type="button" id="{{ 'btn_save_'.@invoice.id }}" class="btn btn-success btn-sm hidden">Save</button>
                                                <button type="button" id="{{ 'btn_unmark_'.@invoice.id }}" class="btn btn-danger btn-sm hidden">Cancel</button>
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
    
    $("button[id^='btn_mark_']").click(function(){
        
        $("span[id^='unpaid_"+id+"'], button[id^='btn_mark_"+id+"']").hide();
        $("input[id^='new_paid_date_"+id+"'], button[id^='btn_save_"+id+"'], button[id^='btn_unmark_"+id+"']").removeClass('hidden');
        
        console.log('marked #'+id+' as paid');
    });
    
    $("button[id^='btn_unmark_']").click(function(){
        
        $("span[id^='unpaid_"+id+"'], button[id^='btn_mark_"+id+"']").show();
        $("input[id^='new_paid_date_"+id+"'], button[id^='btn_save_"+id+"'], button[id^='btn_unmark_"+id+"']").addClass('hidden');

        console.log('unmarked #'+id+' as paid');
    });
    
    $("button[id^='btn_save_']").click(function(){
        
        var datePaid = $("input[id^='new_paid_date_"+id+"']").val();
        var alertbox = '';
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/markinvoiceaspaid/'+id+'/'+datePaid,
            dataType: 'json',
            success: function(data){
                
                window.location = '{{ @BASE }}/admin/invoices';
                /*if(data.success){
                    
                    alertbox += '<div class="alert alert-success">';
                    
                } else {
                    
                    alertbox += '<div class="alert alert-danger">';
                    
                }
                
                alertbox += data.message + '</div>';*/
            }
        });
        
    });
    
});
</script>