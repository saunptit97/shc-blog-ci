 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
<!--          <p>--><?php //echo $user->username ?><!--</p>-->
          <a href="<?php echo base_url(); ?>#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>#">
            <i class="fa fa-edit"></i> <span>Post</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>admin/post/add"><i class="fa fa-circle-o"></i>New
            Post</a></li>
            <li><a href="<?php echo base_url(); ?>admin/post"><i class="fa fa-circle-o"></i>All Post</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>#">
            <i class="fa fa-edit"></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>admin/category/add"><i class="fa fa-circle-o"></i>New Category</a></li>
            <li><a href="<?php echo base_url(); ?>admin/category"><i class="fa fa-circle-o"></i>All Category</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>#">
            <i class="fa fa-user"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>admin/user/add"><i class="fa fa-circle-o"></i>New
            User</a></li>
            <li><a href="<?php echo base_url(); ?>admin/user"><i class="fa fa-circle-o"></i>All User</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>