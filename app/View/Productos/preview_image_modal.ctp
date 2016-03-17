  <div class="modal-header">
        <button type="button" class="close" id="cerrarImagen" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel">Imagen del Producto</p>      
  </div>
 <section class="panel-body">  
		<div class="form-horizontal">
					<div class="" style="margin: 0px auto; padding: 20px; color: grey;">
						<!-- <h4 class="title titulos_accede"></h4> -->
						<?php
							echo $this->Form->create('Producto', array(
								'url' => array('controller' => 'productos', 'action' => 'product_image_temp',$imagen_id),
								'id' =>'productImage',
								'class' => 'formblock',
								'style' => '',
								'type' => 'file',
								'inputDefaults' => array(
										'class' => '',
										'div' => false,
										'label' => false
										)));?>
													
							<div class="form-group">
									<p> <?php echo 'Imagen: '. '<span id="imagenid">'.  $imagen_id .'</span>' ?> </p>		
									<p> 
									  Seleccione una imagen de minimo 640px por 640px
									  <span class="choose_file" style="margin-left: 10px; padding: 6px 5%;width: 25%;">
										<i class="fa fa-upload"></i>
										<span style="margin-left: 10px;">Cargar Imagen</span>
										<!-- <input type="file" name="Fotofoto1" id="Fotofoto1" onchange="fileSelectHandler()" /> -->  
										<?php 
										$dim = Configure::read('TIVIA_CONFIG.CROP_SIZE.'.$tipo_imagen);
										$arrsizeEncode =  json_encode($dim);
										echo $this->Form->input('Foto.foto'.$imagen_id, array('type' => 'file', 'onchange' =>'fileSelectHandler('.$imagen_id.','.$arrsizeEncode.')'));
										
										if(isset($fotoid)){
										$idarr= $imagen_id -$imagen_id;
										echo $this->Form->hidden('Foto.'.$idarr.'.id', array ('id'=>'FotoFoto'.$imagen_id.'Id', 'name' =>'data[Foto][foto'.$imagen_id.'][id]', 'value' => $fotoid ));
										}
										?>																			 
									  </span>
									</p>
									<img id="preview" />
							</div> 
						    <div class="form-group">
								<div class="info">										
						                <input type="hidden" id="filesize" name="filesize" />
						                <input type="hidden" id="filetype" name="filetype" />
						                <input type="hidden" id="filedim" name="filedim" />
						                <input type="hidden" id="w" name="w" />
						                <input type="hidden" id="h" name="h" />	
						                <input type="hidden" id="x1" name="x1" />
								        <input type="hidden" id="y1" name="y1" />
								        <input type="hidden" id="x2" name="x2" />
								        <input type="hidden" id="y2" name="y2" />					               
	           					</div>	           						 
							</div>
							<p>
							 <button class="boton_morado" style="width: 15%;" type="button" id="guardaImagen">Aceptar</button>
							 <button id="btncerrarImagen" style="background: none repeat scroll 0px 0px grey; padding: 5px 40px;color:white;" class="grey" type="button">Cerrar</button>
     						</p>
							<?php
							echo $this->Form->end();?>
						
       
						</div>
					</div>
	    </section>  
<!-- Llamada a la funcion que revisa las dimensiones -->
<script type="text/javascript">
//editar form modal productos
$('#guardaImagen').on('click', function(){
	var imgid = '<?php echo $imagen_id; ?>'; //id de imagen para mostrar en contenedores de img 	
	var formData = new FormData($('#productImage')[0]);	
	var xfile = $('input[id=FotoFoto'+imgid+']')[0].files;	
	formData.append('img_file', xfile);      
    var formUrlImgProduct = $('#productImage').attr('action');                  
   $.ajax({
       type: 'POST',
       url: formUrlImgProduct,
       data: formData,
       processData: false,
       contentType: false,
       success: function(dataimgcropped,textStatus,xhr){   
    	 //si se carga la img se muestra en contenedores configurados en listing y modal          	
    	   if (dataimgcropped == 1){
    			var msg = "Por favor cargue una imagen para continuar";     			
				notifyInfo(msg); 				
           }else if(dataimgcropped == 2){
               var msg ="Solo puedes ingresar imagenes de tipo png o jpg.";
               notifyInfo(msg);                
    		}else{    		    	     		    	
    			$('#hideFoto'+imgid).show();	   
    	    	$('#imagePreview'+imgid).empty();
    	        $('#imagePreview'+imgid).css("background-image", "url("+dataimgcropped+")");
    	        $('[id^=modalUploadImage]').modal('hide');  	  
    		} 		  
         
       },
       error: function(xhr,textStatus,error){
         
       }
   });
  // $('[id^=modalUploadImage]').modal('hide');  	               
   return false;
});	
</script>
<script type="text/javascript">
$('#cerrarImagen').on('click', function(){ // cerrar : usado porque al abrir sobre el otro modal de producto da conflicto y cierra todos los modales
	$('[id^=modalUploadImage]').modal('hide');  
});
$('#btncerrarImagen').on('click', function(){ // cerrar : usado porque al abrir sobre el otro modal de producto da conflicto y cierra todos los modales 
	$('[id^=modalUploadImage]').modal('hide');  
});
</script>
<script type="text/javascript">
$('body').on('hidden.bs.modal', '.modal', function () { // usado para limpiar cache modal y que no cargue la misma img cada vez que se haga llamado 
	  $(this).removeData('bs.modal');
	});
</script>