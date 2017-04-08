<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container-fluid">
    
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <!--<ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>-->

        <!--<ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>-->
    </div>
    <!-- /.navbar-top-links -->

    <nav class="navbar-default sidebar" role="navigation">

    
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">
                
                <li>
                    <a href="{{ @BASE.'/admin' }}" class="active">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>
                </li>
                
                <li>
                    <a href="{{ @BASE.'/admin/categories' }}" class="active">
                    <i class="fa fa-tags fa-fw"></i> Categories
                    </a>
                </li>
                
                <li>
                    <a href="{{ @BASE.'/admin/products' }}" class="active">
                    <i class="fa fa-gift fa-fw"></i> Products
                    </a>
                </li> <!-- letak layer 1 lagi -->
                
                <li>
                    <a href="{{ @BASE.'/admin/invoices' }}" class="active">
                    <i class="fa fa-list-alt fa-fw"></i> Invoices
                    </a>
                </li>

                <li>
                    <a href="{{ @BASE.'/admin/orders' }}" class="active">
                    <i class="fa fa-pencil fa-fw"></i> Orders
                    </a>
                </li>
                
                <li>
                    <a href="{{ @BASE.'/admin/customers' }}" class="active">
                    <i class="fa fa-users fa-fw"></i> Customers
                    </a>
                </li>
                
                <li>
                    <a href="{{ @BASE.'/logout' }}" class="active">
                    <i class="fa fa-times fa-fw"></i> Log Out
                    </a>
                </li>
                
            </ul>
            
        </div>
        
    </nav>
    
</nav>