<form action="{{ @BASE.'/account/forgot' }}" method="post">
    
    <div class="row">
        
        <div class="col-md-4 col-md-offset-4">

            <center>{{ Template::instance()->render('title.php') }}</center>
            
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address">
            </div>
            
            <div class="form-group">
                <input type="submit" name="recover_account" value="Recover" class="btn btn-primary btn-block">
            </div>
            
        </div>
        
    </div>
    
</form>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <include href="error.php" with="error={{ @error }}" />
        <include href="message.php" with="message={{ @message }}" />
    </div>
</div>