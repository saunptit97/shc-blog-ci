>
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
                        <h2 class="box-title">Posts</h2>

                    </div>
                    <!-- /.box-header -->
                    <div class="add-new-post">
                        <div class="pages-action-button">
                            <a href="<?php echo base_url('admin/post/add') ?>">
                                <button class="btn btn-default" style="margin-bottom: 20px">New Post</button>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                                <div class="col-md-4">
                                  
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search&hellip;" id="search" name="search" onchange="Change()">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default" height="34px" style="height: 34px;"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                   <!--   -->
                                </div>
                               
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <a href="<?php echo base_url('admin/post/massdelete')?>" style="color: darkred" onclick=" return confirm('Are you sure you want to delete this post?')" type="submit"><span class="glyphicon glyphicon-trash"></span></a>
                                </th>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Published</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead> 
                            <tbody id="result">
                                
                            </tbody>
                            <?php echo $links ?>
                        </table>
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
            <h4 class="modal-title">Add Post</h4>
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
<script type="text/javascript">
    jQuery(document).ready(function() {
        load_data();
        function load_data(){
             var search =  $("#search").val();
            $.ajax({
                url: "<?php echo base_url('admin/post/fetch')?>",
                type: 'POST',
                data: {search , search},
                success: function(data1){
                    $("#result").html(data1);
                }
            })
            
        };
        $("#search").keyup(function(event) {
            load_data();
        });
    });
</script>