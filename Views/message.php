<check if="{{ @message }}">

    <div class="alert alert-success">
    
        <check if="{{ is_array(@message) }}">
            
            <true>
            <ul>
                <repeat group="{{ @message }}" value="{{ @msg }}">
                <li>{{ @msg|raw }}</li>
                </repeat>
            </ul>
            </true>
            
            <false>{{ @message|raw }}</false>

        </check>
        
    </div>
    
</check>