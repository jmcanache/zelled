<div class="homepage_content clearfix">
    <div class="container">    
      <div class="sixteen columns" style="margin: 0 auto;">
        <div class="section clearfix">

					<div class="fondo_accede_column_morado" style="width: 45%; margin: 0px auto; padding: 20px; color: white;">
						<h4 class="title titulos_accede">Edita los datos del producto</h4>
						<?php
							echo $this->Form->create('Producto', array(
								'url' => array('controller' => 'productos', 'action' => 'edit'),
								'class' => 'formblock',
								'style' => '',
								'type' => 'file',
								'inputDefaults' => array(
										'class' => '',
										'div' => false,
										'label' => false
										)));?>
							
							<p><?php								
								echo $this->Form->input('Producto.nombre', array('placeholder' => __('Nombre')));
							?></p>
							<p>Describe a tus clientes que es, para que se usa.</p>
							<p>Ingresa una descripción corta y una larga.</p>

							<p><?php
								echo $this->Form->input('Producto.descripcion_corta', array('rows' => '1', 'cols' => '1', 'placeholder' => __('Descripción corta de tu producto')));
							?></p>
							<p><?php
								echo $this->Form->textarea('Producto.descripcion_larga', array('rows' => '5', 'cols' => '5', 'placeholder' => __('Descripción larga de tu producto')));
							?></p>
							<div>
								<p id="label-style" style="display: inline-flex"><?php
									$opciones = array(
													Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.VALOR') => '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.FISICO.TEXTO'), true)),
													Configure::read('TIVIA_CONFIG.PRODUCTO.DIGITAL.VALOR') =>  '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.DIGITAL.TEXTO'), true))
											);

									$attributes = array('legend' => false, 'separator' => '', 'value' => $this->data['Producto']['es_fisico'], 'style' => '');

									echo $this->Form->radio('Producto.es_fisico', $opciones, $attributes);
								?></p>
							</div>
							<div>
								<p id="label-style" style="display: inline-flex"><?php
									$opciones = array(
													Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.VALOR') => '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.ESTA_HECHO.TEXTO'), true)),
													Configure::read('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.VALOR') =>  '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.PRODUCTO.POR_PEDIDO.TEXTO'), true))
											);

									$attributes = array('legend' => false, 'separator' => '', 'value' => $this->data['Producto']['esta_hecho'], 'style' => '');

									echo $this->Form->radio('Producto.esta_hecho', $opciones, $attributes);
								?></p>
							</div>
							<p><?php
								echo $this->Form->input('Producto.existencia', array('min' =>'1', 'placeholder' => __('Cant. existente')));
							?></p>
							<p><?php
								echo $this->Form->input('Producto.precio', array('placeholder' => __('Precio en Bs.')));
							?></p>
							<p><?php
								echo $this->Form->input('Producto.materiales', array('placeholder' => __('Materiales utilizados')));
							?></p>
							<p><?php
								echo $this->Form->input('Producto.peso', array('min' =>'1', 'placeholder' => __('Peso en gramos')));
							?></p>
							<p>Carga hasta 3 imagenes de 640px por 640px</p>
							<div style="display:inline-block;">
								<div id="hideFoto1" class="imagePreviewBorder1">
									<div id="imagePreview1">
										<?php if (isset($this->data['Foto']['0']['foto_principal'])) { 
											echo '<img style="width: 144px" src="data:image/jpeg;base64,'.base64_encode($this->data['Foto']['0']['foto_principal']).'"/>';
										}?>
									</div>
								</div>
								<p class="choose_file">
									<span>Imagen 1</span><?php
									echo $this->Form->input('Foto.foto1', array('type' => 'file'));
								?></p>
							</div>
							<div style="display:inline-block;">
								<div id="hideFoto2" class="imagePreviewBorder2">
									<div id="imagePreview2">
										<?php if(isset($this->data['Foto']['1']['foto_principal'])) {
											echo '<img style="width: 144px" src="data:image/jpeg;base64,'.base64_encode($this->data['Foto']['1']['foto_principal']).'"/>';
										}?>
									</div>
								</div>
								<p class="choose_file">
									<span>Imagen 2</span><?php
									echo $this->Form->input('Foto.foto2', array('type' => 'file', 'disabled'));
								?></p>
							</div>

							<div style="display:inline-block;">
								<div id="hideFoto3" class="imagePreviewBorder3">
									<div id="imagePreview3">
										<?php if (isset($this->data['Foto']['2']['foto_principal'])) { 
											echo '<img style="width: 144px" src="data:image/jpeg;base64,'.base64_encode($this->data['Foto']['2']['foto_principal']).'"/>';
										}?>
							
									</div>
								</div>
								<p class="choose_file">
									<span>Imagen 3</span><?php
									echo $this->Form->input('Foto.foto3', array('type' => 'file', 'disabled'));
								?></p>
							</div>

							<p><?php
								echo $this->Form->button(__('Guardar Cambios'), array('class' => 'boton_morado', 'style' => ''));
							?></p><?php
							echo $this->Form->end();?>
						</div>

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

	/* $('#FotoFoto1').on('change', function() {
	    $("#FotoFoto2").removeAttr('disabled');  //Enable input
	})

	$('#FotoFoto2').on('change', function() {
	    $("#FotoFoto3").removeAttr('disabled');  //Enable input

	})

	$('#FotoFoto3').on('change', function() {
	    $("#FotoFoto3").removeAttr('disabled');  //Enable input

	})
 */
</script>


<!-- Llamada a la funcion que revisa las dimensiones -->
<script type="text/javascript">

jQuery(document).ready(function(){

	$("#FotoFoto1").on('click', function() {
   		var $item = $("#FotoFoto1");
   		var $preview = ".imagePreviewBorder1";
		
	});

	$("#FotoFoto2").on('click', function() {
	    var $item = $("#FotoFoto2");
	    var $preview = ".imagePreviewBorder2";
	    
	});
	$("#FotoFoto3").on('click', function() {
	    var $item = $("#FotoFoto3");
	    var $preview = ".imagePreviewBorder3";
	    
	});

});
</script>

<!-- Funcion que valida en el side client las dimensiones de las imagenes y la extension-->
<script type="text/javascript">
	function checkDimensionsExtensionsSize($item, $preview)
	{
		//este script lee URL.. pilas en el hosting cuando las lea.
		var _URL = window.URL;
		var minWidht = 1000;
		var minHeight = 1000;
		var maxWidht = 1000;
		var maxHeight = 1000;


		$item.change(function (e) {
			//Valida las dimensiones de la imagen
		    var file, img;
		    if ((file = this.files[0])) {
		        img = new Image();
		        img.onload = function () {
		            if(this.width < minWidht || this.height < minHeight){
		            	alert("Tu imagen es muy pequeña " + "Width:" + this.width + "px   Height: " + this.height + "px");//this will give you image width and height and you can easily validate here....
		            	$item.replaceWith( $item.val('').clone( true ) )
		            	$($preview).hide();
		            	return;
		            }
		            else if (this.width > maxWidht || this.height > maxHeight){
		            	alert("Tu imagen es muy grande " + "Width:" + this.width + "px   Height: " + this.height + "px");//this will give you image width and height and you can easily validate here....
		            	$item.replaceWith( $item.val('').clone( true ) )
		            	$($preview).hide();
		            	return;
		            }
		        };
		        img.src = _URL.createObjectURL(file);
		    }

        	//Valida las extensiones de las imagenes: .jpg, .png, jpeg
        	var ftype = $item[0].files[0].type;

		  	alert(ftype);

	        if(ftype == 'image/png' || ftype == 'image/jpeg' || ftype == 'image/jpeg')
	        {
	        	alert(ftype);
	        }
	        else
	        {
                alert('Suba solo imagenes con extensiones .png .jpg o .jpeg');
                $item.replaceWith( $item.val('').clone( true ) );
	            $(".imagePreviewBorder").hide();
	             return;
	        }

	       	//Valida el peso
	       	var fsize = $item[0].files[0].size;

		    if(fsize>1024000) // 1000 KB o 1024000 bytes
		    {
		        alert("Tu imagen es muy pesada");
		       	$item.replaceWith( $item.val('').clone( true ) )
		        $(".imagePreviewBorder").hide();
		        return;
		    }

		});


	}
</script>
<script type="text/javascript">

	$(function() {
	    $("#FotoFoto1").on("change", function()
	    {
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file

	            reader.onloadend = function(){ // set image data as background of div
		            alert(this.result);
	                $("#imagePreview1").css("background-image", "url("+this.result+")");
	            }
	        }
	    });
	});

	$(function() {
	    $("#FotoFoto2").on("change", function()
	    {
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file

	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview2").css("background-image", "url("+this.result+")");
	            }
	        }
	    });
	});

	$(function() {
	    $("#FotoFoto3").on("change", function()
	    {
	        var files = !!this.files ? this.files : [];
	        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

	        if (/^image/.test( files[0].type)){ // only image file
	            var reader = new FileReader(); // instance of the FileReader
	            reader.readAsDataURL(files[0]); // read the local file

	            reader.onloadend = function(){ // set image data as background of div
	                $("#imagePreview3").css("background-image", "url("+this.result+")");
	            }
	        }
	    });
	});

</script>


<!-- Oculta o muestra la imagen del preview-->
<script type="text/javascript">
$(document).ready(function(){
	
 /*  $("#hideFoto1").hide();
  $("#hideFoto2").hide();
  $("#hideFoto3").hide();  */

 /*  $("#FotoFoto1").change(function(){
    $("#hideFoto1").show();
  });

  $("#FotoFoto2").change(function(){
   $("#hideFoto2").show();
  });

  $("#FotoFoto3").change(function(){
    $("#hideFoto3").show();
  }); */

});
</script>

<!-- Una funcion cualquiera -->
<script type="text/javascript">
	function notify($item)
	{
		alert( "clicked" );
	}

	$( "#Cualquiera" ).on( "click", notify );
</script>

<!-- ESTA FALTANDO AGREGAR CATEGORIAS Y ATRIBUTOS Y DECIMALES, SOLO RECIBIMOS ENTEROS POSITIVOS EN EL PRECIO-->