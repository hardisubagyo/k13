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
					<h6 class="card-title"><?php echo $header; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				
				<div class="card-body" style="overflow-x:scroll;overflow-y:visible;">
					<div class="col-md-12">
						<table class="table" style="width: 2750px;">
							<tr class="bg-success" align="center">
								<th rowspan="3" width="200px">Nama Siswa</th>
								<th colspan="6">Ekstrakulikuler</th>
								<th colspan="3">Absen</th>
								<th rowspan="3" width="300px">Keterangan</th>
								<th colspan="4">Ukuran Badan</th>
								<th colspan="3">Kondisi Kesehatan</th>
								<th rowspan="3" width="300px">Prestasi</th>
								<th rowspan="3" width="50px">Aksi</th>
							</tr>
							<tr class="bg-success" align="center">
								<th colspan="2">Pilihan 1</th>
								<th colspan="2">Pilihan 2</th>
								<th colspan="2">Pilihan 3</th>
								<th rowspan="2" width="100px">Sakit</th>
								<th rowspan="2" width="100px">Ijin</th>
								<th rowspan="2" width="100px">Alpa</th>
								<th colspan="2">Ganjil</th>
								<th colspan="2">Genap</th>
								<th rowspan="2" width="150px">Pendengaran</th>
								<th rowspan="2" width="150px">Penglihatan</th>
								<th rowspan="2" width="150px">Gigi</th>
							</tr>
							<tr class="bg-success" align="center">
								<th width="150px">Nama</th>
								<th width="100px">Nilai</th>
								<th width="150px">Nama</th>
								<th width="100px">Nilai</th>
								<th width="150px">Nama</th>
								<th width="100px">Nilai</th>
								<th width="100px">Tinggi</th>
								<th width="100px">Berat</th>
								<th width="100px">Tinggi</th>
								<th width="100px">Berat</th>

							</tr>
							<?php 
								foreach($siswa as $rows){ 
									$absen = $this->db->query("
										SELECT * FROM tr_absen WHERE NISN = '".$rows->NISN."' AND id_kelas = '".$this->input->get('id_kelas')."' AND id_tahunajaran = '".$this->input->get('id_tahunajaran')."' AND semester = '".$this->input->get('semester')."'
									")->row();

									$fisik = $this->db->query("
										SELECT * FROM tr_fisik WHERE NISN = '".$rows->NISN."' AND id_kelas = '".$this->input->get('id_kelas')."' AND id_tahunajaran = '".$this->input->get('id_tahunajaran')."' AND semester = '".$this->input->get('semester')."'
									")->row();

									$prestasi = $this->db->query("
										SELECT * FROM tr_prestasi WHERE NISN = '".$rows->NISN."' AND id_kelas = '".$this->input->get('id_kelas')."' AND id_tahunajaran = '".$this->input->get('id_tahunajaran')."' AND semester = '".$this->input->get('semester')."'
									")->row();

									$eks = $this->db->query("
										SELECT * FROM tr_ekstra WHERE NISN = '".$rows->NISN."' AND id_kelas = '".$this->input->get('id_kelas')."' AND id_tahunajaran = '".$this->input->get('id_tahunajaran')."' AND semester = '".$this->input->get('semester')."'
									")->row();
							?>
							<tr>
								<td><?php echo $rows->nama_lengkap; ?></td>
								<!-- Pilihan 1 -->
								<td>
									<select class="form-control" name="id_tm_ekstra_1-<?php echo $rows->NISN; ?>" readonly>
										<?php foreach($ekstra as $item){ ?>
										<option value="<?php echo $item->id_tm_ekstra; ?>" <?php if($item->id_tm_ekstra == $eks->id_tm_ekstra_1){echo "selected";}else{} ?>><?php echo $item->nama_ekstra; ?></option>
										<?php } ?>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" name="nilai-<?php echo $rows->NISN; ?>" value="<?php echo $eks->nilai; ?>" readonly>
								</td>

								<!-- Pilihan 2 -->
								<td>
									<select class="form-control" name="id_tm_ekstra_2-<?php echo $rows->NISN; ?>" readonly>
										<?php foreach($ekstra as $item){ ?>
										<option value="<?php echo $item->id_tm_ekstra; ?>" <?php if($item->id_tm_ekstra == $eks->id_tm_ekstra_2){echo "selected";}else{} ?>><?php echo $item->nama_ekstra; ?></option>
										<?php } ?>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" name="nilai_2-<?php echo $rows->NISN; ?>" value="<?php echo $eks->nilai_2; ?>" readonly>
								</td>

								<!-- Pilihan 2 -->
								<td>
									<select class="form-control" name="id_tm_ekstra_3-<?php echo $rows->NISN; ?>" readonly>
										<?php foreach($ekstra as $item){ ?>
										<option value="<?php echo $item->id_tm_ekstra; ?>" <?php if($item->id_tm_ekstra == $eks->id_tm_ekstra_3){echo "selected";}else{} ?>><?php echo $item->nama_ekstra; ?></option>
										<?php } ?>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" name="nilai_3-<?php echo $rows->NISN; ?>" value="<?php echo $eks->nilai_3; ?>" readonly>
								</td>

								<!-- Absen -->
								<td>
									<input type="text" class="form-control" name="sakit-<?php echo $rows->NISN; ?>" value="<?php echo $absen->sakit; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="ijin-<?php echo $rows->NISN; ?>" value="<?php echo $absen->ijin; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="alpa-<?php echo $rows->NISN; ?>" value="<?php echo $absen->alpa; ?>" readonly>
								</td>

								<!-- Keterangan -->
								<td>
									<textarea class="form-control" name="saran-<?php echo $rows->NISN; ?>" readonly><?php echo $absen->saran; ?></textarea>
								</td>

								<!-- Ukuran Badan -->
								<td>
									<input type="text" class="form-control" name="tinggi_1-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->tinggi_1; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="berat_1-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->berat_1; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="tinggi_2-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->tinggi_2; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="berat_2-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->berat_2; ?>" readonly>
								</td>

								<!-- Kesehatan -->
								<td>
									<input type="text" class="form-control" name="pendengaran-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->pendengaran; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="penglihatan-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->penglihatan; ?>" readonly>
								</td>
								<td>
									<input type="text" class="form-control" name="gigi-<?php echo $rows->NISN; ?>" value="<?php echo $fisik->gigi; ?>" readonly>
								</td>

								<!-- Prestasi -->
								<td>
									<textarea class="form-control" name="prestasi-<?php echo $rows->NISN; ?>" readonly><?php echo $prestasi->prestasi; ?></textarea>
								</td>

								<td>
									<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Nilai" data-toggle="modal" data-target="#Edit_Nilai" data-nisn="<?php echo $rows->NISN; ?>" data-idkelas="<?php echo $this->input->get('id_kelas'); ?>" data-idtahunajaran="<?php echo $this->input->get('id_tahunajaran'); ?>" data-semester="<?php echo $this->input->get('semester'); ?>" data-backdrop="static" data-keyboard="false">
										<i class="icon-pencil3"></i>
									</button>
								</td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<hr>
					<input type="hidden" name="id_kelas" value="<?php echo $this->input->get('id_kelas'); ?>">
					<input type="hidden" name="id_tahunajaran" value="<?php echo $this->input->get('id_tahunajaran'); ?>">
					<input type="hidden" name="semester" value="<?php echo $this->input->get('semester'); ?>">
				</div>
			</div>
		</div>

		<div id="Edit_Nilai" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-full">
				<div class="modal-content">
					<form action="<?php echo site_url('Lainnya/ubah'); ?>" method="post">
						<div class="modal-header">
							<h5 class="modal-title">Edit Nilai</h5>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							<div id="listnilai" style="overflow-x:scroll;overflow-y:visible;"></div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  	$(document).on("click", ".Edit_Nilai", function () {
  		var nisn = $(this).data('nisn');
  		var idkelas = $(this).data('idkelas');
  		var idtahunajaran = $(this).data('idtahunajaran');
  		var semester = $(this).data('semester');

	    $.ajax({
			type : "post",
		    data: {
		        "nisn" : nisn,
		        "idkelas" : idkelas,
		        "idtahunajaran" : idtahunajaran,
		        "semester" : semester
		    },
		    url: "<?php echo site_url('Lainnya/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		    	$('#listnilai').empty();
		        if(data.status == '1'){
		        	listnilai.innerHTML += '\
		        		<table class="table" style="width: 2750px;">\
							<tr class="bg-success" align="center">\
								<th colspan="6">Ekstrakulikuler</th>\
								<th colspan="3">Absen</th>\
								<th rowspan="3" width="300px">Keterangan</th>\
								<th colspan="4">Ukuran Badan</th>\
								<th colspan="3">Kondisi Kesehatan</th>\
								<th rowspan="3" width="300px">Prestasi</th>\
							</tr>\
							<tr class="bg-success" align="center">\
								<th colspan="2">Pilihan 1</th>\
								<th colspan="2">Pilihan 2</th>\
								<th colspan="2">Pilihan 3</th>\
								<th rowspan="2" width="100px">Sakit</th>\
								<th rowspan="2" width="100px">Ijin</th>\
								<th rowspan="2" width="100px">Alpa</th>\
								<th colspan="2">Ganjil</th>\
								<th colspan="2">Genap</th>\
								<th rowspan="2" width="150px">Pendengaran</th>\
								<th rowspan="2" width="150px">Penglihatan</th>\
								<th rowspan="2" width="150px">Gigi</th>\
							</tr>\
							<tr class="bg-success" align="center">\
								<th width="150px">Nama</th>\
								<th width="100px">Nilai</th>\
								<th width="150px">Nama</th>\
								<th width="100px">Nilai</th>\
								<th width="150px">Nama</th>\
								<th width="100px">Nilai</th>\
								<th width="100px">Tinggi</th>\
								<th width="100px">Berat</th>\
								<th width="100px">Tinggi</th>\
								<th width="100px">Berat</th>\
							</tr>\
							<tr>\
								<td>\
									<select class="form-control" name="id_tm_ekstra_1" id="id_tm_ekstra_1">\
										<?php foreach($ekstra as $item){ ?>\
										<option value="<?php echo $item->id_tm_ekstra; ?>"><?php echo $item->nama_ekstra; ?></option>\
										<?php } ?>\
									</select>\
								</td>\
								<td>\
									<input type="text" class="form-control" name="nilai" id="nilai">\
								</td>\
								<td>\
									<select class="form-control" name="id_tm_ekstra_2" id="id_tm_ekstra_2">\
										<?php foreach($ekstra as $item){ ?>\
										<option value="<?php echo $item->id_tm_ekstra; ?>"><?php echo $item->nama_ekstra; ?></option>\
										<?php } ?>\
									</select>\
								</td>\
								<td>\
									<input type="text" class="form-control" name="nilai_2" id="nilai_2">\
								</td>\
								<td>\
									<select class="form-control" name="id_tm_ekstra_3" id="id_tm_ekstra_3">\
										<?php foreach($ekstra as $item){ ?>\
										<option value="<?php echo $item->id_tm_ekstra; ?>"><?php echo $item->nama_ekstra; ?></option>\
										<?php } ?>\
									</select>\
								</td>\
								<td>\
									<input type="text" class="form-control" name="nilai_3" id="nilai_3">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="sakit" id="sakit">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="ijin" id="ijin">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="alpa" id="alpa">\
								</td>\
								<td>\
									<textarea class="form-control" name="saran" id="saran"></textarea>\
								</td>\
								<td>\
									<input type="text" class="form-control" name="tinggi_1" id="tinggi_1">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="berat_1" id="berat_1">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="tinggi_2" id="tinggi_2" readonly>\
								</td>\
								<td>\
									<input type="text" class="form-control" name="berat_2" id="berat_2">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="pendengaran" id="pendengaran">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="penglihatan" id="penglihatan">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="gigi" id="gigi">\
								</td>\
								<td>\
									<textarea class="form-control" name="prestasi" id="prestasi"></textarea>\
								</td>\
							</tr>\
						</table>\
						<input type="hidden" name="nisn" id="nisn">\
						<input type="hidden" name="id_kelas" id="id_kelas">\
						<input type="hidden" name="id_tahunajaran" id="id_tahunajaran">\
						<input type="hidden" name="semester" id="semester">\
						';
					var ekstra = JSON.parse(data.eks);
					var absen = JSON.parse(data.absen);
					var fisik = JSON.parse(data.fisik);
					var prestasi = JSON.parse(data.prestasi);

					document.getElementById("id_tm_ekstra_1").value = ekstra.id_tm_ekstra_1;
					$('#nilai').val(ekstra.nilai);
					document.getElementById("id_tm_ekstra_2").value = ekstra.id_tm_ekstra_2;
					$('#nilai_2').val(ekstra.nilai_2);
					document.getElementById("id_tm_ekstra_3").value = ekstra.id_tm_ekstra_3;
					$('#nilai_3').val(ekstra.nilai_3);

					$('#sakit').val(absen.sakit);
					$('#ijin').val(absen.ijin);
					$('#alpa').val(absen.alpa);
					$('#saran').val(absen.saran);

					$('#tinggi_1').val(fisik.tinggi_1);
					$('#berat_1').val(fisik.berat_1);
					$('#tinggi_2').val(fisik.tinggi_2);
					$('#berat_2').val(fisik.berat_2);
					$('#pendengaran').val(fisik.pendengaran);
					$('#penglihatan').val(fisik.penglihatan);
					$('#gigi').val(fisik.gigi);

					$('#prestasi').val(prestasi.prestasi);

					$('#nisn').val(data.nisn);
					$('#id_kelas').val(data.id_kelas);
					$('#id_tahunajaran').val(data.id_tahunajaran);
					$('#semester').val(data.semester);
					
		        }else{
		        	
		        }
		    },
		    error: function (jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR);
            }
	    });
	});
</script>