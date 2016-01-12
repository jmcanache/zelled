 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabelS">Editar Bio</p>      
  </div>
 <section class="panel-body">  
		<div class="form-horizontal">
					<div class="" style="margin: 0px auto; padding: 20px; color: grey;">
						<!-- <h4 class="title titulos_accede">Abre tu tienda</h4> -->
							<?php
								echo $this->Form->create('Usuario', array(
									'url' => array('controller' => 'usuarios', 'action' => 'update_modal_bio'),
									'id' =>'editBio',
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
								//echo $this->Form->label('Bio');
							    ?>
								<?php
									echo $this->Form->textarea('Usuario.bio', array('rows' => '5', 'cols' => '5', 'placeholder' => __('Bio')));
								?></div>								
								<p>
								<button class="boton_morado" type="button" id="actualizaBio">Guardar Cambios</button>
								<button data-dismiss="modal" style="background: none repeat scroll 0px 0px grey; padding: 5px 40px;color:white;" class="grey" type="button">Cerrar</button>
								
								</p><?php
								echo $this->Form->end();?>
							</div>
			</div>
</section>

<script type="text/javascript">
 //editar form modal productos
 $('#actualizaBio').on('click', function(){
     //serialize form data              
    var frmData = $('#editBio').serialize();   
   //get form action
    var formUrl = $('#editBio').attr('action');                  
    $.ajax({
        type: 'POST',
        url: formUrl,
        data: frmData,       
        success: function(data,textStatus,xhr){
        	 if (data == 0){
        	    notifyError();  
	     	 }else{	
	     		$('#UserBio').html(data); 
	     		notifySuccess(); 	     			
	     			     		     		
	         }        	     	
        },
        error: function(xhr,textStatus,error){        	
        	notifyError();    
        }
    });	
    $('#ModalBio').modal('hide');                  
    return false;
});

</script>
			     