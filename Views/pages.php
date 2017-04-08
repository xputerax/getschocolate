<check if="{{ @pages }}">
    
    <ul class="pagination">
    <repeat group="{{ @pages }}" key="{{ @num }}" value="{{ @name }}">
        <li><a href="{{ '?page='.@num }}">{{ @num }}</a></li>
    </repeat>
    </ul>
    
</check>