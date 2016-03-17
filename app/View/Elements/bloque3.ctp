<div style="background-image: url('http://4.bp.blogspot.com/_TSWmZHan7nU/S7ntrlROJEI/AAAAAAAACAw/xXMciaZiw3A/s1600/DSC_0002.JPG'); background-position: 50% 0px;" class="block-home-feature main-bg">
	<div class="inner-container">
		<div class="row">
			<div data-delay="200" data-animate="fadeInUp" class="col-lg-24 col-md-24 col-sm-24 col-xs-24 fadeInUp animated">
				<p style="margin-top: 10px; font-size: 35px;">ASÍ FUNCIONA</p>

				<div data-delay="400" data-animate="fadeInUp" class="block-feature-detail fadeInUp animated">
					<div class="feature-1 col-lg-6 col-md-6-alter col-sm-6 col-xs-24">
						<a title="" hrel="#" class="image">
							<?php echo $this->Html->image('icons1.png', array('alt' => 'Abre tu tienda')); ?>
						</a>
						<span>¡ABRE TU TIENDA!</span>

						<p>Exhibe tus productos hechos a mano en tu propia galería</p>
					</div>

					<div class="feature-2 col-lg-6 col-md-6-alter col-sm-6 col-xs-24">
						<a title="" hrel="#" class="image">
							<?php echo $this->Html->image('icons2.png', array('alt' => 'Vende')); ?>
						</a>
						<span>VENDE · EXPORTA · INTERCAMBIA</span>

						<p>Todo el producto creativo de tu imaginación desde bienes físicos hasta digitales</p>
					</div>

					<div class="feature-3 col-lg-6 col-md-6-alter col-sm-6 col-xs-24">
						<a title="" hrel="#" class="image">
							<?php echo $this->Html->image('icons3.png', array('alt' => 'plataforma robusta')); ?>
						</a>
						<span>PLATAFORMA ROBUSTA</span>

						<p>Pensada exclusivamente para dar lugar a un gran Marketplace de bienes hechos a mano</p>
					</div>

					<div class="feature-4 col-lg-6 col-md-6-alter col-sm-6 col-xs-24">
						<a title="" hrel="#" class="image">
							<?php echo $this->Html->image('icons4.png', array('alt' => 'transacciones seguras')); ?>
						</a>
						<span>TRANSACCIONES SEGURAS</span>

						<p>Ofrecemos distintas formas de pago para comodidad de tus clientes</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- bloque 4 -->


<div class="sheet--padding">
	<div class="inner-container">
		<div class="row">
			<div data-delay="600" data-animate="fadeInUp" class="newletter col-xs-24 col-sm-24 col-md-24 fadeInUp animated" style="text-align: center;">
				<h3 class="snd-title"><span>Suscríbete</span></h3>
				<div><p class="text-title" style="text-align: center;">¡En TiviaStore queremos mantener el contacto!</p>
					<div class="newletter-content">
						<div id="frm_subscribe">							
						<?php echo $this->Form->create('Usuario', array(
											'url' => array('controller' => 'Suscriptores', 'action' => 'insert'),
											'class' => null,
											'style' => 'display: inline;',
											'id' => 'subscribe',
											'inputDefaults' => array(
													'class' => 'form-inline',
													'div' => false,
													'label' => false
													)));?>
							<table>
							   <tbody>
								   	<tr>
									 	<td>
									 	 	<?php echo $this->Form->input('Suscriptor.email', array('id' => 'subscribe_email', 'size'=> '50', 'placeholder' => "Escribe tu correo aquí", 'class' => 'form-control'));?>
									 	 	<?php echo $this->Form->submit(__('Suscribirme'), array('class' => 'inner-btn', 'style' => 'margin-top: 10px;')); ?>	 
									 				     				
									 	</td>
									</tr>								   					  
								</tbody>
							</table>
					  
	 				<?php echo $this->Form->end();?>  
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
