<table id="tabel-kelas-siswa" class="table table-striped table-hover" width="100%">\
	<thead><th>Tahun Ajar</th><th>Kelas</th><th></th></thead>\
	<tbody><tr><td colspan="3" class="text-center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span></td></tr></tbody>\
</table>\
<div class="row">\
	<div class="col-md-6 pr-md-1">\
		<div class="card mb-0">\
			<div class="card-header font-weight-bold">Tahun Ajar</div>\
			<div class="form-group m-0">\
				<div class="row m-0">\
					<input type="number" name="th_ajar" class="form-control col-6" id="th_ajar" oninput="changeThAjar()"></input>\
					<span class="col-6 p-2" id="th"></span>\
				</div>\
			</div>\
		</div>\
	</div>\
	<div class="col-md-6 pl-sm-1">\
		<div class="card mb-0">\
			<div class="card-header font-weight-bold">Kelas</div>\
			<div class="form-group m-0">\
				<select name="kelas" class="form-control select2" id="kelas"></select>\
			</div>\
		</div>\
	</div>\
</div>