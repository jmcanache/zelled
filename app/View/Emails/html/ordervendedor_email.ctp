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
	foreach ($datos['Datos']['Envio'] as $envio) 
	{
		if($datos['Notificacion']['destinatario'] == $envio['Tienda']['Usuario']['login'])
		{
			$nombre_vendedor = $envio['Tienda']['Usuario']['nombre'].' '.$envio['Tienda']['Usuario']['apellido'];
			$tienda_id = $envio['tienda_id'];
      $costo_envio = $envio['costoenvio'];
			break;
		}
	}
?>
<!-- inicio contenido de orden --> 
        <tr>
          <td class="highlight pdTp32" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;padding-top:32px;width:512px;text-align:center;background-color:#f9f8fb;">
          	<h1 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:24px;font-weight:bold;line-height:36px;color:#465059;">
              <span style="color: #465059;">Hey �Tienes un nuevo pedido!</span>
            </h1>
            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;color:#a1a2a5;">Orden # <?php echo $datos['Datos']['Order']['orden_compra'] ?></p>
          </td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody alignLeft pdBt16" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;padding-bottom:16px;width:512px;color:#54565c;background-color:#ffffff;">
          	<p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;text-align:left;"><strong>Pre-alerta:</strong> <?php echo $nombre_vendedor?>, te enviaremos la confirmaci�n de pago junto con los datos del comprador en las pr�ximas 48 horas y puedas env�ar los siguientes productos:</p>
            <table cellspacing="0" cellpadding="0" border="0" class="defaultBtn" style="margin:0 !important;padding:0;border-collapse:collapse;border-spacing:0;width:100% !important;margin-left:0;margin-right:auto;">
              <tbody>
	              <tr>
	                <td class="btnMain" style="margin:0;padding:12px 22px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;background-color:#45c29d;font-size:18px;height:20px;line-height:20px;text-align:center;vertical-align:middle;">
	                	<a href="#" style="display:block !important;padding:10px 18px !important;text-decoration:none;font-family:Arial,Helvetica,sans-serif;color:#ffffff;line-height:26px !important;font-size:20px;">
	                		<span style="text-decoration:none;color:#ffffff;">Detalles de la venta:</span>
	                	</a>
	                </td>
	              </tr>
             </tbody>
            </table>
          </td>
          <!-- end .eBody--> 
        </tr>
        <tr>
          <td class="blank" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;">
          	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="invoiceTable2 bottomLine" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;background-color:#ffffff;border-bottom:1px solid #ebebeb;">
              <tbody>
              <tr>
                <th class="alignLeft pdLf16" colspan="2" style="font-family:Arial,Helvetica,sans-serif;text-align:left;padding-left:16px;font-size:12px;line-height:16px;padding:14px 16px;font-weight:bold;padding-bottom:6px;padding-top:6px;text-transform:uppercase;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;">Item</th>
                <th class="alignRight" style="font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:12px;line-height:16px;padding:14px 16px;font-weight:bold;padding-bottom:6px;padding-top:6px;text-transform:uppercase;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;vertical-align:top;">Subtotal</th>
              </tr><?php 

        			$total=0;			
        			foreach ($datos['Datos']['OrderDetail'] as $orderdetail): 
        			  if($tienda_id == $orderdetail['tienda_id']):
        			  	$url = Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL') . $this->Html->url(array('controller' => 'productos', 'action' => 'detail', $orderdetail['tienda_id'], $orderdetail['Producto']['id'] )); ?>
        				  <tr>					 

        					  <td class="alignLeft prodImg" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;border-bottom:1px solid #ebebeb;padding-right:0;width:80px;"><?php 
                      $image = 'http://tiviastore.com/versiondos/img/todosproductos/' . $orderdetail['Foto']['Foto']['ruta_thumb'];?>
                      <img alt="TiviaStore" src=<?php echo '"'.$image.'"';?> style="width: 160px;"> 
                    </td>

        					  <td class="alignLeft prodDesc" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;font-size:12px;line-height:18px;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;padding-right:0;vertical-align:top;"><h4 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:16px !important;font-weight:bold;color:#54565c;line-height:24px !important;"><?php echo $orderdetail['Producto']['nombre']; ?></h4>Cantidad: <?php echo $orderdetail['cantidad']; ?><br>Precio: Bs. <?php echo number_format($orderdetail['precio_producto'],2,",","."); ?> <br> <b><?php echo $this->Html->link(__('Ver'), $url, array()); ?> </b> </td>
        					  <td class="alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;border-bottom:1px solid #ebebeb;vertical-align:top;"><span class="desktopHide">Subtotal: </span><span class="amount" style="color: #78b8c4;"><br>Bs. 
        					  		<?php $subtotal=$orderdetail['cantidad']*$orderdetail['precio_producto']; 
        					  				echo number_format($subtotal,2,",",".") ?></span></td>
        				 </tr><?php 
                 $total = $total + ($orderdetail['cantidad']*$orderdetail['precio_producto']);		
			          endif; 
			        endforeach; ?>
              <tr>
                <td class="subTotal alignRight mobileHide" colspan="2" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:22px;color:#a1a2a5;background-color:#f9f8fb;border-bottom:1px solid #ebebeb;vertical-align:top;padding-top:16px;"> Subtotal<br>Envio</td>
                <td class="subTotal alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:22px;color:#a1a2a5;background-color:#f9f8fb;border-bottom:1px solid #ebebeb;vertical-align:top;padding-top:16px;"><span class="amount" style="color:#54565c;">Bs. <?php echo number_format($total,2,",",".");?>	 </span><br> <span class="amount" style="color:#54565c;">Bs. <?php echo number_format($costo_envio,2,",","."); ?></span> </td>
              </tr>
              <tr>
                <td class="eTotal alignRight" colspan="2" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;border-bottom:1px solid #ebebeb;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;vertical-align:top;padding-top:16px;"><strong>Total</strong></td>
                <td class="eTotal alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;border-bottom:1px solid #ebebeb;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;vertical-align:top;padding-top:16px;">
                		<span class="amount">
                		<?php 
                			$totalgeneral=0;
                			$totalgeneral=$costo_envio + $total;
                			echo 'Bs. '.number_format($totalgeneral,2,",",".");
                		?>
                		</span>
                </td>
              </tr>
              </tbody>
            </table>
          </td>
          <!-- end order body --> 
        </tr>       		
			<!-- end .eBody--> 
 <!-- fin contenido de orden -->