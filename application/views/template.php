<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<?php $data['title'] = $title; $this->load->view('header', $data); ?>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Brand options
1. '.brand-minimized'       - Minimized brand (Only symbol)

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Breadcrumb -->
    <ol class="nav navbar-nav d-md-down-none breadcrumb" style="border:none;margin:0;">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item"><a href="#">Admin</a></li>
      <li class="breadcrumb-item active">Dashboard</li>

    </ol>

    <ul class="nav navbar-nav ml-auto mr-3">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="<?php echo base_url(); ?>assets/img/upload/profile/<?php if ($this->session->userdata('foto')): echo $this->session->userdata('foto'); else: ?>blank.jpg<?php endif ?>" class="img-avatar">
          <span class="d-md-down-none"><?php echo $this->session->userdata('username'); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
          <a class="dropdown-item" href="<?php echo base_url('authorization/logout'); ?>"><i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
      <li class="nav-item d-md-down-none">
        <button class="navbar-toggler aside-menu-toggler" type="button">
          <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">2</span></a>
        </button>
      </li>
    </ul>

  </header>

  <div class="app-body">
    <?php $this->load->view('sidebar'); ?>

    <!-- Main content -->
    <main class="main">
      <div class="container-fluid px-3 pt-3">
        <div class="main-container"></div>
        <?php $this->load->view($main); ?>
      </div>
      <!-- /.conainer-fluid -->
    </main>

    <aside class="aside-menu">
      <div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">
        <small><b>Today</b></small>
      </div>
      <hr class="transparent mx-3 my-0">
      <div class="callout callout-warning m-0 py-3">
        <div>Meeting with
          <strong>Lucas</strong>
        </div>
        <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
        <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
      </div>
      <hr class="mx-3 my-0">
      <div class="callout callout-info m-0 py-3">
        <div>Nilai Kosong
          <strong>XII RPL 5</strong>
        </div>
        <small class="text-muted mr-3"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
        <small class="text-muted"><i class="icon-home"></i>&nbsp; On-line </small>
        <div class="avatars-stack mt-2">
          <div class="avatar avatar-xs">
            <img src="<?php echo base_url(); ?>assets/img/upload/profile/blank.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
          </div>
          <div class="avatar avatar-xs">
            <img src="<?php echo base_url(); ?>assets/img/upload/profile/blank.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
          </div>
          <div class="avatar avatar-xs">
            <img src="<?php echo base_url(); ?>assets/img/upload/profile/blank.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
          </div>
        </div>
      </div>
    </aside>

  </div>

<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      </div>
      <form class="modal-form" action="" method="POST">
        <div class="modal-body"></div>
        <div class="modal-footer d-flex justify-content-start flex-row-reverse">
          <button type="submit" class="btn modal-btn-action ml-1 mr-0"><i class="fa fa-save"></i>&nbsp;Save</button>
          <button class="btn btn-secondary text-white mr-1" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('footer'); ?>

<!-- Plugins and scripts required by this views -->

<!-- Custom scripts required by this view -->
<!-- <script src="js/views/main.js"></script> -->

</body>
</html>