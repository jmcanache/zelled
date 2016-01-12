<?php echo '<div id="bloque-productos" class="container content" style="padding-top: 20px">
					            <div class="container content" style="text-align:center;padding-top: 60px;">
					      	       <p class="font-KG-Manhattan" style="color:#59A09A;font-size:36px;">Datos Bancarios</p>
					               <p style="font-size: 16px;">Lo siento, aún no tienes datos Bancarios cargados</p>
					               <p style="margin-bottom: 100px;">'.
					               $this->Html->link('Cargar Datos Bancarios', array('controller' => 'usuarios', 'action' => 'datos_bancarios_modal'),
					                   										array('class' => 'link_verde','escape' => FALSE, 'id'=>'editdatosBancoslink', 'data-toggle' =>'modal', 'data-target'=>'#ModalUsuarioBanco', 'style' => 'text-decoration: none;margin: 0 auto;')).'</p>
					             </div>
					          </div>'; ?>