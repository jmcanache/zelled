<div>
	<h2> ORDEN DETALLADA  </h2>
	<h3>El usuario <?php echo $ds_order['Usuario']['nombre'].', '.$ds_order['Usuario']['apellido'] ?> realizo el siguiente pedido: </h3>
	
	<div>
		<table>
			<th>Nombre del producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>subtotal</th>

			
			<?php 
				foreach ($ds_order[0]['OrderDetail'] as $orderDetail): 
					if($orderDetail['tienda_id'] == $tienda_id): ?>
						<tr>
							<td> <?php echo $orderDetail['Producto']['nombre'] ?> </td>
							<td> <?php echo $orderDetail['precio'] ?> </td>
							<td> <?php echo $orderDetail['cantidad'] ?> </td>
							<td> <?php echo $orderDetail['precio'] * $orderDetail['cantidad'] ?> </td>
						</tr> 
					<?php endif ?>
				<?php endforeach ?>
		</table>
	</div>


	<div style ="display: inline-block">
		<h3> Informacion para el envio: </h3>
		<p> A nombre de: <?php echo $ds_order['Direccion']['nombre_completo']; ?> </p>
		<p> Celular: <?php echo $ds_order['Direccion']['telefono']; ?> </p>
		<p> Direccion: <?php echo $ds_order['Direccion']['direccion']; ?> </p>
		<p> Ciudad: <?php echo $ds_order['Direccion']['ciudad']; ?> </p>
		<p> Estado: <?php echo $ds_order['Provincia']['descripcion']; ?> </p>
		<p> Courier: <?php echo $ds_order[0]['Order']['courier']; ?> </p>

	</div>
</div>