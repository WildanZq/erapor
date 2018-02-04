<script type="text/javascript">
	$(document).ready(function() {
		tabelNilai = false;
		$('.main-container').html('<?php echo $this->load->view('guru/mapel/main_view', '', TRUE); ?>');
		
		getKKM();

		refreshPilihanKelas();

		refreshThAjar();

		updateNilai();

		refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
	});

	function updateThAjar() {
		updateNilai();
	}

	function showModalEditNilaiSiswa(id) {
		body = '';
		updateModal('Edit Nilai', body, '', 'editNilaiSiswa', id, 'md', 'primary');
		$.ajax({
			url: '<?php echo base_url('kd/getKD') ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_mapel='+<?php echo $this->uri->segment(3); ?>+'&semester='+$('#semester').val(),
			success: function(r) {
				$.ajax({
					url: '<?php echo base_url('nilai/getNilaiKD') ?>',
					type: 'GET',
					dataType: 'json',
					data: 'id_kelas_siswa='+id+'&id_mapel='+<?php echo $this->uri->segment(3); ?>+'&semester='+$('#semester').val(),
					success: function(nkr) {
						$.ajax({
							url: '<?php echo base_url('nilai/getNilai'); ?>',
							type: 'GET',
							dataType: 'json',
							data: 'id_kelas_siswa='+id+'&id_mapel='+idMapel+'&semester='+semester,
							success: function(nr) {
								body += '<div class="row">';
								$.each(r, function(key,data) {
									kd = 0;
									$.each(nkr, function(nkkey,nkdata) {
										if (data.id_kd == nkdata.id_kd) {
											kd = nkdata.nilai;
										}
									});
									clsKD = ''; infoKD = '';
									if (cekKKM(kd) == ' class="table-danger"') {
										clsKD = 'is-invalid';
										infoKD = '<div class="invalid-feedback">Nilai di bawah KKM.</div>';
									} else if (cekKKM(kd) == ' class="table-warning"') {
										clsKD = 'is-invalid';
										infoKD = '<div class="invalid-feedback">Nilai sama dengan KKM.</div>';
									}
									body += '<div class="col-12">\
											    <div class="form-group">\
											      <label>'+data.nama_kd+'</label>\
											      <input type="number" class="d-none" name="kd[]" value="'+data.id_kd+'">\
											      <input type="number" name="'+data.id_kd+'" class="form-control '+clsKD+'" id="'+data.id_kd+'" value="'+kd+'">'+infoKD+'\
											    </div>\
											  </div>';
								});
								uts = 0; uas = 0;
								$.each(nr, function(nkey,ndata) {
									if (ndata.id_kelas_siswa == id) {
										uts = ndata.nilai_uts;
										uas = ndata.nilai_uas;
									}
								});
								clsUTS = ''; infoUTS = '';
								if (cekKKM(uts) == ' class="table-danger"') {
									clsUTS = 'is-invalid';
									infoUTS = '<div class="invalid-feedback">Nilai di bawah KKM.</div>';
								} else if (cekKKM(uts) == ' class="table-warning"') {
									clsUTS = 'is-invalid';
									infoUTS = '<div class="invalid-feedback">Nilai sama dengan KKM.</div>';
								}
								clsUAS = ''; infoUAS = '';
								if (cekKKM(uas) == ' class="table-danger"') {
									clsUAS = 'is-invalid';
									infoUAS = '<div class="invalid-feedback">Nilai di bawah KKM.</div>';
								} else if (cekKKM(uas) == ' class="table-warning"') {
									clsUAS = 'is-invalid';
									infoUAS = '<div class="invalid-feedback">Nilai sama dengan KKM.</div>';
								}
								body += '<div class="col-12">\
										    <div class="form-group">\
										      <label>UTS</label>\
										      <input type="number" name="uts" class="form-control '+clsUTS+'" id="uts" value="'+uts+'">'+infoUTS+'\
										    </div>\
										  </div>\
										  <div class="col-12">\
										    <div class="form-group">\
										      <label>UAS</label>\
										      <input type="number" name="uas" class="form-control '+clsUAS+'" id="uas" value="'+uas+'">'+infoUAS+'\
										    </div>\
										  </div>\
										</div>';
								updateModal('Edit Nilai', body, '<?php echo base_url('nilai/editNilai'); ?>', 'editNilaiSiswa', id, 'md', 'primary');
							}
						});
					}
				})
			}
		});
	}

	function editNilaiSiswa(id) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('nilai/editNilai'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id_kelas_siswa='+id+'&semester='+$('#semester').val()+'&id_mapel='+<?php echo $this->uri->segment(3); ?>,
			success: function(r) {
				if (r.status) {
					updateNilai();
			    	toastr.remove();
			      	toastr["success"]("Nilai berhasil diedit");
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
			}
		});
	}

	function refreshPilihanKelas() {
		$.ajax({
			url: '<?php echo base_url('kelas/getKelasByMapelId'); ?>',
			type: 'GET',
			data: 'id='+<?php echo $this->uri->segment(3); ?>,
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih kelas-</option>';
				r = groupBy(r,'nama_kelompok_kelas');
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

	function refreshThAjar() {
		$.ajax({
			url: '<?php echo base_url('kelas_siswa/getThAjar'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				$.each(r, function(key,data) {
					html += '<option value="'+data.th_ajar+'">'+data.th_ajar+'/'+(parseInt(data.th_ajar)+1)+'</option>';
				});
				$('#th_ajar').html(html);
			}
		});
	}

	function cekKKM(data) {
		data = parseInt(data);
		kkm = parseInt(kkm);
		if (data == kkm) {
			return ' class="table-warning"';
		} else if (data < kkm) {
			return ' class="table-danger"';
		}
		return '';
	}

	function getKKM() {
		$.ajax({
			url: '<?php echo base_url('mapel/getMapelById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id=<?php echo $this->uri->segment(3); ?>',
			success: function(r) {
				kkm = r.kkm;
				$('#kkm').html(r.kkm);
			}
		});
	}

	function updateSemester() {
		refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
		updateNilai();
	}

	function updateKelas() {
		updateNilai();
	}

	function updateNilai() {
		$('#tabel-nilai-siswa').html('');
		idKelas = $('#kelas').val();
		idMapel = <?php echo $this->uri->segment(3); ?>;
		thAjar = $('#th_ajar').val();
		semester = $('#semester').val();

		if (tabelNilai) {tabelNilai.fnDestroy();}
		if (! idKelas) {
			$('#header-nilai').html('Nilai Siswa');
			$('#tabel-nilai-siswa').html('<h5 class="text-danger text-center">Pilih kelas dahulu</h5>');
			return;
		}

		$.ajax({
			url: '<?php echo base_url('kd/getKD') ?>',
			type: 'GET',
			dataType: 'json',
			data: 'semester='+semester+'&id_mapel='+idMapel,
			success: function(r) {
				thtml = '<thead><th>No</th><th>Nama Siswa</th>';
				$.each(r, function(key,data) {
					thtml += '<th>'+data.nama_kd+'</th>';
				});
				thtml += '<th>UTS</th><th>UAS</th><th>Nilai Akhir</th><th></th></thead><tbody></tbody><tfoot></tfoot>';

				$.ajax({
					url: '<?php echo base_url('siswa/getSiswaByKelasIdAndThAjar') ?>',
					type: 'GET',
					dataType: 'json',
					data: 'id='+idKelas+'&th_ajar='+thAjar,
					success: function(sr) {
						if (sr.length == 0) {
							$('#tabel-nilai-siswa').html('<h5 class="text-danger text-center">Tidak ada siswa</h5>');
							return;
						}

						$('#tabel-nilai-siswa').html(thtml);
						shtml = '';
						$.ajax({
							url: '<?php echo base_url('nilai/getAllNilaiKD'); ?>',
							type: 'GET',
							dataType: 'json',
							data: 'id_mapel='+idMapel+'&semester='+semester,
							success: function(nkr) {
								$.ajax({
									url: '<?php echo base_url('nilai/getAllNilai'); ?>',
									type: 'GET',
									dataType: 'json',
									data: 'id_mapel='+idMapel+'&semester='+semester,
									success: function(nr) {
										$.each(sr, function(skey,sdata) {
											shtml += '<tr><td>'+(skey+1)+'</td><td>'+sdata.nama_siswa+'</td>';

											$.each(r, function(key,data) {
												kd = 0;
												$.each(nkr, function(nkkey,nkdata) {
													if (nkdata.id_kelas_siswa == sdata.id_kelas_siswa && data.id_kd == nkdata.id_kd) {
														kd = nkdata.nilai;
													}
												});
												shtml += '<td'+(cekKKM(kd))+'>'+kd+'</td>';
											});

											uts = 0; uas = 0; na = 0;
											$.each(nr, function(nkey,ndata) {
												if (ndata.id_kelas_siswa == sdata.id_kelas_siswa) {
													uts = ndata.nilai_uts;
													uas = ndata.nilai_uas;
													na = ndata.nilai_akhir;
												}
											})
											shtml += '<td'+(cekKKM(uts))+'>'+uts+'</td><td'+(cekKKM(uas))+'>'+uas+'</td><td'+(cekKKM(na))+'>'+na+'</td>';
											
											shtml += '<td><button onclick="showModalEditNilaiSiswa('+sdata.id_kelas_siswa+')" data-target="#modal" data-toggle="modal" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</button></td></tr>';
										});
										$('#tabel-nilai-siswa tbody').html(shtml);
										tabelNilai = $('#tabel-nilai-siswa').dataTable();
									}
								});
							}

						});
					}
				});
			}
		});

	}

	function refreshTabelKD(semester,idMapel) {
		$('#tabel-kd').html('<thead></thead><tbody><tr></tr></tbody>');
		$.ajax({
			url: '<?php echo base_url('kd/getKD'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'semester='+semester+'&id_mapel='+idMapel,
			success: function(r) {
				if (r.length == 0) {
					$('#tabel-kd thead').html('<strong class="text-danger">KD belum ada, segera tambahkan!</strong>');
					$('#tabel-kd tbody tr').html('');
					return;
				}

				htmlHead = ''; htmlBody = '';
				$.each(r, function(i, data) {
					htmlHead += '<th>'+(++i)+'. '+data.nama_kd+'</th>';
					if (i == 1) {awal = 'disabled'} else {awal = ''}
					if (i == r.length) {akhir = 'disabled'} else {akhir = ''}
					htmlBody += '<td class="py-2">\
						<div style="width: 100px;">\
							<div class="d-flex justify-content-center align-items-center">\
								<button '+awal+' onclick="moveLeftKD('+data.id_kd+')" class="btn mr-1"><i class="fa fa-caret-left"></i></button>\
								<button '+akhir+' onclick="moveRightKD('+data.id_kd+')" class="btn"><i class="fa fa-caret-right"></i></button>\
							</div>\
							<div class="mt-1 d-flex justify-content-center align-items-center">\
								<button onclick="showModalEditKD('+data.id_kd+')" class="btn btn-primary mr-1" data-target="#modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button>\
								<button onclick="showModalDeleteKD('+data.id_kd+')" class="btn btn-danger" data-target="#modal" data-toggle="modal"><i class="fa fa-trash"></i></button>\
							</div>\
						</div>\
					</td>';
				});
				$('#tabel-kd thead').html(htmlHead);
				$('#tabel-kd tbody tr').html(htmlBody);
			}
		});
	}

	function showModalAddKD(idMapel) {
		body = '<?php echo $this->load->view('guru/kd/modal_body', '', TRUE); ?>';
		updateModal('Tambah KD', body, '<?php echo base_url('kd/addKD'); ?>', 'addKD', idMapel, 'md', 'success');

		$('#semester_kd').val($('#semester').val());
	}

	function showModalEditKD(idKD) {
		body = '<?php echo $this->load->view('guru/kd/modal_body', '', TRUE); ?>';
		updateModal('Edit KD', body, '<?php echo base_url('kd/editKD'); ?>', 'editKD', idKD, 'md', 'primary');

		$.ajax({
			url: '<?php echo base_url('kd/getKDById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_kd='+idKD,
			success: function(r) {
				$('#semester_kd').val(r.semester);
				$('#nama_kd').val(r.nama_kd);
			}
		});
	}

	function showModalDeleteKD(idKD) {
		updateModal('Delete KD?', '', '<?php echo base_url('kd/deleteKD'); ?>', 'deleteKD', idKD, 'sm', 'danger', 'Yes');
	}

	function addKD(idMapel) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kd/addKD'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id_mapel='+idMapel+'&semester_kd='+$('#semester').val(),
			success: function(r) {
				if (r.status) {
					updateNilai();
			    	toastr.remove();
			      	toastr["success"]("Data KD berhasil ditambahkan");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
			}
		});
	}

	function editKD(idKD) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kd/editKD'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id_kd='+idKD+'&id_mapel='+<?php echo $this->uri->segment(3); ?>,
			success: function(r) {
				if (r.status) {
			      	updateNilai();
			    	toastr.remove();
			      	toastr["success"]("Data KD berhasil diedit");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
			}
		});
	}

	function deleteKD(idKD) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kd/deleteKD'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idKD,
	      	success: function(r) {
		        if (r.status) {
		        	updateNilai();
		          	toastr.remove();
		          	toastr["success"]("Data KD berhasil dihapus");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

	function moveLeftKD(idKD) {
		$.ajax({
			url: '<?php echo base_url('kd/moveLeftKD'); ?>',
			type: 'POST',
			dataType: 'json',
			data: 'id='+idKD,
			success: function(r) {
				if (r.status) {
					updateNilai();
					toastr.remove();
					toastr['success']("KD berhasil dipindah");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
				} else {
					toastr.remove();
					toastr['error'](r.error);
				}
			}
		});
	}

	function moveRightKD(idKD) {
		$.ajax({
			url: '<?php echo base_url('kd/moveRightKD'); ?>',
			type: 'POST',
			dataType: 'json',
			data: 'id='+idKD,
			success: function(r) {
				if (r.status) {
					updateNilai();
					toastr.remove();
					toastr['success']("KD berhasil dipindah");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
				} else {
					toastr.remove();
					toastr['error'](r.error);
				}
			}
		});
	}
</script>