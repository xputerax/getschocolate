<check if="{{ @error }}">

    <div class="alert alert-danger">
    
        <check if="{{ is_array(@error) }}">
            
            <true>
            <ul>
                <repeat group="{{ @error }}" value="{{ @err }}">
                <li>{{ @err|raw }}</li>
                </repeat>
            </ul>
            </true>
            
            <false>{{ @error|raw }}</false>

        </check>
        
    </div>
    
</check>