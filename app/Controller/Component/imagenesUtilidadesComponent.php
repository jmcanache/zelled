<?php

App::uses('Component', 'Controller');
class imagenesUtilidadesComponent extends Component 
{

   public function crearCarpeta($thepath)
    {

        $carpeta_ok = mkdir($thepath, 0777, true);
       
        if($carpeta_ok)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

   public function uploadImage($uploadedInfo, $upload_dir, $prefix, $minAllowdimensions, $maxAllowdimensions)
    {
       //$upload_dir = WWW_ROOT.str_replace("/", DS, $uploadTo);
        $upload_path = $upload_dir.DS;
        $max_file = "34457280";
        $max_width = 710;
        // añado al prefijo, el identificador de tiempo, para que el archivo que se suba siempre sea unico
        $prefix = $prefix.time();

        $userfile_name = $uploadedInfo['name'];
        $userfile_tmp =  $uploadedInfo["tmp_name"];
        $userfile_size = $uploadedInfo["size"];
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
        $uploadTarget = $upload_path.$filename;

        if(empty($uploadedInfo)) {
            return $todo_bien;
        }

        if (isset($uploadedInfo['name'])){
            move_uploaded_file($userfile_tmp, $uploadTarget);
            chmod ($upload_path, 0777);
            $todo_bien = true;
        }

        return array('resultado' => $todo_bien, 'rutaArchivo' => $upload_dir.$filename);

    }

}
?>