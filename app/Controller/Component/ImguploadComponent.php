<?php

App::uses('Component', 'Controller');
class ImguploadComponent extends Component
{

   public function uploadImage($uploadedInfo, $uploadTo, $prefix, $minAllowdimensions, $maxAllowdimensions)
    {
    	$upload_dir = WWW_ROOT.str_replace("/", DS, $uploadTo);
        $upload_path = $upload_dir.DS;
        $max_file = "34457280";
       	$max_width = 710;
        // añado al prefijo, el identificador de tiempo, para que el archivo que se suba siempre sea unico
        $prefix = $prefix.time();

        $userfile_name = $uploadedInfo['name'];
        $userfile_tmp =  $uploadedInfo["tmp_name"];
        $userfile_size = $uploadedInfo["size"];
        //$filename = $prefix.basename($uploadedInfo["name"]);
        $id_unic = $uuid = String::uuid();

    	$todo_bien = false;
    	
        //validamos el peso de la foto. Debe ser menor a 1000 KB o 1024000 bytes
        if($userfile_size > 1024000){
        	return $todo_bien;
        }
        //validamos tipo de foto
        $imageInfo = getimagesize($uploadedInfo["tmp_name"]);
        if ($imageInfo['mime'] != 'image/gif' && $imageInfo['mime'] != 'image/jpeg' && $imageInfo['mime'] != 'image/png')
        {
            return $todo_bien;
        }

        //validamos dimensiones minimas de la imagen
        if($this->checkMindimensions($imageInfo, $minAllowdimensions)){
                return $todo_bien;
        }

        //validamos dimensiones maximas de la imagen
        if($this->checkMaxdimensions($imageInfo, $maxAllowdimensions)){
            return $todo_bien;
        }


        $extension =  $this->getFileExtension($uploadedInfo["name"]);
        $filename = $prefix.$id_unic.'.'.$extension;
        //$file_ext = mb_substr($filename, strrpos($filename, ".") + 1);
        $uploadTarget = $upload_path.$filename;

        if(empty($uploadedInfo)) {
            return $todo_bien;
        }

        if (isset($uploadedInfo['name'])){
            move_uploaded_file($userfile_tmp, $uploadTarget);
            chmod ($upload_path, 0777);
            $todo_bien = true;
        }

        return array('resultado' => $todo_bien, 'rutaArchivo' => $upload_dir.$filename, 'nombreArchivo' => $filename);

    }


    //Generico: chequea las dimensiones minimas de una imagen.
    function checkMinDimensions($image, $minAllowdimensions)
    {
        //Si una imagen es mas pequeña de lo permitido, la rebota.
        //para esto, la funcion recibe un parametro de dimensiones permitidas

        $widthImage = $image[0];
        $heightImage = $image[1];

        $minWidthAllowDimensions = $minAllowdimensions['WIDTH'];
        $minHeightAllowDimensions = $minAllowdimensions['HEIGHT'];

        if($widthImage < $minWidthAllowDimensions || $heightImage < $minHeightAllowDimensions){
            return true;
        }
        else
            return false;

    }

    //Generico: chequea las dimensiones maximas de una imagen.
    function checkMaxDimensions($image, $maxAllowdimensions)
    {
        //Si una imagen pasa de tanto x tanto como maximo, la rebota.
        //para esto, la funcion recibe un parametro de dimensiones permitidas

        $widthImage = $image[0];
        $heightImage = $image[1];

        $maxWidthAllowDimensions = $maxAllowdimensions['WIDTH'];
        $maxHeightAllowDimensions = $maxAllowdimensions['HEIGHT'];

        if($widthImage > $maxWidthAllowDimensions || $heightImage > $maxHeightAllowDimensions){
            return true;
        }
        else
            return false;

    }

    function getHeight($image)
    {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
    }

    function getWidth($image)
    {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
    }


    function resizeImage($image,$width,$height,$scale)
    {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $this->log($newImage);
		$ext = strtolower(mb_substr(basename($image), strrpos(basename($image), ".") + 1));
        $this->log($ext);
        $source = "";
        if($ext == "png"){
            $source = imagecreatefrompng($image);
            $this->log($source);
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image);
            $this->log($source);
        }elseif($ext == "gif"){
            $source = imagecreatefromgif($image);
            $this->log($source);
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        imagejpeg($newImage,$image,90);
        chmod($image, 0777);
        return $image;
    }

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
    {
    	$newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $ext = strtolower(mb_substr(basename($image), strrpos(basename($image), ".") + 1));
        $source = "";
        if($ext == "png"){
            $source = imagecreatefrompng($image);
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image);
        }elseif($ext == "gif"){
            $source = imagecreatefromgif($image);
        }

        /*$this->log(array(
        		'$start_width,' => $start_width,
        		'$start_height,' => $start_height,
        		'$newImageWidth,' => $newImageWidth,
        		'$newImageHeight,' => $newImageHeight,
        		'$width,' => $width,
        		'$height' => $height
        		));*/

        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        imagejpeg($newImage,$thumb_image_name,90);
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    function cropImage($thumb_width, $x1, $y1, $x2, $y2, $w, $h, $thumbLocation, $imageLocation)
    {

    	/*$this->log(
    			array(
    					'$thumb_width' => $thumb_width,
    					'$x1' => $x1,
    					'$y1' => $y1,
    					'$x2' => $x2,
    					'$y2' => $y2,
    					'$w' => $w,
    					'$h' => $h,
    					'$thumbLocation' => $thumbLocation,
    					'$imageLocation' => $imageLocation
    					)

    			);*/


    	$scale = $thumb_width/$w;
        $cropped = $this->resizeThumbnailImage($thumbLocation,$imageLocation,$w,$h,$x1,$y1,$scale);
        return $cropped;
    }

     function getFileExtension($str)
     {
        /*
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = mb_substr($str,$i,$l);
        return $ext;*/
        $var = explode (".", $str);
        return  end($var);
    }


    function createThumb($foto, $filename, $ext)
    {
        $formato_peq = Configure::read('TIVIA_CONFIG.FOTO.PEQUENA');

        $imagen_grande = imagecreatefromstring($foto);

        //Genera la imagen pequeña
        $imagen_pequenia = imagecreatetruecolor($formato_peq['ANCHO'],$formato_peq['ALTO']);
        imagecopyresampled($imagen_pequenia, $imagen_grande, 0, 0, 0, 0, $formato_peq['ANCHO'], $formato_peq['ALTO'], imagesx($imagen_grande), imagesy($imagen_grande)); // resize the image
        
        //Captura la imagen pequeña
        $OK = false;
        ob_start(); // Start capturing stdout

        if($ext == 'image/png'){            
            $OK = imagepng($imagen_pequenia, $filename, 6); // As though output to browser.
            $thumb = ob_get_contents(); // RETURN THUMB SI QUIERES IMPRIMIR LA IMAGEN O SALVARLA EN DB
        }elseif($ext == 'image/jpeg' || $ext == 'image/jpg'){
            $OK = imageJPEG($imagen_pequenia, $filename, 100); // RETURN THUMB SI QUIERES IMPRIMIR LA IMAGEN O SALVARLA EN DB
            $thumb = ob_get_contents(); // the raw jpeg image data.
        }

        ob_end_clean();

        return $OK;
    }

  public function validaExtension($uploadedInfo)
    {
        //validamos tipo de foto
        $imageInfo = getimagesize($uploadedInfo['tmp_name']);
        if ($imageInfo['mime'] != 'image/gif' && $imageInfo['mime'] != 'image/jpeg' && $imageInfo['mime'] != 'image/png')
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    
    function xcropImage($src, $x1, $y1, $w, $h){
    	$targ_w = $targ_h = $w;
    	$iJpgQuality = 90;
    
    	// new unique filename
    	$sTempFileName = 'img/temporales/' . md5(time().rand());
    	 
    	// move uploaded file into cache folder
    	move_uploaded_file($src, $sTempFileName);
    	 
    	// change file permission to 644
    	chmod($sTempFileName, 0644);
    	$aSize = getimagesize($sTempFileName);
    	if (!$aSize) {
    		unlink($sTempFileName);
    		return;
    	}
    
    	// check for image type
    	switch($aSize[2]) {
    		case IMAGETYPE_JPEG:
    			$sExt = '.jpg';
    			 
    			// create a new image from file
    			$vImg = imagecreatefromjpeg($sTempFileName);
    			break;
    		case IMAGETYPE_PNG:
    			$sExt = '.png';
    			 
    			// create a new image from file
    			$vImg = imagecreatefrompng($sTempFileName);
    			break;
    		default:
    			unlink($sTempFileName);
    			return;
    	}
    	 
    	// create a new true color image
    	$vDstImg = imagecreatetruecolor($w,$h);
    	 
    	// copy and resize part of an image with resampling
    	imagecopyresampled($vDstImg, $vImg, 0, 0, $x1, $y1, $targ_w, $targ_h, $w, $h);
    	// define a result image filename
    	$sResultFileName = $sTempFileName . $sExt;
    	// output image to file
    	imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
    	if (file_exists($sTempFileName)) {
    		unlink($sTempFileName);
    	}
    	//$this->log($sResultFileName);
    	return $sResultFileName;
    	 
    
    }
    
    public function xuploadImage($uploadedInfo, $uploadTo, $prefix, $minAllowdimensions, $maxAllowdimensions)
    {
    	$upload_dir = WWW_ROOT.str_replace("/", DS, $uploadTo);
    	$upload_path = $upload_dir.DS;
    	$max_file = "34457280";
    	$max_width = 710;
    	// a�ado al prefijo, el identificador de tiempo, para que el archivo que se suba siempre sea unico
    	$prefix = $prefix.time();    	;
    	$userfile_size = filesize($uploadedInfo);
    	$basename = basename($uploadedInfo);
    	$id_unic = $uuid = String::uuid();
    	$todo_bien = false;
    	//validamos el peso de la foto. Debe ser menor a 1000 KB o 1024000 bytes
    	if($userfile_size > 1024){
    		$todo_bien = true;
    	}
    	//validamos tipo de foto
    	$imageInfo = getimagesize($uploadedInfo);
    	if ($imageInfo['mime'] == 'image/gif' || $imageInfo['mime'] == 'image/jpeg' || $imageInfo['mime'] == 'image/png'){
    		$todo_bien = true;
    	}
    	//validamos dimensiones minimas de la imagen
    	if($this->checkMindimensions($imageInfo['0'], $minAllowdimensions)){
    		$todo_bien = true;
    	}
    	//validamos dimensiones maximas de la imagen
    	if($this->checkMaxdimensions($imageInfo['1'], $maxAllowdimensions)){
    		$todo_bien = true;
    	}
    
    	$extension =  $this->getFileExtension($uploadedInfo);
    	$filename = $prefix.$id_unic.'.'.$extension;
    	//$file_ext = mb_substr($filename, strrpos($filename, ".") + 1);
    	$uploadTarget = $upload_path.$filename;
    	 
    	if(empty($uploadedInfo)) {
    		return $todo_bien;
    	}
    
    	if (isset($basename)){
    		//move_uploaded_file($uploadedInfo, $uploadTarget);
    		rename($uploadedInfo, $uploadTarget); //la otra solo funciona si el archivo es cargado , en este caso el logo fue cortado y esta en temporales
    		chmod ($upload_path, 0777);
    		$todo_bien = true;
    		if (file_exists($uploadedInfo)) {
    			unlink($uploadedInfo); // borrar el achivo de temporales
    		}
    		CakeSession::delete('imagenestemporales'); //destruir la sesion
    	}
    
    	return array('resultado' => $todo_bien, 'rutaArchivo' => $upload_dir.$filename, 'nombreArchivo' => $filename);
    }

}
?>