<script src="<?php echo base_url();?>bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(function () {
       CKEDITOR.replace( 'editor1',
        {
            extraPlugins : 'uicolor',
            height: '400px',
            width: '100%',
        });
    })
</script>
<style>
    .box-add-post input{
        margin: 10px 0px;
    }
    .box-add-post span{
        margin: 10px 0px;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">New post</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body box-add-post">
                <div class="row">
                     <form action="<?php echo base_url('admin/post/editpost/'. $id);?>" method="post" enctype="multipart/form-data"> 
                        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input id="post-title" type="text" class="form-control" name="title" required="true" value="<?php echo $post->title ?>" />
                             <label>Category</label>
                        <select class="form-control" name="category" id="post-category" >
                            <?php 
                                foreach ($categories as $key => $value) { ?>
                                    <option value="<?php echo $value->id ?>" <?php if($value->id == $post->id_category) echo "selected"?> >
                                        <?php echo $value->name ?>
                                    </option>
                            <?php } ?>
                        </select>
                        </div>
                        <!-- /.form-group -->
                      
                          
                         <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" id="post-image" />
                       
                        <label>Status</label>
                        <select class="form-control" name="status" id="post-status" value="1" >
                            <option value="0" <?php if($post->status ==0) echo "selected"?> >Draft</option>
                            <option value="1" <?php if($post->status ==1) echo "selected"?>>Publish</option>
                        </select>
                        <label>Tags</label >
                        <input id="post-tag"  type="text" class="form-control" name="tags" required="true" value="<?php echo $post->tags ?> "/>
                      
                    </div>
                    <div class="col-md-12">
                          <label>Body</label>
                            <textarea id="editor1" name="body" rows="50" cols="80" required="true">
                                <?php echo $post->body ?>
                            </textarea>
                              <button class="btn btn-primary" id="post-submit" type="submit" name="submit">Submit</button>
                    </div>
                    </form> 
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
