<include href="account/menu.php">

<form action="{{ @BASE.'/account/invoices'.@invoice.id }}" method="post">
    
    <include href="shared/invoiceitems.php" with="items=@invoice.items">
    
</form>