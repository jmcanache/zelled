<?php	echo $this->Form->create('OrderTDC', array(
				'url' => array('controller' => 'orders', 'action' => 'store_pay_order'),
				'class' => '',
				'style' => 'height: 420px;',
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
	  <label class="ccjs-number">
	    NO. Tarjeta
	    <input name="card-number" class="ccjs-number" placeholder="•••• •••• •••• ••••">
	  </label>

	  <label class="ccjs-csc">
	    CVC
	    <input name="csc" class="ccjs-csc" placeholder="•••">
	  </label>

	  <button type="button" class="ccjs-csc-help">?</button>

	  <label class="ccjs-name">
	    Tarjetahabiente
	    <input name="name" class="ccjs-name">
	  </label>

	  <fieldset class="ccjs-expiration">
	    <legend>Vencimiento</legend>
	    <select name="month" class="ccjs-month">
	      <option selected disabled>MM</option>
	      <option value="01">01</option>
	      <option value="02">02</option>
	      <option value="03">03</option>
	      <option value="04">04</option>
	      <option value="05">05</option>
	      <option value="06">06</option>
	      <option value="07">07</option>
	      <option value="08">08</option>
	      <option value="09">09</option>
	      <option value="10">10</option>
	      <option value="11">11</option>
	      <option value="12">12</option>
	    </select>

	    <select name="year" class="ccjs-year">
	      <option selected disabled>YY</option>
	      <option value="14">14</option>
	      <option value="15">15</option>
	      <option value="16">16</option>
	      <option value="17">17</option>
	      <option value="18">18</option>
	      <option value="19">19</option>
	      <option value="20">20</option>
	      <option value="21">21</option>
	      <option value="22">22</option>
	      <option value="23">23</option>
	      <option value="24">24</option>
	    </select>
	  </fieldset>

	  <select name="card-type" class="ccjs-hidden-card-type">
	  	<option value="mastercard" class="ccjs-mastercard"></option>
	    <option value="visa" class="ccjs-visa"></option>
	  </select>

	  <label class="ccjs-name" style="position: relative; top: 140px; width: 20em;">
	    Cedula o RIF
	    <input name="identificador" class="ccjs-name">
	  </label>
	  <?php 
			echo $this->Form->hidden('');
			echo $this->Form->button(__('Pagar Bs.' . $total), array('class' => 'boton_morado', 'id'=> 'sendform', 'style' => 'position: relative; top: 190px; width: 100%; height: 20%;'));?>
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
<!-- $('#UserBio').html(data); 
-->