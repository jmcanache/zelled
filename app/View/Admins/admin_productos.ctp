<div class="homepage_content clearfix">
    <div class="container">
      <div class="sixteen columns" style="margin: 0 auto;">
        <div class="section clearfix">
			<div class="container content" style="text-align:left;padding-top: 0px;">		  	  
		           <p style="margin-bottom: 10px; padding-top: 0px;"> <?php echo $this->Html->link('Agregar Producto', array('controller' => 'productos','action' => 'listing'), array('class' => 'link_verde', 'style' => 'margin: 0 auto;padding-left: 20px; padding-right: 20px;')); ?> </p>
		    	  
		    </div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th colspan="2">Producto</th>						
						<th>Precio Bs.</th>
						<th>Existencia</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
				<?php
			  	$total=0;
				$idCheck = 0;				
				foreach($data['Producto'] as $product):
				$idCheck++;
				
				?>
					<tr>
						<td style="width: 90px;border-right-width: 0px;">
						<figure> <?php echo	'<img style="width: 80px" src="data:image/jpeg;base64,'.base64_encode($product['Foto']['0']['foto_principal']).'"/>'?></figure>
						</td>
						<td><span>
						<?php echo $this->Html->link($product['nombre'], array('controller' => 'productos', 'action' => 'detail', $product['tienda_id'], $product['id'] ), array('escape' => false));?><br>
						</span>
						<p><?php echo $product['descripcion_corta'];?> </p>
						</td>
						<td style="text-align:center;vertical-align:middle;"><?php echo number_format($product['precio'],2,",",".") ?></td>
						<td style="text-align:center;vertical-align:middle;"><?php echo $product['existencia'] ?></td>
						<td> </td>
						<td style="text-align:center;vertical-align:middle;">
							<!--<a href="../../tivia/productos/edit_modal/42" data-toggle="modal" data-target="#myModal" class="fa fa-pencil-square-o fa-lg">Modal</a> -->
								<?php	echo $this->Html->link('<p class="fa fa-pencil-square-o fa-lg"></p> ', array('controller' => 'productos', 'action' => 'edit_modal', $product['id']),array('escape' => FALSE, 'id'=>'','class'=>'', 'data-toggle' =>'modal', 'data-target'=>'#myModal'));?>
								<?php 	echo $this->Html->link('<p class="fa fa-trash-o fa-lg"></p> ', array('controller' => '', 'action' => ''),array('escape' => FALSE, 'id'=>'','class'=>''));?>
								<?php	echo $this->Html->link('<p class="fa fa-search fa-lg"></p> ', array('controller' => 'productos', 'action' => 'detail',$data['Tienda']['id'],$product['id']),array('escape' => FALSE, 'id'=>'','class'=>''));?>
						</td>
						
					</tr>
					
						<?php endforeach;?>
					</tbody>
				</table>
	        </div>
	      </div>
	    </div>
	  </div>
	  
	  
	  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog">
    <div class="modal-content">
     <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel">Edita los datos del producto</p>      
      </div>-->
      <div class="modal-body" id="myModalBody" >
      
      </div>
      <!--<div class="modal-footer">
        <button data-dismiss="modal" style="background: none repeat scroll 0px 0px grey; padding: 5px 40px;" class="font-human grey" type="button">Cerrar</button>
        <button style="background: none repeat scroll 0px 0px rgb(105, 56, 141); padding: 5px 10px;" class="font-human" type="button">Guardar Cambios</button>
      </div>-->
    </div>
  </div>
</div>