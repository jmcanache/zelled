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

$cakeDescription = 'TiviaStore: Marketplace de artesanías';
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
  <?php
    echo $this->Html->charset();
    echo $this->Html->meta('robots', 'index,follow');
    echo  $this->Html->meta('description', 'Marketplace de productos hechos a manos');
    echo $this->Html->meta('icon');
  ?>
  <title>
    <?php echo $cakeDescription ?>
  </title>

  <?php
    //Mobile Specific Metas
    echo  $this->Html->meta('HandheldFriendly', 'True');
    echo  $this->Html->meta('MobileOptimized', '320');
    echo  $this->Html->meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1');

    //Custom CSS
    echo $this->Html->css('storestyles');
    echo $this->Html->css('listing');    
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('custom-c');

    //fetch
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</head>
<body data-twttr-rendered="true" class="index"><?php
      echo $this->element('adaptative-store');?>
      <div><?php
        echo $this->element('newHeader');
        echo $this->Session->flash();
        echo $this->fetch('content');
        echo $this->element('footer');
      ?></div>

    <?php
    //js
      echo $this->Html->script('jquery-1-10-2.min');
      echo $this->Html->script('jquery');
      echo $this->Html->script('ajax_like');   
      echo $this->Html->script('app');
      echo $this->Html->script('ajax_estado_ciudad_registro');
      ?>

    <div id="mm-blocker"></div>
    <iframe style="display: none;" allowtransparency="true" scrolling="no" id="rufous-sandbox" frameborder="0"></iframe>
</body>
</html>

