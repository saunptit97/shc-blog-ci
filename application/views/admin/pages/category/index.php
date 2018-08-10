 <style> 
  
 </style>   
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Category</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
  
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Category</h2>

                    </div>
                    <!-- /.box-header -->
                    <div class="add-new-post">
                        <div class="pages-action-button">
                                <button class="btn btn-default new-cat-button" style="margin-bottom: 20px">New Category</button>
                        </div>
                    </div>
                    <div class="box-body">
                    	<div class="row">
                        <div class="col-md-4">
                          	<div class="input-group">
                                <input type="text" class="form-control" placeholder="Search&hellip;" id="search" name="search" onchange="Change()">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default" height="34px" style="height: 34px;"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                           <!--   -->
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                        	<div class="row">
	                        	<div class="col-md-12 data-table-cat">
			                        <table id="example2" class="table table-bordered table-hover">
			                            <thead>
			                            <tr>
			                     
			                                <th>#</th>
			                                <th>Title</th>
			                                <th>Action</th>
			                            </tr>
			                            </thead> 
			                            <tbody id="result">
			                          		<?php foreach($categories as $key => $category) : ?>
                                            <tr>
                                                <td> <?php echo (int) ($key+1) ?></td>
                                                <td><?php echo  $category->name ?></td>
                                                <td>
                                                    <a href="#" style="color: #0df100" onclick="editFunction(<?php echo $category->id ?>)"><span class="glyphicon glyphicon-edit"></span></a>
                                                    <a href="<?php echo base_url('admin/category/delete/') . $category->id ?>" style="color: darkred" onclick=" return confirm('Are you sure delete this category?')"><span class="glyphicon glyphicon-trash"></span></a></td>
                                            </tr>
                                            <?php endforeach ?>
			                            </tbody>
			                        </table>
		                    	</div>
		                    	<div class="col-md-6 add-cat cat">
									<?php $this->load->view('admin/pages/category/add')?>
		                    	</div>
                                <div class="col-md-6 update-cat cat">
                                    <?php $this->load->view('admin/pages/category/edit')?>
                                </div>
		                    </div>
	                    </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script>
$(document).ready(function() {
    $(".add-cat").css("display", "none");
    $(".update-cat").css("display", "none");
    $(".new-cat-button").click(function(){
        $(".add-cat").css("display", "block");
        $(".update-cat").css("display", "none");
        $(".data-table-cat").removeClass('col-md-12').addClass('col-md-6');
    });
    $(".back-btn").click(function(){
        event.preventDefault(); 
        $(".add-cat").css("display", "none");
         $(".update-cat").css("display", "none");
        $(".data-table-cat").removeClass('col-md-6').addClass('col-md-12');
    });
		$(document).keyup(function(e) {
		  if (e.keyCode == 13) { alert('enter') }     // enter
		  if (e.keyCode == 27) { alert('esc') }   // esc
		});
	/* Get the checkboxes values based on the class attached to each check box */
	
		$("#submit-cat").click(function(event){
    		event.preventDefault(); 
    		var data = $("#form-add-cat").serialize();
            $.ajax({
                url: "<?php echo base_url('admin/category/add') ?>",
                type: 'POST',
                dataType: "json",
                data: data,
                success: function(data){
                    if(data.error){
                        $(".print-error-msg").css("display" , "block");
                        $(".print-error-msg").html(data.error);
                    }else{
                        location.reload();  
                    }
                    
                }
                //,
                // error: function(data){
                //     $(".print-error-msg").css("display" , "block");
                //     $(".print-error-msg").html('Category not add');
                // }
            });
		});
        
});

function editFunction(id){
    $(".update-cat").css("display", "block");
    $(".data-table-cat").removeClass('col-md-12').addClass('col-md-6');
    $.ajax({
        url: '<?php echo base_url('admin/category/edit/')?>' + id,
        type: 'POST',
        dataType: 'json',
        data: {param1: 'value1'},
        success: function(data){
            $("#category-update").val(data.data['name']);
             $("#id-category").val(data.data['id']);
        }
    });
    
}
   $("#submit-update-cat").click(function(event){
        event.preventDefault(); 
        var data = $("#form-update-cat").serialize();
        $.ajax({
            url: '<?php echo base_url('admin/category/update')?>',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data){
                    if(data.error){
                        $(".print-error-msg").css("display" , "block");
                        $(".print-error-msg").html(data.error);
                    }else{
                        location.reload();  
                    }
                    
                },
            error: function(data){
                $(".print-error-msg").css("display" , "block");
                $(".print-error-msg").html('Category not add');
            }
        })
        });

</script>