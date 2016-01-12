<?php
  echo $this->element('user_detail',array('data' => $data)); 

  if (empty($ds_data))
  {
    echo '<div id="bloque-productos" class="container content" style="padding-top: 20px">
            <div class="container content" style="text-align:center;padding-top: 60px;">
               <p style="font-size: 16px;">Lo siento, aún no tienes productos favoritos</p>
               <p style="margin-bottom: 100px;">'.$this->Html->link('Empieza a dar likes', array('controller' => 'likes','action' => 'ver_favoritos'), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
             </div>
          </div>';
  }
  else
  {
    echo $this->element('inspiracion', array('ds_data' => $ds_data, 'titulo' => "Mis Favoritos")); 
  }


  