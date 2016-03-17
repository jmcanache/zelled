<div class="homepage_content clearfix" style="background-color: #e8f5f0;">
	<p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">¡Esta es tu cesta!</p>
	<p style="text-align: center; font-size: 16px; color: #8bbdb8; margin-bottom: 10px;">Elige los productos que desees comprar y procede a chequear</p>
	<div id="" class="container content" style="padding-top: 20px; background-color: #e8f5f0;"><?php 
		echo $this->Form->create('Cart',array('url'=>array('controller' => 'orders', 'action' => 'checkout')));?>
		<div class="">
			<div class="">
				<table class="table">
					<thead>
						<tr>				   
							<th colspan="2">Producto</th>
							<th>Precio Bs.</th>
							<th>Cantidad</th>
							<th>SubTotal Bs.</th>
							<th>Selecciona <?php echo $this->Form->checkbox('done', array('value' => '', 'id' => 'checkoutall' ,'name' => 'checkall', 'style' => 'margin-left: 10px'));?>
							</th>
							<th>
							<p id="removeall" class="fa fa-trash-o"></p>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php						
						$total=0;
						$idCheck = 0;
						foreach($products as $product):
						$idCheck++;
						?>
						<tr>
							<td style="width: 90px;border-right-width: 0px;">
							<figure><?php echo	'<img style="width: 80px" src="data:image/jpeg;base64,'.base64_encode($product['Foto']['0']['foto_principal']).'"/>'?></figure>
							</td>
							<td style="line-height: normal;">
							<?php echo $this->Html->link($product['Producto']['nombre'], array('controller' => 'productos', 'action' => 'detail', $product['Producto']['tienda_id'], $product['Producto']['id'] ), array('escape' => false));?><br>
							<p style="line-height: 1.4em;margin: 0;"><?php echo $product['Producto']['descripcion_corta'];?> </p>
							<?php  
								if($this->Session->read('atributos')){				
					                foreach( $this->Session->read('atributos') as $atr)
									{  
									  if($product['Producto']['id'] == $atr['producto_id']){              
					                  	echo '<p style="font-size: 12px;line-height: 1.4em;margin: 0;">' . $atr['atributo'] .':  '.$atr['valor'].'  </p>';                
					                  }
									}
					                  
					            }   
				            ?> 
							</td>
							<td class="precios"><?php 
							echo '<p id="precio'.$idCheck.'" style="display:none">' . $product['Producto']['precio'] . '</p>';
							echo '<p id="precioV'.$idCheck.'">' . number_format($product['Producto']['precio'],2,",",".") . '</p>';?></td>
							<td><div class="col-xs-4">
									<?php echo $this->Form->hidden('product_id',array('value'=>$product['Producto']['id']));
									      echo '<p id="productId'.$idCheck.'" style="display:none">' . $product['Producto']['id'] . '</p>';
									      echo $this->Form->input('count.',array('type'=>'number', 'min'=> '1', 'max'=> $product['Producto']['existencia'], 'label'=>false, 'value'=>$product['0'], 'id' => $idCheck ,'name' => 'quantity'));?>
								</div>
							</td>
							<td class="precios">
							<?php 
							echo '<p id="subtotalH'.$idCheck.'" class="subtotal" style="display:none">' . $product['0']*$product['Producto']['precio'] . '</p>';
							echo '<p id="subtotal'.$idCheck.'">' . number_format($product['0']*$product['Producto']['precio'],2, ',', '.') . '</p>'; ?>
							</td>
							<td class="check"><?php
								 echo $this->Form->checkbox('done', array('value' => $product['Producto']['id'].'/'.'cart'.'/'.'checkout', 'id' => 'check'. $idCheck.'' ,'name' => 'check', 'class' => 'checkout_check','hiddenField' => false));?>
							</td>
							<td style="text-align: center"><?php
							  echo $this->Html->link(' <p id="remove'.$idCheck.'" class="fa fa-trash-o"></p>', array('controller' => 'carritos', 'action' => 'remove', $product['Producto']['id'],'cart','checkout'),array('escape' => FALSE, 'id'=>'removeElement'));?>
							</td>
						</tr>
						<?php $total = $total + ($product['0']*$product['Producto']['precio']);?>
						<?php endforeach;?>

						<tr class="total">
							<td colspan="4"></td>
							<td class="grantotal"> <p id="Gtotal"> <?php echo  number_format($total,2,",","."); ?> </p></td>
							<td colspan="2"></td>							
						</tr>
					</tbody>
				</table>

				<p class="text-right">
					<?php echo $this->Form->submit('Comprar',array('class'=>'font-human','div'=>false, 'style'=>'background: none repeat scroll 0 0 #69388d;'));
					?>
				</p>

			</div>
		</div><?php 
			echo $this->Form->end();?>  

	</div>
</div>