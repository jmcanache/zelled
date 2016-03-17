<?php 

echo $this->element('user_detail',array('data' => $data)); 

  if (empty($tienda_aleatoria))
  {
    echo '<div id="bloque-productos" class="container content" style="padding-top: 20px">
            <div class="container content" style="text-align:center;padding-top: 60px;">
               <p style="font-size: 16px;">Lo siento, aún no estas siguiendo tiendas</p>
               <p style="margin-bottom: 100px;">'.$this->Html->link('Comienza a seguir tiendas', array('controller' => 'seguidores','action' => 'ver_seguidores'), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
             </div>
          </div>';
  }
  else
  {
    echo $this->element('descubre', array('tienda_aleatoria' => $tienda_aleatoria, 'titulo' => 'Tiendas que sigo', 'background' => 'style="background-color: white;"'));

  }

