<div class="row">
	<div class="col-sm-2 pr-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<button class="btn btn-primary" onclick="showMapel()"><i class="fa fa-arrow-left"></i> Back</button>
		</div>
	</div>
	<div class="col-sm-5 pr-sm-1 pl-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Mapel</div>
			<div class="form-group m-0">
			  <select name="semester" class="form-control select2" id="mapel" onchange="changeMapel($(this).val())">
			  	<option value="1">Bahasa Indonesia</option>
			  	<option value="2">Matematika</option>
			  </select>
			</div>
		</div>
	</div>
	<div class="col-sm-5 pl-sm-1 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">KKM</div>
			<span class="p-2 pl-3" id="kkm">75</span>
		</div>
	</div>
	<div class="col-12 card-mapel-detail" style="display: none">
		<div class="card">
			<div class="card-header font-weight-bold">Bahasa Indonesia</div>
			<div class="card-body">
				<canvas id="canvas-kd" height="80"></canvas>
			</div>
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
					<tbody>
						<tr>
							<td>Bahasa Indonesia</td>
							<td>75</td>
							<td>80</td>
							<td>80</td>
							<td>25</td>
							<td>
								<button onclick="showDetailMapel(1)" class="btn btn-primary"><span class="icon-eye"></span> Detail</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#tabel-mapel').dataTable();

		color = Chart.helpers.color;
		canvasKD = new Chart(document.getElementById("canvas-kd").getContext("2d"), {
	      	type: 'bar',
	      	data: {
	        	labels: ['kd1','kd2','kd3','kd3','kd4'],
	        	datasets: [{
		          	backgroundColor: [color(getRandomColor()).rgbString(),color(getRandomColor()).rgbString(),color(getRandomColor()).rgbString(),color(getRandomColor()).rgbString(),color(getRandomColor()).rgbString()],
		          	borderWidth: 0,
		          	pointBorderWidth: 1,
		          	data: ['90','80','85']
	      		}]
	      	},
	      	options: {
		        responsive: true,
	        	legend: {display: false},
	        	scales: {yAxes: [{ticks: {beginAtZero: true}}]}
	    	}
	  	});
	});

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

	function changeMapel(id) {
		
	}
</script>