<div class="homepage_content clearfix">
    <div class="container">
      	<div class="sixteen columns" style="margin: 0 auto;">
        	<div class="section clearfix">
          		<div id="productosTienda">
					<div class="container content" style="text-align:left;padding-top: 0px;">		  	  
		           		<p style="margin-bottom: 10px; padding-top: 0px;"> <?php echo $this->Html->link('Agrega otro producto', array('controller' => 'productos','action' => 'listing'), array('class' => 'follow bck-morado', 'style' => 'margin: 0 auto;padding-left: 20px; padding-right: 20px;')); ?> </p>
		    		</div>		  
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th colspan="2">Producto</th>						
								<th>Precio Bs.</th>
								<th>Existencia</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody><?php							
						  	$total=0;
							$idCheck = 0;	
							foreach($admin_productos as $product):							
							$idCheck++;?>
							<tr>
								<td style="width: 90px;border-right-width: 0px;">
									<figure> <?php echo $this->Html->image('todosproductos/' . $product['ruta_thumb'], array('alt' => 'producto', 'style' => 'width: 80px'));?></figure>
								</td>
								<td>
									<span><?php echo $this->Html->link($product['Producto']['nombre'], array('controller' => 'productos', 'action' => 'detail', $product['Producto']['tienda_id'], $product['Producto']['id'] ), array('escape' => false));?><br>
									</span>
									<p><?php echo $product['Producto']['descripcion_corta'];?> </p>
								</td>
								<td style="text-align:center;vertical-align:middle;"><?php 
									echo number_format($product['Producto']['precio'],2,",",".") ?>
								</td>
								<td style="text-align:center;vertical-align:middle;"><?php 
									echo $product['Producto']['existencia'] ?>
								</td>								
								<td style="text-align:center;vertical-align:middle;">
									<!--<a href="../../tivia/productos/edit_modal/42" data-toggle="modal" data-target="#myModal" class="fa fa-pencil-square-o fa-lg">Modal</a> -->
										<?php	echo $this->Html->link('<p class="fa fa-pencil-square-o fa-lg"></p> ', array('controller' => 'productos', 'action' => 'edit_modal', $product['Producto']['id']),array('escape' => FALSE, 'id'=>'','class'=>'', 'data-toggle' =>'modal', 'data-target'=>'#myModal'.$product['Producto']['id']));?>
										<?php 	echo $this->Html->link('<p class="fa fa-trash-o fa-lg"></p> ', array('controller' => 'productos', 'action' => 'delete', $product['Producto']['id']),array('escape' => FALSE, 'id'=>'deleteProduct','class'=>''));?>
										<?php	echo $this->Html->link('<p class="fa fa-search fa-lg"></p> ', array('controller' => 'productos', 'action' => 'detail',$product['Producto']['tienda_id'],$product['Producto']['id']),array('escape' => FALSE, 'id'=>'','class'=>''));?>
								</td>					
							</tr>	
							<!-- Modal -->
							<?php 
							echo '<div class="modal fade" id="myModal'.$product['Producto']['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: transparent;">';
							echo '<div class="modal-dialog" style="width: 940px;">';
							echo '<div class="modal-content">'; 
							echo '<div class="modal-body" id="myModalBody" >';
							      						
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';	
							?>
							<?php endforeach;?>
						</tbody>
					</table>
						<nav>
							<ul class="pagination  pull-right ng-table-pagination">
								<?php echo $this->Paginator->numbers(array('tag' => 'li', 'class ' => 'ng-scope', 'separator' => false));?>
							</ul>
						</nav>
			 	</div>
	        </div>
	    </div>
	</div>
</div>