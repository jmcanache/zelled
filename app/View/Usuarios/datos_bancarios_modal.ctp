 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabelS">Datos Bancarios</p>      
  </div>
 <section class="panel-body">  
		<div class="form-horizontal">
					<div class="" style="margin: 0px auto; padding: 20px; color: grey;">
						<!-- <h4 class="title titulos_accede">Abre tu tienda</h4> -->
							<?php
								echo $this->Form->create('Usuariobanco', array(
									'url' => array('controller' => 'usuarios', 'action' => 'update_modal_datos_bancarios'),
									'id' =>'editDatosBanco',
									'class' => 'formblock',
									'style' => '',
									'type' => 'file',
									'inputDefaults' => array(
											'class' => '',
											'div' => false,
											'label' => false
											)));?>
								
								<div class="form-group"><?php
									echo $this->Form->input('Usuariobanco.titular_cuenta', array('type'=>'text','placeholder' => __('Titular de Cuenta'),'step'=>'0','style'=>'-moz-appearance:textfield;width: 350px;','label' => array('text' => 'Titular Cuenta','class' => '', 'style' =>'margin-right: 10px;')));
								?></div>
								<div class="form-group">								
								<?php
									echo $this->Form->label('Usuariobanco.cedula', 'Identificaci&oacute;n', array('style'=>'padding-left: 0px; padding-right: 5px;margin-right: 10px'));
									$opciones = array(
											Configure::read('TIVIA_CONFIG.TIPO_ID.VENEZOLANO.CODIGO') => Configure::read('TIVIA_CONFIG.TIPO_ID.VENEZOLANO.TEXTO'),
											Configure::read('TIVIA_CONFIG.TIPO_ID.EXTRANJERO.CODIGO') => Configure::read('TIVIA_CONFIG.TIPO_ID.EXTRANJERO.TEXTO'),
											Configure::read('TIVIA_CONFIG.TIPO_ID.RIF.CODIGO') => Configure::read('TIVIA_CONFIG.TIPO_ID.RIF.TEXTO')
									);
									echo $this->Form->input('Usuariobanco.tipo_id', array('options'=> $opciones, 'style'=>'width: 50px; margin-right: 10px;'));
									echo $this->Form->input('Usuariobanco.cedula', array('type'=>'number','placeholder' => __('Identificación'),'step'=>'0','style'=>'-moz-appearance:textfield;width: 100px;'));
								?></div>							
								<div class="form-group"><?php
									echo $this->Form->input('Usuariobanco.banco_id', array('placeholder' => __('Banco'),'label' => array('text' => 'Banco','class' => '', 'style' =>'margin-right: 10px')));
								?></div>
								<div class="form-group">
								<p id="label-style" style="display: inline-flex">
								<?php									
									echo $this->Form->label('Usuariobanco.tipo_cuenta', 'Tipo de Cuenta', array('style'=>'padding-left: 0px; padding-right: 5px;'));
									$opciones = Configure::read('TIVIA_CONFIG.TIPO_CUENTA');
									$attributes = array('legend' => false, 'separator' => '', 'value' => $this->data['Usuariobanco']['tipo_cuenta'],'style'=>'display: block' ,'label' => array('style' =>'color:grey; padding-left: 5px; padding-right: 5px;'));
									echo $this->Form->radio('Usuariobanco.tipo_cuenta', $opciones, $attributes);
								?>
								</p>
							    </div>
								<div class="form-group"><?php
									echo $this->Form->input('Usuariobanco.nro_cuenta', array('type'=>'text','placeholder' => __('Numero de Cuenta'),'step'=>'0','style'=>'-moz-appearance:textfield;','label' => array('text' => 'Cuenta','class' => '', 'style' =>'margin-right: 10px')));
								?></div>
								<div class="form-group"><?php									
									echo $this->Form->input('Usuariobanco.correo', array('type'=>'email','placeholder' => __('Correo electrÃ³nico'),'label' => array('text' => 'Correo','class' => '', 'style' =>'margin-right: 10px')));
								?></div>
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
 $('#actualizaDatos').on('click', function(e){	
     //serialize form data              
  	var frmData = $('#editDatosBanco').serialize(); 
   //get form action
    var formUrl = $('#editDatosBanco').attr('action');                  
    $.ajax({
        type: 'POST',
        url: formUrl,
        data: frmData,       
        success: function(data,textStatus,xhr){                   
        	 if (data == 0){
        		 notifyInfo("Verifique los campos. No se ha completado la operacion"); 
 	     	 }else{	 	 
 	 	     	//alert(data);
 	 	     	var datosbancarios = data; 	 	     	  	 	 	     	
 	     		$('#InfoBancaria').html(datosbancarios); 
 	     		notifySuccess(); 
 	         }                	
        },
        error: function(xhr,textStatus,error){        	
        	notifyError();    
        }
    });	 
    $('#ModalUsuarioBanco').modal('hide');                   
    return false;
});

$('#UsuariobancoBancoId').bind('change', function() //codigo cuenta al cambiar banco id
{
	 if ( $('#UsuariobancoNroCuenta').val() == "") {
	   	 $.ajax({
               type: "GET",
               url: "../../../usuarios/updatecodigobanco/" + $(this).val(),
               beforeSend: function() {		            	 
            	   $('#UsuariobancoNroCuenta').html("");   	  
                
               },
               success: function(data){                   
                   $('#UsuariobancoNroCuenta').val(data);
                   $('#UsuariobancoNroCuenta').focus().select();
                  
               }
             }); 
	 }
});
</script>		     