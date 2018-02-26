<!DOCTYPE html>
<html lang="en">
<?php $data['title'] = $title; $this->load->view('header', $data); ?>

<body class="app flex-row align-items-center">
  <div class="fixed-top">
    <div id="alert-danger" class="alert alert-danger text-center" style="display: none"></div>
    <div class="alert alert-success text-center" style="display: none">Login success</div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
              <h1>Login</h1>
              <p class="text-muted">Sign In to your account</p>
              <form id="login-form" method="POST" action="<?php echo base_url('authorization/login'); ?>">
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" class="form-control" placeholder="NISN/NIK/Username" name="username">
              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4 ladda-button" data-style="zoom-out" onclick="signin(this,event);"><span class="ladda-label">Login</span></button>
                </div>
              </div>
              </form>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <img class="mb-2 mt-4" src="<?php echo base_url('assets/img'); ?>/putih.png" height="50px">
                <h2 class="mb-0">E-Raport</h2>
                <p>Aplikasi pemantau nilai siswa</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function signin(t,event) {
      event.preventDefault();
      var l = Ladda.create(t);
      l.start();
      $.ajax({
        url: $('#login-form').attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $('#login-form').serialize(),
        success: function(r) {
          l.stop();
          if (r.status) {
            toastr.remove();
            toastr["success"]("Login Success");
            setTimeout(function() {
              location.reload();
            },500);
          } else {
            toastr.remove();
            toastr["error"](r.error);
          }
        }
      });
    }
  </script>

</body>
</html>