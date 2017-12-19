<div class="card col-lg-3 col-md-4 col-sm-6 p-0">
	<div class="card-header font-weight-bold">Kelas</div>	
	<div class="form-group m-0">
	  <select name="kelas" class="form-control select2" id="kelas"></select>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		refreshPilihanKelas();
	});

	function refreshPilihanKelas() {
		$.ajax({
			url: '<?php echo base_url('kelas/getAllKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih kelas-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_kelas+'">'+data.nama_kelas+'</option>';
				});
				$('#kelas').html(html);
				$('.select2').select2();
  				$('.select2').css('width','100%');
			}
		});
	}
</script>