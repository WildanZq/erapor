<!DOCTYPE html>
<html lang="en">
<?php $data['title'] = $title; $this->load->view('header', $data); ?>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="clearfix">
          <h1 class="float-left display-3 mr-4">404</h1>
          <h4 class="pt-3">Oops! You're lost.</h4>
          <p class="text-muted">The page you are looking for was not found.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="<?php echo base_url(); ?>/assets/vendors/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendors/js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendors/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendors/js/pace.min.js"></script>

</body>
</html>