        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet" />

<!-- jQuery -->
<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>" ></script>
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
                        <h2 class="box-title">User</h2>

                    </div>
                    <!-- /.box-header -->
                    <div class="add-new-post">
                        <div class="pages-action-button">
                           
                                <button class="btn btn-default" style="margin-bottom: 20px" data-toggle="modal" data-target="#myModalCreate">New User</button>
             
                        </div>
                    </div>
                    <div class="box-body">
                
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Created at</th>
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


    <div class="modal fade" id="myModalCreate" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content New user-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">New User</h4>
                </div>
                <div class="modal-body">
                    <form id="form-user">

                        <div class="form-group test">
                            <label>Name</label><span class="required">*</span>
                            <input type="text" id="name" name="name" class="form-control"/>
                            <div id="error_name" class=" required name"></div>
                        </div>
                        <div class="form-group test">
                            <label>Email</label><span class="required">*</span>
                            <input type="email" name="email" id="email" class="form-control">
                            <div id="error_email" class="required email"></div>
                        </div>
                        <div class="form-group test">
                            <label>Address</label><span class="required">*</span>
                            <input type="text" name="address" id="address" class="form-control">
                            <div id="error_address" class="required address"></div>
                        </div>
                        <div class="form-group test">
                            <label>Phone</label><span class="required">*</span>
                            <input type="text" name="phone" id="phone" class="form-control">
                            <div id="error_phone" class="required phone"></div>
                        </div>
                        <div class="form-group test">
                            <label>Level</label>
                            <select class="form-control">
                                <option value="1">Member</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>     
                        <div class="form-group test">
                            <label>Password</label><span class="required">*</span>
                            <input type="password" name="password" id="password" class="form-control">
                            <small>[This password have least one uppercase letter and lowercase letter]</small>
                            <div id="error_password" class="required password"></div>
                        </div>
                        <div class="form-group test">
                            <label>Confirm Password</label><span class="required">*</span>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                            <div id="error_confirm_password" class="required confirm_password"></div>
                        </div>
                        
                        <button class="btn btn-primary" id="submit">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--EDIT-->
    <div class="modal fade" id="myModalEdit" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content New user-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form id="form_user_edit">

                        <div class="form-group test">
                            <label>Name</label><span class="required">*</span>
                            <input type="text" id="name_edit" name="name" class="form-control"/>
                            <div id="error_name" class=" required name"></div>
                        </div>
                        <div class="form-group test">
                            <label>Email</label><span class="required">*</span>
                            <input type="email" name="email" id="email_edit" class="form-control">
                            <div id="error_email" class="required email"></div>
                        </div>
                        <div class="form-group test">
                            <label>Address</label><span class="required">*</span>
                            <input type="text" name="address" id="address_edit" class="form-control">
                            <div id="error_address" class="required address"></div>
                        </div>
                        <div class="form-group test">
                            <label>Phone</label><span class="required">*</span>
                            <input type="text" name="phone" id="phone_edit" class="form-control">
                            <div id="error_phone" class="required phone"></div>
                        </div>
                        <div class="form-group test">
                            <label>Level</label>
                            <select class="form-control">
                                <option value="1">Member</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>     
                        <div class="form-group test">
                            <label>Password</label><span class="required">*</span>
                            <input type="password" name="password" id="password_edit" class="form-control">
                            <small>[This password have least one uppercase letter, lowercase letter, number and 5 characters in length.]</small>
                            <div id="error_password_edit" class="required password"></div>
                        </div>
                        <div class="form-group test">
                            <label>Confirm Password</label><span class="required">*</span>
                            <input type="password" name="confirm_password" id="confirm_password_edit" class="form-control">
                            <div id="error_confirm_password" class="required confirm_password"></div>
                        </div>
                        
                        <button class="btn btn-primary" id="submit_edit">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#example2').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
            "url": "<?php echo base_url('admin/user/user_ajax') ?>",
            "dataType": "json",
            "type": "POST",
            "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "address" },
                { "data": "phone"},
                { "data": "role"},
                { "data": "status"},
                { "data": "created_at"},
                { "data": "action"},
                ]    

        }); 
     });
   $("#submit").click(function(event) {
       event.preventDefault();
       var data = $("#form-user").serialize();
       $.ajax({
            url: '<?php echo base_url('admin/user/add')?>',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(data){
                for(var key in data.mess) {
                    $('.test .'+ key +' ').html(data.mess[key]);                     
                }
                if(data.success == true){
                    location.reload();
                }
           }
       });    
   });
    function edit_user(id){
        alert('AAA');
        $("#name_edit").val('AA');
        $("#myModalEdit").modal('show');                        
            
    }
</script>