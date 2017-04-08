<table class="table table-bordered">

    <thead>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Price Per Unit (RM)</th>
        <th>Quantity</th>
        <th>Total (RM)</th>
    </thead>
    
    <tbody>
        
        <check if="{{ count(@items) }}">
        
            <true>
                <repeat group="{{ @items }}" value="{{ @item }}">
                
                <set currentItemPrice="{{ number_format((@item.quantity * @item.product.price), 2) }}">
                <set itemCounter="{{ (@itemCounter + @item.quantity) }}">
                <set priceCounter="{{ number_format((@priceCounter + @currentItemPrice), 2) }}">
                
                <tr>
                    <td>{{ @item.product.id }}</td>
                    <td>{{ @item.product.name }}</td>
                    <td>{{ @item.product.price }}</td>
                    <td>{{ @item.quantity }}</td>
                    <td>{{ @currentItemPrice }}</td>
                </tr>
                
                </repeat>
            </true>
            
            <false>
                <tr><td colspan="5">no data.</td></tr>
            </false>
            
        </check>
        
        <tr style="border-top: 2px solid black;">
            <td colspan="3"><label>Total</label></td>
            <td>{{ @itemCounter }}</td>
            <td>{{ @priceCounter }}</td>
        </tr>
        
    </tbody>

</table>
