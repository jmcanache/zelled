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
  ?>


  <?php
    //Custom CSS     
    echo $this->Html->css('storestyles');   
    echo $this->Html->css('ihover');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('custom-c');
    echo $this->Html->css('bootstrap-theme.min');
    echo $this->Html->css('animations');
  
    //fetch
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>


</head>
<body data-twttr-rendered="true" class="index"><?php
      echo $this->element('adaptative-store');?>
      <?php
        echo $this->element('newHeader');
        echo $this->Session->flash();
        echo $this->fetch('content');
        echo $this->element('footer');
      ?>

    <?php
    //js
      echo $this->Html->script('jquery-1-10-2.min');
      echo $this->Html->script('jquery');
      echo $this->Html->script('bootstrap.min');
      echo $this->Html->script('ajax_estado_ciudad_registro');  
      echo $this->Html->script('bootstrap-notify');
      echo $this->Html->script('ajax_custom'); 
      echo $this->Html->script('notify_custom');
      echo $this->Html->script('app'); 
      echo $this->Html->script('css3-animate-it'); 
      ?>

    <div id="mm-blocker"></div>
    <iframe style="display: none;" allowtransparency="true" scrolling="no" id="rufous-sandbox" frameborder="0"></iframe>

    <!-- Include jQuery Popup Overlay      <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>-->
    <script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.10/jquery.popupoverlay.js"></script>

<?php 
//chequea si entra por primera vez para mostrar el popup tutorial
if($first_visit) { ?>
  <script>
    $(document).ready(function() {
      // Initialize the plugin
      $('#my_popup').popup();
    });

    $('#my_popup').popup({autoopen: true});
</script>
<?php }else{?>
  <script type="text/javascript">
    $('#my_popup').hide();
  </script>
<?php }?>

</body>
</html>