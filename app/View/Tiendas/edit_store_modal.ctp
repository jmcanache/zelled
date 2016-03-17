 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabelS">Editar datos de tienda</p>      
  </div>
 <section class="panel-body">  
	<div class="form-horizontal">
		<div class="" style="margin: 0px auto; padding: 20px; color: grey;"><?php
			echo $this->Form->create('Tienda', array(
				'url' => array('controller' => 'tiendas', 'action' => 'update_modal_store'),
				'id' =>'editStore',
				'class' => 'formblock',
				'style' => '',
				'type' => 'file',
				'inputDefaults' => array(
						'class' => '',
						'div' => false,
						'label' => false
						)));?>
			<div class="form-group"><?php
				echo $this->Form->input('Tienda.nombre', array('placeholder' => __('Nombre'),'label' => array('text' => 'Nombre','class' => '', 'style' =>'margin-right: 10px')));
			?></div>
			<div class="form-group"><?php
				echo $this->Form->input('Tienda.telefono', array('placeholder' => __('Telefono'),'label' => array('text' => 'Telefono','class' => '', 'style' =>'margin-right: 10px')));
			?></div>
			<div class="form-group"><?php
				echo $this->Form->input('Tienda.slogan', array('placeholder' => __('Slogan'),'label' => array('text' => 'Slogan','class' => '', 'style' =>'margin-right: 10px')));
			?></div>
			<div class="form-group">
			<?php
			echo $this->Form->label('Bio');
		    ?>
			<?php
				echo $this->Form->textarea('Tienda.bio', array('rows' => '5', 'cols' => '5', 'placeholder' => __('Bio')));
			?></div>
			<div class="form-group">
				<?php
				echo $this->Form->label('Logo');
		    	?>
		    	<!-- vista previa -->
				<div style="display:inline-block;">
					<div id="hideFoto1" class="imagePreviewBorder1" style="border: 1px solid #bdbdbd;">
						<div id="imagePreview1"><?php echo $this->Html->image('logo/' . $this->data['Tienda']['logo'], array('alt' => '', 'id' => 'img_data', 'style' =>'width: 120px'));?></div>
					</div>
					<p class="choose_file">
						<span>Imagen 1</span><?php
						echo $this->Form->input('Tienda.logo', array('type' => 'file'));
					?></p>
				</div>
			</div>								
			<div class="form-group">
				<div class="row">
					<div id="atributos">
					  <div class="col-lg-6 col-md-6 col-sm-6">
						<p>
						<?php 	
						//CakeSession::delete('selectedcourier');
						if($this->Session->read('couriers')){
							$courier = $this->session->read('couriers');							
							echo $this->Form->label('Envio ');
							//echo '<br>';
							echo $this->Form->input('Courier', array('options'=> $courier,'class' => 'input-label-style', 'style' => 'border-width:1px;width:130px;margin-left: 5px;', 'id' =>'couriersModal'));
							}
							?>
						<!-- panel con opciones seleccionadas -->
						<div id="coloresSeleccionados" class="atributoColor" style="display:block;">
							<div class="panel panel-default">
						 <!-- Default panel contents -->
							 
							  <!-- Table -->
							  
							  <table class="table" id="tblColor" style="width:75%;">							  
							    <tbody>							   
							    <?php 							   
							    if ($this->session->read('selectedcourier')){?>															 
								<!-- seleccionados -->
								 <?php 
							      foreach($this->session->read('selectedcourier') as $c => $value):?>							
								     <tr>
									     <td style="display:none;"><?php echo $this->Form->input('Courier', array('value'=>$c, 'name' =>'data[Courier]['.$c.']'));?></td>
									     <td><?php echo $value;?></td>
									     <td><?php echo $this->Html->link('<p id="removeAtr'.$c.'" style="cursor: pointer;" class="fa fa-minus-square-o"></p>', array('controller' => 'tiendas', 'action' => 'add_courier', $c),array('escape' => FALSE, 'id'=>'delCourier','class'=>'remRow'));?></td>
									 </tr>								
								 <?php 
								  endforeach;
								}?>
							 
							     </tbody>
							  </table>
							</div>
						</div>
						
						</p>
					  </div>
					</div>	
				</div>
			
			
			<?php
			/* 	echo $this->Form->label('Envio');
			   	$options = array('7' => 'Todos', '1' => 'Mrw', '2' => 'Domesa', '4' =>'DHL');
				echo $this->Form->select('Tienda.couriers', $options ,array('multiple' => 'checkbox','class'=>'courier')); 
		 */	?>
			</div>
			<p>				
				<button class="boton_morado" type="button" id="actualizaDatos">Guardar Cambios</button>
				<button data-dismiss="modal" style="background: none repeat scroll 0px 0px grey; padding: 5px 40px;color:white;" class="grey" type="button">Cerrar</button>			
			</p><?php
			echo $this->Form->end();?>
		</div>
	</div>
</section>

<script type="text/javascript">
 //editar form modal productos
 $('#actualizaDatos').on('click', function(){
     //serialize form data              
  	var frmData = new FormData($('#editStore')[0]);   
	jQuery.each(jQuery("input[type='file']")[0].files, function(i, file) {
	    frmData.append(i, file);
	});
   //get form action
    var formUrl = $('#editStore').attr('action');                  
    $.ajax({
        type: 'POST',
        url: formUrl,
        data: frmData,
        processData: false,
        contentType: false,
        success: function(data,textStatus,xhr){
               //actualizar los datos en tabla de vista anterior
        	//$('#productosTienda').html(data);
        	//alert('Datos Actualizados');
        	notifySuccess();           	
        },
        error: function(xhr,textStatus,error){
        	//alert('error');
        	notifyError();    
        }
    });	 
    $('#myModalStore').modal('hide');                
    return false;
});


</script>

<!-- Con esto funcionan los checkboxes -->
<?php if($this->request->data['Tienda']['couriers'] == 7) :?>

<script type="text/javascript">	
	//courier checked if all esta marcado por data
	    $('[id^=TiendaCouriers]').each(function() { 
			this.checked = true; 
			$(this).attr("disabled", true);
		});
	$('#TiendaCouriers7').removeAttr("disabled"); 
	
</script>
<?php endif?>

<!-- Cuando entra por 1era vez, muestra logo por this->data. Cuando hacemos subimos nueva foto, mandamos a ocultar esa imagen para que se muestre como background-image, la preview que estamos sibiendo. -->
<script type="text/javascript">
 $(document).on('change','#TiendaLogo',function(){
    var files = !!this.files ? this.files : [];
	if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

	if (/^image/.test( files[0].type)){ // only image file
	    var reader = new FileReader(); // instance of the FileReader
	    reader.readAsDataURL(files[0]); // read the local file

	    reader.onloadend = function(){ // set image data as background of div
	    	$("#img_data").css("display", "none"); //oculta imagen que vino por this->data
	        $("#imagePreview1").css("background-image", "url("+this.result+")"); //agregamos por css al background del div, la img nueva.
	    }
	}
});
</script>
<script type="text/javascript">
// muestra los valores seleccionados en tabla
	$('[id^=couriersModal]').change(function(){	    
	   var val =  $(this).find(':selected').attr('value');
	   var txt =  $(this).find(':selected').text();		
	  // var id = $('#ProductoId').attr('value');  
	   $('.atributoColor').show();	
	  	
     if (val != 0){
    	 $.ajax({
   			type: "POST",
   			url: "../../../tiendas/add_courier/"+val+'/'+true,
   			dataType:"json", 			
   		    success:function (data) {   	   		   
   	  		     if (data.valor == 1){ 	     			    		    	     		    	
 	     			 $("#tblColor").last().append( 	    	     		  
 	  	  		  	      '<tr><td style="display:none;"><input id="Courier"  type="text" name="data[Courier]['+val+']" value="'+val+'"></td>'+
 	  	  		  	      '<td>'+txt+'</td>'+
 	  	  		  	      '<td><a class="remRow" id="delProdcolor" href="/tivia/tiendas/add_courier/'+val+'"><p class="fa fa-minus-square-o" style="cursor: pointer;" id="removeAtr'+val+'"></p></a></td></tr>'
 	  	  			 );	
 	     			$('[id^=couriersModal]').children('option').remove();
 	 	     		$.each(data.listcouriers, function(key,value) { 	     			
 	 	     			$('[id^=couriersModal]').append('<option value="'+ key +'">'+ value +'</option>');
 	 	     		});  
 	     		}else{
 	     			$('[id^=couriersModal]').children('option').remove();
 	     			$('[id^=couriersModal]').append('<option value="'+ '0' +'">'+ '--Seleccione--' +'</option>');
 	     			$.each(data.listcouriers, function(key,value) { 	     			
 	     				 $("#tblColor").last().append( 	    	     		  
 	   	  	  		  	      '<tr><td style="display:none;"><input id="Courier"  type="text" name="data[Courier]['+key+']" value="'+key+'"></td>'+
 	   	  	  		  	      '<td>'+value+'</td>'+
 	   	  	  		  	      '<td><a class="remRow" id="delProdcolor" href="/tivia/tiendas/add_courier/'+key+'"><p class="fa fa-minus-square-o" style="cursor: pointer;" id="removeAtr'+key+'"></p></a></td></tr>'
 	   	  	  			 );
 	 	     		});
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
        	 $.ajax({
     			type: "POST",
     			url: dir,
     			dataType:"json",			
     		    success:function (data) {
     		    	 if (data.valor == 1){
     		    		$('#'+delColor).closest('tr').remove(); 
	   	     		 }else{	
	     		    	$('#'+delColor).closest('tr').remove();     		    	
	     		    	//notifySuccessDel();
	   	     		 }	   	     		     		    	
     		    	 $('[id^=couriersModal]').children('option').remove();
 	 	     		 $.each(data.listcouriers, function(key,value) { 	     			
 	 	     			$('[id^=couriersModal]').append('<option value="'+ key +'">'+ value +'</option>');
 	 	     		 });
 	 	     		 if (rowCount == 1 && $("#couriersModal option[value='10000']").length == 0){	   		        	   
    		        	 	$('[id^=couriersModal]').last().append('<option value="'+ '10000' +'">'+ 'Seleccionar Todos' +'</option>');
    		         }	   		             		
     			},
     			error: function (data) {
	     			notifyError();
     			}
     		});	        
  });

</script>
