
<div class="fondo_accede_column_verdex" style="margin: 0px auto; padding: 20px; color: white;"><?php
	echo $this->Form->create('Usuario', array(
		'url' => array('controller' => 'usuarios', 'action' => 'login'),
		'class' => 'nav-flyout-menu nav-flyout nav-arrow nav-flyout-api nav-arrow',
		'style' => 'margin-top: 10px; padding-left: 30px; padding-right: 30px;',
		'inputDefaults' => array(
				'class' => '',
				'div' => false,
				'label' => false
				)));
	?>
	<div style="background: none repeat scroll 0px 0px rgba(255, 255, 255, 0.75); padding-bottom: 1px; padding-top: 20px; margin-bottom: 20px;">
		<p><?php
			echo $this->Form->input('Usuario.login', array('placeholder' => __('Correo')));
		?></p>
		<p><?php
			echo $this->Form->input('Usuario.password', array('placeholder' => __('Clave')));
		?></p>
	</div>
	<a href="" target="_blank">
		<p style="background: none repeat scroll 0px 0px rgba(255, 255, 255, 0.75); margin-bottom: 20px; font-size: 12px; color: rgb(86, 90, 92); padding-bottom: 5px; padding-top: 5px;">
      		<?php
		echo $this->Html->link('¿Olvidaste tu contraseña?', array('controller' => 'Usuarios', 'action' => 'reset_password'), array('escape' => false));?></p>
    </a>
	<p><?php
		echo $this->Form->button(__('Entrar'), array('class' => 'boton_verde', 'style' => 'width:100%'));
	?></p><?php
	echo $this->Form->end();?>
</div>