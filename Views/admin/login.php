<form action="{{ @BASE.'/admin/login' }}" method="post">
    
    <div class="row">
    
        <div class="col-md-4 col-md-offset-4">
        
            <center>{{ Template::instance()->render('title.php') }}</center>
        
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email Address">
            </div>

            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            
            <br>
            
            <div class="form-group">
                <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
            </div>
            
        </div>
        
    </div>
        
</form>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <include href="error.php" with="error={{ @error }}" />
    </div>
</div>