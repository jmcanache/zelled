<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
  

echo $this->Html->css('bootstrap-theme.min'); 
echo $this->Html->css('listing'); 
echo $this->Html->css('jquery.Jcrop');
echo $this->fetch('content'); 
//se agregan para que funcionen los checkboxes
/*echo $this->Html->script('jquery-1-10-2.min');
echo $this->Html->script('ajax_custom');*/
echo $this->Html->script('bootstrap-notify');
echo $this->Html->script('notify_custom');
echo $this->Html->script('jquery.Jcrop');
echo $this->Html->script('crop_image');
?>