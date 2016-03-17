<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.elements.email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	$Email = new CakeEmail();
	$Email->helpers(array('Html', 'Text'));	
	//$this->layout = 'Emails/html/neworder';
?>
<!-- inicio contenido de orden --> 
        <tr>         
          <td class="eBody alignLeft" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;width:512px;color:#54565c;background-color:#ffffff;">
			<h1 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:24px;font-weight:bold;line-height:36px;color:#465059;">Confirmación de Orden</h1>
            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;text-align:left;"><?php echo $datos['Datos'][0]['Usuario']['nombre'].' '.$datos['Datos'][0]['Usuario']['apellido'];?>, gracias por tu orden!</p>
		  </td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody alignLeft pdBt16" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;padding-bottom:16px;width:512px;color:#54565c;background-color:#ffffff;">          	
            <table cellspacing="0" cellpadding="0" border="0" class="defaultBtn" style="margin:0 !important;padding:0;border-collapse:collapse;border-spacing:0;width:100% !important;margin-left:0;margin-right:auto;">
              <tbody>
	              <tr>
	                <td class="highlight invoiceHead alignLeft pdBt5" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;padding-bottom:5px;width:512px;font-size:12px;color:#a1a2a5;background-color:#f9f8fb;">
	                		<h4 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:16px !important;font-weight:bold;color:#54565c;line-height:24px !important;">
	                				Orden # <?php echo $datos['Datos']['Order']['orden_compra'] ?>
	                				<span style="font-size:12px;font-weight:normal;color:#a1a2a5;">	                				
	                				<?php 
	                					$date = date_create($datos['Datos']['Order']['created']);	                					
	                					echo date_format($date, 'd/m/Y H:i:s');
	                				?></span>
							</h4>	                	
	                </td>
	              </tr>
             </tbody>
            </table> 
          </td>
          <!-- end .eBody--> 
        </tr>
        <!-- Datos de Envío -->
        <tr>
         <td class="highlight invoiceHead alignLeft pdTp0" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;padding-top:0;width:512px;text-align:left;background-color:#f9f8fb;font-size:12px;color:#a1a2a5;">
             <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;margin-left:0;margin-right:auto;">
             	<tbody>
             		<tr>
						<td class="width246" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;display:block !important;padding-right:0 !important;width:246px;text-align:left;vertical-align:top;font-size:12px;color:#a1a2a5;">
                  			<table cellspacing="0" cellpadding="0" border="0" class="tag" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;margin-left:0;margin-right:auto;">
                  				<tbody>
                  					<tr>
										<td valign="middle" align="left" class="tagName" style="margin:0;padding:4px 6px;border-collapse:separate !important;border-spacing:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:14px !important;text-align:left;color:#ffffff;background-color:#78b8c4;text-transform:uppercase;white-space:nowrap;">Direcci&oacute;n de Env&iacute;o</td>
 									</tr>
                   				</tbody>
                   			</table>
							<p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:12px;line-height:19px;text-align:left;color:#a1a2a5;"><?php echo $datos['Datos'][1]['Direccion']['nombre_completo']?><br>
        					 <?php echo $datos['Datos'][1]['Direccion']['direccion']?>
        					</p>
       					</td>                
                		<td class="width246 pdRg16" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;padding-right:16px;text-align:left;vertical-align:top;width:246px;font-size:12px;color:#a1a2a5;">
		                	<table cellspacing="0" cellpadding="0" border="0" class="tag" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;margin-left:0;margin-right:auto;">
		                		<tbody>
		                			<tr>
										<td valign="middle" align="left" class="tagName" style="margin:0;padding:4px 6px;border-collapse:separate !important;border-spacing:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:14px !important;text-align:left;color:#ffffff;background-color:#78b8c4;text-transform:uppercase;white-space:nowrap;">Direcci&oacute;n de Facturaci&oacute;n</td>
		 
				                    </tr>
				                 </tbody>
				             </table>
								<p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:12px;line-height:19px;text-align:left;color:#a1a2a5;"><?php echo $datos['Datos'][1]['Direccion']['nombre_completo']?><br>
		        					 <?php echo $datos['Datos'][1]['Direccion']['direccion']?>
		        				</p>
        				</td>
                 </tr>
               </tbody>
            </table>
		</td>
        </tr>
        <!-- Detalle del pedido -->
        <tr>
          <td class="blank" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;">
          	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="invoiceTable2 bottomLine" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;background-color:#ffffff;border-bottom:1px solid #ebebeb;">
              <tbody>
              <tr>
                <th class="alignLeft pdLf16" colspan="2" style="font-family:Arial,Helvetica,sans-serif;text-align:left;padding-left:16px;font-size:12px;line-height:16px;padding:14px 16px;font-weight:bold;padding-bottom:6px;padding-top:6px;text-transform:uppercase;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;">Item</th>
                <th class="alignRight" style="font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:12px;line-height:16px;padding:14px 16px;font-weight:bold;padding-bottom:6px;padding-top:6px;text-transform:uppercase;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;vertical-align:top;">Subtotal</th>
              </tr>
			<?php 
			$total=0;			
			foreach ($datos['Datos']['OrderDetail'] as $orderdetail):   	
				 $url = Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL') . $this->Html->url(array('controller' => 'productos', 'action' => 'detail', $orderdetail['tienda_id'], $orderdetail['Producto']['id'] )); ?> 	 			
				  <tr>					 
					  <td class="alignLeft prodImg" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;border-bottom:1px solid #ebebeb;padding-right:0;width:80px;">	<?php //echo '<img style="width: 80px" alt="TiviaStore" src="data:image/jpeg;base64,'.base64_encode($orderdetail['Producto']['Foto']['0']['thumb']).'"/>'; ?> </td>
					  <td class="alignLeft prodDesc" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;font-size:12px;line-height:18px;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;padding-right:0;vertical-align:top;width:280px;"><h4 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:16px !important;font-weight:bold;color:#54565c;line-height:24px !important;"><?php echo $orderdetail['Producto']['nombre']; ?></h4>Cantidad: <?php echo $orderdetail['cantidad']; ?><br>Precio: <?php echo number_format($orderdetail['precio_producto'],2,",","."); ?> <br> <b><?php echo $this->Html->link(__('Ver'), $url, array()); ?> </b> </td>
					  <td class="alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;border-bottom:1px solid #ebebeb;vertical-align:top;"><span class="desktopHide">Subtotal: </span><span class="amount" style="color: #78b8c4;">
					  		<?php $subtotal=$orderdetail['cantidad']*$orderdetail['precio_producto']; 
					  				echo number_format($subtotal,2,",",".") ?></span></td>
				 </tr>	
			<?php $total = $total + ($orderdetail['cantidad']*$orderdetail['precio_producto']);?>			
			<?php endforeach; ?>
              <tr>
                <td class="subTotal alignRight mobileHide" colspan="2" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:22px;color:#a1a2a5;background-color:#f9f8fb;border-bottom:1px solid #ebebeb;vertical-align:top;padding-top:16px;"> Subtotal<br>Envio</td>
                <td class="subTotal alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:22px;color:#a1a2a5;background-color:#f9f8fb;border-bottom:1px solid #ebebeb;vertical-align:top;padding-top:16px;"><span class="amount" style="color:#54565c;"><?php echo number_format($total,2,",",".");?>	 </span><br> <span class="amount" style="color:#54565c;"><?php echo number_format($datos['Datos']['Envio']['0']['costoenvio'],2,",","."); ?></span> </td>
              </tr>
              <tr>
                <td class="eTotal alignRight" colspan="2" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;border-bottom:1px solid #ebebeb;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;vertical-align:top;padding-top:16px;"><strong>Total</strong></td>
                <td class="eTotal alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;border-bottom:1px solid #ebebeb;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;vertical-align:top;padding-top:16px;"><span class="amount"><?php echo number_format($datos['Datos']['Order']['total_pagar'],2,",",".");?></span></td>
              </tr>
            </tbody></table></td>
          <!-- end order body --> 
        </tr>   
      
 <!-- fin contenido de orden -->