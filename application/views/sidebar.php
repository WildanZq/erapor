<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('dashboard'); ?>"><i class="icon-graph"></i> Dashboard</a>
      </li>
      <?php if ($this->session->userdata('role') == 'admin'): ?>
        <li class="nav-title">
          Manage
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('siswa'); ?>"><i class="icon-graduation"></i> Siswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('guru'); ?>"><i class="icon-people"></i> Guru</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('mapel'); ?>"><i class="icon-notebook"></i> Mapel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('kelas'); ?>"><i class="icon-home"></i> Kelas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('admin'); ?>"><i class="icon-user"></i> Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('rumus'); ?>"><i class="icon-book-open"></i> Rumus</a>
        </li>
      <?php endif ?>
      <?php if ($this->session->userdata('role') == 'guru'): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('wasis'); ?>"><i class="icon-people"></i> Wali Siswa</a>
        </li>
        <li class="nav-title">
          Mapel
        </li>
        <div class="nav-mapel"></div>
        <script type="text/javascript">
          $(document).ready(function() {
            $.ajax({
              url: '<?php echo base_url('mapel/getMapelGuru'); ?>',
              type: 'POST',
              dataType: 'json',
              data: 'userid=<?php echo $this->session->userdata('userid'); ?>',
              success: function(r) {
                if (r.error) {
                  data = '<li class="nav-item">\
                            <a class="nav-link" href="#">'+r.error+'</a>\
                          </li>';
                  $('.nav-mapel').html(data);
                  return;
                }

                data = '';
                $.each(r, function(key,val) {
                  data += '<li class="nav-item">\
                            <a class="nav-link" href="<?php echo base_url('mapel/index/'); ?>'+val.id_mapel+'"><i class="icon-notebook"></i> '+val.nama_mapel+'</a>\
                          </li>';
                });
                $('.nav-mapel').html(data);
                setActiveCurNav();
              }
            });
          });
        </script>
      <?php endif ?>
      <?php if ($this->session->userdata('role') == 'siswa'): ?>
        <li class="nav-title">
          Mapel
        </li>
        <div class="nav-mapel"></div>
        <script type="text/javascript">
          $.ajax({
              url: '<?php echo base_url('mapel/getMapelSiswa'); ?>',
              type: 'POST',
              dataType: 'json',
              data: 'userid=<?php echo $this->session->userdata('userid'); ?>',
              success: function(r) {
                if (r.error) {
                  data = '<li class="nav-item">\
                            <a class="nav-link" href="#">'+r.error+'</a>\
                          </li>';
                  $('.nav-mapel').html(data);
                  return;
                }

                data = '';
                r = groupBy(r,'nama_jenis_mapel');
                $.each(r, function(key,val) {
                  data += '<li class="nav-item nav-dropdown">\
                              <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-notebook"></i> '+key+'</a>\
                                <ul class="nav-dropdown-items">';
                  $.each(val, function(key,val) {
                    data += '<li class="nav-item">\
                          <a class="nav-link" href="<?php echo base_url('mapel/'); ?>'+val.id_mapel+'">'+val.nama_mapel+'</a>\
                        </li>';
                  });
                  data += '</ul></li>';
                });
                $('.nav-mapel').html(data);
                setActiveCurNav();
              }
            });
        </script>
      <?php endif ?>
    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>