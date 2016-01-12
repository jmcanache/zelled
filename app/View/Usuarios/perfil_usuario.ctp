<div class="sixteen"><?php
	echo $this->element('user_detail',array('data' => $data)); 

	if(empty($ds_data))
	{
	    echo '<div id="bloque-productos" class="container content" style="padding-top: 20px">
		        <div class="container content" style="text-align:center;padding-top: 60px;">
		  	       <p class="font-KG-Manhattan titulo mint">Productos</p>
		           <p style="font-size: 16px;">Aún no tienes productos favoritos</p>
		           <p style="margin-bottom: 100px;">'.$this->Html->link('Llevame a ver colecciones', array('controller' => 'productos','action' => 'gallery'), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
		         </div>
		      </div>';

	}
	else
	{
		echo $this->element('inspiracion',array('ds_data' => $ds_data, 'titulo' => "Mis favoritos"));
		echo '<div class="homepage_content clearfix">
			    <div class="container">
			      <div class="sixteen columns">
			        <div class="section clearfix" style="text-align: center;">'.$this->Html->link('Quiero verlos todos', array('controller' => 'likes','action' => 'ver_favoritos'), array('class' => 'link_verde')) .
			        '</div>
			      </div>
			    </div>
			</div>';
	} 

	if(empty($tienda_aleatoria))
	{

		      echo '<div class="homepage_content clearfix" style="background-color: #e8f5f0;">
			    <div class="container">
			      <div class="sixteen columns">
			        <div class="container content" style="text-align:center;padding-top: 60px;">
			  	       <p class="font-KG-Manhattan titulo mint">Tiendas</p>
			           <p style="font-size: 16px;color: #59a09a;padding-bottom: 20px;">¡Hey Comienza a seguir tiendas!</p>
			           <p style="margin-bottom: 100px;">'.$this->Html->link('Llevame a ver tiendas', array('controller' => 'usuarios','action' => 'perfil_usuario'), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
		         	</div>
			        </div>
			      </div>
			    </div>
			</div>';

	}
	else
	{
		echo $this->element('descubre', array('tienda_aleatoria' => $tienda_aleatoria, 'titulo' => 'Tiendas que sigo', 'background' => 'style="background-color: #e8f5f0;"'));
		echo '<div class="homepage_content clearfix" style="background-color: #e8f5f0;">
			    <div class="container">
			      <div class="sixteen columns">
			        <div class="section clearfix" style="text-align: center;">'.$this->Html->link('Quiero verlas todas', array('controller' => 'seguidores','action' => 'ver_seguidores'), array('class' => 'link_verde')) .
			        '</div>
			      </div>
			    </div>
			</div>';
	} ?>
</div>



<!-- Add content to the popup -->
 <div id="my_popup" class="animatedParent">
    <div class="animated fadeInDownShort">
    <?php echo $this->Html->image('monitor-tivia.png', array('alt' => 'TiviaStore'));?>
    </div>
    
    <button class="my_popup_close">Cerrar x</button>
</div>