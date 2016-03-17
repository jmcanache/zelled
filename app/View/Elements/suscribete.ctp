<div class="homepage_content clearfix" style="background-color: #e8f5f0; padding-bottom: 40px;">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix animatedParent">
            <p class="font-KG-Manhattan titulo mint animated fadeInDownShort">Suscríbete</p><?php
			
			echo $this->Form->create('Usuario', array(
				'url' => array('controller' => 'suscriptores', 'action' => 'insert'),
				'class' => '',
				'style' => 'text-align:center;',
				'inputDefaults' => array(
						'class' => 'form-inline',
						'div' => false,
						'label' => false
						)));
			
			echo $this->Form->input('Suscriptor.email', array('placeholder' => "Ingresa tu correo", 'id' => 'box', 'style' => 'width: 40%; color: #8bbdb8; width: 40%; color: rgb(143, 191, 174); box-shadow: 0px 2px 2px rgb(204, 204, 204);'));?>
			<p><?php echo $this->Form->button(__('Suscribirme al boletin'), array('class' => 'boton_verde', 'style' => 'margin-left: 0%;'));	  
 			echo $this->Form->end();?></p>                 
          
            <?php echo $this->Session->flash(); ?>

        </div>
      </div>
    </div>
</div>