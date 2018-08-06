   <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">

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
                                
                            <?php
                            foreach($posts as $key => $post){ ?>
                                <tr>
                                    <td><input type="checkbox" value="<?php echo $post->id?> name="checkbox-delete"/></td>
                                    <td><?php echo $post->id ?></td>
                                    <td><?php echo $post->title ?></td>
                                    <td><?php echo $post->slug ?></td>
                                    <td><?php echo $post->published_at ?></td>
                                    <td><?php echo "Author"?></td>
                                    <td>
                                        <?php 
                                          if($post->status == 0){
                                                echo "Draft";
                                            }else{
                                                echo "Publish";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            <?php } ?>
                     
                            </tbody>
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