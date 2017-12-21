<div class="row">
	<div class="col-lg-3 col-sm-4 pr-sm-1">
		<div class="card">
			<div class="card-header font-weight-bold">Kelas</div>
			<div class="form-group m-0">
			  <select name="kelas" class="form-control select2" id="kelas" onchange="updateKelas()"></select>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-4 pl-sm-1 pr-lg-1">
		<div class="card">
			<div class="card-header font-weight-bold">KKM
				<button onclick="showModalEditKKM()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-primary float-right">
					<i class="fa fa-pencil"></i>&nbsp;Edit KKM
				</button>
			</div>
			<div class="p-1 pl-3">75</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header font-weight-bold">Nilai Siswa X RPL 1
		<button onclick="showModalAddNilaiKD()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">
			<i class="fa fa-plus"></i>&nbsp;Tambah Nilai KD
		</button>
	</div>
	<div class="card-body">
		<table id="tabel-nilai-siswa" class="table table-striped table-hover" width="100%">
			<thead>
				<th>No</th>
				<th>Nama Siswa</th>
				<th>KD1</th>
				<th>KD2</th>
				<th>KD3</th>
				<th>KD4</th>
				<th></th>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>abc</td>
					<td>40</td>
					<td>70</td>
					<td>68</td>
					<td>90</td>
					<td><button class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button></td>
				</tr>
				<tr>
					<td>2</td>
					<td>dbc</td>
					<td>50</td>
					<td>60</td>
					<td>88</td>
					<td>80</td>
					<td><button class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="card">
	<div class="card-header font-weight-bold">Kompetensi Dasar
		<button onclick="showModalAddKD()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">
			<i class="fa fa-plus"></i>&nbsp;Tambah KD
		</button>
	</div>
	<div class="card-body">
		Belum ada KD
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		refreshPilihanKelas();
		$('#tabel-nilai-siswa').DataTable();
	});

	function refreshPilihanKelas() {
		$.ajax({
			url: '<?php echo base_url('kelas/getAllKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih kelas-</option>';
				r = groupBy(r.data,'nama_kelompok_kelas');
				$.each(r, function(key,data) {
					html += '<optgroup label="'+key+'">';
					$.each(data, function(key,data) {
						html += '<option value="'+data.id_kelas+'">'+data.nama_kelas+'</option>';
					});
					html += '</optgroup>';
				});
				$('#kelas').html(html);
				$('.select2').select2();
  				$('.select2').css('width','100%');
			}
		});
	}

	function updateKelas() {
		idKelas = $('#kelas').val();
	}
</script>