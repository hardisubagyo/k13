<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>
				<i class="icon-menu mr-2"></i>
				<span class="font-weight-semibold"><?php echo $title; ?></span> - <?php echo $header; ?>
			</h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<!-- /page header -->
	

<div class="content">
	<div class="row">
		<div class="col-md-6">

			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title"><?php echo $header; ?></h5>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				<form action="<?php echo site_url('Pegawai/simpan'); ?>" method="post" id="Add_Pegawai">
					<div class="card-body">
						<div class="form-group">
							<label>NIP</label>
							<input type="text" name="nip" class="form-control" placeholder="NIP" required>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control" placeholder="Nama" required>
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="Email" required>
						</div>

						<div class="form-group">
							<label>Akses</label>
							<select class="form-control" name="id_akses" id="id_akses">
								<option value="">Pilih Tipe Akses</option>
								<?php foreach ($akses as $item) {?>
									<option value="<?php echo $item->id_akses; ?>"><?php echo $item->nama_akses; ?></option>
								<?php }?>
							</select>
						</div>

						<div id="SelectGuru" style="display: none;">
							<button type="button" onclick="Add_Form();" class="btn bg-brown-400 access-multiple-clear">Pilih Mata Pelajaran</button>
						</div>

						<div class="form-group" id="walikelas" style="display: none;">
							<label>WaliKelas</label>
							<select class="form-control" name="id_walikelas">
								<?php foreach ($kelas as $item) {?>
									<option value="<?php echo $item->id_kelas; ?>"><?php echo $item->kelas; ?></option>
								<?php }?>
							</select>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password" required>
						</div>

						<div class="form-group">
							<label>RePassword</label>
							<input type="password" name="repassword" class="form-control" placeholder="RePassword" required>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>

		</div>

	</div>
</div>

<script type="text/javascript">

	$("#id_akses").change(function(){
    	var akses = $(this).val();
		var walikelas = document.getElementById("walikelas");
		var guru = document.getElementById("SelectGuru");

    	if(akses == '1'){
    		walikelas.style.display = "none";
			guru.style.display = "block";
    	}else if(akses == '2'){
    		walikelas.style.display = "block";
			guru.style.display = "block";
    	}else if(akses == '3'){
    		walikelas.style.display = "none";
			guru.style.display = "none";
    	}else if(akses == '4'){
    		walikelas.style.display = "none";
			guru.style.display = "none";
    	}
	});

	function Add_Form(){
		var html = '';

      	html += '<div class="row">';
      	html += '<div class="col-md-6"><div class="form-group" id="matapelajaran">';
      	html += '<label>Mata Pelajaran</label>';
      	html += '<select class="form-control select" name="id_matpel[]">';
      	html += '<?php foreach ($matpel as $item) {?><option value="<?php echo $item->id_matpel; ?>"><?php echo $item->nama_matpel; ?></option><?php }?>';
		html += '</select>';
      	html += '</div></div>';

      	html += '<div class="col-md-4"><div class="form-group" id="kelas">';
      	html += '<label>Kelas</label>';
      	html += '<select class="form-control select KelasID" multiple="multiple" name="id_kelas[]" id="id_kelas_form  onchange="kelas()">';
		html += '<?php foreach ($kelas as $item) {?><option value="<?php echo $item->id_kelas; ?>"><?php echo $item->kelas; ?></option><?php }?>';
		html += '</select>';
		html += '</div></div>';

		html += '<div class="form-group"';
		html += '<label>&nbsp;</label>';
		html += '<div class="col-md-2"><div class="form-group"><button type="button" class="btn btn-danger" onclick="del_form(this)">Hapus</button></div></div>';
		html += '</div>';
		html += '</div>';

		$('#SelectGuru').append(html);

		$('select').select2({
			dropdownParent: $('#Add_Pegawai')
		});
	}

	function del_form(id){
    	id.closest('.row').remove();
  	}

</script>