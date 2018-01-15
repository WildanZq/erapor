<div class="card">
	<div class="card-header font-weight-bold">Profile
		<button onclick="showModalEdit()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-primary float-right">
			<i class="fa fa-pencil"></i>&nbsp;Edit data
		</button>
		<button onclick="showModalPassword()" data-target="#modal" data-toggle="modal" class="btn btn-sm btn-danger float-right mr-2">
			<i class="fa fa-pencil"></i>&nbsp;Ubah password
		</button>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="my-2 px-3 mx-auto mx-sm-0">
				<form action="" method="post" class="pp" style="background-image: url(<?php echo base_url(); ?>assets/img/upload/profile/<?php if ($this->session->userdata('foto')): echo $this->session->userdata('foto'); else: ?>blank.jpg<?php endif ?>);" id="bg-img">
					<label for="pp">Ubah foto</label>
					<input type="file" name="pp" id="pp" onchange="updateIMG(this)" class="d-none">
				</form>
			</div>
			<div class="px-3 d-flex flex-column justify-content-center text-center text-sm-left mx-auto mx-sm-0 col-12 col-sm-auto pp-data">
				<h1 class="font-weight-bold mb-0"><?php echo $this->session->userdata('username'); ?></h1>
				<h5 class="text-muted"><?php echo $this->session->userdata('admin')['username']; ?></h4>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function showModalPassword() {
		body = '<div class="form-group">\
			      <label>Konfirmasi password</label>\
			      <input type="password" name="password" class="form-control" id="password">\
			    </div>';
		updateModal('Edit Password', body, '<?php echo base_url('profile/editPassword'); ?>', 'cekPassword', null, 'md', 'danger');
	}

	function showModalEdit() {
		body = '<?php echo $this->load->view('admin/profile/modal_body', '', TRUE); ?>';
		updateModal('Edit Profile', body, '<?php echo base_url('profile/editProfile'); ?>', 'editProfile', null, 'md', 'primary');

		$.ajax({
			url: '<?php echo base_url('profile/getProfile'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				$('#nama').val(r.nama_admin);
				$('#username').val(r.username);
			}
		});
	}

	function cekPassword() {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('profile/cekPassword'); ?>',
			type: 'POST',
			dataType: 'json',
			data: 'password='+$('#password').val(),
			success: function(r) {
				if (r.valid) {
		          	body = '<div class="form-group">\
						      <label>Password baru</label>\
						      <input type="password" name="password" class="form-control" id="password">\
						    </div><div class="form-group">\
						      <label>Konfirmasi password</label>\
						      <input type="password" name="password2" class="form-control" id="password2">\
						    </div>';
		          	updateModal('Edit Password', body, '<?php echo base_url('profile/editPassword'); ?>', 'editPassword', null, 'md', 'danger');

					toastr.remove();
		          	toastr["info"]('Masukkan password baru');
				} else {
					toastr.remove();
		          	toastr["error"](r.error);
				}
			}
		});
	}

	function editPassword() {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize(),
			success: function(r) {
				if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data profile berhasil diedit");
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
			}
		});
	}

	function editProfile() {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	      	type: 'POST',
	      	dataType: 'json',
	      	data: $('.modal-form').serialize()+'&id='+<?php echo $this->session->userdata('userid'); ?>,
	      	success: function(r) {
	        	if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data profile berhasil diedit");
					$('.nav-name').html(r.nama);
					$('.pp-data h1').html(r.nama);
					$('.pp-data h5').html(r.username);
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}
</script>