{{ \Template::instance()->render('title.php') }}

<check if="{{ @categories->count() }}">

    <true>
        
        <div class="row">
        
        <div class="col-md-10">
        <repeat group="{{ @categories }}" value="{{ @category }}">
            
            <div class="col-md-3">
            <a href="{{ @BASE.'/categories/'.@category.id }}">{{ @category.name }} <span class="badge">{{ @category.products->count() }}</span> </a>
            </div>
            
        </repeat>
        </div>
        
        </div>
        
    </true>
    
    <false>
    </false>
    
</check>