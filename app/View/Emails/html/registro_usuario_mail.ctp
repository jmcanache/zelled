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
            <p style="font-size: 23px; font-weight: bold; color:#45c29d">¡Hola <?php echo $datos['Datos']['Usuario']['nombre'];?>!</p>
            <p style="font-size: 14px; color:#54565c">¡Gracias por registrate en Tivia! Solo completa un paso más antes de comenzar a vender, comprar y disfrutar del "hecho a mano".</p>
          </td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody alignLeft pdBt16" style="margin:0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;padding-bottom:16px;width:512px;color:#54565c;background-color:#ffffff;">
            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;"><?php
				$url = Configure::read('TIVIA_CONFIG.NOTIFICACIONES.PLATAFORMA.WEB.FULL_URL') . $this->Html->url(
				array('controller' => 'usuarios', 'action' => 'confirmarEmail', $datos['Datos']['Usuario']['clave_validacion_email']),
				false);

				echo $this->Html->link(__('Verificar mi cuenta', true), $url, array('style' => ' color: white;  display: inline-block;    font-size: 18px;    font-weight: normal;    margin-left: 10px;    margin-top: 40px;    padding: 12px 20px;    text-decoration: none;    text-transform: uppercase;	background-color: #45c29d;'));?>
            </p>
            <p style="color:#54565c">¡Gracias por utilizar Tivia!<br> Equipo de Tivia Store</p>
          </td>       
      <!-- end .eBody--> 
        </tr>     
      <!-- end .eBody--> 
     
 <!-- fin contenido de orden -->