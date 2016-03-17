<div>
	<h2> ORDEN DETALLADA </h2>
	<div style ="display: inline-block">
		<h3> Direccion de envio </h3>
		<p> <?php echo $ds_order['Direccion']['nombre_completo']; ?> </p>
		<p> Cel: <?php echo $ds_order['Direccion']['telefono']; ?> </p>
		<p> <?php echo $ds_order['Direccion']['direccion']; ?> </p>
		<p> <?php echo $ds_order['Direccion']['ciudad']; ?> </p>
		<p> <?php echo $ds_order['Provincia']['descripcion']; ?> </p>
	</div>
	<div style = "display: inline-block; position:absolute; margin-left: 200px;">
		<h3> Datos de transaccion </h3>
		<p> Banco: <?php echo $ds_order['Banco']['descripcion']; ?> </p>
		<p> Numero de transaccion: <?php echo $ds_order['Order']['transferencia'];?></p>
	</div>
	<div>
		<h2>Articulos pedidos</h2>
		<table>
			<th>Nombre del producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Tienda</th>
			<th>Courier</th>
			<th>subtotal</th>

			
			<?php foreach ($ds_order['OrderDetail'] as $orderDetail): ?>
				<tr>
					<td> <?php echo $orderDetail['Producto']['nombre'] ?> </td>
					<td> <?php echo $orderDetail['precio_producto'] ?> </td>
					<td> <?php echo $orderDetail['cantidad'] ?> </td>
					<td> <?php echo $orderDetail['Producto']['Tienda']['nombre'] ?> </td>
					<td> <?php echo $orderDetail['Courier'] ?> </td>
					<td> <?php echo $orderDetail['precio_producto'] * $orderDetail['cantidad'] ?> </td>
				</tr> 
			<?php endforeach ?>
		</table>
	</div>
</div>