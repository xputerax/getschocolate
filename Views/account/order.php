<include href="account/menu.php">

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
            <label>Customer:</label> {{ @order.customer.fname.' '.@order.customer.lname }} <br>
            <label>Order ID:</label> {{ @order.id }} <br>
            <label>Order Date:</label> {{ @order.create_date ? @order.create_date : '-' }} <br>
            <label>Order Status:</label> {{ @order.approved == 'Y' ? 'approved' : 'not approved' }} <br>
            <label>Invoice Status:</label> {{ @order.invoice.paid == 'Y' ? 'paid' : 'unpaid' }} <br>
            <label>Payment Date:</label> {{ @order.invoice.paid_date ? @order.invoice.paid_date : '-' }} <br>
            <label>Payment ID:</label> {{ @order.invoice.payment_id ? @order.invoice.payment_id : '-' }} <br>
            <label>Gateway:</label> {{ @order.invoice.gateway ? @order.invoice.gateway : '-' }} <br>
            <label>Shipping Address:</label> {{ @order.customer.line_1.', '.@order.customer.line_2.', '.@order.customer.zipcode.' '.@order.customer.city.', '.@order.customer.state }} <br>
        </div>
    </div>
