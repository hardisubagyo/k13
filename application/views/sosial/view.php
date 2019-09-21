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
				<div class="card-body">
					<div class="alert alert-warning alert-styled-left alert-dismissible">
						Apabila siswa tidak memilik catatan apapun dalam jurnal sikap atau perilaku , maka anak tersebut diasumsikan baik oleh sebab itu dalam aplikasi ini biarkan saja tidak usah diisi apapun sudah otomatis muncul deskripsi baik
				    </div>
					
					<form action="<?php echo site_url('Spiritual/simpan'); ?>" method="post" >
						<div class="card-body">
							<div class="col-md-12">
								<table class="table table-responsive">
									<tr class="bg-success" align="center">
										<th rowspan="2">Nama Siswa</th>
										<th colspan="2">Jujur</th>
										<th colspan="2">Disiplin</th>
										<th colspan="2">Tanggung Jawab</th>
										<th colspan="2">Santun</th>
										<th colspan="2">Peduli</th>
										<th colspan="2">Percaya Diri</th>
										<th rowspan="2">Aksi</th>
									</tr>
									<tr class="bg-success" align="center">
										<th>SB</th>
										<th>PB</th>
										<th>SB</th>
										<th>PB</th>
										<th>SB</th>
										<th>PB</th>
										<th>SB</th>
										<th>PB</th>
										<th>SB</th>
										<th>PB</th>
										<th>SB</th>
										<th>PB</th>
									</tr>
									<?php 
										$id_kelas = $this->input->get('id_kelas');
										$id_tahunajaran = $this->input->get('id_tahunajaran');
										$semester = $this->input->get('semester');

										foreach($siswa as $item){ 
										$getnilai = $this->db->query("SELECT * FROM tr_nilai_sosial WHERE NISN = '$item->NISN' AND id_kelas = '$id_kelas' AND id_tahunajaran = '$id_tahunajaran' AND semester = '$semester' ")->row();
										$jujur = explode("|", $getnilai->jujur);
										$disiplin = explode("|", $getnilai->disiplin);
										$TJ = explode("|", $getnilai->tanggung_jawab);
										$santun = explode("|", $getnilai->santun);
										$peduli = explode("|", $getnilai->peduli);
										$PD = explode("|", $getnilai->percaya_diri);
									?>
									<tr>
										<td><?php echo $item->nama_lengkap; ?></td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'jujurSB-'.$item->NISN; ?>" value="<?php echo $jujur[0]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'jujurPB-'.$item->NISN; ?>" value="<?php echo $jujur[1]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'disiplinSB-'.$item->NISN; ?>" value="<?php echo $disiplin[0]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'disiplinPB-'.$item->NISN; ?>" value="<?php echo $disiplin[1]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'TJSB-'.$item->NISN; ?>" value="<?php echo $TJ[0]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'TJPB-'.$item->NISN; ?>" value="<?php echo $TJ[1]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'santunSB-'.$item->NISN; ?>" value="<?php echo $santun[0]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'santunPB-'.$item->NISN; ?>" value="<?php echo $santun[1]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'peduliSB-'.$item->NISN; ?>" value="<?php echo $peduli[0]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'peduliPB-'.$item->NISN; ?>" value="<?php echo $peduli[1]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'PDSB-'.$item->NISN; ?>" value="<?php echo $PD[0]; ?>" readonly>
										</td>
										<td>
											<input type="text" class="form-control" name="<?php echo 'PDPB-'.$item->NISN; ?>" value="<?php echo $PD[1]; ?>" readonly>
										</td>
										<td>
											<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Nilai" data-toggle="modal" data-target="#Edit_Nilai" data-id="<?php echo $getnilai->id_nilai_sosi; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										</td>
									</tr>
									<?php } ?>
								</table>
							</div>
							<hr>
							<input type="hidden" name="id_tingkat" value="<?php echo $this->input->get('id_tingkat'); ?>">
							<input type="hidden" name="id_tahunajaran" value="<?php echo $this->input->get('id_tahunajaran'); ?>">
							<input type="hidden" name="semester" value="<?php echo $this->input->get('semester'); ?>">
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-success">Simpan <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="Edit_Nilai" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-full">
				<div class="modal-content">
					<form action="<?php echo site_url('Sosial/ubah'); ?>" method="post">
						<div class="modal-header">
							<h5 class="modal-title">Edit Nilai</h5>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							<div id="listnilai"></div>
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
  		var id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        "id" : id
		    },
		    url: "<?php echo site_url('Sosial/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		    	$('#listnilai').empty();
		        if(data.status == '1'){
		        	listnilai.innerHTML += '\
		        		<table class="table">\
							<tr class="bg-success" align="center">\
								<th colspan="2">Jujur</th>\
								<th colspan="2">Disiplin</th>\
								<th colspan="2">Tanggung Jawab</th>\
								<th colspan="2">Santun</th>\
								<th colspan="2">Peduli</th>\
								<th colspan="2">Percaya Diri</th>\
							</tr>\
							<tr class="bg-success" align="center">\
								<th>SB</th>\
								<th>PB</th>\
								<th>SB</th>\
								<th>PB</th>\
								<th>SB</th>\
								<th>PB</th>\
								<th>SB</th>\
								<th>PB</th>\
								<th>SB</th>\
								<th>PB</th>\
								<th>SB</th>\
								<th>PB</th>\
							</tr>\
							<tr>\
								<td>\
									<input type="text" class="form-control" name="jujurSB" id="jujurSB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="jujurPB" id="jujurPB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="disiplinSB" id="disiplinSB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="disiplinPB" id="disiplinPB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="TJSB" id="TJSB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="TJPB" id="TJPB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="santunSB" id="santunSB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="santunPB" id="santunPB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="peduliSB" id="peduliSB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="peduliPB" id="peduliPB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="PDSB" id="PDSB">\
								</td>\
								<td>\
									<input type="text" class="form-control" name="PDPB" id="PDPB">\
								</td>\
							</tr>\
						</table>\
						<input type="hidden" name="id_nilai_sosi" id="id_nilai_sosi">\
						';

					var get = JSON.parse(data.data);
					var a = get.jujur;
					var b = get.disiplin;
					var c = get.tanggung_jawab;
					var d = get.santun;
					var e = get.peduli;
					var f = get.percaya_diri;

					var jujur = a.split("|");
					var disiplin = b.split("|");
					var tanggung_jawab = c.split("|");
					var santun = d.split("|");
					var peduli = e.split("|");
					var percaya_diri = f.split("|");

					$('#jujurSB').val(jujur[0]);
					$('#jujurPB').val(jujur[1]);
					$('#disiplinSB').val(disiplin[0]);
					$('#disiplinPB').val(disiplin[1]);
					$('#TJSB').val(tanggung_jawab[0]);
					$('#TJPB').val(tanggung_jawab[1]);
					$('#santunSB').val(santun[0]);
					$('#santunPB').val(santun[1]);
					$('#peduliSB').val(peduli[0]);
					$('#peduliPB').val(peduli[1]);
					$('#PDSB').val(percaya_diri[0]);
					$('#PDPB').val(percaya_diri[1]);

					$('#id_nilai_sosi').val(get.id_nilai_sosi);
		        }else{
		        	
		        }
		    }
	    });
	});
</script>