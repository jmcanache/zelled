 <div class="homepage_content clearfix">
    <div class="fullwidth-section">
      <div data-stellar-background-ratio="0.2" style="background-image: url('../img/ban.png'); background-position: 50% 0px;" class="parallax">
       </div>
      <div style="background-color:rgba(0,0,0,0.4);" class="img-overlay-solid"></div>

      <div class="container">
          <div class="sixteen columns featured_links offset-by-three" style="margin-left: 0px;">
            <div class="section clearfix offset-by-two" style="padding-top: 68px;">
              <div class="six columns" style="text-align:center;">
              	<p class="font-human" style="font-size: 26px; color: #ffffff">Recupera tu cuenta<p>
 				<div style="margin-top: 50px auto; padding: 20px; color: white;"><?php
 			 		echo $this->Form->create('Usuario', array(
							'url' => array('controller' => 'usuarios', 'action' => 'reset_password'),
							'class' => 'nav-flyout-menu nav-flyout nav-arrow nav-flyout-api nav-arrow',
							'style' => 'margin-top: 15px;',
							'inputDefaults' => array(
														'class' => '',
														'div' => false,
														'label' => false
														)))?>
					<div style="background: none repeat scroll 0px 0px rgba(255, 255, 255, 0.75); padding-bottom: 1px; padding-top: 20px; margin-bottom: 20px;">
						<p><?php
							echo $this->Form->input('Usuario.login', array('type' => 'email', 'placeholder' => __('Correo electrónico')));?>
						</p>
					</div>

					<p><?php
						echo $this->Form->button(__('Recuperar'), array('class' => 'boton_morado margen_boton'));?>
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
