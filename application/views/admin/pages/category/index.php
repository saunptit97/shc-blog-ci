<style>
    #dataTables-example{
        width: auto !important;
    }
    table.dataTable {
    width: 100%;
    margin: 0;
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
                                <button class="btn btn-default new-cat-button" style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal">New Category</button>
                        </div>
                    </div>
                    <div class="box-body">
                        	<div class="row">
	                        	<div class="col-md-12 data-table-cat">
                                    <div class="notify"></div>
			                        <table id="dataTables-example" class="table table-bordered table-hover">
			                            <thead>
			                            <tr>
			                     
			                                <th>#</th>
			                                <th>Title</th>
                                            <th>Description</th>
                                            <th>Created at</th>
			                                <th>Action</th>
			                            </tr>
			                            </thead> 
			                            <tbody id="result">
			                          	<!-- 	<?php //foreach($categories as $key => $category) : ?>
                                            <tr>
                                                <td> <?php //echo (int) ($key+1) ?></td>
                                                <td><?php //echo  $category->name ?></td>
                                                <td><?php //echo $category->description ?></td>
                                                <td><?php //echo $category->created_at ?></td>
                                                <td>
                                                    <a href="#" style="color: #0df100" onclick="editCategory(<?php //echo $category->id ?>)"><span class="glyphicon glyphicon-edit"></span></a>
                                                    <a href="#" style="color: darkred" onclick="deleteCategory(<?php //echo  $category->id ?>)"><span class="glyphicon glyphicon-trash"></span></a></td>
                                            </tr>
                                            <?php //endforeach ?> -->
			                            </tbody>
			                        </table>
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

<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add category</h4>
          </div>
          <div class="modal-body">
            <form id="form_category">
                <div id="the-message"></div>
                <input type="hidden" id="id" />
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" id="category" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>
                <button class="btn btn-primary" id="submit_category">Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
</div>
<div id="myModalEdit" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit category</h4>
          </div>
          <div class="modal-body">
            <form id="form_category_edit">
                <div id="the-message"></div>
                <input type="hidden" id="id_category" name="id"/>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" id="category_edit" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" id="description_edit" class="form-control">
                </div>
                <button class="btn btn-primary" id="submit_category_edit">Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
</div>

<script type="text/javascript">
     jQuery(document).ready(function($) {
        $('#dataTables-example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
            "url": "<?php echo base_url('admin/category/category_ajax') ?>",
            "dataType": "json",
            "type": "POST",
            "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
                           },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "description" },
                { "data": "created_at" },
                { "data": "action"}
                ]    

        }); 
     });
    $("#submit_category").click(function(event) {
        event.preventDefault();
        var url = '<?php echo base_url('admin/category/add') ?>';
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: $("#form_category").serialize(),
            success: function(response){
                if (response.success == true) {
                    $('#the-message').append('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Data has been saved' +
                        '</div>');
                    $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    })
                    location.reload();
                }
                else {
                    $.each(response.messages, function(key, value) {
                        var element = $('#' + key);
                        element.closest('div.form-group')
                        .find('.text-danger')
                        .remove();
                        element.after(value).css('margin-bottom', '5px');
                    });
                }
            }
        });
    });    
    function editCategory(id){
        
        $.ajax({
            url: '<?php echo base_url('admin/category/edit/')?>' + id,
            type: 'POST',
            dataType: 'json',
            success: function(response){
                $("#myModalEdit").modal('show');
                $("#category_edit").val(response.data['name']);
                $("#description_edit").val(response.data['description']);
                $('#id_category').val(response.data['id']);
            }
        });
    }
    $("#submit_category_edit").click(function(event){
        event.preventDefault();
        var url = '<?php echo base_url('admin/category/update/') ?>' + $("#id_category").val();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: $("#form_category_edit").serialize(),
            success: function(response){
                console.log(response);
                alert('SUCCESS');

                if (response.success == true) {
                    $('#the-message').append('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Data has been saved' +
                        '</div>');
                    $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    })
                    location.reload();
                }
                else {
                    $.each(response.messages, function(key, value) {
                        var element = $('#' + key +'_edit');
                        element.closest('div.form-group')
                        .find('.text-danger')
                        .remove();
                        element.after(value).css('margin-bottom', '5px');
                    });
                    alert('VALIDATE');
                }
            },
            fail : function(){
                alert('FAIL');
            }
        });
    });

    function deleteCategory(id){
        if(confirm("Are you sure delete this category")){
            var url = '<?php echo base_url('admin/category/delete/')?>' + id;
            alert(url);
            $.ajax({
                url: url,
                success: function(){
                    $(".notify").html('Delete successfully!').css('color','green');
                    location.reload();
                }
            });      
        }
    }

</script>