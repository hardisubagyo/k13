<option value="Pilih Kelas">--Pilih Kelas--</option>
<?php foreach($kelas as $item){ ?>
	<option value="<?php echo $item->id_kelas; ?>"><?php echo $item->kelas; ?></option>
<?php } ?>