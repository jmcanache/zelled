<?php	echo $this->Form->create('OrderTransferencia', array(
				'url' => array('controller' => 'orders', 'action' => 'store_pay_order'),
				'class' => '',
				'style' => 'height: 360px;',
				'id' => 'form',
				'inputDefaults' => array(
						'class' => 'form-inline',
						'div' => false,
						'label' => false
						)));?>
	<header>
		<div class="header-modal"><?php 
			echo $this->Html->image('iconpayment.png', array('alt' => 'TiviaStore', 'style' => 'border-radius: 32px; display: block; height: 74px; margin: 4px 6px 0; width: 74px'));?>
		</div>		
		<p class="title">tiviastore.com</p>
		<p class="subtitle"><?php 
			$mensaje = ($items == 1)? 'item' : 'items';
			echo $items . '' . $mensaje;?></p>		
	</header>

	<div class="ccjs-card">

		<label class="ccjs-name" style="position: relative; top: 20px; width: 20em;">
	    	Número de transferencia
	    	<?php echo $this->Form->input('Order.referencia', array('placeholder' => "Numero de transferencia", 'class' => 'ccjs-name'));?>
		</label>

		<label class="ccjs-name" style="position: relative; top: 60px; width: 20em;">
		    Banco
		   <?php echo $this->Form->input('Order.banco_id', array('placeholder' => "Numero de transferencia", 'class' => 'ccjs-name'));?>
		</label>

	  	<?php 
			echo $this->Form->hidden('OrderTransferencia');
			echo $this->Form->button(__('Pagar Bs.' . $total), array('class' => 'boton_morado', 'id'=> 'sendform', 'style' => 'position: relative; top: 120px; width: 100%; height: 20%;'));?>
	</div>

<?php echo $this->Form->end();?>


<script type="text/javascript">
 //editar form modal productos
 $('#sendform').on('click', function(){
     //serialize form data              
    var frmData = $('#form').serialize();   
   //get form action
    var formUrl = $('#form').attr('action');                  
    $.ajax({
        type: 'POST',
        url: formUrl,
        dataType:"json",
        data: frmData,       
        success: function(data,textStatus,xhr){
        	 if (data.valor == 0){        	    
          	    notifyInfo(data.mensaje);  
 	     	 }else{ 	 	     		     		
 	     		notifySuccessMsg(data.mensaje);  			    
 				//var url = '<?php //echo Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL') . $this->Html->url(array('controller' => 'orders', 'action' => 'myordersclient')); ?>';	
 				var url = '<?php echo $this->Html->url(array('controller' => 'orders', 'action' => 'myordersclient'));?>';	
 				window.location.replace(url);					    		     		
 	         }        	     	
        },
        error: function(xhr,textStatus,error){        	
        	notifyError();    
        }
    });	
    return false;
});

</script>