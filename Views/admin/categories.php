{{ Template::instance()->render('admin/menu.php') }}

<div id="page-wrapper">

    <form action="{{ @BASE.'/admin/categories' }}" method="post">
        
        <div class="row">
            <div class="col-md-12">
            {{ Template::instance()->render('title.php') }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="alert"></div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12">
     
                <table class="table" id="category_table">
                    
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>
                    
                    <tbody>
                    <check if="{{ count(@categories) }}">
                    
                        <true>
                        
                            <repeat group="{{ @categories }}" value="{{ @category }}">
                                <tr id="{{ @category.id }}">
                                    <td>{{ @category.id }}</td>
                                    
                                    <td>
                                        <label for="{{ 'name_'.@category.id }}" id="{{ 'name_'.@category.id }}">{{ @category.name }}</label>
                                        <input type="text" id="{{ 'newname_'.@category.id }}" value="{{ @category.name }}" class="form-control hidden">
                                    </td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" id="{{ 'btn_rename_'.@category.id }}">Rename</button>                                
                                        <button type="button" class="btn btn-danger btn-sm" id="{{ 'btn_delete_'.@category.id }}">Delete</button>
                                        <button type="button" class="btn btn-primary btn-sm hidden" id="{{ 'btn_save_'.@category.id }}">Save</button>
                                        <button type="button" class="btn btn-warning btn-sm hidden" id="{{ 'btn_cancel_'.@category.id }}">Cancel</button>
                                    </td>
                                </tr>
                            </repeat>
                        </true>
                        
                        <false>
                            <tr>
                                <td colspan="3">no data.</td>
                            </tr>
                        </false>
                        
                    </check>
                        
                        
                        <tr id="add">
                            <td></td>
                            <td><input type="text" name="add_name" id="add_name" placeholder="Name" class="form-control"></td>
                            <td><button type="button" class="btn btn-primary btn-sm" id="btn_add">Add</td>
                        </tr>
                        
                    </tbody>
                    
                </table>
                
            </div>        
        </div>
        
        {{ Template::instance()->render('pages.php') }}
        
    </form>

</div>

<script>
$(document).ready(function(){
    
    var page = {{ intval($_GET['page']) }};    
    var id = 0;
    
    $("li#page_"+page).addClass('active');
    
    $("button[id^='btn_rename_'], button[id^='btn_delete_'], button[id^='btn_save_'], button[id^='btn_cancel_']").click(function(){
        var row = $(this).parent().parent();
        id = row.attr('id');
    });
    
    $("button[id^='btn_rename_']").click(function(){
        
        $("label[id='name_"+id+"'], button[id='btn_rename_"+id+"'], button[id='btn_delete_"+id+"']").hide();        
        $("input[id='newname_"+id+"'], button[id='btn_save_"+id+"'], button[id='btn_cancel_"+id+"']").removeClass('hidden');
        
        $("button[id^='btn_save_']").click(function(){
            
            var newname = $("input[id='newname_"+id+"']").val();
            
            $.ajax({
                url: '{{ @BASE }}/adminapi/renamecategory/'+id+'/'+encodeURI(newname),
                success: function(data, status){
                    
                    var alertbox = '';
                    
                    if(data.success){
                        
                        $("#name_"+id).text(data.data.name);
                        alertbox += '<div class="alert alert-success alert-dismissable">';
                        
                    } else {
                        alertbox += '<div class="alert alert-danger alert-dismissable">';
                    }
                    
                    $("label[id='name_"+id+"'], button[id='btn_rename_"+id+"'], button[id='btn_delete_"+id+"']").show();        
                    $("input[id='newname_"+id+"'], button[id='btn_save_"+id+"'], button[id='btn_cancel_"+id+"']").addClass('hidden');

                    alertbox += data.message + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
                    
                    $("#alert").html(alertbox);
                },
                dataType: 'json'
            });
            
            console.log('saved '+id);            
        });
        
        $("button[id^='btn_cancel_']").click(function(){
            
            $("label[id='name_"+id+"'], button[id='btn_rename_"+id+"'], button[id='btn_delete_"+id+"']").show();        
            $("input[id='newname_"+id+"'], button[id='btn_save_"+id+"'], button[id='btn_cancel_"+id+"']").addClass('hidden');
            
            console.log('action cancelled');
        });
        
    });
    
    $("button[id^='btn_delete_']").click(function(){
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/deletecategory/'+id,
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                    
                    $("tr#"+id).remove();
                    
                    alertbox += '<div class="alert alert-success alert-dismissable">';
                    
                } else {
                    alertbox += '<div class="alert alert-danger alert-dismissable">';
                }
                
                alertbox += data.message + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
                
                $("#alert").html(alertbox);
            }
            
        });
    });
    
    $("#btn_add").click(function(){
        
        $.ajax({
            url: '{{ @BASE }}/adminapi/addcategory/'+encodeURI($("#add_name").val()),
            dataType: 'json',
            success: function(data){
                
                var alertbox = '';
                
                if(data.success){
                
                    var row = "<tr>"
                            + "<td>"+data.data.id+"</td>"
                            + '<td><label for="name_'+data.data.id+'" id="name_'+data.data.id+'">'+data.data.name+'</label><input type="text" id="newname_'+data.data.id+'" value="'+data.data.name+'" class="form-control hidden"></td>'
                            + '<td><button type="button" class="btn btn-warning btn-sm" id="btn_rename_'+data.data.id+'">Rename</button> <button type="button" class="btn btn-danger btn-sm" id="btn_delete_'+data.data.id+'">Delete</button> <button type="button" class="btn btn-primary btn-sm hidden" id="btn_save_'+data.data.id+'">Save</button> <button type="button" class="btn btn-warning btn-sm hidden" id="btn_cancel_'+data.data.id+'">Cancel</button> </td>'
                            + "</tr>";
                            
                    $(row).insertBefore("tr#add");
                    
                    alertbox += '<div class="alert alert-success alert-dismissable">';
                    
                } else {
                    
                    alertbox += '<div class="alert alert-danger alert-dismissable">';
                    
                }
                
                alertbox += data.message + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
                
                $("#alert").html(alertbox);
            }
            
        });
        
    });
    
    console.log(id);
    
});
</script>