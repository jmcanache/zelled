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
		echo $this->Html->css('custom-c');
		echo $this->Html->css('listing');
		echo $this->Html->css('storestyles');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('bootstrap-theme.min');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	?>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</head>
<body data-twttr-rendered="true" class="index"><?php
      echo $this->element('adaptative-store');?>
      <div class="mm-page" style=""><?php
        echo $this->element('newHeader');
        echo $this->Session->flash();
        echo $this->fetch('content');
        echo $this->element('footer');
      ?></div>

      <script>window.jQuery || document.write("<script src='//cdn.shopify.com/s/files/1/0592/4833/t/2/assets/jquery.min.js?1134'>\x3C/script>")</script>
    <?php
      echo $this->Html->script('jquery');
      echo $this->Html->script('bootstrap.min');
      echo $this->Html->script('app');
      echo $this->Html->script('cloudzoom');
      echo $this->Html->script('option_selection');
      
      ?>

    <div id="mm-blocker"></div>
    <iframe style="display: none;" allowtransparency="true" scrolling="no" id="rufous-sandbox" frameborder="0"></iframe>
</body>
</html>
