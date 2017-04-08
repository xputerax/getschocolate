{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">
    
    <form action="" method="">
    
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
            <div class="col-md-5">
                
                <div class="form-group">
                    <label>Personal Information</label>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ @customer.email }}">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" value="{{ @customer.fname }}">
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" value="{{ @customer.lname }}">
                    <input type="password" name="npass" class="form-control" placeholder="New Password" value="">
                    <input type="password" name="cnpass" class="form-control" placeholder="Confirm Password" value="">
                </div>
            
            </div>
            
            <div class="col-md-5">

                <div class="form-group">
                    <label>Shipping Details</label>
                    <input type="text" name="line_1" class="form-control" placeholder="Line 1" value="{{ @customer.line_1 }}">
                    <input type="text" name="line_2" class="form-control" placeholder="Line 2" value="{{ @customer.line_2 }}">
                    <input type="text" name="city" class="form-control" placeholder="City" value="{{ @customer.city }}">
                    <input type="text" name="zipcode" class="form-control" placeholder="Zip Code" value="{{ @customer.zipcode }}">
                    <input type="text" name="state" class="form-control" placeholder="State/Region" value="{{ @customer.state }}">
                </div>                
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <input type="submit" name="save" value="Save" class="btn btn-primary">
                
                <check if="{{ @customer.active == 'Y' }}">
                    
                    <true><input type="submit" name="suspend" value="Suspend" class="btn btn-danger"></true>
                    
                    <false><input type="submit" name="unsuspend" value="Unsuspend" class="btn btn-warning"></false>
                    
                </check>
                
            </div>
        </div>
        
    </form>
    
    <div class="row">
        <div class="col-md-12">
        {{ Template::instance()->render('message.php') }}
        {{ Template::instance()->render('error.php') }}
        </div>
    </div>
    
</div>
