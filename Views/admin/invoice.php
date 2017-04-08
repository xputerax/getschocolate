{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/invoices/'.@invoice.id }}" method="post">
        
        <div class="row">
            <div class="col-md-12">
            {{ Template::instance()->render('title.php') }}
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Customer:</label> <span><a href="{{ @BASE.'/admin/customers/'.@invoice.customer_id }}">{{ @invoice.customer.fname.' '.@invoice.customer.lname }}</a></span> <br>
                    <label>Order ID:</label> <span><a href="{{ @BASE.'/admin/orders/'.@invoice.order_id }}">{{ @invoice.order_id }}</a></span> <br>
                    <label>Status:</label> <span>{{ (@invoice.paid == 'Y' ? 'Paid' : 'Unpaid') }}</span> <br>
                    <label>Created At:</label> <span>{{ @invoice.create_date }}</span> <br>
                    <label>Paid At:</label> <span>{{ (@invoice.paid_date ? @invoice.paid_date : '-') }}</span> <br>
                    <label>Payment ID:</label> <span>{{ (@invoice.payment_id ? @invoice.payment_id : '-') }}</span> <br>
                    <label>Gateway:</label> <span>{{ (@invoice.gateway ? @invoice.gateway : '-') }}</span> <br>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <set items="{{ @invoice.items }}">
                <include href="shared/invoiceitems.php" with="" />
            </div>
        </div>

        <check if="{{ @invoice.paid == 'Y' }}">
            
            <true></true>
            <false><input type="submit" name="mark_as_paid" value="Mark As Paid" class="btn btn-success"></false>
            
        </check>
        
    </form>

</div>