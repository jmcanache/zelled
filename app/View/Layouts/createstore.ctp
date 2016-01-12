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

$cakeDescription = 'ZELLED';
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//Custom CSS
		echo $this->Html->css('custom-a');
		echo $this->Html->css('responsive');
		echo $this->Html->css('custom-c');
		echo $this->Html->css('custom-d');
		echo $this->Html->css('openstore');

				
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
</head>
<body>
	<div id="container">
		<div id="content" style="padding-top: 10px;">

		</div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		<div id="footer"></div>
	</div>
		
	<!-- Aqui scripts -->
	
	<?php echo $this->Html->script('jquery-2.1.0.min'); 
		  echo $this->Html->script('jquery-accordion');
		  echo $this->Html->script('slider-banner');
		  echo $this->Html->script('bxslider');?>
	
</body>
</html>
