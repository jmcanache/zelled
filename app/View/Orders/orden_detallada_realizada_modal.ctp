 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabelS">Orden Detallada</p>      
 </div>
<section class="panel-body">    
		<div class="form-horizontal">	
			<div style ="display: inline-block">
				<h3> Datos de envio </h3>
				<p> <?php echo $ds_order['Direccion']['nombre_completo']; ?> </p>
				<p> Cel: <?php echo $ds_order['Direccion']['telefono']; ?> </p>
				<p> <?php echo $ds_order['Direccion']['direccion']; ?> </p>
				<p> <?php echo $ds_order['Direccion']['ciudad']; ?> </p>
				<p> <?php echo $ds_order['Provincia']['descripcion']; ?> </p>
				<p> <?php echo $ds_order[0]['OrderDetail']['courier']; ?> </p>

			</div>
				<?php if($metodo_cliente):?>	
					<div style = "display: inline-block; position:absolute; margin-left: 200px;">
						<h3> Datos de transaccion </h3>
						<p> Banco: <?php echo (isset($ds_order['Banco']['descripcion']) ? $ds_order['Banco']['descripcion'] : " "); ?> </p>
						<p> Numero de transaccion: <?php echo (isset($ds_order[0]['Order']['transferencia']) ? $ds_order[0]['Order']['transferencia'] : " ");?></p>
					</div>
				<?php endif ?>
			<div>
				<h2>Articulos pedidos</h2>
				<table>
					<th>Nombre del producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>subtotal</th>
					 <?php 
					foreach($ds_order as $key => $order ):?>	
							    <?php 							   
							    if (($key !== 'Direccion') && ($key !== 'Provincia')) {								
							    ?> 						
								    <tr>
									<td> <?php echo $order['Producto']['nombre'] ?> </td>
									<td> <?php echo $order['Producto']['precio'] ?> </td>
									<td> <?php echo $order['OrderDetail']['cantidad'] ?> </td>
									<td> <?php echo $order['Producto']['precio'] * $order['OrderDetail']['cantidad'] ?> </td>
									</tr> 							
					 <?php 
					 			}
					endforeach;
					 ?>				
				</table>
			</div>
		</div>
		<p>					
			<button data-dismiss="modal" style="background: none repeat scroll 0px 0px grey; padding: 5px 40px;color:white;float: right;" class="grey" type="button">Cerrar</button>		
		</p>
</section>