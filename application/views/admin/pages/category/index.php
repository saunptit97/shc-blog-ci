 <style> 
  .box{
        padding: 30px;
    }
    .box-body .col-md-4{
        padding: 0;
    }
    .box-body .col-md-4 input{
         margin: 20px 0;
    }
    .add-new-post .pages-action-button button{
        background: #eb5202;
        color: #fff;
        margin: 20px 0;
        padding: 7px 15px;
        margin-top: 30px;
        margin-right: 15px;
    }
    .pages-action-button{
        float: right;
    }
    .add-cat{
    	padding: 0 20px;
    }
    .add-cat button{
    	margin-top: 20px;
		margin-right: 10px;
    }
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
                            <a href="<?php echo base_url('admin/category/add') ?>">
                                <button class="btn btn-default" style="margin-bottom: 20px">New Category</button>
                            </a>
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
	                        	<div class="col-md-6">
			                        <table id="example2" class="table table-bordered table-hover">
			                            <thead>
			                            <tr>
			                     
			                                <th>#</th>
			                                <th>Title</th>
			                                <th>Action</th>
			                            </tr>
			                            </thead> 
			                            <tbody id="result">
			                          		
			                            </tbody>
			                        </table>
		                    	</div>
		                    	<div class="col-md-6 add-cat">
									<form id="form-add-cat" method="post" action="<?php echo base_url('admin/category/add')?>">
										<span class="print-error-msg alert alert-danger" style="display: none"></span>
										<span class="print-success-msg alert alert-success" style="display: none"></span>
										<title>Add Category</title>
			                    		<label>Category</label>
			                    		<input  class ="form-control" type="text" value="" id="category" name="category" placeholder="Category" />
										<button class="btn btn-primary" id="submit-cat">Add Category</button><button class="btn btn-default">Back</button>	
									</form>	
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
		$.ajax({
			url: '<?php echo base_url('admin/category/fetch_data');?>',
			type: 'POST',
			data: {data : '1'},
			success: function(data){
				$("#result").html(data);
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		$(document).keyup(function(e) {
		  if (e.keyCode == 13) { alert('enter') }     // enter
		  if (e.keyCode == 27) { alert('esc') }   // esc
		});
	/* Get the checkboxes values based on the class attached to each check box */
	
		$("#submit-cat").click(function(event){
		//	var category = $("#category-name").val();
		event.preventDefault(); 
		var data = $("#form-add-cat").serialize()
			$.ajax({
				url: "<?php echo base_url('admin/category/add') ?>",
				type: 'POST',
				dataType: "json",
				data: data,
				success: function(data){
					
				},
                fail: function(data){
                    $(".print-error-msg").css("display" , "block");
                    $(".print-error-msg").html('Category not add');
                }
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
});


			

</script>