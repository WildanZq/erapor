<div class="row">\
	<div class="col-sm-4 pr-sm-1">\
		<div class="card">\
			<div class="card-header font-weight-bold">Semester</div>\
			<div class="form-group m-0">\
			  <select name="semester" class="form-control" id="semester" onchange="updateSemester()">\
			  	<option value="1">Semester 1</option>\
			  	<option value="2">Semester 2</option>\
			  </select>\
			</div>\
		</div>\
	</div>\
	<div class="col-sm-4 pl-sm-1 pr-sm-1">\
		<div class="card">\
			<div class="card-header font-weight-bold">Kelas</div>\
			<div class="form-group m-0">\
			  <select name="kelas" class="form-control select2" id="kelas" onchange="updateKelas()"></select>\
			</div>\
		</div>\
	</div>\
	<div class="col-sm-4 pl-sm-1">\
		<div class="card">\
			<div class="card-header font-weight-bold">KKM</div>\
			<div class="p-1 pl-3" id="kkm">75</div>\
		</div>\
	</div>\
</div>\
<div class="card">\
	<div class="card-header font-weight-bold">Nilai Siswa X RPL 1\
		<button onclick="showModalPilihNilai()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
			<i class="fa fa-plus"></i>&nbsp;Tambah Nilai\
		</button>\
	</div>\
	<div class="card-body">\
		<table id="tabel-nilai-siswa" class="table table-striped table-hover" width="100%">\
			<thead>\
				<th>No</th>\
				<th>Nama Siswa</th>\
				<th>Lorem ipsum dolor sit amet</th>\
				<th></th>\
			</thead>\
			<tbody>\
				<tr>\
					<td>1</td>\
					<td>abc</td>\
					<td>90</td>\
					<td><button onclick="showModalEditNilaiSiswa()" data-target="#modal" data-toggle="modal" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button></td>\
				</tr>\
			</tbody>\
			<tfoot>\
				<tr>\
					<td colspan="2" class="font-weight-bold text-right">Edit Nilai per KD:</td>\
					<td><button onclick="showModalEditNilaiKD()" data-target="#modal" data-toggle="modal" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit Nilai KD1</button></td>\
					<td></td>\
				</tr>\
			</tfoot>\
		</table>\
	</div>\
</div>\
<div class="card">\
	<div class="card-header font-weight-bold">Kompetensi Dasar\
		<button onclick="showModalAddKD(<?php echo $this->uri->segment(3); ?>)" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
			<i class="fa fa-plus"></i>&nbsp;Tambah KD\
		</button>\
	</div>\
	<div class="card-body" style="overflow-x: auto;">\
		<table id="tabel-kd" class="table mb-0">\
			<thead></thead>\
			<tbody><tr></tr></tbody>\
		</table>\
	</div>\
</div>