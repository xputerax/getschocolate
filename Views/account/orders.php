<include href="account/menu.php">

<form action="{{ @BASE.'/account/orders' }}" method="post">

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

            <table class="table table-bordered table-hover">
            
                <thead>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Approval Date</th>
                </thead>
                
                <tbody>
                    <check if="{{ @orders->count() }}">
                    
                        <true>
                            <repeat group="{{ @orders }}" value="{{ @order }}">
                                <tr>
                                    <td><!--<a href="{{ @BASE.'/account/orders/'.@order.id }}">-->{{ @order.id }}<!--</a>--></td>
                                    <td>{{ @order.create_date }}</td>
                                    
                                    <check if="{{ @order.approved == 'Y'}}">
                                        
                                        <true>
                                            <td>Approved</td>
                                            <td>{{ @order.approval_date }}</td>
                                        </true>
                                        
                                        <false>
                                            <td>Not Approved</td>
                                            <td>-</td>
                                        </false>
                                        
                                    </check>                    

                                </tr>
                            </repeat>
                        </true>
                        
                        <false>
                            <tr><td colspan="4">no data.</td></tr>
                        </false>
                        
                    </check>
                    
                </tbody>
                
            </table>
        
        
        </div>
        
    </div>
    
    
</form>

<include href="pages.php" with="pages={{ @pages }}" />