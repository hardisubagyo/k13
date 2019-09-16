	<!-- Footer -->
	<div class="navbar navbar-expand-lg navbar-light">
		<div class="text-center d-lg-none w-100">
			<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
				<i class="icon-unfold mr-2"></i>
				Footer
			</button>
		</div>

		<div class="navbar-collapse collapse" id="navbar-footer">
			<span class="navbar-text">
				&copy; <?php echo date('Y'); ?>
			</span>
		</div>
	</div>
	<!-- /footer -->

	<script>
        $('#tgl').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd'
	    });

	    $('#tgl_lahir').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd'
	    });
    </script>
		
</body>
</html>
