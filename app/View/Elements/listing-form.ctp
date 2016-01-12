<div style="margin: 0px auto; padding: 20px; color: white;"><?php
	echo $this->Form->create('Producto', array(
								'url' => array('controller' => 'productos', 'action' => 'listing'),
								'class' => 'formblock',
								'style' => '',
								'type' => 'file',
								'inputDefaults' => array(
										'class' => '',
										'div' => false,
										'label' => false
										)));?>

	<div style="background: none repeat scroll 0px 0px rgba(255, 255, 255, 0.75); padding-bottom: 1px; padding-top: 20px;padding-left: 5%; margin-bottom: 20px;">
		
		<div style="display: inline-block;width:46%;">
           <label for="first-name" style="display: block;">Nombre</label>
           <?php echo $this->Form->input('Producto.nombre', array('style'=>'width:100%;display:block;', 'placeholder' => __('Ej. Mini Notes')));?>
        </div>
		
		<div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;;">Descripción Corta</label>
            <?php echo $this->Form->input('Producto.descripcion_corta', array('style'=>'width:100%;display:block;','placeholder' => __('Ej. Set de libretitas')));?>
        </div>
        
        <div style="display: inline-block;width:93%;">
            <label for="first-name" style="display: block;">Descripción larga</label>
            <?php echo $this->Form->input('Producto.descripcion_larga', array('type' => 'textarea', 'placeholder' => __('Ej. Nuestras Mini Notes son ideales para tener en tu cartera, morral, bolso. Vienen personalizadas y diversas gamas de colores.')));?>
        </div>


		<div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;;">Tipo de producto</label>
            <?php $opciones = array(
						Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.VALOR') => Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.TEXTO'),
						Configure::read('TIVIA_CONFIG.PRODUCTO.DIGITAL.VALOR') => Configure::read('TIVIA_CONFIG.PRODUCTO.DIGITAL.TEXTO')
				);
			echo $this->Form->input('Producto.es_fisico', array('options'=> $opciones, 'style'=>'width:100%;display:block;'));?>
        </div>

        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Disponibilidad</label>
            <?php $opciones = array(
						Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.VALOR') => Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.TEXTO'),
						Configure::read('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.VALOR') => Configure::read('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.TEXTO')
				);
			echo $this->Form->input('Producto.esta_hecho', array('options'=> $opciones, 'style'=>'width:100%;display:block;'));?>
        </div>

        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Cantidad</label>
            <?php echo $this->Form->input('Producto.existencia', array('style'=>'width:100%;display:block;','min' =>'1','placeholder' => __('Ej. 4')));?>
        </div>

        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Materiales</label>
            <?php echo $this->Form->input('Producto.materiales', array('style'=>'width:100%;display:block;','placeholder' => __('Ej. Tinta y papel ecológico.')));?>
        </div>

        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Peso</label>
            <?php echo $this->Form->input('Producto.peso', array('style'=>'width:100%;display:block;','placeholder' => __('Ej. 500 (Nota: todo en gramos)')));?>
        </div>


        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Precio</label>
            <?php echo $this->Form->input('Producto.precio', array('style'=>'width:100%;display:block;','placeholder' => __('Ej. 1400 (Nota: solo números)')));?>
        </div>

		<div style="display: inline-block;width:46%;">
			<label for="first-name" style="display: block;">Selecciona si aplica</label><?php 	
			//ATRIBUTOS COLORES					
			$countcolores = count($color);
			for ($i = 0; $i <= $countcolores - 1; $i++)
			{
				$array_color[$color[$i]['Color']['id']] =$color[$i]['Color']['descripcion'];						
			}
			
			echo $this->Form->input('Color', array('options'=> $array_color,'label' => array('text' => 'Color','class' => 'inline-label', 'style' => 'background-color: transparent;'),'class' => 'input-label-style', 'style' => 'border-width:0px;;', 'id' =>'colores'));?>
			<!-- panel con opciones seleccionadas -->
			<div class="atributoColor" style="width:100%;">
				<div class="panel panel-default">
				  <!-- Default panel contents -->
				  <div class="panel-heading morado" style="padding-left: 10px;"><span>Seleccionados</span></div>
				
				  <!-- Table -->
				  <table class="table" id="tblColor">
				    <tbody>				    
				     </tbody>
				  </table>
				</div>
			</div>
		</div>

		<div style="display: inline-block;width:46%;">
			<label for="first-name" style="display: block;">Selecciona si aplica</label><?php 	
			//ATRIBUTOS TALLAS													
			$counttallas = count($talla);
			for ($x = 0; $x <= $counttallas - 1; $x++)
			{
				$array_talla[$talla[$x]['Talla']['id']] =$talla[$x]['Talla']['descripcion'];													
			}

			echo $this->Form->input('Talla', array('options'=> $array_talla,'label' => array('text' => 'Talla','class' => 'inline-label', 'style' => 'background-color: transparent;'),'class' => 'input-label-style', 'style' => 'border-width:0px;', 'id' =>'tallas'));?>
			<!-- panel con opciones seleccionadas -->
			<div class="atributoTalla" style="width:100%;">
				<div class="panel panel-default">
				  <!-- Default panel contents -->
				  <div class="panel-heading morado" style="padding-left: 10px;"><strong>Seleccionados</strong></div>				
				  <!-- Table -->
				  <table class="table" id="tblTalla">
				    <tbody>
				    </tbody>
				  </table>
				</div>
			</div>
		</div>

		<?php foreach ($couriers as $key=>$courier) :?>		
		<div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Costo <?php echo $courier?></label>
            <?php echo $this->Form->input('Costoenvio.'.$courier.'.costo', array('style'=>'width:100%;display:block;','placeholder' => __('Ej. 250 (Nota: solo números)')));?>
        </div>												
		<?php endforeach;?>	
        	<label for="first-name" style="display: block;">Sube mínimo una imagen</label>
        <div style="display: inline-block;width:28%;">

			<div id="hideFoto1" class="imagePreviewBorder1">
				<div id="imagePreview1"></div>
			</div> 
			<span style="padding: 6px 5%;margin: 10px 0 20px;" class="choose_file_form">
				<i class="fa fa-upload"></i>
				
				<?php echo $this->Html->link('<span style="margin-left: 10px;">Image 1</span>', array('controller' => 'productos', 'action' => 'preview_image_modal','3','1'),
									    													 array('escape' => FALSE, 'id'=>'UploadImagelink1', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default;'));?>
			</span>

        </div>

        <div style="display: inline-block;width:28%;">
			<div id="hideFoto2" class="imagePreviewBorder2">
				<div id="imagePreview2"></div>
			</div>
			<span style="padding: 6px 5%;margin: 10px 0 20px;" class="choose_file_form">
				<i class="fa fa-upload"></i>
				
				<?php echo $this->Html->link('<span>Imagen 2</span>', array('controller' => 'productos', 'action' => 'preview_image_modal','3','2'),
						array('escape' => FALSE, 'id'=>'UploadImagelink2', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default; pointer-events: none;'));?>
			</span>

        </div>


        <div style="display: inline-block;width:28%;">
			<div id="hideFoto3" class="imagePreviewBorder3">
				<div id="imagePreview3"></div>
			</div>
			<span style="padding: 6px 5%;margin: 10px 0 20px;" class="choose_file_form">
				<i class="fa fa-upload"></i>
				
				<?php echo $this->Html->link('<span>Imagen 3</span>', array('controller' => 'productos', 'action' => 'preview_image_modal','3','3'),
						array('escape' => FALSE, 'id'=>'UploadImagelink3', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default; pointer-events: none;'));?>
			</span>
        </div>

	</div>

	<p><?php
		echo $this->Form->button(__('LISTAR'), array('class' => 'boton_verde', 'style' => 'width:100%'));
	?></p><?php
	echo $this->Form->end();?>
</div>


<!-- Modal -->
<div class="modal fade" id="modalUploadImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabelS" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog" style="width: 900px;">
    <div class="modal-content">
      <div class="modal-body" id="modalbodyImages" style="max-height:840px;">
      		
      </div>
     </div>
  </div>
</div>

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
$(document).ready(function() { // muestra los valores seleccionados en tabla
	$('[id^=tallas]').change(function(){	 
	   var val =  $(this).find(':selected').attr('value');
	   var txt =  $(this).find(':selected').text();	
	  $('.atributoTalla').show();	
	 if (val != 0){
	  $("#tblTalla").last().append(
    	  '<tr><td style="display:none;"><input id="Talla"  type="text" name="data[Talla]['+val+']" value="'+val+'"></td><td>'+txt+'</td><td><p id="removeAtr" style="cursor: pointer;" class="fa fa-minus-square-o remRow"></p></td></tr>');
	 }
	});
	 $("#tblTalla").on('click','.remRow',function(){ //remueve valor seleccionado
		 var rowCount = $('#tblTalla >tbody >tr').length; 
	        $(this).parent().parent().remove();
	        if (rowCount == 1){
	        	 $('.atributoTalla').hide();
	        }
	 });
});
</script>
<script type="text/javascript">
$(document).ready(function() { // muestra los valores seleccionados en tabla
	$('[id^=colores]').change(function(){	 
	   var val =  $(this).find(':selected').attr('value');
	   var txt =  $(this).find(':selected').text();	
	  $('.atributoColor').show();	
	 if (val != 0){
	  $("#tblColor").last().append(
	      '<tr><td style="display:none;"><input id="Color"  type="text" name="data[Color]['+val+']" value="'+val+'"></td><td>'+txt+'</td><td><p id="removeAtr" style="cursor: pointer;" class="fa fa-minus-square-o remRow"></p></td></tr>');
	 }
	});
	 $("#tblColor").on('click','.remRow',function(){ //remueve valor seleccionado
		 var rowCount = $('#tblColor >tbody >tr').length; 
	        $(this).parent().parent().remove();
	        if (rowCount == 1){
	        	 $('.atributoColor').hide();
	        }
	 });
});
</script>