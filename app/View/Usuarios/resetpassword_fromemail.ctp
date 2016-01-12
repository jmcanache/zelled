<div class="homepage_content clearfix">
    <div class="fullwidth-section">
      <div data-stellar-background-ratio="0.2" style="background-image: url('../../img/ban.png'); background-position: 50% 0px;" class="parallax">
       </div>
      <div style="background-color:rgba(0,0,0,0.4);" class="img-overlay-solid"></div>

      <div class="container">
          <div class="sixteen columns featured_links offset-by-three" style="margin-left: 0px;">
            <div class="section clearfix offset-by-two" style="padding-top: 68px;">
              <div class="six columns" style="text-align:center;">
              	<p class="font-human" style="font-size: 26px; color: #ffffff">Resetear Clave en Tivia<p>
 				<div style="margin-top: 50px auto; padding: 20px; color: white;"><?php
 				echo $this->Form->create('Usuario', array(
 						'url' => array('controller' => 'usuarios', 'action' => 'resetpassword_fromemail'),
 						'class' => 'nav-flyout-menu nav-flyout nav-arrow nav-flyout-api nav-arrow',
 						'style' => 'margin-top: 10px; padding-left: 30px; padding-right: 30px;',
 						'inputDefaults' => array(
 								'class' => '',
 								'div' => false,
 								'label' => false
 						)));
 						echo $this->Form->hidden('Usuario.clave_recuperacion');
 				?>
 										<div style="background: none repeat scroll 0px 0px rgba(255, 255, 255, 0.75); padding-bottom: 1px; padding-top: 20px; margin-bottom: 20px;">
 											<p><?php
 												echo $this->Form->input('Usuario.login', array('type' => 'email', 'placeholder' => __('Correo electrónico')));?>
 											</p>				
 											<p><?php
 												echo $this->Form->input('Usuario.password', array('placeholder' => __('Clave')));?>
 											</p>				
 											<p><?php
 												echo $this->Form->input('Usuario.password2', array('type' => 'password', 'placeholder' => __('Repita su clave')));?>
 											</p>
 										</div>				
 											<p><?php
 													echo $this->Form->button(__('Cambiar'), array('class' => 'boton_verde', 'style' => 'width:100%'));?>
 											</p>
 														
 										<?php
 										echo $this->Form->end(); ?>
 				
				</div>
 			  </div>
            </div>
          </div>
        </div>
    </div>            
</div>
