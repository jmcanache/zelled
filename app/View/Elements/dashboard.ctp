<section class="panel-body">
	<div class="row">		
		<div class="col-lg-6 col-md-3 col-sm-6" style="color: #363636"><?php
			echo $this->Form->create('Order', $parametros);?>
			<div class="col-lg-7 col-md-3 col-sm-6"><?php
				echo $this->Form->input('status_orden', array('options' => $options, 'class' => 'form-control ng-pristine ng-valid ng-touched col-lg-3 col-md-3 col-sm-6'));?></div>
			<div class="col-lg-5 col-md-3 col-sm-6"><?php
				echo $this->Form->button(__('Buscar'), array('class' => 'boton_verde col-lg-3 col-md-3 col-sm-6', 'style' => 'width: 100%; margin-top: 29px; padding-top: 3px; padding-bottom: 3px;'));
				echo $this->Form->end();?>
			</div>
		</div>

		<div class="col-lg-6 col-md-2 col-sm-6" style="color: #363636"> 
			<blockquote class="blockquote-reverse">
				<p><?php echo $main_tittle?></p>
				<small><?php echo $subtitulo?></small>
			</blockquote>
		</div>
	</div>
</section>

<div class="col-xlg-6 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color: #363636">
	<article class="panel panel-default">
		<header class="panel-heading">
			<?php echo $titulo;?>
			<div class="panel-options">
				<a data-toggle="refresh" href=""><i class="fa fa-refresh"></i></a>
			</div>
		</header>
		<section class="panel-body">
			<table class="table ng-table-responsive ng-scope ng-table" ng-table="tableParams" id="icon-gray">
				<thead ng-include="templates.header" class="ng-scope"><?php
					if($this->params['action'] == 'myordersclient')
					{
						echo $this->Html->tableHeaders(
						    array('Nro de orden', 'Tienda', 'Cant de productos', 'Recibe', 'Estatus', 'Fecha', 'Ver'),
						    array('class' => 'ng-scope'),
						    array('class' => '')
						);	
					}
					else
					{
						echo $this->Html->tableHeaders(
						    array('Nro de orden', 'Usuario', 'Cant de productos', 'Recibe', 'Estatus', 'Fecha', 'Ver'),
						    array('class' => 'ng-scope'),
						    array('class' => '')
						);	
					}?>
				</thead>
				<tbody><?php
					foreach ($ds_orders as $order)
					{
						$fecha = $this->Time->format($order['Order']['created'], '%m/%d/%Y', 'invalid');
						$ver = null;
						$ver_icon = '<i id="detalleOrden'.$order['Order']['id'].'" class="fa fa-plus-square-o "></i>';
						$status_description = Configure::read($leyenda.'.'.$order['Envio']['status_pago']);

						$status = '<span class="label '.$status_description['class'].'">'.$status_description['status'].'</span>';

						if($order['Envio']['status_pago'] == 2 and $this->params['action'] == 'myordersstore')
						{
							$status = $status.' '.$this->Html->link('¡Notifica envío!', array('controller' => 'envios', 'action' => 'notifica_envio', $order['Envio']['id'], $order['Order']['id']), array('style' =>'border-left:none; color:#5c8cca'));
						}

						if($order['Envio']['status_pago'] == 3 and $this->params['action'] == 'myordersclient')
						{
							$status = $status.' '.$this->Html->link('¡Notifica recibido!', array('controller' => 'envios', 'action' => 'notifica_recibido', $order['Envio']['id'], $order['Envio']['tienda_id']), array('style' =>'border-left:none; color:#5c8cca'));
						}

						if($this->params['action'] == 'myordersclient')
						{
							$ver = $this->Html->link($ver_icon, array('controller' => 'orders', 'action' => 'orden_detallada_realizada_modal', $order['Order']['id'], $order['Envio']['tienda_id'], 1), array('escape' => false, 'id'=>'detalleOrden', 'data-toggle' =>'modal', 'data-target'=>'#ModalDashboard'.$order['Envio']['id'], 'data-id'=>$order['Envio']['id'], 'style' => 'text-decoration: none;')); 						
							echo $this->Html->tableCells(array(
							    array($order['Order']['orden_compra'],$order['Tienda']['nombre'], $order['Envio']['cantidad_productos'], $order['Order']['destinatario'], $status, $fecha, $ver)),
								array('class' => 'ng-scope'));	
						}
						else
						{
							$ver = $this->Html->link($ver_icon, array('controller' => 'orders', 'action' => 'orden_detallada_realizada_modal', $order['Order']['id'], $order['Envio']['tienda_id'], 0), array('escape' => false, 'id'=>'detalleOrden', 'data-toggle' =>'modal', 'data-target'=>'#ModalDashboard'.$order['Envio']['id'], 'data-id'=>$order['Envio']['id'], 'style' => 'text-decoration: none;')); 						
							echo $this->Html->tableCells(array(
							    array($order['Order']['orden_compra'],$order['Order']['nombre_cliente'], $order['Envio']['cantidad_productos'], $order['Order']['destinatario'], $status, $fecha, $ver)),
								array('class' => 'ng-scope'));	
						}				
				//Modal
					echo '<div class="modal fade" id="ModalDashboard'.$order['Envio']['id'].'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="background-color: transparent;">';
					echo '<div class="modal-dialog" role="document">';
					echo '<div class="modal-content">';
					echo '<div class="modal-body" id="ModalBody" >';
					
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					
					}?>	
				</tbody>
			</table>
			<div ng-table-pagination="params" template-url="templates.pagination" class="ng-scope ng-isolate-scope">
				<div ng-include="templateUrl" class="ng-scope">
					<div class="ng-table-pager ng-scope">
						<nav <?php echo $hide_paginatorcount;?>>
							<ul class="pagination  pull-right ng-table-pagination">
								<?php echo $this->Paginator->numbers(array('tag' => 'li', 'class ' => 'ng-scope', 'separator' => false));?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
	</article>
</div>