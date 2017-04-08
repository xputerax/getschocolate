{{ \Template::instance()->render('title.php') }}

<check if="{{ @products->count() }}">
    
    <true>
        <div class="row">
            
            <div class="col-md-10">
                
                <repeat group="{{ @products }}" value="{{ @product }}">
                    
                    <div class="col-md-2">
                        <div class="thumbnail">
                            <a href="{{ @BASE.'/products/'.@product.id }}">
                            
                            <check if="{{ @product.image_1_thumb }}">

                                <true>
                                <img src="{{ @BASE.'/assets/images/cache/'.@product.image_1_thumb }}" alt="{{ @product.name }}" class="img-responsive">
                                </true>

                                <false>
                                <img src="{{ @BASE.'/assets/images/placeholder.png' }}" alt="{{ @product.name }}" class="img-responsive" width="150" height="150">
                                </false>

                            </check>

                            <div class="caption">{{ @product.name }}</div>

                            </a>
                        </div>
                    </div>
                    
                </repeat>
            
            </div>
            
        </div>
        
        {{ \Template::instance()->render('pages.php') }}
    </true>
    
    <false>
    no data.
    </false>
    
</check>

