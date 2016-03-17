<div class="homepage_content clearfix direccion" style="background-color: #e8f5f0;padding-bottom: 20px; width: 100%">
<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Carga hasta cuatro direcciones</p>

<?php
   echo $this->Form->create('Direccion', array(
      'inputDefaults' => array(
         'style' => '',
         'div' => false,
         'label' => false
      ))

   );?>

   <div class="col-md-4 col-md-offset-4"><?php
      echo $this->Form->input('Direccion.nombre_completo', array('placeholder' => __('Nombre completo')));
      echo $this->Form->input('Direccion.telefono', array('placeholder' => __('Telefono movil')));
      echo $this->Form->input('Direccion.direccion', array('placeholder' => __('Direccion')));
      echo $this->Form->input('Direccion.provinciaID', array('placeholder' => __('Estado')));
      echo $this->Form->input('Direccion.ciudad', array('placeholder' => __('Ciudad')));
      echo '<p>'.$this->Form->button('Guardar y continuar', array('name' => 'Guardar_continuar', 'class' => 'boton_verde', 'style' => ' width: 100%')).'</p>';
      //si editar es True es porque proviene del metodo editar_direccon
      if ($Cantidad_de_direcciones<(Configure::read('TIVIA_CONFIG.DIRECCION.CANTIDAD_DE_DIRECCIONES')-1))
         { 
         	echo $this->Form->button('Guardar y añadir otra direccion', array('name' => 'Guardar_anadir', 'class' => 'boton_verde', 'style' => ' width: 100%'));
         }
      echo $this->Form->end();
?>
</div>
</div>
