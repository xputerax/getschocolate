<!--<div class="container">-->

    <div class="row">
        <div class="col-md-12">
            <a href="{{ @BASE }}" alt="Home">
                <img src="{{ @BASE.'/assets/images/logo.png' }}" alt="Logo" class="img-responsive" style="width: 220px; height: 110px;">
            </a>
        </div>
    </div>
    
    <nav class="navbar navbar-inverse navbar-static-top">

        <div class="container-fluid">
        
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <div id="navbar3" class="navbar-collapse collapse">
                
                <ul class="nav navbar-nav">
                
                    <li>
                        <a href="{{ @BASE.'/products' }}">
                            <i class="glyphicon glyphicon-gift"></i> Products
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ @BASE.'/categories' }}">
                            <i class="glyphicon glyphicon-tags"></i> Categories
                        </a>
                    </li>
                    
                    <!--<li>
                        <a href="{{ @BASE.'/about' }}">
                        <i class="glyphicon glyphicon-info-sign"></i> About
                        </a>
                    </li>-->
                    
                    <check if="{{ \Helpers\Check::is_customer() }}">
                    
                        <true>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> My Account <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ @BASE.'/account' }}" id="menu_index">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ @BASE.'/account/cart' }}">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                    Cart
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ @BASE.'/account/orders' }}">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ @BASE.'/account/invoices' }}">
                                    <i class="glyphicon glyphicon-usd"></i>
                                    Invoices
                                    </a>
                                </li>
                            </ul>
                        </li>
                        </true>
                        
                        <false>
                            
                            <check if="{{ \Helpers\Check::is_admin() }}">
                            
                                <true>
                                <li>
                                    <a href="{{ @BASE.'/account' }}">
                                        <i class="glyphicon glyphicon-user"></i> Admin Panel
                                    </a>
                                </li>
                                </true>
                                
                                <false>
                                <li>
                                    <a href="{{ @BASE.'/account/register' }}">
                                        <i class="glyphicon glyphicon-pencil"></i> Register
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="{{ @BASE.'/account/login' }}">
                                        <i class="glyphicon glyphicon-user"></i> User login
                                    </a>
                                </li>
                                </false>
                                
                            </check>
                            
                        </false>

                    </check>

                    <check if="{{ \Helpers\Check::is_not_visitor() }}">

                        <true>
                        <li>
                            <a href="{{ @BASE.'/logout' }}">
                                <i class="glyphicon glyphicon-ban-circle"></i> Logout
                            </a>
                        </li>
                        </true>
                        
                    </check>
                            
                </ul>
                
            </div><!--/.nav-collapse -->
            
        </div><!--/.container-fluid -->
        
    </nav>
    
<!--</div>-->