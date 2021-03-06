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
										<th colspan="2">Beribadah</th>
										<th colspan="2">Syukur</th>
										<th colspan="2">Berdoa</th>
										<th colspan="2">Toleransi</th>
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
									</tr>
									<?php 
										$id_kelas = $this->input->get('id_kelas');
										$id_tahunajaran = $this->input->get('id_tahunajaran');
										$semester = $this->input->get('semester');

										foreach($siswa as $item){ 
										$getnilai = $this->db->query("SELECT * FROM tr_nilai_spirit WHERE NISN = '$item->NISN' AND id_kelas = '$id_kelas' AND id_tahunajaran = '$id_tahunajaran' AND semester = '$semester' ")->row();
										$ibadah = explode("|", $getnilai->beribadah);
										$syukur = explode("|", $getnilai->syukur);
										$doa = explode("|", $getnilai->berdoa);
										$toleransi = explode("|", $getnilai->toleransi);

									?>
									<tr>
										<td><?php echo $item->nama_lengkap; ?></td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'ibadahSB-'.$item->NISN; ?>" value="<?php echo $ibadah[0]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'ibadahPB-'.$item->NISN; ?>" value="<?php echo $ibadah[1]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'syukurSB-'.$item->NISN; ?>" value="<?php echo $syukur[0]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'syukurPB-'.$item->NISN; ?>" value="<?php echo $syukur[1]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'doaSB-'.$item->NISN; ?>" value="<?php echo $doa[0]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'doaPB-'.$item->NISN; ?>" value="<?php echo $doa[1]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'toleransiSB-'.$item->NISN; ?>" value="<?php echo $toleransi[0]; ?>" readonly>
										</td>
										<td>
											<input type="number" max="1" min="1" class="form-control" name="<?php echo 'toleransiPB-'.$item->NISN; ?>" value="<?php echo $toleransi[1]; ?>" readonly>
										</td>
										<td>
											<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Nilai" data-toggle="modal" data-target="#Edit_Nilai" data-nisn="<?php echo $item->NISN; ?>" data-ta="<?php echo $id_tahunajaran; ?>" data-semester="<?php echo $semester; ?>" data-idkelas="<?php echo $id_kelas; ?>" data-backdrop="static" data-keyboard="false">
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

						<div class="card-footer">
							<button type="submit" class="btn btn-success">Simpan <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="Edit_Nilai" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form action="<?php echo site_url('Spiritual/ubah'); ?>" method="post">
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
  		var nisn = $(this).data('nisn');
	    var semester = $(this).data('semester');
	    var ta = $(this).data('ta');
	    var idkelas = $(this).data('idkelas');
	    
	    $.ajax({
			type : "post",
		    data: {
		        "nisn" : nisn,
				"ta" : ta,
				"semester" : semester,
				"idkelas" : idkelas
		    },
		    url: "<?php echo site_url('Spiritual/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		    	$('#listnilai').empty();
		        if(data.status == '1'){

		        	listnilai.innerHTML += '\
		        		<table class="table">\
							<tr class="bg-success" align="center">\
								<th colspan="2">Beribadah</th>\
								<th colspan="2">Syukur</th>\
								<th colspan="2">Berdoa</th>\
								<th colspan="2">Toleransi</th>\
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
							</tr>\
							<tr>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="ibadahSB" id="ibadahSB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="ibadahPB" id="ibadahPB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="syukurSB" id="syukurSB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="syukurPB" id="syukurPB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="doaSB" id="doaSB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="doaPB" id="doaPB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="toleransiSB" id="toleransiSB">\
								</td>\
								<td>\
									<input type="number" max="1" min="1" class="form-control" name="toleransiPB" id="toleransiPB">\
								</td>\
							</tr>\
						</table>\
						<input type="hidden" name="id_nilai_spirit" id="id_nilai_spirit">\
						';

					var get = JSON.parse(data.data);
					var i = get.beribadah;
					var s = get.syukur;
					var d = get.berdoa;
					var t = get.toleransi;

					var ibadah = i.split("|");
					var syukur = s.split("|");
					var doa = d.split("|");
					var toleransi = t.split("|");

					$('#ibadahSB').val(ibadah[0]);
					$('#ibadahPB').val(ibadah[1]);
					$('#syukurSB').val(syukur[0]);
					$('#syukurPB').val(syukur[1]);
					$('#doaSB').val(doa[0]);
					$('#doaPB').val(doa[1]);
					$('#toleransiSB').val(toleransi[0]);
					$('#toleransiPB').val(toleransi[1]);

					$('#id_nilai_spirit').val(get.id_nilai_spirit);
		        }else{
		        	
		        }
		    }
	    });
	});
</script>