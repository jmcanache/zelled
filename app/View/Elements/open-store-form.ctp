<div style="margin: 0px auto; padding: 20px; color: white;"><?php
	echo $this->Form->create('Usuario', array(
		'url' => array('controller' => 'tiendas', 'action' => 'open_store'),
		'class' => 'nav-flyout-menu nav-flyout nav-arrow nav-flyout-api nav-arrow',
		'style' => 'margin-top: 10px; padding-left: 30px; padding-right: 30px;',
		'inputDefaults' => array(
				'class' => '',
				'div' => false,
				'label' => false,
				'format' => array('before', 'error', 'label', 'between', 'input', 'after')
				)));
	?>
	<div style="background: none repeat scroll 0px 0px rgba(255, 255, 255, 0.75); padding-bottom: 1px; padding-top: 20px;padding-left: 5%; margin-bottom: 20px;">
		
		<div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Tienda</label>
           <?php echo $this->Form->input('Tienda.nombre', array('style'=>'width:100%;display:block;', 'placeholder' => __('Ej. Notely')));?>
        </div>
		
		<div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;;">Slogan</label>
            <?php echo $this->Form->input('Tienda.slogan', array('style'=>'width:100%;display:block;','placeholder' => __('Ej. Libretitas hechas con amor')));?>
        </div>
        
        <div style="display: inline-block;width:93%;">
            <label for="first-name" style="display: block;">Descripción</label>
            <?php echo $this->Form->input('Tienda.bio', array('type' => 'textarea', 'placeholder' => __('Ej. En Notely, fabricamos  usando 100% material ecológico, libretitas y agendas de bolsillo con divertidos diseños, ideales para tus notas  diarias.')));?>
        </div>
        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Estado</label>
           <?php echo $this->Form->input('Tienda.provinciaID', array('style'=>'width:100%;display:block;', 'placeholder' => __('Estado')));?>
        </div>
        
        <div style="display: inline-block;width:46%;">
            <label for="first-name" style="display: block;">Ciudad</label>
            <?php echo $this->Form->input('Tienda.ciudad_id', array('style'=>'width:100%;display:block;', 'placeholder' => __('Ciudad')));?>	
        </div>

        <div style="display: inline-block;width:45%;">
            <label for="first-name" style="display: block;">Telefono</label>
            <?php echo $this->Form->input('Tienda.telefono', array('style'=>'width:100%;display:block;', 'placeholder' => __('Telefono')));?>
        </div>

        <div style="display: inline-table;width:46%;">
            <label for="first-name" style="display: block;">Logo</label>
            <span style="padding: 6px 5%;" class="choose_file_form">
				<i class="fa fa-upload"></i>
				
				<?php 
				echo $this->Html->link('Sube tu Logo',array('controller' => 'images', 'action' => 'preview_image_modal','1','1'),
						array('escape' => FALSE, 'id'=>'UploadImagelink1', 'data-toggle' =>'modal', 'data-target'=>'#modalUploadImage', 'style' => 'text-decoration: none;cursor: default;margin-left:10px;color: #7f7f7f;'));
				?>	
				<span>
					<div id="hideFotoPeq" class="imagePreviewBorderPeq">
											<div id="imagePreviewPeq"></div>
					</div> 
				</span>																		 
			</span>
			
		</div>

		<?php 
			if($this->Session->read('couriers')){
				$courier = $this->session->read('couriers');
				echo $this->Form->label('Empresas de envío');
				//echo '<br>';
				echo $this->Form->input('Courier', array('options'=> $courier,'class' => 'input-label-style', 'style' => 'border-width:1px;width:92%;', 'id' =>'couriersModal'));
		}?>
		<!-- panel con opciones seleccionadas -->
		<div id="coloresSeleccionados" class="atributoColor" style="display:block;">
			<div class="panel panel-default">
		  
			  <table class="table" id="tblColor" style="width:35%;">							  
			    <tbody><?php 							   
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
	</div>

	<p><?php
		echo $this->Form->button(__('ABRIR MI TIENDA'), array('class' => 'boton_verde', 'style' => 'width:100%'));
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
<!-- Oculta o muestra la imagen del preview-->
<script type="text/javascript">
$(document).ready(function(){
  
  $("#hideFotoPeq").hide(); 

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
   			url: "../tiendas/add_courier/"+val+'/'+true,
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