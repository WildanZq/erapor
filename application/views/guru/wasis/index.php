<div class="row">
	<div class="col-12 card-siswa">
		<div class="card">
			<div class="card-header font-weight-bold">Siswa</div>
			<div class="card-body">
				<table id="tabel-siswa" class="table table-striped table-hover" width="100%">
					<thead>
						<th>Nama Siswa</th>
						<th>Jenis Kelamin</th>
						<th>Kelas</th>
						<th></th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-2 pr-sm-1 card-mapel" style="display: none">
		<div class="card">
			<button class="btn btn-primary" onclick="showSiswa()"><i class="fa fa-arrow-left"></i> Back</button>
		</div>
	</div>
	<div class="col-sm-3 pr-sm-1 pl-sm-1 card-mapel" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Siswa</div>
			<div class="form-group m-0">
			  <select name="siswa" class="form-control select2" id="siswa" onchange="changeSiswa()"></select>
			</div>
		</div>
	</div>
	<div class="col-sm-4 pr-sm-1 pl-sm-1 card-mapel" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Kelas - Th Ajar</div>
			<div class="form-group m-0">
			  <select name="kelas" class="form-control select2" id="kelas" onchange="refreshMapel()"></select>
			</div>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 card-mapel" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Semester</div>
			<div class="form-group m-0">
			  <select name="semester" class="form-control" id="semester" onchange="refreshMapel()">
			  	<option value="1">1</option>
			  	<option value="2">2</option>
			  </select>
			</div>
		</div>
	</div>
	<div class="col-sm-3 pr-sm-1 card-mapel" style="display: none">
		<div class="card mb-2">
			<div class="card-header font-weight-bold">Ranking Kelas</div>
			<span class="pl-3 p-2" id="rank">3</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 pr-sm-1 card-mapel" style="display: none">
		<div class="card mb-2">
			<div class="card-header font-weight-bold">Nilai Sikap</div>
			<span class="pl-3 p-2" id="ns">A</span>
		</div>
	</div>
	<div class="col-sm-3 pl-sm-1 card-mapel" style="display: none">
		<div class="card mb-2">
			<button class="btn btn-primary" onclick="showModalEditNilaiSikap()"><i class="fa fa-pencil"></i> Edit Nilai Sikap</button>
		</div>
	</div>
	<div class="col-12 card-mapel" style="display: none">
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
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		tabelMapel = false;
		refreshSiswa();
	});

	function showModalEditNilaiSikap() {
		idKelasSiswa = $('#kelas').val();
		semester = $('#semester').val();
		if (! idKelasSiswa) {return;}

		body = '<div class="form-group">\
			      <label>Nilai Sikap</label>\
			      <select name="nilai" id="nilai" class="form-control">\
			      	<option value="-">-</option>\
					<option value="A">A</option>\
					<option value="B">B</option>\
					<option value="C">C</option>\
					<option value="D">D</option>\
					<option value="E">E</option>\
					<option value="F">F</option>\
				</select>\
			    </div>';
		updateModal('Edit Nilai Sikap', body, '<?php echo base_url('nilai/editNilaiSikap'); ?>', 'editNilaiSikap', null, 'md', 'primary');
		$('#modal').modal('show');
		$('#nilai').val(ns).trigger('change');
	}

	function editNilaiSikap() {
		idKelasSiswa = $('#kelas').val();
		semester = $('#semester').val();
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id_kelas_siswa='+idKelasSiswa+'&semester='+semester,
			success: function(r) {
				if (r.status) {
					ns = r.ns;
					$('#ns').html(r.ns);
				    toastr.remove();
				    toastr["success"]("Nilai sikap berhasil diedit");
				    $('.modal').modal('hide');
			    } else {
			    	toastr.remove();
			    	toastr["error"](r.error);
			    }
			}
		});
	}

	function refreshSiswa() {
		$.ajax({
			url: '<?php echo base_url('siswa/getSiswaByGuruId'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				opt = ''; html = '';
				$.each(r.data, function(key,data) {
					html += '<tr><td>'+data.nama_siswa+'</td><td>'+jk[data.jk]+'</td><td><span id="kelas'+data.id_siswa+'"></span></td>\
					<td><button class="btn btn-primary" onclick="showDetailSiswa('+data.id_siswa+')"><i class="icon-eye"></i> Detail</button></td></tr>';
					getKelas(data.id_siswa);
					opt += '<option value="'+data.id_siswa+'">'+data.nama_siswa+'</option>';
				});
				$('#siswa').html(opt);
				$('.select2').select2();
  				$('.select2').css('width','100%');
				$('#tabel-siswa tbody').html(html);
			}
		});
	}

	function getKelas(idSiswa) {
		$.ajax({
			url: '<?php echo base_url('kelas_siswa/getAllKelasSiswa') ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_siswa='+idSiswa,
			success: function(r) {
				html = ''; opt = '<option value="">-Pilih kelas-</option>';
				$.each(r.data, function(key,data) {
					html += data.nama_kelas+' - '+data.th_ajar+'/'+(parseInt(data.th_ajar)+1)+'<br>';
					opt += '<option value="'+data.id_kelas_siswa+'">'+data.nama_kelas+' - '+data.th_ajar+'/'+(parseInt(data.th_ajar)+1)+'</option>';
				});
				$('#kelas').html(opt);
				$('#kelas'+idSiswa).html(html);
				$('#tabel-siswa').dataTable();
				refreshMapel();
			}
		});
	}

	function showSiswa() {
		$('.card-mapel').slideUp();
		setTimeout(function() {
			$('.card-siswa').slideDown();
		},500);
	}

	function showDetailSiswa(idSiswa) {
		if (tabelMapel) {tabelMapel.fnDestroy();}
		$('.card-siswa').slideUp();
		$('#siswa').val(idSiswa).trigger('change');
		getKelas(idSiswa);
		setTimeout(function() {
			$('.card-mapel').slideDown();
			if (tabelMapel) {tabelMapel.fnDestroy();}
			$('#tabel-mapel').html('<h5 class="text-danger text-center">Pilih kelas dahulu</h5>');
			$('#rank').html('-');
			$('#ns').html('-');
		},500);
	}

	function changeSiswa() {
		idSiswa = $('#siswa').val();
		getKelas(idSiswa);
	}

	function refreshMapel() {
		idKelasSiswa = $('#kelas').val();
		semester = $('#semester').val();
		if (tabelMapel) {tabelMapel.fnDestroy();}
		if (! idKelasSiswa) {
			$('#tabel-mapel').html('<h5 class="text-danger text-center">Pilih kelas dahulu</h5>');
			$('#rank').html('-');
			$('#ns').html('-');
			return;
		} else {
			$('#tabel-mapel').html('<thead><th>Mapel</th><th>KKM</th><th>Nilai Akhir</th><th>Rata" Kelas</th><th>Ranking Kelas</th></thead><tbody></tbody>');
		}

		$.ajax({
			url: '<?php echo base_url('nilai/getNilaiSikap'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_kelas_siswa='+idKelasSiswa+'&semester='+semester,
			success: function(r) {
				if (r[0]) {
					ns = r[0].nilai;
					$('#ns').html(r[0].nilai);
				} else {
					ns = '-';
					$('#ns').html('-');
				}
			}
		});

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
								html = '';
								$.each(r, function(key,data) {
									na = 0;
									$.each(nr, function(nkey,ndata) {
										if (data.id_mapel == ndata.id_mapel) {
											na = ndata.nilai_akhir;
										}
									});
									clsna = '';
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
									if (rk == data.kkm) {clsrk = ' class="table-warning"';}
									else if (rk < data.kkm) {clsrk = ' class="table-danger"';}

									html += '<tr><td>'+data.nama_mapel+'</td><td>'+data.kkm+'</td><td'+clsna+'>'+na+'</td><td'+clsrk+'>'+rk+'</td><td>'+pos+'</td></tr>';
								});
								$('#tabel-mapel tbody').html(html);
								tabelMapel = $('#tabel-mapel').dataTable();
							}
						});
					}
				});
			}
		});
	}
</script>