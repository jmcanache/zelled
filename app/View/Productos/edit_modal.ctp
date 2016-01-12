  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel">Edita los datos del producto</p>      
  </div>
 <section class="panel-body">  
		<div class="form-horizontal">
					<div class="" style="margin: 0px auto; padding: 20px; color: grey;">
						<!-- <h4 class="title titulos_accede"></h4> -->
						<?php
							echo $this->Form->create('Producto', array(
								'url' => array('controller' => 'productos', 'action' => 'update_modal'),
								'id' =>'editProduct',
								'class' => 'formblock',
								'style' => '',
								'type' => 'file',
								'inputDefaults' => array(
										'class' => '',
										'div' => false,
										'label' => false
										)));?>
							
							<div class="form-group">							
							<?php
							    echo $this->Form->hidden('Producto.id');
								echo $this->Form->input('Producto.nombre', array('placeholder' => __('Nombre'),'label' => array('text' => 'Nombre del Producto','class' => '', 'style' =>'')));
							?>
							</div>
							<div class="form-group">
							<?php
								echo $this->Form->input('Producto.descripcion_corta', array('rows' => '1', 'cols' => '1', 'placeholder' => __('Descripción corta de tu producto'),'label' => array('text' => 'Descripción corta de tu producto','class' => '', 'style' =>'')));
							?>
							</div>							
							<div class="form-group">
							<?php
								echo $this->Form->label('Descripción larga de tu producto');
							?>
							<?php
								echo $this->Form->textarea('Producto.descripcion_larga', array('rows' => '5', 'cols' => '5', 'placeholder' => __('Descripción larga de tu producto')));
							?>
							</div>
							<div class="form-group">
							<?php
								echo $this->Form->label('Caracteristicas de tu producto');
							?>
							
							<div class="row" style="border-radius: 5px;">
								<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
									$opciones = array(
													Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.VALOR') => '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.TEXTO'), true)),
													Configure::read('TIVIA_CONFIG.PRODUCTO.DIGITAL.VALOR') =>  '<span style="background-color: grey;"></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.DIGITAL.TEXTO'), true))
											);

									$attributes = array('legend' => false, 'separator' => '', 'value' => $this->data['Producto']['es_fisico'], 'label' => array('style' =>'color:grey'));

									echo $this->Form->radio('Producto.es_fisico', $opciones, $attributes);
								?>
								
										
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
									$opciones = array(
													Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.VALOR') => '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.TEXTO'), true)),
													Configure::read('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.VALOR') =>  '<span style="background-color: grey;"></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.TEXTO'), true))
											);

									$attributes = array('legend' => false, 'separator' => '', 'value' => $this->data['Producto']['esta_hecho'], 'style' => '', 'label' => array('style' =>'color:grey'));

									echo $this->Form->radio('Producto.esta_hecho', $opciones, $attributes);
								?>
										
								</div>
								
							</div>
							</div>
							<div class="form-group">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6"><?php echo $this->Form->input('Producto.existencia', array('min' =>'1', 'placeholder' => __('Cant. existente'),'class'=>'form-control','label' => array('text' => 'Cant. Existente','class' => '', 'style' =>'')));?></div>
								<div class="col-lg-6 col-md-6 col-sm-6"><?php echo $this->Form->input('Producto.precio', array('placeholder' => __('Precio en Bs.'),'class'=>'form-control','label' => array('text' => 'Precio en Bs.','class' => '', 'style' =>'')));?></div>
							</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
									<?php
										echo $this->Form->input('Producto.materiales', array('placeholder' => __('Materiales utilizados'),'label' => array('text' => 'Materiales Utilizados','class' => 'font-human', 'style' =>'')));
									?></div>
									<div class="col-lg-6 col-md-6 col-sm-6"><?php
										echo $this->Form->input('Producto.peso', array('min' =>'1', 'placeholder' => __('Peso en gramos'), 'style' =>'','label' => array('text' => 'Peso en gramos','class' => 'font-human', 'style' =>'')));
									?>
									</div>
							   </div>
							</div>
							<div class="form-group">
							  <div class="row">	
								<div id="atributos">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<p>
									<?php 						
									$countcolores = count($color);
									for ($i = 0; $i <= $countcolores - 1; $i++)
									{
									$array_color[$color[$i]['Color']['id']] =$color[$i]['Color']['descripcion'];						
									}
									echo $this->Form->label('Color'); 
									echo '<br>';
									echo $this->Form->input('Color', array('options'=> $array_color,'class' => 'input-label-style', 'style' => 'border-width:1px;width:130px;', 'id' =>'coloresModal'));
								 	?>
									<!-- panel con opciones seleccionadas -->
									<div id="coloresSeleccionados" class="atributoColor" style="display:block;">
										<div class="panel panel-default">
										  <!-- Default panel contents -->
										  <?php if (!empty($this->data['Productocolor'])){
										  echo '<div class="panel-heading morado" style="padding-left: 10px;width:75%;"><strong>Seleccionados</strong></div>';
										  }
										  ?>
										  <!-- Table -->
										  <table class="table" id="tblColor" style="width:75%;">
										    <tbody>
										    <?php foreach($this->data['Productocolor'] as $productoColor):?>
										    <?php if (array_key_exists($productoColor['color_id'], $color)) {?> 
										     <tr>
											     <td style="display:none;"><?php echo $this->Form->input('Color', array('value'=>$productoColor['color_id'], 'name' =>'data[Color]['.$productoColor['color_id'].']'));?></td>
											     <td><?php echo $color[$productoColor['color_id']]['Color']['descripcion'];?></td>
											     <td><?php echo $this->Html->link('<p id="removeAtr'.$productoColor['color_id'].'" style="cursor: pointer;" class="fa fa-minus-square-o"></p>', array('controller' => 'productos', 'action' => 'delete_productocolor', $productoColor['producto_id'], $productoColor['color_id']),array('escape' => FALSE, 'id'=>'delProdcolor','class'=>'remRow'));?></td>
											 </tr>
											 <?php }?>
											 <?php endforeach;?>
										     </tbody>
										  </table>
										</div>
									</div>
									 </p>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									 <p>
									<?php 													
									$counttallas = count($talla);									
									for ($x = 0; $x <= $counttallas - 1; $x++)
									{
									$array_talla[$talla[$x]['Talla']['id']] =$talla[$x]['Talla']['descripcion'];													
									}
									echo $this->Form->label('Talla');
									echo '<br>';
									echo $this->Form->input('Talla', array('options'=> $array_talla,'class' => 'input-label-style', 'style' => 'border-width:1px;width:130px;', 'id' =>'tallasModal'));
								    ?>
									<!-- panel con opciones seleccionadas -->
									<div class="atributoTalla" style="display:block;">
										<div class="panel panel-default">
										  <!-- Default panel contents -->
										   <?php if (!empty($this->data['Productotalla'])){
										 	 echo '<div class="panel-heading morado" style="padding-left: 10px;width:75%;"><strong>Seleccionados</strong></div>';
										   }
										   ?>
										  <!-- Table -->
										  <table class="table" id="tblTalla" style="width:75%;">
										    <tbody>
										    <?php foreach($this->data['Productotalla'] as $productoTalla):?>
										    <?php if (array_key_exists($productoTalla['talla_id'], $talla)) {?> 
										     <tr>
											     <td style="display:none;"><?php echo $this->Form->input('Talla', array('value'=>$productoTalla['talla_id'], 'name' =>'data[Talla]['.$productoTalla['talla_id'].']'));?></td>
											     <td><?php echo $talla[$productoTalla['talla_id']]['Talla']['descripcion'];?></td>
											     <td><?php echo $this->Html->link('<p id="removeAtrTalla'.$productoTalla['talla_id'].'" style="cursor: pointer;" class="fa fa-minus-square-o"></p>', array('controller' => 'productos', 'action' => 'delete_productotalla', $productoTalla['producto_id'], $productoTalla['talla_id']),array('escape' => FALSE, 'id'=>'delProdtalla','class'=>'remRowTalla'));?></td>
											 </tr>
											 <?php }?>
											 <?php endforeach;?>
										    </tbody>
										  </table>
										</div>
									</div>
									 </p>
								  </div>
								 </div>
							  </div>
							</div>
							<div class="form-group">
							<?php
								echo $this->Form->label('Imagenes');								
							?>							
							<p>Carga hasta 3 imagenes de 640px por 640px</p>
							<div style="display:inline-block;">
								<div id="hideFoto1" class="imagePreviewBorder1" style="border: 1px solid #bdbdbd;">
									<div id="imagePreview1">
										<?php if (!empty($this->data['Foto']['0']['foto_principal'])) { 
											echo '<img style="width: 120px" src="data:image/jpeg;base64,'.base64_encode($this->data['Foto']['0']['foto_principal']).'"/>';
										}?>
									</div>
								</div>
								<p class="choose_file">
									<?php
									 //echo $this->Form->input('Foto.foto1', array('type' => 'file'));
									echo $this->Html->link('<span>Imagen 1</span>', array('controller' => 'productos', 'action' => 'preview_image_modal','3','1', $this->data['Foto']['0']['id']),
											array('escape' => FALSE, 'id'=>'UploadImagelink1', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default;'));
									  
									 if (isset($this->data['Foto']['0']['foto_principal'])) { echo $this->Form->hidden('Foto.0.id', array ('id'=>'FotoFoto1Id', 'name' =>'data[Foto][foto1][id]'));}
								?></p>
							</div>
							<div style="display:inline-block;">
								<div id="hideFoto2" class="imagePreviewBorder2" style="border: 1px solid #bdbdbd;">
									<div id="imagePreview2">
										<?php if(isset($this->data['Foto']['1']['foto_principal'])) {
											echo '<img style="width: 120px" src="data:image/jpeg;base64,'.base64_encode($this->data['Foto']['1']['foto_principal']).'"/>';
										}?>
									</div>
								</div>
								<p class="choose_file">
								<?php
									//echo $this->Form->input('Foto.foto2', array('type' => 'file', 'disabled'));
									echo $this->Html->link('<span>Imagen 2</span>', array('controller' => 'productos', 'action' => 'preview_image_modal','3','2'),
										array('escape' => FALSE, 'id'=>'UploadImagelink2', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default; pointer-events: none;'));
									
									 if (isset($this->data['Foto']['1']['foto_principal'])) { echo $this->Form->hidden('Foto.1.id', array ('id'=>'FotoFoto2Id', 'name' =>'data[Foto][foto2][id]'));}
								?></p>
							</div>

							<div style="display:inline-block;">
								<div id="hideFoto3" class="imagePreviewBorder3" style="border: 1px solid #bdbdbd;">
									<div id="imagePreview3">
										<?php if (isset($this->data['Foto']['2']['foto_principal'])) { 
											echo '<img style="width: 120px" src="data:image/jpeg;base64,'.base64_encode($this->data['Foto']['2']['foto_principal']).'"/>';
										}?>							
									</div>
								</div>
								<p class="choose_file">
								<?php
									//echo $this->Form->input('Foto.foto3', array('type' => 'file', 'disabled'));
									echo $this->Html->link('<span>Imagen 3</span>', array('controller' => 'productos', 'action' => 'preview_image_modal','3','3'),
										array('escape' => FALSE, 'id'=>'UploadImagelink3', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default; pointer-events: none;'));
									
									 if (isset($this->data['Foto']['2']['foto_principal'])) { echo $this->Form->hidden('Foto.2.id', array ('id'=>'FotoFoto3Id', 'name' =>'data[Foto][foto3][id]'));}
								?></p>
							</div>
							</div>
							<p><?php
								//echo $this->Form->button(__('Guardar Cambios'), array('class' => 'boton_morado', 'style' => ''));
							?>
							 <button class="boton_morado" type="button" id="guardaCambios">Guardar Cambios</button>
							 <button data-dismiss="modal" style="background: none repeat scroll 0px 0px grey; padding: 5px 40px;color:white;width: 15%;" class="grey" type="button">Cerrar</button>
     						</p>
							<?php
							echo $this->Form->end();?>
						
       
						</div>
					</div>
	    </section>  
  <!-- Modal -->
<div class="modal fade" id="modalUploadImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabelS" aria-hidden="true" style="background-color: transparent; top: 70%;">
  <div class="modal-dialog" style="width: 900px;">
    <div class="modal-content">
      <div class="modal-body" id="modalbodyImages" style="max-height:840px;">
      		
      </div>
     </div>
  </div>
</div>	  
<!-- chequea si hay imagen y habilita input -->
<script type="text/javascript">
if( $('#imagePreview1').is(':empty') ) {	
	 $("#UploadImagelink2").css( "pointer-events", "none" );
} else{	
	 $("#UploadImagelink2").css( "pointer-events", "auto" );
}

if( $('#imagePreview2').is(':empty') ) {	
	 $("#UploadImagelink3").css( "pointer-events", "none" );
} else{	
	 $("#UploadImagelink3").css( "pointer-events", "auto" );
}
</script>
<!-- Habilita o inhabilita los inputs -->	    
<script type="text/javascript">

	//Si es fisico inhabilita el campo existencia
	$('#ProductoEsFisico1').on('click', function() {
	    $("#ProductoExistencia").removeAttr('disabled');   //Enable input
	})
	$('#ProductoEsFisico0').on('click', function() {
	    $("#ProductoExistencia").attr('disabled','disabled');  //Disable input
	})

	$('#UploadImagelink1').on('click', function() {	   
	    $("#UploadImagelink2").css( "pointer-events", "auto" );
	})

	$('#UploadImagelink2').on('click', function() {
		 $("#UploadImagelink3").css( "pointer-events", "auto" );
	})

</script>
<!-- Oculta o muestra la imagen del preview-->
<script type="text/javascript">
$(document).ready(function(){
	
  $("#hideFoto1").hide();
  $("#hideFoto2").hide();
  $("#hideFoto3").hide();  

  $("#FotoFoto1").change(function(){
    $("#hideFoto1").show();
  });

  $("#FotoFoto2").change(function(){
   $("#hideFoto2").show();
  });

  $("#FotoFoto3").change(function(){
    $("#hideFoto3").show();
  }); 

});
</script>
<script type="text/javascript">
 //editar form modal productos
 $('#guardaCambios').on('click', function(){
	 //serialize form data  
   var formData = new FormData($('#editProduct')[0]);
	/* jQuery.each(jQuery("input[type='file']")[0].files, function(i, file) {
	    formData.append(i, file);
	}); */
   // var formData = $('#editProduct').serialize();          
    //get form action
    var formUrlEditProduct = $('#editProduct').attr('action');                  
    $.ajax({
        type: 'POST',
        url: formUrlEditProduct,
        data: formData,
        processData: false,
        contentType: false,
        success: function(data,textStatus,xhr){
               //actualizar los datos en tabla de vista anterior
        	$('#productosTienda').html(data);
        	//alert('Datos Actualizados');
        	notifySuccess();     	
        },
        error: function(xhr,textStatus,error){
        	//alert('error');
        	notifyError();      
        }
    });
    $('[id^=myModal]').modal('hide'); 
    $('.modal-backdrop').css("display","none"); //linea que oculta div modal-backdrop del modal                  
    return false;
});

</script>
<script type="text/javascript">
 // muestra los valores seleccionados en tabla
	$('[id^=tallasModal]').change(function(){	 
	   var val =  $(this).find(':selected').attr('value');
	   var txt =  $(this).find(':selected').text();
	   var id = $('#ProductoId').attr('value'); 	
	  $('.atributoTalla').show();
	  if (val != 0){
		  $.ajax({
	  			type: "POST",
	  			url: "../../../productos/verificar_productotalla/"+id+"/"+val,			
	  		    success:function (data) {
	  	  		    if (data == 1){
		     			var msg = "El atributo ya fue asignado al producto";
	     				notifyInfo(msg);
		     		}else{    		    	     		    	
	     			 	$("#tblTalla").last().append(
	     	  		  	      '<tr><td style="display:none;"><input id="Talla"  type="text" name="data[Talla]['+val+']" value="'+val+'"></td>'+
	     	  		  	      '<td>'+txt+'</td>'+
	     	  		  	      '<td><a class="remRowTalla" id="delProdtalla" href="/tivia/productos/delete_productotalla/'+id+'/'+val+'"><p class="fa fa-minus-square-o" style="cursor: pointer;" id="removeAtrTalla'+val+'"></p></a></td></tr>'
	     	  		  	  );	
		     		}  		    		
	  			},
	  			error: function (data) {
	  	  			notifyError();		     
	  			}
	  			});  		     	     	
	 }
	});
	 $("#tblTalla").on('click','.remRowTalla',function(e){ //remueve valor seleccionado		
	         e.preventDefault();
		   	 var rowCount = $('#tblTalla >tbody >tr').length;
		   	 var delTalla = $(this).children('.fa-minus-square-o').attr('id');
		   	 var dir = $(this).attr('href');	
		   	 notifyConfirm();
		         $('#confirm').one('click', '[data-value]', function (e) {
		   	         if($(this).data('value')) { //si respuesta en dialogo es eliminar
		   	        	 $('#confirm').hide();
		   	        	 $.ajax({
		   	     			type: "POST",
		   	     			url: dir,			
		   	     		    success:function (data) {
			   	     		    if (data == 0){
			   	     		    	$('#'+delTalla).closest('tr').remove();
			   	     		    }else{
			   	     		    	$('#'+delTalla).closest('tr').remove();     		    	
		   	     		    		notifySuccessDel();      
			   	     		    }		   	     		    	
		   	     		    	if (rowCount == 1){
		   	   		        	 $('.atributoTalla').hide();
		   	   		            }		
		   	     			},
		   	     			error: function (data) {
		   		     			notifyError();
		   	     			}
		   	     			});
		   	         } else {
		   	        	 $('#confirm').hide();   
		   	         }
		   	});	 
	     
	 });

</script>
<script type="text/javascript">
// muestra los valores seleccionados en tabla
	$('[id^=coloresModal]').change(function(){	    
	   var val =  $(this).find(':selected').attr('value');
	   var txt =  $(this).find(':selected').text();		
	   var id = $('#ProductoId').attr('value');  
	   $('.atributoColor').show();			
     if (val != 0){
    	 $.ajax({
   			type: "POST",
   			url: "../../../productos/verificar_productocolor/"+id+"/"+val,			
   		    success:function (data) {
   	  		    if (data == 1){
 	     			var msg = "El atributo ya fue asignado al producto";
      				notifyInfo(msg);
 	     		}else{    		    	     		    	
 	     			 $("#tblColor").last().append(
 	  	  		  	      '<tr><td style="display:none;"><input id="Color"  type="text" name="data[Color]['+val+']" value="'+val+'"></td>'+
 	  	  		  	      '<td>'+txt+'</td>'+
 	  	  		  	      '<td><a class="remRow" id="delProdcolor" href="/tivia/productos/delete_productocolor/'+id+'/'+val+'"><p class="fa fa-minus-square-o" style="cursor: pointer;" id="removeAtr'+val+'"></p></a></td></tr>'
 	  	  			 );	 
 	     		}  		    		
   			},
   			error: function (data) {
   	  			notifyError();		     
   			}
   			});    	        
     }
	});

$("#tblColor").on('click','.remRow',function(e){ //remueve valor seleccionado
	 e.preventDefault();
	 var rowCount = $('#tblColor >tbody >tr').length;
	 var delColor = $(this).children('.fa-minus-square-o').attr('id');
	 var dir = $(this).attr('href');	
	 notifyConfirm();
      $('#confirm').one('click', '[data-value]', function (e) {
	         if($(this).data('value')) { //si respuesta en dialogo es eliminar
	        	 $('#confirm').hide();
	        	 $.ajax({
	     			type: "POST",
	     			url: dir,			
	     		    success:function (data) {
	     		    	 if (data == 0){
	     		    		$('#'+delColor).closest('tr').remove(); 
		   	     		 }else{	
		     		    	$('#'+delColor).closest('tr').remove();     		    	
		     		    	notifySuccessDel();
		   	     		 }
	     		    	 if (rowCount == 1){
	   		        	    $('.atributoColor').hide();
	   		             }		
	     			},
	     			error: function (data) {
		     			notifyError();
	     			}
	     			});
	         } else {
	        	 $('#confirm').hide();   
	         }
	});	 
});

</script>
<!-- ESTA FALTANDO AGREGAR CATEGORIAS Y ATRIBUTOS Y DECIMALES, SOLO RECIBIMOS ENTEROS POSITIVOS EN EL PRECIO-->