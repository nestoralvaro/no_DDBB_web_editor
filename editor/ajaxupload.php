<?php
/**
* Se encarga de subir la foto y mostrar el resultado de la subida
*/

	// Función que hace la subida
	function uploadImage($fileName, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH = null){
		$folder = $relPath;
		$maxlimit = $maxSize;
		$allowed_ext = "jpg,jpeg,gif,png,bmp";
		$match = "";
		$filesize = $_FILES[$fileName]['size'];
		// Si hay foto se sube
		if($filesize > 0){	
			$filename = strtolower($_FILES[$fileName]['name']);
			$filename = preg_replace('/\s/', '_', $filename);
			// Se comprueba si hay algo
		   	if($filesize < 1){ 
				$errorList[] = 'El fichero esta vacio.';
			}
			if($filesize > $maxlimit){ 
				$errorList[] = 'El fichero es demasiado grande.';
			}
			// En caso de que no haya errores se sigue
			if(count($errorList)<1){
				$file_ext = preg_split("/\./",$filename);
				$allowed_ext = preg_split("/\,/",$allowed_ext);
				// Comprueba la extensión del fichero
				foreach($allowed_ext as $ext){
					if($ext==end($file_ext)){
						$match = "1"; // File is allowed
                        // TODO to avoid duplicates
						// $NUM = time();
						$front_name = substr($file_ext[0], 0, 15);
                        // TODO to avoid duplicates
						// $newfilename = $front_name."_".$NUM.".".end($file_ext);
						$newfilename = $front_name.".".end($file_ext);
						$filetype = end($file_ext);
						$save = $folder.$newfilename;
						// La foto NO esta almacenada
						if(!file_exists($save)){
							list($width_orig, $height_orig) = getimagesize($_FILES[$fileName]['tmp_name']);
							// Si no hay que tocar la altura
							if($maxH == null){
								if($width_orig < $maxW){
									$fwidth = $width_orig;
								}else{
									$fwidth = $maxW;
								}
								$ratio_orig = $width_orig/$height_orig;
								$fheight = $fwidth/$ratio_orig;
								
								$blank_height = $fheight;
								$top_offset = 0;
							}else{
								if($width_orig <= $maxW && $height_orig <= $maxH){
									$fheight = $height_orig;
									$fwidth = $width_orig;
								}else{
									if($width_orig > $maxW){
										$ratio = ($width_orig / $maxW);
										$fwidth = $maxW;
										$fheight = ($height_orig / $ratio);
										if($fheight > $maxH){
											$ratio = ($fheight / $maxH);
											$fheight = $maxH;
											$fwidth = ($fwidth / $ratio);
										}
									}
									if($height_orig > $maxH){
										$ratio = ($height_orig / $maxH);
										$fheight = $maxH;
										$fwidth = ($width_orig / $ratio);
										if($fwidth > $maxW){
											$ratio = ($fwidth / $maxW);
											$fwidth = $maxW;
											$fheight = ($fheight / $ratio);
										}
									}
								}
								if($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0){
									die('ERROR FATAL');
								}
								if($fheight < 45){
									$blank_height = 45;
									$top_offset = round(($blank_height - $fheight)/2);
								}else{
									$blank_height = $fheight;
								}
							}
							$image_p = imagecreatetruecolor($fwidth, $blank_height);
							$white = imagecolorallocate($image_p, $colorR, $colorG, $colorB);
							imagefill($image_p, 0, 0, $white);
							switch($filetype){
								case "gif":
									$image = @imagecreatefromgif($_FILES[$fileName]['tmp_name']);
								break;
								case "jpg":
									$image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
								break;
								case "jpeg":
									$image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
								break;
								case "png":
									$image = @imagecreatefrompng($_FILES[$fileName]['tmp_name']);
								break;
							}
							@imagecopyresampled($image_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
							switch($filetype){
								case "gif":
									if(!@imagegif($image_p, $save)){
										$errorList[]= 'NO TIENE PERMISOS PARA SUBIR LA IMAGEN [GIF]';
									}
								break;
								case "jpg":
									if(!@imagejpeg($image_p, $save, 100)){
										$errorList[]= 'NO TIENE PERMISOS PARA SUBIR LA IMAGEN [JPG]';
									}
								break;
								case "jpeg":
									if(!@imagejpeg($image_p, $save, 100)){
										$errorList[]= 'NO TIENE PERMISOS PARA SUBIR LA IMAGEN [JPEG]';
									}
								break;
								case "png":
									if(!@imagepng($image_p, $save, 0)){
										$errorList[]= 'NO TIENE PERMISOS PARA SUBIR LA IMAGEN [PNG]';
									}
								break;
							}
							@imagedestroy($filename);
						// La foto ya esta almacenada
						}else{
							$errorList[]= 'NO SE PUEDE CREAR LA IMAGEN. LA IMAGEN YA EXISTE';
						}	
					}
				}		
			}
		}else{
			$errorList[]= 'NO HA SELECCIONADO FICHERO';
		}
		if(!$match){
		   	$errorList[]= 'El tipo de fichero elegido no esta permitido:' . " $filename";
		}
		if(sizeof($errorList) == 0){
			return $fullPath.$newfilename;
		}else{
			$eMessage = array();
			for ($x=0; $x<sizeof($errorList); $x++){
				$eMessage[] = $errorList[$x];
			}
		   	return $eMessage;
		}
	}// Fin de la función
	
	

	// Se inician los parámetros
	$maxSize = "9999999999";
	$maxW = "400";
	$fullPath = "../uploads/";
	$relPath = "../uploads/";
	$colorR = 255;
	$colorG = 255;
	$colorB = 255;
	$maxH = "600";

	$filename = strip_tags($_REQUEST['filename']);
	$filesize_image = $_FILES[$filename]['size'];

	if($filesize_image > 0){
		$upload_image = uploadImage($filename, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH);
		if(is_array($upload_image)){
			foreach($upload_image as $key => $value) {
				if($value == "-ERROR-") {
					unset($upload_image[$key]);
				}
			}
			$document = array_values($upload_image);
			for ($x=0; $x<sizeof($document); $x++){
				$errorList[] = $document[$x];
			}
			$imgUploaded = false;
		}else{
			$imgUploaded = true;
		}
	}else{
		$imgUploaded = false;
		$errorList[] = 'El fichero esta vacio.';
	}

	if($imgUploaded){
        echo 'Imagen subida correctamente.';
	}else{
		echo 'Se encontraron errores durante la carga de la imagen:';
		foreach($errorList as $value){
	    		echo $value.', ';
		}
	}
?>
