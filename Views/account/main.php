<include href="account/menu.php" />

<form action="{{ @BASE.'/account/index' }}" method="post">

    <div class="row">
        
        <div class="col-md-6">
            
            <h4><u>Personal Details</u></h4>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ @user.email }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" name="fname" value="{{ @user.fname }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" value="{{ @user.lname}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="cpass" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="npass" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="cnpass">Confirm Password</label>
                <input type="password" name="cnpass" class="form-control">
            </div>
        
        </div>
        
        <div class="col-md-6">
            
            <h4><u>Shipping Details</u></h4>
            
            <div class="form-group">
                <label for="line_1">Line 1</label>
                <input type="text" name="line_1" value="{{ @user.line_1 }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="line_2">Line 2</label>
                <input type="text" name="line_2" value="{{ @user.line_2 }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" value="{{ @user.city }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="zipcode">Zipcode</label>
                <input type="text" name="zipcode" value="{{ @user.zipcode }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" value="{{ @user.state }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="submit">&nbsp;</label>
                <input type="submit" name="edit" value="Save" class="btn btn-primary btn-block">
            </div>
            
        </div>
        
    </div>
    
</form>

<include href="message.php" with="message={{ @message }}" />
<include href="error.php" with="error={{ @error }}" />