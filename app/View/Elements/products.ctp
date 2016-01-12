<div id="bloque-productos" class="container content" style="padding-top: 20px; padding-bottom: 30px">
  <?php
    $cant_fotos = count($ds_data);      
    $i = 0;
    $count = 0;
	$idImagen = 0;
    foreach($ds_data as $info):
      $idImagen++;
      if($i == 0)
      {
        echo '<div class="sixteen columns featured_links">
              <div class="section clearfix margen-section-clearfix">';
      }?>
      <div class="five alpha column">
        <!-- normal -->
       <div class="ih-item square effect6 from_top_and_bottom tamanio-foto-producto"> <?php       
	        $cant_likes = null ;
	        if (!empty($info['Producto']['likes']))
	        {
	        	$cant_likes = $info['Producto']['likes'];
	        }
	        //$image = '<div class="img"><img src="data:image/jpeg;base64,'.base64_encode($info['Foto']['thumb']).'"/>';
	        $image = '<div class="img">'.$this->Html->image('todosproductos/' . $info['Foto']['thumb'], array('alt' => 'producto'));	               
	        $info_top = '<div class="info tamanio-info-top"><h3>'. $info['Producto']['nombre'].'</h3><p>'. $info['Producto']['descripcion'].'</p> </div>';	        
	        $info_bottom_price = '<div class="info tamanio-info-bottom" style="top:143px;"> <p class="font-human padding-price-heart" style="font-style: normal; font-size: 20px; line-height: 0; display: inline-block;">Bs. '. number_format($info['Producto']['precio'],2,",",".").'</p>';	        
	        $info_bottom_likes = '<p id="heart'. $idImagen .'" class="fa fa-heart padding-price-heart" style="font-style: normal; font-size: 20px; line-height: 0; padding-right: 0px;"> </p> <p id="countLike'. $idImagen .'" class="fa likeCount" style="">' . $cant_likes.'</p></div></div>';
	        $cantUsuarioLike = count($info['Producto']['UsuarioLike']);	        
 			for ($x = 0; $x < $cantUsuarioLike; $x++) {	        		        	
	        	if($info['Producto']['UsuarioLike'][$x]['usuario_id'] == $actualUser['Usuario']['id'])
	        	{
	        		$info_bottom_likes = '<p id="heart'. $idImagen .'" class="fa fa-heart padding-price-heart likered" style="font-style: normal; font-size: 20px; line-height: 0; padding-right: 0px;"> </p> <p id="countLike'. $idImagen .'" class="fa likeCount" style="">' . $cant_likes.'</p></div></div>';					
	        	}	        	        
	        }         	      	       
			echo $image;
			echo $this->Html->link($info_top, array('controller' => 'productos', 'action' => 'detail', $info['Producto']['tienda_id'], $info['Producto']['id'] ), array('escape' => false));
			echo $info_bottom_price;		
			echo $this->Html->link($info_bottom_likes, array('controller' => 'productos', 'action' => 'like_product', $info['Producto']['tienda_id'], $info['Producto']['id']), array('escape' => false, 'id'=> 'heartElementA'));
			?>
        </div>
        <!-- end normal -->
      </div>
      <?php $i++; $count++;
      if($i == 3 || $cant_fotos == $count ){
        echo '</div>
              </div>';
        $i = 0;
      }
    endforeach;
    ?>
</div>