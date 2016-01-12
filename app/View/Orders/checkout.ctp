 <!-- Productos -->
<div class="homepage_content clearfix" style="background-color: #e8f5f0;">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix">
            <p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">¡Amamos tu elección!</p>
            <p style="text-align: center; font-size: 16px; color: #8bbdb8; margin-bottom: 10px;">Haz hecho una excelente elección</p><?php

	           foreach ($ds_productos as $ds_producto):?>	            	
		           
		            <div class="container  offset-by-two">
		            	<table class="table checkout-table col-md-10" style="background: none repeat scroll 0 0 rgba(255, 255, 255, 0.75); margin-bottom: 0px;">
		        			<tbody>
		        				<tr>
		        					<td class="product-name-col">
		        						<figure style="float: left; margin-right: 25px;"><?php
		        							$image = $this->Html->image('todosproductos/' . $ds_producto['Foto']['ruta_thumb'], array('alt' => 'producto', 'style' => 'width: 140px;'));;
		        							echo $this->Html->link($image,array('controller' => 'productos', 'action' => 'detail', $ds_producto['Tienda']['id'], $ds_producto['Producto']['id']), array('escape' => false));?>
		        						</figure>
		        						<p class="product-name" style="text-transform:uppercase;">
		        							<a href="#"><?php echo $ds_producto['Producto']['nombre']?></a>
		        						</p>		        						
		        						<ul style="color: #a5a5a5">
		        							<li style="line-height: 10px;"><?php echo $ds_producto['Producto']['descripcion']?></li>
		        							<?php  
											if($this->Session->read('atributos')){				
								                foreach( $this->Session->read('atributos') as $atr){ 
													if($ds_producto['Producto']['id'] == $atr['producto_id']){               
								                  		echo '<li style="line-height: 10px;">' . $atr['atributo'] .':  '.$atr['valor'].'  </li>';
								                  	}                
								                }								                  
								            }   
				            				?> 
		        							<li style="line-height: 10px;">Cantidad: <?php echo $ds_producto['Producto']['cantidad']?></li>
		        							<li style="font-weight: bold; color:#8bbdb8;line-height: 10px;">Precio: Bs. <?php echo number_format($ds_producto['Producto']['precio'],2,",",".");?></li>
		        						</ul>
		        					</td>
		        					<td>
		        						<p style="color: #a5a5a5; text-align: center">Lo vende:</p>
		        						<p style="text-align: center; margin-bottom: 0px;"><?php 
		        						echo $this->Html->link($this->Html->image('logo/' . $ds_producto['Tienda']['logo'], array('alt' => 'TiviaStore', 'style' => 'margin-left: 10px; margin-right: 10px; width: 90px;', 'class' => 'profile-pic')),  array('controller' => 'tiendas', 'action' => 'view_store', $ds_producto['Tienda']['id']), array('escape' => false));?></p>
		        						<p style="text-align: center;"><?php
		        							echo $this->Html->link($ds_producto['Tienda']['nombre'],  array('controller' => 'tiendas', 'action' => 'view_store', $ds_producto['Tienda']['id']), array('escape' => false));?></p>
		        					</td>
								</tr>
							</tbody>
						</table>
					</div>
				<?php endforeach; ?>
        	</div>
      </div>
    </div>
</div>
<!-- / Productos -->

<!-- Inicio del formulario-->
<?php	echo $this->Form->create('Order', array(
				'url' => array('controller' => 'orders', 'action' => 'checkout'),
				'class' => '',
				'style' => 'text-align:center;margin-bottom: 0px;',
				'inputDefaults' => array(
						'class' => 'form-inline',
						'div' => false,
						'label' => false
						)));?>

 <div class="homepage_content clearfix">
    <div class="fullwidth-section">
      <div class="container">
          <div class="sixteen featured_links" style="margin-left: 0px;">
            <div class="section clearfix">
            	<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">¿A dónde van tus productos?</p>
            	<p style="text-align: center; font-size: 16px; color: #8bbdb8; margin-bottom: 30px;">Elige solo una dirección de envío o <?php echo $this->Html->link('gestiona tus direcciones de envío', array('controller' => 'direcciones', 'action' => 'ver_direccion'), array('escape' => false, 'style' => 'color:#8bbdb8; font-weight: 700'));?></p>
				 <!-- Direcciones con formato --> <?php 

				 if(empty($ds_direcciones)){
				 	echo '<p style="color: #109998">Hey! No tienes direcciones cargadas, agrega una ' . 
				 	$this->Html->link('ahora.', array('controller' => 'direcciones', 'action' => 'nueva_direccion'), array('data-target'=>'#exampleModal', 'data-toggle'=> 'modal', 'class' => '', 'style' => '')) . '</p>';
		
				 	
				 }
				 else{
					 foreach($ds_direcciones as $direccion): ?>  	 
					  	 <div class="four columns" style="color: #A5A5A5; border-top: 4px solid rgb(16, 153, 152);">
					        <div style="background: none repeat scroll 0 0 #e8f5f0; margin-bottom: 20px; padding-left: 20px; padding-bottom: 10px; padding-top: 10px;">
					            <p style="font-size:18px; font-weight: bold; color: #8bbdb8;">
					            	<?php echo $direccion['Direccion']['nombre_completo'];?>
					            </p>
					            <p> <?php echo $direccion['Direccion']['direccion'] . '.<br><strong>'. $direccion['Direccion']['ciudad'] .', '. $direccion['Provincia']['descripcion'] . '.</strong><br>' . $direccion['Direccion']['telefono'];?>
					            </p>
					        </div>
					        
					        <!-- <a class="accede-verde" href="/xampp/repos/tivia/direcciones/eliminar_direccion/76" style="width: 100%; margin-bottom: 10px;">Seleccionar</a>	-->
										        
							<div class="radio-direccion">
							<?php
								$opciones = array(
										$direccion['Direccion']['id'] => 'Seleccione'
										);
								$attributes = array('legend' => false, 'separator' => '', 'value' => true);
								echo $this->Form->radio('Direccion.id', $opciones, $attributes);?>
							</div>

					  	 	<p><?php echo $this->Html->link('Editar', array('controller' => 'direcciones', 'action' => 'editar_direccion', $direccion['Direccion']['id']), array('class' => 'accede', 'style' => 'width:49%; left: 0px; top:0px;')) . '  ';
					          echo  $this->Html->link('Eliminar', array('controller' => 'direcciones', 'action' => 'eliminar_direccion', $direccion['Direccion']['id']), array('class' => 'accede', 'style' => 'width:49%; left: 0px; top:0px;'))?>
					      	</p>
					  	</div>
					<?php endforeach;}?>
				 <!-- / Direcciones con formato -->
            </div>
          </div>
        </div>
    </div>            
</div>


<!-- Metodo de envio-->
 <div class="homepage_content clearfix">
    <div class="fullwidth-section">
      <div data-stellar-background-ratio="0.2" style="background: #e8f5f0; background-position: 50% 0px;" class="parallax">
       </div>

      <div class="container">
          <div class="sixteen featured_links" style="margin-left: 0px;">
            <div class="section clearfix">
            	<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Selecciona el courier</p>
				<p style="text-align: center; font-size: 16px; color: #8bbdb8; margin-bottom: 30px;">Elige una empresa de envíos por tienda</p>
            	<div class="ten columns">
            		<section class="panel-body">
						<table class="table-checkout table-bordered table-striped">
							<thead>
								<tr>
									<th>Logo</th>
									<th>Tienda</th>
									<th>Courier</th>
									<th>Costo de envío</th>
								</tr>
							</thead>
							<tbody>
								 <?php 
								 foreach ($ds_tiendas as $ds_tienda) :?>									 	
									<tr>
									<td><p style="text-align:center"><?php echo $this->Html->link($this->Html->image('logo/' . $ds_tienda['Tienda']['logo'], array('alt' => 'TiviaStore', 'style' => 'margin-left: 10px; margin-right: 10px; width: 90px;', 'class' => 'profile-pic')),  array('controller' => 'tiendas', 'action' => 'view_store', $ds_tienda['Tienda']['id']), array('escape' => false));?></p></td>
									<td><?php echo $ds_tienda['Tienda']['nombre'];?></td>
									<td>
										<span>
											<ul style="display:block"><?php 
												foreach ($ds_tienda['Costoenvio'] as $key => $couriers) :?>	
													<li><?php echo $couriers['courier'];?></li>
												<?php endforeach;?>
											</ul>
										</span>
									</td>
									<td>
										<span>
											<?php 
												// Para separar los bloques de radio buttons de cada tienda se tiene que tener un id unico por bloque, "<input name="data[Courier][NombreTienda]" id="CourierNombreTienda"
												// por esto se crea la variable $CourierTienda y se usa en el Formhelper de radio button de cakephp
												//Tienda.4.mari
												
											?>
											<ul class="radio-direccion"><?php 
												foreach ($ds_tienda['Costoenvio'] as $couriers):
													$CourierTienda = 'Courier.'.$couriers['Producto']['tienda_id'];
												    $value = $ds_tienda['Tienda']['courier_mult'] * $couriers['costo'] . '-'. $couriers['courier'];
												    $envio_courier =  $ds_tienda['Tienda']['courier_mult'] * $couriers['costo'];
																											
													$opciones = array($value => 'Bs '.number_format($envio_courier,2,",","."));
													$attributes = array('legend' => false, 'separator' => '', 'value' => true);	?>
													<li><?php echo $this->Form->radio($CourierTienda, $opciones, $attributes);?></li>
												<?php endforeach;?>
											</ul>
										</span>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</section>
            	</div>
            	<div class="six columns">
            		<div class="panel-checkout panel-danger-checkout">
						<div class="panel-heading-checkout">Tips para elegir tu courier</div>
						<div class="panel-body-checkout">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum ullam maiores, repellat nostrum qui impedit quibusdam, beatae hic dolor vel, aperiam voluptates veritatis laudantium illo exercitationem mollitia provident enim temporibus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quasi cupiditate perferendis nisi ad? Voluptas quasi mollitia aperiam tempora iure minima incidunt perferendis! Esse voluptatibus praesentium nesciunt animi vero, enim.
						</div>
					</div>
            	</div>
		   		<p><?php 
					echo $this->Form->hidden('formCheckout');
					echo $this->Form->button(__('Continuar'), array('class' => 'boton_verde', 'style' => 'width: 40%; margin-bottom: 10px;'));?>
				</p>                
        
            </div>
          </div>
        </div>
    </div>            
</div>

<?php echo $this->Form->end();?>