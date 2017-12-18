<div class="row">
  <div class="col-sm-6 col-lg-3">
    <div class="card card-accent-primary">
      <div class="card-body p-3 clearfix">
        <i class="icon-graduation p-3 font-2xl mr-3 float-left"></i>
        <div class="h5 mt-2 mb-0 text-primary">326</div>
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
        <div class="h5 mt-2 mb-0 text-primary">326</div>
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
        <div class="h5 mt-2 mb-0 text-primary">326</div>
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
        <div class="h5 mt-2 mb-0 text-primary">326</div>
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
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">X</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="false">XI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-expanded="false">XII</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
            <canvas id="canvas-RPL-X-Umum" height="80"></canvas>
            <canvas id="canvas-RPL-X-Kejuruan" height="80"></canvas>
          </div>
          <div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">
            2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
            aute irure
            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>
          <div class="tab-pane" id="messages" role="tabpanel" aria-expanded="false">
            3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  window.onload = function() {
    color = Chart.helpers.color;
    window.canvasRPLXUmum = new Chart(document.getElementById("canvas-RPL-X-Umum").getContext("2d"), {
        type: 'bar',
        data: {
          labels: ["Matematika", "Bahasa Inggris", "Bahasa Indonesia", "Bahasa Inggris", "Bahasa Indonesia", "Bahasa Inggris", "Bahasa Indonesia"],
          datasets: [{
            label: 'X RPL 1',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '80',
              '73',
              '86',
              '73',
              '86',
              '73',
              '86'
            ]
          }, {
            label: 'X RPL 2',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '83',
              '87',
              '84',
              '73',
              '86',
              '73',
              '86'
            ]
          }, {
            label: 'X RPL 2',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '83',
              '87',
              '84',
              '73',
              '86',
              '73',
              '86'
            ]
          }, {
            label: 'X RPL 2',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '83',
              '87',
              '84',
              '73',
              '86',
              '73',
              '86'
            ]
          }, {
            label: 'X RPL 2',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '83',
              '87',
              '84',
              '73',
              '86',
              '73',
              '86'
            ]
          }, {
            label: 'X RPL 2',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '83',
              '87',
              '84',
              '73',
              '86',
              '73',
              '86'
            ]
          }]
        },
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Umum'
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
    });
    window.canvasRPLXKejuruan = new Chart(document.getElementById("canvas-RPL-X-Kejuruan").getContext("2d"), {
        type: 'bar',
        data: {
          labels: ["Pemrograman Dasar", "Sistem Komputer", "Sistem Operasi"],
          datasets: [{
            label: 'X RPL 1',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '80',
              '93',
              '86'
            ]
          }, {
            label: 'X RPL 2',
            backgroundColor: color(tempColor = getRandomColor()).alpha(0.5).rgbString(),
            borderColor: tempColor,
            borderWidth: 1,
            data: [
              '83',
              '87',
              '84'
            ]
          }]
        },
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Kejuruan'
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
    });
  };
</script>