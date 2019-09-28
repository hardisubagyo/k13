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

<?php
    $kelas = $this->session->userdata('walikelas');
    $gettingkat = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas = '$kelas'")->row();
?>

<div class="content">
	<div class="row">

		<div class="col-md-12">

			<div class="card">
				<div class="card-header bg-success text-white header-elements-inline">
                <h6 class="card-title"><?php echo $header ; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
                </div>
                
                <div class="card-body">
                    <table class="table datatable-basic">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($siswa as $item) { 
                                $tahunajaran = $this->input->get('id_tahunajaran');
                                $semester = $this->input->get('semester');
                                $param = $item->NISN.'|'.$tahunajaran.'|'.$semester;
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $item->NISN; ?></td>
                                <td><?php echo $item->nama_lengkap; ?></td>
                                <td><?php echo $item->nama_jenkel; ?></td>
                                <td><?php echo $item->nama_agama; ?></td>
                                <td><?php echo $item->tmpt_lahir.', '.date("d M Y", strtotime($item->tgl_lahir)); ?></td>
                                <td><?php echo $item->alamat; ?></td>
                                <td>
                                    <a href="<?php echo site_url('Rapor/detail/'.base64_encode($param)); ?>">
                                        <button type="button" class="btn btn-outline bg-info text-info-800 btn-icon ml-2">
                                            <i class="icon-file-eye"></i>
                                        </button>
                                    </a>

                                    <a href="<?php echo site_url('Rapor/cetak/'.base64_encode($param)); ?>">
                                        <button type="button" class="btn btn-outline bg-success text-success-800 btn-icon ml-2">
                                            <i class="icon-printer2"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
				
			</div>
		</div>
	</div>
</div>