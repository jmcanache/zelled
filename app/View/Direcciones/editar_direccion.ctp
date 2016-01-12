<div class="homepage_content clearfix direccion" style="background-color: #e8f5f0;padding-bottom: 20px; width: 100%">
<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Edita esta dirección</p>

<?php
   echo $this->Form->create('Direccion', array( 
	  'url' => array('controller' => 'direcciones', 'action' => 'editar_direccion'),	
      'inputDefaults' => array(
         'class' => '',
         'div' => false,
         'label' => false
      ))
   );?>
   <div class="col-md-4 col-md-offset-4"><?php
   echo $this->Form->input('Direccion.nombre_completo', array('placeholder' => __('Nombre completo')));
   echo $this->Form->input('Direccion.telefono', array('placeholder' => __('Telefono movil')));
   echo $this->Form->input('Direccion.direccion', array('placeholder' => __('Direccion')));
   echo $this->Form->input('Direccion.provinciaID', array('placeholder' => __('Estado'), 'default' => $provincia));
   echo $this->Form->input('Direccion.ciudad', array('placeholder' => __('Ciudad')));
   echo $this->Form->button('Guardar cambios', array('name' => 'Guardar_continuar', 'class' => 'boton_verde','style' => ' width: 100%'));
   echo $this->Form->end();
?>
</div>
</div>
