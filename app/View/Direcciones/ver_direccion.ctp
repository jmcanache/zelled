<div class="homepage_content clearfix" style="background-color: #e8f5f0;">
<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Tus direcciones</p>
 <!-- Direcciones con formato -->
<?php echo $this->element('direcciones', array('ds_direcciones' => $ds_direcciones)); ?>
 <!-- / Direcciones con formato -->


<?php
  if(count($ds_direcciones)<Configure::read('TIVIA_CONFIG.DIRECCION.CANTIDAD_DE_DIRECCIONES'))	
    {
    	echo '<div>
    	        <p style="text-align: center; padding-top: 20px; padding-bottom: 20px; font-size: 18px;">'.$this->Html->link('Nueva direccion', array('controller' => 'direcciones', 'action' => 'nueva_direccion'), array('escape' => false)).'</p>
    	     </div>';
    } 
?>
</div>