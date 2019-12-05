<!-- <div class="mb-5"></div>
<footer class="footer bg-light">
    <div class="container">
		<small> © 2019 AMPLIFIER</small>
    </div>
</footer> -->

	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/api/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/api/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/api/DataTables/datatables.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>assets/js/custom-flatly.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bs-custom-file-input.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/autocomplete.js"></script>

	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>

	<script>
	    // For dataTable
		$(document).ready(function() {
		    $('#datatable').DataTable( {     
		        // ajax: 'https://api.myjson.com/bins/qgcu',
		        // drawCallback: function(settings){
		        //     var api = this.api();
		            
		        //     /* Add some tooltips for demonstration purposes */
		        //     $('td', api.table().container()).each(function () {
		        //        $(this).attr('title', $(this).text());
		        //     });

		        //     /* Apply the tooltips */
		        //     $('td', api.table().container()).tooltip({
		        //        container: 'body'
		        //     });          
		        // }  
		    });
		} );
	</script>
	<script>
		// File Input
		// Add the following code if you want the name of the file appear on select
		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
	<script>
	    // Replace the <textarea id="editor1"> with a CKEditor
	    // instance, using default configuration.
	    CKEDITOR.replace( 'ckeditor' );
	</script>
	<script>
		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
				window.location = $(this).data("href");
				// var url = $(this).data("href");
				// window.open(url);
			});
		});
	</script>

	<?php echo isset($refresh) ? $refresh : '' ?>
	
</body>
</html>