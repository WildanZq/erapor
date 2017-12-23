<div class="row">\
	<div class="col-lg-6 col-sm-5 pr-sm-2">\
		<div class="card">\
			<div class="card-header font-weight-bold">List Jurusan\
				<button onclick="showModalAddKelompokKelas()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
					<i class="fa fa-plus"></i>&nbsp;Tambah Jurusan\
				</button>\
			</div>\
			<div class="card-body">\
				<table id="tabel-kelompokkelas" class="table table-striped table-hover" width="100%">\
					<thead>\
						<th style="width: 800px">Jurusan</th>\
						<th></th>\
					</thead>\
				</table>\
			</div>\
		</div>\
	</div>\
</div>\
<div class="card">\
	<div class="card-header font-weight-bold">List Kelas\
		<button onclick="showModalAddKelas()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
			<i class="fa fa-plus"></i>&nbsp;Tambah Kelas\
		</button>\
	</div>\
	<div class="card-body">\
		<table id="tabel-kelas" class="table table-striped table-hover" width="100%">\
			<thead>\
				<th>Jurusan</th>\
				<th>Nama Kelas</th>\
				<th></th>\
			</thead>\
		</table>\
	</div>\
</div>