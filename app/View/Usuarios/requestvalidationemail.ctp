<?php
	echo $this->Form->create('Usuario', array(
	'url' => array('controller' => 'Usuarios', 'action' => 'requestvalidationemail'),
	'class' => null,
	'inputDefaults' => array(
			'class' => '',
			'div' => false,
			'label' => false
			))); ?>

	<h2 class="landing-form"><?php echo __('Validar mi cuenta');?></h2>

	<p><?php
		echo $this->Form->input('Usuario.login', array('label'=> 'Correo', 'type' => 'email', 'placeholder' => __('Correo electrónico')));?>
	</p>

	<p><?php
			echo $this->Form->button(__('Recuperar'), array('class' => 'boton_morado margen_boton'));?>
	</p>

<?php
	echo $this->Form->end(); ?>