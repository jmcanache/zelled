<div class="homepage_content clearfix">
    <div class="container">
      	<div class="sixteen columns" style="margin: 0 auto;">
        	<div class="section clearfix">
          		<div id="InfoBancaria">
					<div class="container content" style="text-align:left;padding-top: 0px;">		  	  
		           		<p style="margin-bottom: 10px; padding-top: 0px;"> <?php //echo $this->Html->link('Agregar Producto', array('controller' => 'productos','action' => 'listing'), array('class' => 'link_verde', 'style' => 'margin: 0 auto;padding-left: 20px; padding-right: 20px;')); ?> </p>
		    		</div>		  
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Titular</th>						
								<th>Cuenta</th>
								<th>Email</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>								
								<td>
									<span><b>Beneficiario:</b> <?php echo $datosbancarios['titular_cuenta'];?></span>
								    <p><b>Identificacion:</b> <?php echo $datosbancarios['cedula']; ?></p>
								</td>
								<td>
									<span><b>Tipo:</b> <?php 									
									$cuentas = Configure::read('TIVIA_CONFIG.TIPO_CUENTA');
									if (array_key_exists($datosbancarios['tipo_cuenta'], $cuentas)) {
										echo $cuentas[$datosbancarios['tipo_cuenta']];
									}										
									?>									
									</span>
									<p><b>Numero:</b> <?php echo $datosbancarios['nro_cuenta'];?> </p>
								</td>								
								<td style="text-align:center;vertical-align:middle;"><?php 
									echo $datosbancarios['correo'] ?>
								</td>								
								<td style="text-align:center;vertical-align:middle;">
									<!--<a href="../../tivia/productos/edit_modal/42" data-toggle="modal" data-target="#myModal" class="fa fa-pencil-square-o fa-lg">Modal</a> -->
										<?php	echo $this->Html->link('<p class="fa fa-pencil-square-o fa-lg"></p> ', array('controller' => 'usuarios', 'action' => 'datos_bancarios_modal'),array('escape' => FALSE, 'id'=>'editdatosBancoslink','class'=>'', 'data-toggle' =>'modal', 'data-target'=>'#ModalUsuarioBanco'));?>
										<?php 	echo $this->Html->link('<p class="fa fa-trash-o fa-lg"></p> ', array('controller' => 'usuarios', 'action' => 'delete_datosbancarios'),array('escape' => FALSE, 'id'=>'deleteDatosBancoslink','class'=>''));?>
										<?php	//echo $this->Html->link('<p class="fa fa-search fa-lg"></p> ', array('controller' => 'productos', 'action' => 'detail',1,1),array('escape' => FALSE, 'id'=>'','class'=>''));?>
								</td>					
							</tr>	
							<!-- Modal -->
							<?php 
							echo '<div class="modal fade" id="ModalUsuarioBanco" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: transparent;">';
							echo '<div class="modal-dialog">';
							echo '<div class="modal-content">'; 
							echo '<div class="modal-body" id="myModalBody" >';
							      						
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';	
							?>						
						</tbody>
					</table>
						<nav>
							<ul class="pagination  pull-right ng-table-pagination">
								<?php //echo $this->Paginator->numbers(array('tag' => 'li', 'class ' => 'ng-scope', 'separator' => false));?>
							</ul>
						</nav>
			 	</div>
	        </div>
	    </div>
	</div>
</div>