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
		  <td class="highlight pdTp32" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;padding-top:32px;width:512px;text-align:center;background-color:#f9f8fb;">
          	<h1 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:24px;font-weight:bold;line-height:36px;color:#465059;">
          		<span style="color: #465059;">Confirmación de envío</span>
          	</h1>
            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;color:#a1a2a5;">Orden # <?php echo $datos['Datos']['Order']['orden_compra'] ?></p>
          </td>
          <!-- end .highlight--> 
        </tr>  
 		<tr> 
            <td class="eBody alignLeft pdBt16" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;padding-bottom:16px;width:512px;color:#54565c;background-color:#ffffff;">
          	<p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;text-align:left;">¡Hola! <?php echo $datos['Datos'][2]['Usuario']['nombre'].' '.$datos['Datos'][2]['Usuario']['apellido'];?>, el o los siguientes productos han sido enviados:</p>
          </td>
        </tr>  
       <!-- Detalle del pedido -->
        <tr>
          <td class="blank" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;">
          	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="invoiceTable2 bottomLine" style="margin:0;padding:0;border-collapse:collapse;border-spacing:0;background-color:#ffffff;border-bottom:1px solid #ebebeb;">
              <tbody>
              <tr>
                <th class="alignLeft pdLf16" colspan="2" style="font-family:Arial,Helvetica,sans-serif;text-align:left;padding-left:16px;font-size:12px;line-height:16px;padding:14px 16px;font-weight:bold;padding-bottom:6px;padding-top:6px;text-transform:uppercase;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;">Item</th>
                <th class="alignRight" style="font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:12px;line-height:16px;padding:14px 16px;font-weight:bold;padding-bottom:6px;padding-top:6px;text-transform:uppercase;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;vertical-align:top;">Descripcion</th>
              </tr>
			<?php 
			$total=0;			
			foreach ($datos['Datos'][0] as $orderdetail):   	
				 $url = Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL') . $this->Html->url(array('controller' => 'productos', 'action' => 'detail', $orderdetail['OrderDetail']['tienda_id'], $orderdetail['Producto']['id'] )); ?> 	 			
				  <tr>					 
					  <td class="alignLeft prodImg" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;border-bottom:1px solid #ebebeb;padding-right:0;width:80px;"><?php 
                     	 $image = 'http://tiviastore.com/versiondos/img/todosproductos/' . $orderdetail['Foto']['Foto']['ruta_thumb'];?>
                      	<img alt="TiviaStore" src=<?php echo '"'.$image.'"';?> style="width: 160px;"> 
					  </td>
					  <td class="alignLeft prodDesc" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:left;font-size:12px;line-height:18px;color:#a1a2a5;background-color:#ffffff;border-bottom:1px solid #ebebeb;padding-right:0;vertical-align:top;"><h4 style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:5px;font-size:16px !important;font-weight:bold;color:#54565c;line-height:24px !important;"><?php echo $orderdetail['Producto']['nombre']; ?></h4>Cantidad: <?php echo $orderdetail['OrderDetail']['cantidad']; ?><br>Precio: Bs. <?php echo number_format($orderdetail['OrderDetail']['precio_producto'],2,",","."); ?> <br> <b><?php echo $this->Html->link(__('Ver'), $url, array()); ?> </b> </td>

					  <td class="alignRight" style="margin:0;padding:14px 16px;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;text-align:right;font-size:14px;line-height:19px;color:#54565c;background-color:#ffffff;border-bottom:1px solid #ebebeb;vertical-align:top;"><span class="amount" style="color: #78b8c4;"><?php echo $orderdetail['Producto']['descripcion_corta'];?></span></td>
				 </tr>	
			<?php $total = $total + ($orderdetail['OrderDetail']['precio_producto']);?>			
			<?php endforeach; ?>

            </tbody></table></td>
          <!-- end order body --> 
        </tr>        
        <tr>
	        <td class="eBody" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;display:block !important;width:512px;overflow:hidden !important;padding-top:16px !important;color:#54565c;background-color:#ffffff;">
	            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:18px;font-size:14px;line-height:22px;text-align:left;"><b>Dirección de envío:</b></p>
				<p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:18px;font-size:14px;line-height:22px;text-align:left;"><?php echo $datos['Datos'][1]['Direccion']['nombre_completo']?><br>
	        	 <?php echo $datos['Datos'][1]['Direccion']['direccion'] .'<br>' . $datos['Datos'][1]['Direccion']['ciudad'] . ' - ' . $datos['Datos'][1]['Provincia']['descripcion'] .'.'?>        	
	        	</p>
	 
				<p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:18px;font-size:14px;line-height:22px;text-align:left;"></p>
	
	
	            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:18px;font-size:18px;line-height:22px;text-align:center;">¡Gracias por tu compra en TiviaStore!</p>
			</td>       
        </tr> 
      
 <!-- fin contenido de orden -->