<form action="{{ @BASE.'/account/register' }}" method="post">
    
    <div class="row">
        
        <div class="col-md-4 col-md-offset-4">

            <center>{{ Template::instance()->render('title.php') }}</center>

            <div class="form-group">
                <label>Personal Information</label>
                <input type="email" name="email" class="form-control" placeholder="Email Address">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                <input type="text" name="fname" class="form-control" placeholder="First Name">
                <input type="text" name="lname" class="form-control" placeholder="Last Name">
            </div>
            
            <div class="form-group">
                <label>Shipping Details</label>
                
                <input type="text" name="line_1" class="form-control" placeholder="Line 1">
                <input type="text" name="line_2" class="form-control" placeholder="Line 2">
                <input type="text" name="city" class="form-control" placeholder="City">
                <input type="text" name="zipcode" class="form-control" placeholder="Zipcode">
                <input type="text" name="state" class="form-control" placeholder="State/Region">
                <!--<input type="text" name="country" class="form-control" placeholder="Country">-->
            </div>
            
            <div class="form-group">
                <center><div class="g-recaptcha" data-sitekey="{{ @recaptcha.public }}"></div></center>
            </div>
            
            <div class="form-group">
                <input type="submit" name="register" value="Create Account" class="btn btn-primary btn-block">
            </div>
            
        </div>
        
    </div>
    
</form>

<div class="row text-center">
    <div class="col-md-4 col-md-offset-4">
        <include href="message.php" with="message={{ @message }}" />
        <include href="error.php" with="error={{ @error }}" />
    </div>
</div>