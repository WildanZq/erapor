<div class="row" id="dashboard">
  <div class="col-sm-6 col-lg-3">
    <div class="card card-accent-primary">
      <div class="card-body p-3 clearfix">
        <i class="icon-graduation p-3 font-2xl mr-3 float-left"></i>
        <div class="h5 mt-2 mb-0 text-primary" id="siswa">326</div>
        <div class="text-muted text-uppercase font-weight-bold font-xs">Siswa</div>
      </div>
      <div class="card-footer px-3 py-2 text-white bg-primary">
        <a class="font-weight-bold font-xs btn-block text-white" href="<?php echo base_url('siswa'); ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card card-accent-primary">
      <div class="card-body p-3 clearfix">
        <i class="icon-people p-3 font-2xl mr-3 float-left"></i>
        <div class="h5 mt-2 mb-0 text-primary" id="guru"></div>
        <div class="text-muted text-uppercase font-weight-bold font-xs">Guru</div>
      </div>
      <div class="card-footer px-3 py-2 text-white bg-primary">
        <a class="font-weight-bold font-xs btn-block text-white" href="<?php echo base_url('guru'); ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card card-accent-primary">
      <div class="card-body p-3 clearfix">
        <i class="icon-notebook p-3 font-2xl mr-3 float-left"></i>
        <div class="h5 mt-2 mb-0 text-primary" id="mapel"></div>
        <div class="text-muted text-uppercase font-weight-bold font-xs">Mapel</div>
      </div>
      <div class="card-footer px-3 py-2 text-white bg-primary">
        <a class="font-weight-bold font-xs btn-block text-white" href="<?php echo base_url('mapel'); ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card card-accent-primary">
      <div class="card-body p-3 clearfix">
        <i class="icon-home p-3 font-2xl mr-3 float-left"></i>
        <div class="h5 mt-2 mb-0 text-primary" id="kelas"></div>
        <div class="text-muted text-uppercase font-weight-bold font-xs">Kelas</div>
      </div>
      <div class="card-footer px-3 py-2 text-white bg-primary">
        <a class="font-weight-bold font-xs btn-block text-white" href="<?php echo base_url('kelas'); ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 mb-4">
    <div class="card">
      <div class="card-header bg-primary text-white">
        RPL
      </div>
      <div class="card-body">  
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    countGuru();
    countKelas();
    countMapel();
  });

  function countGuru(){
    $.ajax({
      url: '<?php echo base_url('dashboard/countGuru'); ?>',
      type: 'GET',
      dataType: 'json',
      success: function(r) {
        $('#guru').html(r);
      }
    });
  }

  function countKelas(){
    $.ajax({
      url: '<?php echo base_url('dashboard/countKelas'); ?>',
      type: 'GET',
      dataType: 'json',
      success: function(r) {
        $('#kelas').html(r);
      }
    });
  }

  function countMapel(){
    $.ajax({
      url: '<?php echo base_url('dashboard/countMapel'); ?>',
      type: 'GET',
      dataType: 'json',
      success: function(r) {
        $('#mapel').html(r);
      }
    });
  }
</script>