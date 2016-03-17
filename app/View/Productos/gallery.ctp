<div style="height: 100px;text-align: center; color: white" class="gradient homepage_content clearfix franja-perfil height-franja-perfil-P">
  <p style="font-size: 40px; padding-left: 0px; line-height: 0.7em; padding-top: 15px;" class="font-KG-Manhattan">Inspírate</p>
  <p class="font-human" style="font-size: 18px; padding-left: 30px; line-height: 1em;">¡Disfruta de una galería de mucha creatividad y talento!<?php echo $this->Html->image('isomini-verde.png', array('alt' => 'TiviaStore', 'style' => 'padding-top: 0px; width: 18px; height: 18px; margin-left: 8px;'))?></p>             
</div>

<section id="portfolio">
  <div id="posts-list"><?php $icon = '<i class="fa fa-plus round-icon" style="color: #109998"></i>';

 foreach($posts as $post)
 {
    $image ='<div class="">
              <div class="post-item col-sm-6 col-md-2 col-xs-12 portfolio-link hover">'.         
                $this->Html->image('todosproductos/' . $post['ruta_thumb'], array('alt' => 'producto', 'style' => 'height: 80%; width: 100%;','class'=>'img-responsive animate'))
              .'<div class="overlay text-center" style="top: 40px;">
                  <h2>'.$post['Producto']['nombre'].'</h2>
                  <h5>'.$post['Producto']['descripcion_corta'].'</h5>
                  <h5>Bs. '.number_format($post['Producto']['precio'],2,",",".").'</h5>            
                </div>
              </div>
            </div>'; 
    echo $this->Html->link($image, array('controller' => 'productos', 'action' => 'detail', $post['Producto']['tienda_id'], $post['Producto']['id'] ), array('escape' => false, 'style' => 'text-decoration: none;'));            
      

    }    
?></div></section>

<?php
    //echo $this->Paginator->next('');
?>

<script>
  $(function(){
  var $container = $('#posts-list');

  $container.infinitescroll({
    navSelector  : '.next',    // selector for the paged navigation 
    nextSelector : '.next a',  // selector for the NEXT link (to page 2)
    itemSelector : '.post-item',     // selector for all items you'll retrieve
    debug     : true,
    dataType    : 'html',
    loading: {
      finishedMsg: 'No hay mas productos!',
      img: '<?php echo $this->webroot; ?>img/ajax-loader.gif'
    }
    }
  );
  });

</script>