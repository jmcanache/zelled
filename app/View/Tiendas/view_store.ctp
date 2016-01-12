<?php
	if(!empty($ds_data) && $esdueno && !empty($referencia))
	{
		echo $this->element('admin_panel', array('storeId' => $data['Tienda']['id']));
		//$this->log($data['Tienda']['id']);
	}
  echo $this->element('image_banner', array('posts' => $data['Tienda'], $esdueno, $follow_unfollow));
 /* $this->log($ds_data); */
  if(empty($ds_data) && $esdueno)
  {
    echo '<div id="bloque-productos" class="container content" style="padding-top: 20px">
            <div class="container content" style="text-align:center;padding-top: 60px;">
      	       <p class="font-KG-Manhattan" style="color:#59A09A;font-size:36px;">Productos</p>
               <p style="font-size: 16px;">Lo siento, aún no tienes productos cargados</p>
               <p style="margin-bottom: 100px;">'.$this->Html->link('Cargar mi primer producto', array('controller' => 'productos','action' => 'listing'), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
             </div>
          </div>';

  }
  elseif (empty($ds_data) && !$esdueno)
  {
    echo '<div id="bloque-productos" class="container content" style="padding-top: 20px">
            <div class="container content" style="text-align:center;padding-top: 60px;">
      	       <p class="font-KG-Manhattan" style="color:#59A09A;font-size:36px;">Productos</p>
               <p style="font-size: 16px;">Lo siento, aún no hay productos cargados</p>
               <p style="margin-bottom: 100px;">'.$this->Html->link('Ver otras tiendas', array('controller' => '','action' => ''), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
             </div>
          </div>';
  }
  elseif (!empty($ds_data))
  {
    echo $this->element('products', array('ds_data' => $ds_data));
  }
