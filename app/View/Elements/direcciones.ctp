<div class="container">
<?php 
  foreach($ds_direcciones as $direccion)
  	 {
  	 	 echo ' <div class="four columns" style="color: #A5A5A5; border-top: 4px solid rgb(16, 153, 152);">
                <div style="background: none repeat scroll 0 0 #ffffff; margin-bottom: 20px; padding-left: 20px; padding-bottom: 10px; padding-top: 10px;">
                <p style="font-size:18px; font-weight: bold; color: #8bbdb8;">' .$direccion['Direccion']['nombre_completo']. '</p>
                <p>' . $direccion['Direccion']['direccion'] . '.<br><strong> '. $direccion['Direccion']['ciudad'] . ', '  . $direccion['Provincia']['descripcion'] . '.</strong><br>' .$direccion['Direccion']['telefono'].'.</p></div>
  	 	
               <p>' .$this->Html->link('Editar', array('controller' => 'direcciones', 'action' => 'editar_direccion', $direccion['Direccion']['id']), array('class' => 'accede', 'style' => 'width:49%; left: 0px; top:0px;')).'      ' 
                      .$this->Html->link('Eliminar', array('controller' => 'direcciones', 'action' => 'eliminar_direccion', $direccion['Direccion']['id']), array('class' => 'accede', 'style' => 'width:49%; left: 0px; top:0px;')).
              '</p>
  	 	       </div>';
  	 }
      
?>
</div>
