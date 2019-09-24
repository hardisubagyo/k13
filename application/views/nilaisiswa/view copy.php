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
					<div class="col-md-12">
						<table class="table table-responsive" width="100%">
                            <tr class="bg-success" align="center">
                                <th rowspan="3">No</th>
                                <th rowspan="3">NISN</th>
                                <th rowspan="3">Nama Siswa</th>

                                <?php 
                                    $getjeniskd = $this->db->query("SELECT * FROM tm_jenis_kd")->result();
                                    foreach($getjeniskd as $jeniskd){
                                        $colspan = $this->db->query("
                                            SELECT 
                                                COUNT(DISTINCT tm_matpel.nama_matpel) as total
                                            FROM 
                                                tm_kd
                                            JOIN tm_matpel ON tm_matpel.id_matpel = tm_kd.id_matpel
                                            WHERE tm_kd.id_tingkat = '$gettingkat->id_tingkat'
                                        ")->row();
                                        $total = $colspan->total + 4;
                                        echo '<th colspan = "'.$total.'">'.$jeniskd->nama_jenis_kd.'</th>';
                                    }
                                ?>    
                            </tr>
                            <tr class="bg-success" align="center">
                            <?php
                                foreach($getjeniskd as $jeniskd){
                                    $colspan = $this->db->query("
                                        SELECT 
                                            DISTINCT tm_matpel.nama_matpel
                                        FROM 
                                            tm_kd
                                        JOIN tm_matpel ON tm_matpel.id_matpel = tm_kd.id_matpel
                                        WHERE tm_kd.id_tingkat = '$gettingkat->id_tingkat'
                                    ")->result();
                                    foreach($colspan as $rows){
                                        echo '<th colspan="3">'.$rows->nama_matpel.'</th>';
                                    }
                                }
                            ?>
                            </tr>

                            <tr class="bg-success" align="center">
                            <?php
                                foreach($getjeniskd as $jeniskd){
                                    $colspan = $this->db->query("
                                        SELECT 
                                            DISTINCT tm_matpel.nama_matpel
                                        FROM 
                                            tm_kd
                                        JOIN tm_matpel ON tm_matpel.id_matpel = tm_kd.id_matpel
                                        WHERE tm_kd.id_tingkat = '$gettingkat->id_tingkat'
                                    ")->result();
                                    foreach($colspan as $rows){
                                        echo '<th>Nilai</th>';
                                        echo '<th>Predikat</th>';
                                        echo '<th>Keterangan</th>';
                                    }
                                }
                            ?>
                            </tr>
                            
                            <?php 
                                $no = 1;
                                foreach($siswa as $item) { 
                            ?>
                            <!-- <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $item->NISN; ?></td>
                                <td><?php echo $item->nama_lengkap; ?></td>
                                <td><?php echo $item->nama_lengkap; ?></td>
                                <td><?php echo $item->nama_lengkap; ?></td>
                            </tr> -->
                            <?php 
                                }
                            ?>

                        </table>
                    </div>
                </div>
				
			</div>
		</div>
	</div>
</div>