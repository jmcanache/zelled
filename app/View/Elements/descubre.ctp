<div class="sheet--padding" <?php echo $background;?>>
	<div class="container1">
		<div class="text-center animatedParent" style="margin-top: 20px;">
			<p class="font-KG-Manhattan mint animated fadeInDownShort" style="font-size: 40px;"><?php echo $titulo;?></p>
		</div><?php 

       foreach($tienda_aleatoria as $info)
       {
       	//Foto grande
		$foto = $this->Html->image('todosproductos/' . $info[0]['ruta_thumb'], array('alt' => 'tienda', 'style' => 'display: block; width: 100%; height: 232px; padding: 5px;'));
       	//Las fotos pequenas
       	$foto1 = '<div class="thumbnail-outer" style="margin-right: 0px;"> 
				      <div class="thumbnail-inner">'.						
						$this->Html->image('todosproductos/' . $info[1]['ruta_thumb'], array('alt' => 'tienda', 'style' => 'height: 115px; width: 96px;'))
				      .'</div>
				  </div>';
       	$foto2 = '<div class="thumbnail-outer" style="margin-right: 0px;"> 
		      <div class="thumbnail-inner">'.				
				$this->Html->image('todosproductos/' . $info[2]['ruta_thumb'], array('alt' => 'tienda', 'style' => 'height: 115px; width: 96px;'))
		      .'</div>
		  </div>';

       	$foto3 = '<div class="thumbnail-outer" style="margin-right: 0px;"> 
				      <div class="thumbnail-inner">'.
				      $this->Html->image('todosproductos/' . $info[3]['ruta_thumb'], array('alt' => 'tienda', 'style' => 'height: 115px; width: 96px;'))
				      .'</div>
				  </div>';

		//Tienda de las fotos
		$ir_a_tienda= '<p class="font-human" style="font-size: 20px; margin-bottom: 10px; padding-left: 10px; color: white;">'.$info[0]['tienda_nombre'].'</p>';
        

        //link con numero de seguidores 
        $me_gusta=  '<p style="padding-right: 10px;" class="fa fa-user like-hover" target="_blank"><span class="font-human"> '.$info[0]['tienda_seguidores'].' Seguidores</span></p>';


       	//bloque html
       	$image =
       	'<div class="element_from_right col-xs-12 col-sm-6 col-md-4">
	        <div class="clearfix xs-margin-bottom-large sm-margin-top-large md-margin-bottom-large" style="border: 1px solid #ccc;">
				<div class="clearfix xs-margin-bottom-large">'. $this->Html->link($foto, array('controller' => 'productos', 'action' => 'detail', $info[0]['tienda_id'], $info[0]['producto_id'] ), array('escape' => false)) .'</div>
				<ul class="related-listings clearfix " style="width: 100%;  padding-left: 2px; margin-bottom: 0px;">
			        <li>'
			          . $this->Html->link($foto1, array('controller' => 'productos', 'action' => 'detail', $info[1]['tienda_id'], $info[1]['producto_id'] ), array('escape' => false)) .
			        '</li>
			        <li>
			          '. $this->Html->link($foto2, array('controller' => 'productos', 'action' => 'detail', $info[2]['tienda_id'], $info[2]['producto_id'] ), array('escape' => false)) .'
			        </li>
			        <li>
			          '. $this->Html->link($foto3, array('controller' => 'productos', 'action' => 'detail', $info[3]['tienda_id'], $info[3]['producto_id'] ), array('escape' => false)) .'
			        </li>

		      </ul>
				
				<div class="clearfix xs-margin-top-small sm-margin-top-small md-margin-top-small">
					<div class="pull-leftx" style="background-color: #109998">
					    '. $this->Html->link($ir_a_tienda, array('controller' => 'tiendas', 'action' => 'view_store', $info[0]['tienda_id']), array('escape' => false)) .'
					</div> <!-- close .pull-left -->
				    <div class="pull-right">					    
					    '. $this->Html->link($me_gusta, array('controller' => 'seguidores', 'action' => 'follow_store', $info[0]['tienda_id']), array('escape' => false)).'
				    </div> <!-- close .pull-right -->
				</div> <!-- close .clearfix -->
			</div> <!-- close .md-margin-bottom -->          
		</div> <!-- close .col -->';
        echo $image;
    }?>
	</div>	
</div>

