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
					
					<form action="<?php echo site_url('Sosial/simpan'); ?>" method="post" >
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
									<?php foreach($siswa as $item){ ?>
									<tr>
										<td><?php echo $item->nama_lengkap; ?></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'jujurSB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'jujurPB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'disiplinSB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'disiplinPB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'TJSB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'TJPB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'santunSB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'santunPB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'peduliSB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'peduliPB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'PDSB-'.$item->NISN; ?>"></td>
										<td><input type="number" max="1" min="1" class="form-control" name="<?php echo 'PDPB-'.$item->NISN; ?>"></td>
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
	</div>
</div>