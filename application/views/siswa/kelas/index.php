<div class="row">
	<div class="col-sm-2 pr-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<button class="btn btn-primary" onclick="showMapel()"><i class="fa fa-arrow-left"></i> Back</button>
		</div>
	</div>
	<div class="col-sm-3 pr-sm-1 pl-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Mapel</div>
			<div class="form-group m-0">
			  <select name="mapel" class="form-control select2" id="mapel" onchange="getNilaiMapel($(this).val())"></select>
			</div>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 pr-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">KKM</div>
			<span class="p-2 pl-3" id="kkm">75</span>
		</div>
	</div>
	<div class="col-sm-4 pl-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Ranking Kelas</div>
			<span class="p-2 pl-3" id="rank">1</span>
		</div>
	</div>
	<div class="col-sm-3 pr-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Rata" Kelas</div>
			<span class="p-2 pl-3" id="rk">80</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 pr-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Nilai Akhir</div>
			<span class="p-2 pl-3" id="na">80</span>
		</div>
	</div>
	<div class="col-sm-3 pr-sm-1 pl-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">UTS</div>
			<span class="p-2 pl-3" id="uts">75</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">UAS</div>
			<span class="p-2 pl-3" id="uas">75</span>
		</div>
	</div>
	<div class="col-12 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Nilai KD</div>
			<div class="card-body">
				<canvas id="canvas-kd" height="80"></canvas>
			</div>
		</div>
	</div>
	<div class="col-sm-3 pr-sm-1 card-mapel">
		<div class="card mb-2">
			<div class="card-header font-weight-bold">Ranking Kelas</div>
			<span class="pl-3 p-2" id="rank">-</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 pr-sm-1 card-mapel">
		<div class="card mb-2">
			<div class="card-header font-weight-bold">Nilai Sikap</div>
			<span class="pl-3 p-2" id="ns">-</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 pr-sm-1 card-mapel">
		<div class="card mb-2">
			<div class="card-header font-weight-bold">Jumlah Nilai</div>
			<span class="pl-3 p-2" id="jn">-</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 card-mapel">
		<div class="card mb-2">
			<div class="card-header font-weight-bold">Rata" Nilai</div>
			<span class="pl-3 p-2" id="rn">-</span>
		</div>
	</div>
	<div class="col-12 card-mapel">
		<div class="card">
			<div class="card-header font-weight-bold">Nilai Mapel</div>
			<div class="card-body">
				<table id="tabel-mapel" class="table table-striped table-hover" width="100%">
					<thead>
						<th>Mapel</th>
						<th>KKM</th>
						<th>Nilai Akhir</th>
						<th>Rata" Kelas</th>
						<th>Ranking Kelas</th>
						<th></th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#tabel-mapel').dataTable();
		refreshMapel();
		getNilaiSikap();

		color = Chart.helpers.color;
		canvasKD = new Chart(document.getElementById("canvas-kd").getContext("2d"), {
	      	type: 'bar',
	      	data: {
	        	labels: [],
	        	datasets: [{
		          	backgroundColor: [],borderWidth: 0,pointBorderWidth: 1,data: []
	      		}]
	      	},
	      	options: {
		        responsive: true,legend: {display: false},scales: {yAxes: [{ticks: {beginAtZero: true}}]}
	    	}
	  	});
	});

	function getNilaiSikap() {
		$.ajax({
			url: '<?php echo base_url('nilai/getNilaiSikap'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_kelas_siswa='+<?php echo $this->uri->segment(3); ?>+'&semester='+<?php echo $this->uri->segment(4); ?>,
			success: function(r) {
				if (r[0]) {
					$('#ns').html(r[0].nilai);
				} else {
					$('#ns').html('-');
				}
			}
		});

	}

	function refreshMapel() {
		idKelasSiswa = <?php echo $this->uri->segment(3); ?>;
		semester = <?php echo $this->uri->segment(4); ?>;
		$.ajax({
			url: '<?php echo base_url('mapel/getMapelByKelasSiswa'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_kelas_siswa='+idKelasSiswa,
			success: function(r) {
				$.ajax({
					url: '<?php echo base_url('nilai/getNilaiByKelasSiswaAndSemester'); ?>',
					type: 'GET',
					dataType: 'json',
					data: 'id_kelas_siswa='+idKelasSiswa+'&semester='+semester,
					success: function(nr) {
						$.ajax({
							url: '<?php echo base_url('nilai/getAVGNilaiKelas'); ?>',
							type: 'GET',
							dataType: 'json',
							data: 'id_kelas='+r[0].id_kelas+'&semester='+semester+'&th_ajar='+r[0].th_ajar,
							success: function(anr) {
								avgnkelas = anr;
								nkelas = nr;
								mapelkelas = r;
								totalna = 0;
								mr = groupBy(r,'nama_jenis_mapel'); html = '';
								$.each(mr, function(key,data) {
									html += '<optgroup label="'+key+'">';
									$.each(data, function(key,data) {
										html += '<option value="'+data.id_mapel+'">'+data.nama_mapel+'</option>';
									});
									html += '</optgroup>';
								});
								$('#mapel').html(html);
								$('.select2').select2();
				  				$('.select2').css('width','100%');
								html = '';
								$.each(r, function(key,data) {
									na = 0;
									$.each(nr, function(nkey,ndata) {
										if (data.id_mapel == ndata.id_mapel) {
											na = ndata.nilai_akhir;
											totalna += parseInt(ndata.nilai_akhir);
										}
									});
									clsna = '';
									na = parseInt(na);
									data.kkm = parseInt(data.kkm);
									if (na == data.kkm) {clsna = ' class="table-warning"';}
									else if (na < data.kkm) {clsna = ' class="table-danger"';}

									rk = 0; pos = '-';
									$.each(anr, function(ankey,andata) {
										if (data.id_mapel == andata.id_mapel) {
											rk = Math.round(andata.nilai_akhir);
											pos = andata.position;
										}
									});
									clsrk = '';
									rk = parseInt(rk);
									if (rk == data.kkm) {clsrk = ' class="table-warning"';}
									else if (rk < data.kkm) {clsrk = ' class="table-danger"';}

									html += '<tr><td>'+data.nama_mapel+'</td><td>'+data.kkm+'</td><td'+clsna+'>'+na+'</td><td'+clsrk+'>'+rk+'</td><td>'+pos+'</td><td><button onclick="showDetailMapel('+data.id_mapel+')" class="btn btn-primary"><span class="icon-eye"></span> Detail</button></td></tr>';
								});
								$('#jn').html(totalna);
								$('#rn').html(Math.round(totalna/r.length));
								$('#tabel-mapel tbody').html(html);
								tabelMapel = $('#tabel-mapel').dataTable();
							}
						});
					}
				});
			}
		});
	}

	function showMapel() {
		$('.card-mapel-detail').slideUp();
		setTimeout(function() {
			$('.card-mapel').slideDown();
		},500);
	}

	function showDetailMapel(id) {
		$('#mapel').val(id).trigger('change');
		$('.card-mapel').slideUp();
		setTimeout(function() {
			$('.card-mapel-detail').slideDown();
		},500);
	}

	function getNilaiMapel(id) {
		semester = <?php echo $this->uri->segment(4); ?>;
		$.ajax({
			url: '<?php echo base_url('kd/getKD'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'semester='+semester+'&id_mapel='+$('#mapel').val(),
			success: function(kr) {
				$.ajax({
					url: '<?php echo base_url('nilai/getAllNilaiKD'); ?>',
					type: 'GET',
					dataType: 'json',
					data: 'id_mapel='+id+'&semester='+semester,
					success: function(r) {
						datas = []; labels = []; bg = [];
						$.each(kr, function(kkey,kdata) {
							dataval = 0;
							labels.push(kdata.nama_kd);
							bg.push(color(getRandomColor()).rgbString());
							$.each(r, function(key,data) {
								if (data.id_kelas_siswa == <?php echo $this->uri->segment(3); ?> && data.id_kd == kdata.id_kd) {
									dataval = data.nilai;
								}
							});
							datas.push(dataval);
						})
						canvasKD.data.labels = labels;
						canvasKD.data.datasets[0].data = datas;
						canvasKD.data.datasets[0].backgroundColor = bg;
						canvasKD.update();
					}
				});
			}
		});

		na = 0; kkm = ''; rank = '-'; na = 0; uas = 0; uts = 0;
		$.each(nkelas, function(key,data) {
			if (data.id_mapel == id) {
				na = data.nilai_akhir;
				uas = data.nilai_uas;
				uts = data.nilai_uts;
			}
		});
		$.each(mapelkelas, function(key,data) {
			if (data.id_mapel == id) {
				kkm = data.kkm;
			}
		});
		$.each(avgnkelas, function(key,data) {
			if (data.id_mapel == id) {
				na = Math.round(data.nilai_akhir);
				rank = data.position;
			}
		});
		$('#uts').html(uts);
		$('#uas').html(uas);
		$('#na').html(na);
		$('#kkm').html(kkm);
		$('#rk').html(na);
		$('#rank').html(rank);
	}
</script>