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
  ?>

  <?php
    //Custom CSS
    echo $this->Html->css('storestyles');

    //fetch
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');

  ?>
</head>
<body data-twttr-rendered="true" class="index"><?php
      echo $this->element('adaptative-store');?>
      <div class="mm-page" style=""><?php
        echo $this->element('header');
        echo $this->Session->flash();
        echo $this->fetch('content');
      ?></div>

    <?php
      // Aqui scripts
      echo $this->Html->script('shopify_stats');
      echo $this->Html->script('jquery_002');
    ?>
      <script>window.jQuery || document.write("<script src='//cdn.shopify.com/s/files/1/0592/4833/t/2/assets/jquery.min.js?1134'>\x3C/script>")</script>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      <script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
    <?php
      echo $this->Html->script('app');
      echo $this->Html->script('cloudzoom');
      echo $this->Html->script('option_selection');
      echo $this->Html->script('jquery');
      ?>

    <div id="mm-blocker"></div>
    <iframe style="display: none;" allowtransparency="true" scrolling="no" id="rufous-sandbox" frameborder="0"></iframe>
</body>
</html>
