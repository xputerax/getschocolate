<form action="{{ @BASE.'/account/reset?email='.$_GET['email'].'&reset_key='.$_GET['reset_key'] }}" method="post">
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="password" name="npass" placeholder="New Password" class="form-control">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="password" name="cnpass" placeholder="Confirm Password" class="form-control">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="submit" name="reset" class="btn btn-primary" value="Reset Password">
            </div>
        </div>
    </div>
    
</form>

<include href="message.php" with="message={{ @message }}" />
<include href="error.php" with="error={{ @error }}" />
