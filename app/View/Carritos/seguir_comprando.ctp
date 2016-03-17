<div class=" homepage_content clearfix franja-perfil height-franja-perfil-P" style="height: 400px;">
  <div class="container" style="padding-top: 10px;">  
    <div id="p_human" class="sixteen columns">
      <div class="section clearfix">
        <div style="font-size: 38px; text-align: center; margin-top: 50px;"">
          <span class="font-KG-Manhattan mint">Tu Cesta de Compras esta Vacia</span>         
          <p class="font-human grey" style="margin-bottom: 0px; padding-top: 5px; font-size: 16px; line-height: 18px; padding-bottom: 10px;"></p>
       
             <?php echo $this->Html->image('bag.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'padding-top: 20px; padding-bottom: 20px'));?>
      		<!--  <p class="font-human mint" style="margin-bottom: 100px;">Haz clic   <?php // echo $this->Html->link('aqui', array('controller' => 'productos','action' => 'gallery'), array('class' => 'font-human'));?> para regresar a la galeria de productos </p>--> 
      		  <div class="container content" style="text-align:center;padding-top: 0px;">		  	  
		           <p style="margin-bottom: 100px; padding-top: 20px;"> <?php echo $this->Html->link('Regresa a la Galeria', array('controller' => 'productos','action' => 'gallery'), array('class' => 'link_verde', 'style' => 'margin: 0 auto;padding-left: 40px; padding-right: 40px;')); ?> </p>
		      </div>
       </div>
    </div>
  
  </div>
</div>
