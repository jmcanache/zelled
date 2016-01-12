<!-- Compra -->
<div class="homepage_content clearfix" style="background-color: #e8f5f0;">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix">
	        <p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Tu compra</p>
	        <p style="text-align: center; font-size: 16px; color: #8bbdb8;margin-bottom: 30px;">Revisa tu orden y verifica el monto</p>
	        <div class="eight columns">
		        <div class="order-summary" style="top: 437px;">

					  <div class="order-summary__section order-summary__section--header">
					    <p  style="text-transform:uppercase;color: #a5a5a5; font-weight: bold;">Resumen de su pedido</p>
					  </div>

					  <div class="summary-body" style="color:#a5a5a5">
					    <div data-order-summary-section="payment-lines" class="order-summary__section">
					      <div class="total-line total-line--subtotal">
					        <span class="total-line__name">
					          Subtotal
					        </span>
					        <strong data-checkout-subtotal-price-target="" class="total-line__price">Bs. <?php echo number_format($subtotal,2,",",".");?></strong>
					      </div>
					      <div class="total-line total-line--shipping">
					        <span class="total-line__name">
					          Envío
					        </span>
					        <strong data-checkout-total-shipping-target="" class="total-line__price">Bs. <?php echo number_format($totalenvio,2,",",".");?></strong>
					      </div>
					      <div class="total-line total-line--shipping">
					        <span class="total-line__name">
					          Impuestos
					        </span>
					        <strong data-checkout-total-shipping-target="" class="total-line__price">&mdash;</strong>
					      </div>
					    </div>

					    <div data-order-summary-section="payment-due" class="order-summary__section">
					      <div class="payment-due-container">
					        <span class="payment-due__label">
					            Total a pagar
					        </span>
					        <div class="payment-due">
					          <div data-checkout-payment-due-target="" class="payment-due__price"><?php echo number_format($total,2,",",".");?></div>
					          <div class="payment-due__currency">Bs. </div>
					        </div>
					      </div>

					    </div>
					  </div>
				</div>
        	</div>
        	<div class="seven columns">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
						<div class="info-box widget bg-success">
							<span class="icon-payment fa fa-credit-card fa-5x"></span>
							<div class="widget-body">
								<p count-from="100" count-to="679" duration="8" class="counter text-info ng-scope ng-binding">Transferencias bancarias a nombre de tiviastore</p>
								<span class="info-text">Banesco</span>
								<span class="subinfo-text">Cta cte 0116-0106-58-0203199618</span>
								<span class="info-text">Provincial</span>
								<span class="subinfo-text">Cta cte 0116-0106-58-0203199618</span>
								<span class="info-text">Bancaribe</span>
								<span class="subinfo-text">Cta cte 0116-0106-58-0203199618</span>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
      </div>
    </div>
</div>
<!-- /Compra -->

<!-- metodo de pago -->
<div class="homepage_content clearfix" style="text-align:center;margin-bottom: 0px;">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix ">
          <div style="margin: 0 auto; width:10%;"></div>
          <p class="font-KG-Manhattan titulo mint" style="margin-bottom: 0px;">Selecciona el método de pago</p>
          <p style="text-align: center; font-size: 16px; color: #8bbdb8; margin-bottom: 30px;">Ofrecemos pasarela de pago segura con tu tarjeta de crédito y datos cifrados a traves de Instapago y Banesco.<br> Si lo prefieres tambien puedes realizar una transferencia bancaria.</p>

		    <div>
		     	<input type="checkbox" id="adminOrders" role="button" class="checkbutton" style="position: absolute;">
		     	<label for="adminOrders" onclick="" style="padding-right:20px;">
		      		<div class="panel-body mint" style="border: 1px solid #d1dee6; padding-top: 15px;width: 300px;color: #a5a5a5;"><?php
			   			echo $this->Html->link('<h2 class="font-human" style="font-weight: normal;color: #a5a5a5;">Tarjeta de crédito</h2>', array('controller' => 'orders', 'action' => 'modal_form_instapago', $total, $items),array('escape' => FALSE, 'data-toggle' =>'modal', 'data-target'=>'#ModalInstapago', 'style' => 'text-decoration: none;'));
			   			echo $this->Html->image('instapago-banesco.png', array('alt' => 'TiviaStore', 'style' => 'width: 200px;'));?>				
					</div>
				</label>

				<input type="checkbox" id="adminOrders" role="button" class="checkbutton" style="position: absolute;">
		     	<label for="adminOrders" onclick="" style="padding-right:20px;">
		      		<div class="panel-body mint" style="border: 1px solid #d1dee6; padding-top: 15px;width: 300px;color: #a5a5a5;"><?php
			   			echo $this->Html->link('<h2 class="font-human" style="font-weight: normal;color: #a5a5a5;">Transferencia Bancaria</h2>', 
			   				array(
			   				'controller' => 'orders',
			   				'action' => 'modal_form_transferencia',
			   				 $total,
			   				 $items),
				   			array(
				   				'escape' => FALSE, 
				   				'data-toggle' =>'modal', 
				   				'data-target'=>'#ModalTransferencia', 
				   				'style' => 'text-decoration: none;')
			   			);

			   			echo $this->Html->image('transferencia.png', array('alt' => 'TiviaStore', 'style' => 'width: 200px;'));?>				
					</div>
				</label>
		    </div>
        </div>
      </div>
    </div>
</div>
<!-- /metodo de pago -->


<!-- Modal Instapago -->
<div class="modal fade" id="ModalInstapago" tabindex="-1" role="dialog" aria-labelledby="MyModLabel" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog" style="width: 360px">
    <div class="modal-content">
      <div class="modal-body" id="myModBody">
      		
      </div>
    </div>
  </div>
</div>
<!-- /Modal Instapago -->

<!-- Modal Transferencia -->
<div class="modal fade" id="ModalTransferencia" tabindex="-1" role="dialog" aria-labelledby="MyModLabel" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog" style="width: 360px">
    <div class="modal-content">
      <div class="modal-body" id="myModBody">
      		
      </div>
    </div>
  </div>
</div>
<!-- /Modal Transferencia -->