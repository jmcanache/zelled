<div class="homepage_content clearfix" style="background-image: url('../img/fondo.png'); padding-bottom: 40px;">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix ">          
          <p class="font-human" style="font-size:35px; color: #ffffff; text-align:center; line-height: 40px">¿Haces diseños únicos? ¿Quieres exponer y vender tus productos hechos a mano? Primer Marketplace venezolano de artistas para artistas. ¡Abrimos en 2015!</p>
          <p class="font-KG-Manhattan" style="font-size:45px; color: #ffffff; text-align:center;">Suscríbete</p><?php
			
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


 <!-- Contactanos -->
<div class="homepage_content clearfix" style="">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix">
          <div style="margin: 0 auto; width:10%;"><?php //echo $this->Html->image('isologo.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px;  width: 130px; padding-top: 50px;'));?></div>



            <ul class="footer-suscribete">
                <li class="tamano-redes-a">
                  <a class="twitter-morado" href="https://twitter.com/tiviastore"></a>
                </li> 
                <li class="tamano-redes-a">
                  <a class="facebook-morado" href="https://facebook.com/tiviastore"></a>
                </li>
                <li class="tamano-redes-a">
                  <a class="instagram-morado" href="https://instagram.com/tiviastore"></a>
                </li>
                <li class="tamano-redes-a">
                  <a class="pinterest-morado" href="https://pinterest.com/"></a>
                </li>
              </ul>

        </div>
      </div>
    </div>
</div>
 <!-- / Contactanos -->

