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
              <span style="color: #465059;">Nuevo pago en tivia</span>
            </h1>
          </td>
          <!-- end .highlight--> 
        </tr>
        <tr>
          <td class="eBody alignLeft pdBt16" style="margin:0;padding:16px 16px 0;border-collapse:collapse;border-spacing:0;font-family:Arial,Helvetica,sans-serif;padding-bottom:16px;width:512px;color:#54565c;background-color:#ffffff;">
            <p style="margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;margin-bottom:24px;font-size:14px;line-height:22px;">
              <a href="tiviastore.com/teammembers" style="text-align: center; text-decoration: none; color: #622D86;">Llévame a Team Members</a>
            </p>
          </td>       
      <!-- end .eBody--> 
        </tr>     
      <!-- end .eBody--> 
     
 <!-- fin contenido de orden -->