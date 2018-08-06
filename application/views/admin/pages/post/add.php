<script src="<?php echo base_url();?>bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

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
    .box-add-post input{
        margin: 5px 0px;
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
                    
                    <div id="message"  style="width: 200px; color: red; padding-left: 20px; margin-bottom: 10px;"><span><?php
                            if(isset($message)) echo $message;
                    ?></span></div>
                     <!-- <form action="<?php //echo base_url('admin/post/addpost');?>" method="post" enctype="multipart/form-data">  -->
               <!--     <?php //echo form_open('echo base_url("admin/post/addpost")', array('id' => 'form-add-post'));?> -->
                <form id="form-add-post" method="post" action="<?php echo base_url('admin/post/addpost') ?>"enctype="multipart/form-data" >

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input id="post-title" type="text" class="form-control" name="title"  />
                        </div>
                        
                        <label>Body</label>
                           <textarea  required="true" id="editor1" name="body" rows="10" cols="80" >
                        
                            </textarea>
                         <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <label>Image</label>
                         <input type="file" name="image" id="image" /> 
                        <label>Category</label>
                        <select class="form-control" name="category" id="post-category" >
                            <?php 
                                foreach ($categories as $key => $value) { ?>
                                    <option value="<?php echo $value->id ?>" >
                                        <?php echo $value->name ?>
                                    </option>
                            <?php } ?>
                        </select>
                        <label>Status</label>
                        <select class="form-control" name="status" id="post-status" >
                            <option value="0">Draft</option>
                            <option value="1">Publish</option>
                        </select>
                        <label>Tags</label >
                        <input id="post-tag" type="text" class="form-control" name="tags"  />
                        <button class="btn btn-primary" id="post-submit" type="submit" name="submit">Submit</button>
                    </div>
                    <?php echo form_close();?>
                 <!--    </form>  -->
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
<script type="text/javascript">
    $(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    $("#message").fadeOut(1000);
    setTimeout(function() {
         
    }, 5000);
    $('input').fadeOut(300);
});
    $('input').fadeOut(300);
    
/**
    $("#form-add-post").submit(function(event) {
        event.preventDefault();
        var me = $(this);
        $.ajax({
            url: 'http://127.0.0.1/blog/admin/post/addpost',
            type: 'POST',
            dataType: 'json',
            data: me.serialize(),
            success: function(response){
                if(response == true){
                    alert('success');
                }else{
                    alert('error');
                }
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
   function SubmitPost(){
    console.log($('#form-add-post').serialize());
       $.ajax({
                url: "<?php //echo site_url('admin/post/addpost') ?>",
                type: 'POST',
                dataType: 'json',
                data: $('#form-add-post').serialize(),
                encode:true,
                success:function(data) {
                    console.log(data);
                    alert(data);
                    if(!data.success){

                        if(data.errors){
                            alert(data.errors);
                            //$('#message').html(data.errors).addClass('alert alert-danger');
                        }
                    }else {
                        alert(data.message);
                        setTimeout(function() {
                            window.location.reload()
                        }, 400);
                    }
                }
            })
    }
   // $(function(){
   //  alert('test');
   // });
</script>