    <script type="text/javascript" src="./js/ajaxupload.js"></script>

	<form action="./ajaxupload.php" method="post" name="unobtrusive" id="unobtrusive" enctype="multipart/form-data">

    	<!-- Imagenes AJAX -->
		<input type="file" name="url_foto" id="url_foto" value="filename" onchange="jQuery('#submit').attr('disabled',true);jQuery('#url_foto_lista').attr('disabled',true); ajaxUpload(this.form,'./ajaxupload.php?filename=url_foto','upload_area_foto','Subiendo la foto&nbsp;&nbsp;&nbsp;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','Error subiendo la foto'); return false;" />

		<div id="upload_area_foto"></div> 
    </form>
