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

            <table class="table table-bordered">
        
                <thead>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                </thead>
                
                <tbody>
                    <check if="{{ @invoices->count() }}">
                    
                        <true>
                            <repeat group="{{ @invoices }}" value="{{ @invoice }}">
                                <tr>
                                    <td><a href="{{ @BASE.'/account/invoices/'.@invoice.id }}">{{ @invoice.id }}</a></td>
                                    <td><a href="{{ @BASE.'/account/orders/'.@invoice.order_id }}">{{ @invoice.order_id }}</a></td>
                                    <td>{{ @invoice.create_date }}</td>
                                    
                                    <check if="{{ @invoice.paid == 'Y' }}">
                                        
                                        <true>
                                            <td>Paid</td>
                                            <td>{{ @invoice.paid_date }}</td>
                                            <td>-</td>
                                        </true>
                                        
                                        <false>
                                            <td>Unpaid</td>
                                            <td>-</td>
                                            <td>
                                            <form action="{{ @BASE.'/account/payinvoice/'.@invoice.id }}" method="post">
                                            <input type="hidden" name="invoice_id" value="{{ @invoice.id }}">
                                            <input type="submit" name="checkout" value="Pay" class="btn btn-primary">
                                            </td>
                                        </false>
                                        
                                    </check>
                                </tr>
                            </repeat>
                        </true>
                        
                        <false>
                            <tr> <td colspan="6">no data.</td> </tr>
                        </false>
                        
                    </check>
                </tbody>
                
            </table>


        </div>
        
    </div>
    

<include href="pages.php" with="pages={{ @pages }}" />