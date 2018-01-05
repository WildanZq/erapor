<div class="card">\
	<div class="card-header font-weight-bold">List Mapel\
		<button onclick="showModalAddMapel()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
			<i class="fa fa-plus"></i>&nbsp;Tambah Mapel\
		</button>\
	</div>\
	<div class="card-body">\
		<table id="tabel-mapel" class="table table-striped table-hover" width="100%">\
			<thead>\
				<th>Kurikulum</th>\
				<th>Jenis Mapel</th>\
				<th>Nama Mapel</th>\
				<th>KKM</th>\
				<th></th>\
			</thead>\
		</table>\
	</div>\
</div>\
<div class="row">\
	<div class="col-md-6 pr-sm-2">\
		<div class="card">\
			<div class="card-header font-weight-bold">List Kurikulum\
				<button onclick="showModalAddKurikulum()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
					<i class="fa fa-plus"></i>&nbsp;Tambah Kurikulum\
				</button>\
			</div>\
			<div class="card-body">\
				<table id="tabel-kurikulum" class="table table-striped table-hover" width="100%">\
					<thead>\
						<th style="width: 800px">Kurikulum</th>\
						<th></th>\
					</thead>\
				</table>\
			</div>\
		</div>\
	</div>\
	<div class="col-md-6 pl-sm-2">\
		<div class="card">\
			<div class="card-header font-weight-bold">List Jenis Mata Pelajaran\
				<button onclick="showModalAddJenisMapel()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-success float-right">\
					<i class="fa fa-plus"></i>&nbsp;Tambah Jenis Mapel\
				</button>\
			</div>\
			<div class="card-body">\
				<table id="tabel-jenismapel" class="table table-striped table-hover" width="100%">\
					<thead>\
						<th style="width: 800px">Jenis Mapel</th>\
						<th></th>\
					</thead>\
				</table>\
			</div>\
		</div>\
	</div>\
</div>