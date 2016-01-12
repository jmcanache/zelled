<?php
  if(!empty($ds_encontrados) and $combobox=='Producto')
  {
    echo $this->element('inspiracion',array('ds_data' => $ds_encontrados, 'titulo' => "Encontrados"));
  }

  elseif(!empty($ds_encontrados) and $combobox=='Tienda')
  {
    echo $this->element('descubre', array('tienda_aleatoria' => $ds_encontrados, 'titulo' => 'Tiendas que coinciden con tu búsqueda', 'background' => 'style="background-color: #e8f5f0;"'));
  }

  else
  {
    echo '<p>Lo siento, tivia no encontró coincidencias.</p>';
  }
?>

