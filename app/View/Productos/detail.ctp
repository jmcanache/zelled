<div class="homepage_content clearfix franja-perfil height-franja-perfil-G">
    <div class="container">
      <div class="sixteen columnsx">
        <div class="section clearfix">
         	<div class="seven columns alphax">
			    <div class="producto-descripcion-pic">
					<div id="slider" >
						<div class="like_div" style="left:0px;text-shadow:1px 1px 1px #C5D9D4;"><?php
						  $cant_likes = '';
					  	  if ($producto['Producto']['likes'] > 0){$cant_likes = $producto['Producto']['likes']; }    				      
					  	  $count_likes = '<span id="countLikes" class="font-human" style="padding-right: 0px; padding-left: 5px;">'. $cant_likes. '</span>';    					 			
						  $heart = '<span id="heart" class="'.$producto['1'].'"></span>';
						  echo $this->Html->link($heart, array('controller' => 'productos', 'action' => 'like_product',$producto['Tienda']['id'], $producto['Producto']['id']),
														 array('escape' => FALSE, 'id'=>'heartElement'));?>
	       				</div>
						<div class="opacidad">
						<?php
						 $count = count($producto['Foto']);				 
						 $i = 0;
						 $image_id = 1;
		    				for ($i = 0; $i < $count; $i++) {	 
							  $image_id_words = $this->ConvertNumber->number_to_words($image_id);
							  echo '<img id="' . $image_id_words . '" src="data:image/jpeg;base64,'.base64_encode($producto['Foto'][$i]['foto_principal']).'"/>';
		    				  $image_id++;
		    				};	    			
						?>
						  </div>
						<ul>
							<li><a href="#one"></a></li>
							<li><a href="#two"></a></li>
						</ul>
					</div>
			   </div>
     		</div>
  
			<div class="six columns omegax">
				<div style="font-size:39px;">
			        <span class="font-human mint"><?php echo $producto['Producto']['nombre'];?></span>
			        <span class="font-human margen_product" style="color: #59a09a;margin-bottom: 0px; margin-top: 0px; display: block; font-size: 19px; line-height: 50px;"><?php echo $producto['Producto']['descripcion_corta'];?></span>
			        <span class=" font-human" style="display: inline; padding-right: 20px; font-weight: bold; text-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.3); color: white;">Bs. <?php echo number_format($producto['Producto']['precio'],2,",",".");?> 
			            <ul class="share-buttons share-buttons-margin" style="float: right">
				            <li><a class="tamano-redes tw-icon" href="https://twitter.com/share" data-count="none"></a></li>    
				            <li><a class="tamano-redes fb-icon" data-layout=""></a></li>
				            <li><a class="tamano-redes insta-icon"></a></li>  
				            <li><a class="tamano-redes pin-icon" href="//es.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-shape="round"></a></li>
			           </ul>
		        	</span>
		        </div>
		        <p class="font-human margen_product grey" style="word-wrap: break-word;margin-bottom: 0px; padding-top: 5px; font-size: 16px; line-height: 22px; padding-bottom: 10px;"><?php echo $producto['Producto']['descripcion_larga'];?></p>

		        <!--INICIO FORM -->
		        <?php  echo $this->Form->create('Compra', array(
									'url' => array('controller' => 'carritos', 'action' => 'add', $producto['Producto']['id'],'cart'),
									'id' =>'compraForm',
									'class' => '',
									'style' => '',
									'inputDefaults' => array(
											'class' => '',
											'div' => false,
											'label' => false
											)));

    		  	$oculta_bloque = null;
         		$cantidad = null;

	            if($producto['Producto']['existencia'] == 0){
	            	$oculta_bloque = 'style="display: none"';
	            	echo '<p class="pink" style="text-align:center;">En este momento no lo tenemos en existencia.</p>';
	          	}
	          	elseif ($producto['Producto']['existencia'] == 1) {
	     			$cantidad = $this->Form->input('Compra.cantidad', array('value'=> $producto['Producto']['existencia'], 'label' => array('text' => 'Cantidad','class' => 'inline-label font-KG-Manhattan'),'class' => 'input-label-style', 'style' => 'border-width:0px;width:66px;', 'disabled'=>'disabled')) .'<span style="padding-left: 10px; color: red">¡Último en existencia!</span>';
	    	    }
    	    	elseif ($producto['Producto']['existencia'] > 1){
  		  			$j = 1;
  		  			for ($i = 1; $i <= $producto['Producto']['existencia']; $i++)
  		  			{
			        	$array_type[$i] = $j++;
  					}
    			 	$cantidad = $this->Form->input('Compra.cantidad', array('options'=> $array_type,'label' => array('text' => 'Cantidad','class' => 'inline-label font-KG-Manhattan'),'class' => 'input-label-style', 'style' => 'border-width:0px;width:66px;'));
    		  	}?>

	            <div <?php echo $oculta_bloque;?>>
	            	<?php echo $cantidad;?>
	            	
	            	<div class="ver_componentes" style="float: right;">
		                <p style="text-shadow: 0 0 1px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.3); margin-right: 35px; color: white;" class="fa fa-truck fa-2x fa-flip-horizontal font-human"></p>
		                <div style="margin-top: 10px; background-color: white;z-index: 1;" class="detalles_producto grey">  
		                    <ul style="display:block"><?php echo 'Envios por:';
		                      $couriers = $data['Tiendacourier'];
		                       foreach ($couriers as $courier) :?> 
		                          <li style="margin-bottom: 0px;"><?php $display = $courier['courier_id']; echo Configure::read("TIVIA_CONFIG.$display.COURIERS") ;?></li>
		                        <?php endforeach;?>
		                    </ul>
		                </div>
	              	</div>
	              	<div id="atributos">
            			<?php   
            				if (!empty($color)){          				
								$countcolores = count($color);
								if($countcolores > 1){
									for ($i = 0; $i <= $countcolores - 1; $i++)
									{
										$array_color[$color[$i]['descripcion']] =$color[$i]['descripcion'];	// antes guardaba id $array_color[$color[$i]['id']] =$color[$i]['descripcion'];				
									}
									echo $this->Form->input('Compra.Color', array('options'=> $array_color,'label' => array('text' => 'Color','class' => 'inline-label font-KG-Manhattan'),'class' => 'input-label-style', 'style' => 'border-width:0px;width:150px;'));
								}
							}
							if (!empty($color)){
								$counttallas = count($talla);
								if($counttallas > 1){
									for ($x = 0; $x <= $counttallas - 1; $x++)
									{
										$array_talla[$talla[$x]['descripcion']] =$talla[$x]['descripcion']; // antes guardaba id	$array_talla[$talla[$x]['id']] =$talla[$x]['descripcion'];												
									}
									echo $this->Form->input('Compra.Talla', array('options'=> $array_talla,'label' => array('text' => 'Talla','class' => 'inline-label font-KG-Manhattan'),'class' => 'input-label-style', 'style' => 'border-width:0px;width:150px;'));
								}
							}
							?>						
            		</div>
	              	<?php
	               		if($usuario_id != $producto['Tienda']['usuario_id'])
               			{
               				echo $this->Form->button(__('A la cesta'), array('class' => 'boton_verde font-KG-Manhattan margin-left-150x fs-18', 'style' => 'width: 100%; margin-top: 20px;'));
               			}
	               	?>
	            </div>
		     
		        <div class="grey font-human" style="background-color: white; padding-left: 10px; padding-right: 10px; padding-bottom: 10px; opacity: 0.8;">
		            <p style="font-size: 18px; text-align: center; margin-top: 10px;" class="font-KG-Manhattan mint">Detalles</p><?php 
		                if(!$producto['Producto']['esta_hecho']){
		                  echo '<p style="margin-bottom: 0px;"> Producto disponible por pedidos.</p>';
		                }?>
		               
		              <p>Materiales utilizados: <?php echo $producto['Producto']['materiales'];?></p>  
		        </div>
			</div>

			<div class="three columns omegax">
				<p class="fa fa-heart like-panel morado" style="font-size:20px; text-shadow: 0 0 1px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.3)">
            		<span id="success" class="font-human" style="padding-right: 0px; padding-left: 5px;"><?php echo $cant_likes; $this->log($cant_likes);?> Loves</span>
          		</p>
			</div>
        </div>
      </div>

      <div class="sixteen columnsx">
      	<div class="section clearfix">
			<div class="three columns alphax"><?php 
				$logo = 'logo/' . $producto['Tienda']['logo'];
         		echo $this->Html->image($logo, array(
					  			'alt' => 'TiviaStore',
					  			'class' => 'tienda-perfil-pic',
					  			'url' => array('controller' => 'tiendas', 'action' => 'view_store', $producto['Tienda']['id'])));?>
     		</div>
     		<div class="thirteen margin-tienda">
     			<span class="font-KG-Manhattan" style="font-size:30px;"><span style="padding-top: 0px; margin-top: 0px; text-shadow: 0 0 1px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.3); color: white;">Producto de</span>
		    	 <?php echo $this->Html->link($producto['Tienda']['nombre'], array('controller' => 'tiendas', 'action' => 'view_store', $producto['Tienda']['id'])); ?>
		    	</span>
     		</div>
      	</div>
   	 </div>
   </div>
</div>


<div class="homepage_content clearfix">
    <div class="container">
    	<div class="sixteen columnsx">
      		<div class="sixteen columns">
      			<!--<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Productos</p>-->
      		</div>
      	</div>
    </div>
</div>
<?php echo $this->element('products', array('ds_data' => $ds_data, $producto['Producto']['id']));?>
