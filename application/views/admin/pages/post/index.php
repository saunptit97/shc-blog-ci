<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
 rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet" />
<script src="<?php echo base_url();?>bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery -->
<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>" ></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>
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
    .modal-body{
        padding: 30px;
    }
    .modal-body label{
        margin-top: 10px;
    }
    .modal-body button{
        margin-top: 10px;
    }
    .modal-title{
        text-transform: uppercase;
        font-weight: bold;
    }
    .required{
        color: red;
        padding-left:5px;
    }
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
    small{
        margin-top: 5px;
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
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
  
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Post</h2>
                    </div>
                    <!-- /.box-header -->
                    <div class="add-new-post">
                        <div class="pages-action-button">
                           
                                <button class="btn btn-default" style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal">New Post</button>
             
                        </div>
                    </div>
                    <div class="box-body">
                
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead> 
                            <tbody id="result">
                                
                          
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Post</h4>
      </div>
      <div class="modal-body">
        <form id="form-post" method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <label>Title</label>
                <input id="post-title" type="text" class="form-control" name="title"  />
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" id="image" />            
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" id="post-category" >
                    <?php 
                        foreach ($categories as $key => $value) { ?>
                            <option value="<?php echo $value->id ?>" >
                                <?php echo $value->name ?>
                            </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tags</label >
                <input id="post-tag" type="text" class="form-control" name="tags"  />
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="post-status" >
                    <option value="0">Draft</option>
                    <option value="1">Publish</option>
                </select>
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea  required="true" id="editor1" name="body" rows="10" cols="80" >
                </textarea>
            </div>
            <button class="btn btn-primary" id="post-submit" type="submit" name="submit" >Submit</button>
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
        $('#example2').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
            "url": "<?php echo base_url('admin/post/post_ajax') ?>",
            "dataType": "json",
            "type": "POST",
            "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "description" },
                { "data": "category" },
                { "data": "author"},
                { "data": "created_at"},
                { "data": "status"},
                { "data": "action"},
                ] 
        }); 
     });
    $("#post-submit").click(function(event) {
        event.preventDefault();
        $.ajax({
            url: '<?php echo base_url('admin/post/add_ajax')?>',
            type: 'POST',
            dataType: 'json',
            data: $("#form-post").serialize(),
            success: function(response){
                alert('SUCCESS');
            }
        });
    });
  
</script>