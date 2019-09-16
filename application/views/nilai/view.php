<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>
				<i class="icon-menu mr-2"></i>
				<span class="font-weight-semibold"><?php echo $title; ?></span>
			</h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<!-- /page header -->
	

<div class="content">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title"><?php echo $header .' Mata Pelajaran '. $matpel->nama_matpel . ' Kompetensi '. $jenis_kd->nama_jenis_kd .' Tingkat '. $tingkat->tingkat. ' Tahun Ajaran '. $ta->tahunajaran. ' Semester '. $this->input->get('semester') ; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				
				<div class="card-body">
					<div class="col-md-12">
						<table class="table table-responsive" width="100%">
							<tr class="bg-success">
								<th></th>
								<?php foreach($kd as $item){ ?>
								<th><?php echo $item->no_kd; ?></th>
								<?php } ?>
								<th>Nilai Maks</th>
								<th>Desk</th>
								<th>Nilai Min</th>
								<th>Desk</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
							<?php 

							$getSiswa = $this->db->query("
								SELECT 
									tm_siswa.NISN, 
									tm_siswa.nama_lengkap,
									tm_tingkat.id_tingkat,
									tm_kelas.id_kelas,
									tm_kelas.id_tingkat
								FROM 
									tm_siswa 
								JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
								JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
								WHERE tm_tingkat.id_tingkat = '".$tingkat->id_tingkat."'
								ORDER BY tm_siswa.nama_lengkap ASC
								")->result();

								foreach($getSiswa as $siswa) { ?>
									<tr>
										<td><?php echo $siswa->nama_lengkap; ?></td>
										<?php 
											$maks = array();
											foreach($kd as $item){ 
										?>
										<td>
											<?php 
												$nilai = $this->db->query("SELECT nilai FROM tr_nilai_matpel WHERE NISN = '".$siswa->NISN."' AND id_matpel = '".$matpel->id_matpel."' AND id_kd = '".$item->id_kd."' AND id_tingkat = '".$tingkat->id_tingkat."' AND id_tahunajaran = '".$ta->id_tahunajaran."' AND semester = '".$this->input->get('semester')."' AND id_jenis_kd = '".$this->input->get('id_jenis_kd')."' ")->row();
												if($nilai){
													$maks[] = $nilai->nilai;
													echo $nilai->nilai;

												}else{
													$maks[] = 0;
													echo "0";
												}
											?>
										</td>
										<?php } ?>
										<td><?php echo max($maks); ?></td>
										<td></td>
										<td><?php echo min($maks); ?></td>
										<td></td>
										<td>
											<?php 
												$getketerangan = $this->db->query("SELECT keterangan FROM tr_katerangan WHERE NISN = '".$siswa->NISN."' AND id_matpel = '".$matpel->id_matpel."' AND id_tahunajaran = '".$ta->id_tahunajaran."' AND semester = '".$this->input->get('semester')."' AND id_jenis_kd = '".$this->input->get('id_jenis_kd')."' ")->row();
												if($getketerangan){
													echo $getketerangan->keterangan;
												}else{
													echo "-";
												}
											?>
										</td>
										<td>
											<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Nilai" data-toggle="modal" data-target="#Edit_Nilai" data-nisn="<?php echo $siswa->NISN; ?>" data-idmatpel = "<?php echo $matpel->id_matpel; ?>" data-ta="<?php echo $ta->id_tahunajaran; ?>" data-idjeniskd="<?php echo $this->input->get('id_jenis_kd'); ?>" data-semester="<?php echo $this->input->get('semester'); ?>" data-idkd="<?php echo $item->id_kd; ?>" data-idtingkat="<?php echo $tingkat->id_tingkat; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										</td>
									</tr>

								<?php } ?>
						</table>
					</div>
					<hr>
					<div class="col-md-12">
						<table class="table table-responsive" width="100%">
							<tr class="bg-success">
								<th>No Kompetensii Dasar</th>
								<th>Keterangan</th>
							</tr>
							<?php foreach($kd as $item){  ?>
							<tr>
								<td><?php echo $item->no_kd; ?></td>
								<td><?php echo $item->deskripsi_kd; ?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>

				<div class="card-footer">
					<button type="submit" class="btn btn-success">Cari <i class="icon-search4 ml-2"></i></button>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div id="Edit_Nilai" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Nilai/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Nilai</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div id="listnilai"></div>
				</div>

				<input type="hidden" name="nisn" id="nisn">
				<input type="hidden" name="idmatpel" id="idmatpel">
				<input type="hidden" name="ta" id="ta">
				<input type="hidden" name="idjeniskd" id="idjeniskd">
				<input type="hidden" name="semester" id="semester">
				<input type="hidden" name="idkd" id="idkd">
				<input type="hidden" name="idtingkat" id="idtingkat">


				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

  	$(document).on("click", ".Edit_Nilai", function () {
  		var nisn = $(this).data('nisn');
	    var idmatpel = $(this).data('idmatpel');
	    var ta = $(this).data('ta');
	    var idjeniskd = $(this).data('idjeniskd');
	    var semester = $(this).data('semester');
	    var idkd = $(this).data('idkd');
	    var idtingkat = $(this).data('idtingkat');
	    
	    $.ajax({
			type : "post",
		    data: {
		        "nisn" : nisn,
				"idmatpel" : idmatpel,
				"ta" : ta,
				"idjeniskd" : idjeniskd,
				"semester" : semester,
				"idkd" : idkd,
				"idtingkat" : idtingkat
		    },
		    url: "<?php echo site_url('Nilai/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		    	$('#listnilai').empty();
		        if(data.status == '1'){
		        	$('#nisn').val(nisn);
		        	$('#idmatpel').val(idmatpel);
		        	$('#ta').val(ta);
		        	$('#idjeniskd').val(idjeniskd);
		        	$('#semester').val(semester);
		        	$('#idkd').val(idkd);
		        	$('#idtingkat').val(idtingkat);

		        	var listnilai = document.getElementById("listnilai");
		        	var get = JSON.parse(data.data);
		        	console.log(get);
		        	for(var i=0; i<get.length; i++){
		        		listnilai.innerHTML += '\
			        		<div class="form-group row">\
								<label col-form-label col-lg-3>'+get[i].no_kd+'</label>\
								<div class="col-lg-6	">\
									<input type="text" class="form-control" name="nilai'+get[i].id_nilai+'" value="'+get[i].nilai+'">\
								</div>\
							</div>\
							<input type="hidden" name="id_nilai'+get[i].id_nilai+'" value="'+get[i].id_nilai+'">\
		        		';
		        	}
		        }else{
		        	
		        }
		    }
	    });
	});
</script>