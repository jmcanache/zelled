 <!-- Slider -->
<?php echo $this->element('slider');?>
 <!-- / Slider -->

 <!-- Que es tivia -->
<div class="homepage_content clearfix animatedParent" style="background-color: #e8f5f0; padding-bottom: 40px;">
  <div style="padding-top: 20px;" class="container content">
    <p class="font-KG-Manhattan titulo mint animated fadeInDownShort">¿Qué es <span class="font-keep">ZELLED</span>?</p>
    <div class="sixteen columns featured_links" style="margin-left: 0px;">
      <div class="section clearfix offset-by-two">
        <div class="four columns" style="text-align:center;">

          <p class="font-human" style="font-size:23px; line-height: 30px; color: #919191;">Imagina toda una gamma de productos unicos</p>
          <?php echo $this->Html->image('productos.png', array('alt' => 'ZELLED', 'class'=>'animated fadeInLeftShort',  'style' => 'position: relative; top: -5px;'));?>
         
        </div>

        <div class="four columns" style="text-align:center;">
          <?php echo $this->Html->image('talento.png', array('alt' => 'ZELLED', 'class'=>'animated fadeIn',  'style' => 'position: relative; top: -5px;  width: 130px; '));?>
          <p class="font-human" style="font-size:23px; line-height: 30px; color: #919191;">Hechos por manos talentosas y reunidos todos en un mismo sitio</p>
        </div>

        <div class="four columns" style="text-align:center;">
          <p class="font-human" style="font-size:23px; line-height: 30px; color: #919191;">En donde lo que te guste lo puedes comprar directo al creador</p>
          <?php echo $this->Html->image('gift.png', array('alt' => 'TiviaStore', 'class'=>'animated fadeInRightShort',  'style' => 'position: relative; top: -5px;  width: 130px; padding-top: 10px;'));?>
        </div>
      </div>
    </div>
  </div>
</div>
 <!-- / Que es tivia -->


 <!-- Descubre -->
<?php echo $this->element('descubre', array('tienda_aleatoria' => $tienda_aleatoria, 'titulo' => "¡Descubre productos de marcas auténticas!", 'background' => 'style="background-color: white;"'));?>
 <!-- / Descubre-->


<!-- Como funciona -->
<div class="homepage_content clearfix" style="background-color: #e8f5f0; padding-bottom: 40px;">
  <div style="padding-top: 20px;" class="container content animatedParent">
     <p class="font-KG-Manhattan titulo mint animated fadeInDownShort">¿Cómo funciona?</p>
    <div class="sixteen columns featured_links" style="margin-left: 0px;">
      <div class="section clearfix offset-by-two">
        <div class="four columns" style="text-align:center;">
          <?php echo $this->Html->image('lapices.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px; padding-top: 25px;'));?>
          <p class="font-KG-Manhattan mint" style="font-size:24px;">Creadores</p>
          <p class="font-human" style="font-size:18px; color:#919191;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
        </div>

        <div class="four columns" style="text-align:center;">
          <?php echo $this->Html->image('cartera.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px; padding-top: 25px;'));?>
          <p class="font-KG-Manhattan mint" style="font-size:24px;">Compradores</p>
          <p class="font-human" style="font-size:18px; color:#919191;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
        </div>

        <div class="four columns" style="text-align:center;">
          <?php echo $this->Html->image('corazon.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px; padding-top: 25px;'));?>
          <p class="font-KG-Manhattan mint" style="font-size:24px;">Lovers</p>
          <p class="font-human" style="font-size:18px; color:#919191;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
        </div>
      </div>
    </div>
  </div>
</div>
 <!--/ Como funciona -->

 <!-- Inspiracion -->
<?php echo $this->element('inspiracion', array('ds_data' => $ds_data, 'titulo' => "Inspírate"));
 echo '<div class="container content" style="padding-top: 0px">
		        <div class="container content animatedParent" style="text-align:center;padding-top: 0px;">		  	  
		           <p style="margin-bottom: 40px;">'.$this->Html->link('Galeria ZELLED', array('controller' => 'productos','action' => 'gallery'), array('class' => 'link_verde', 'style' => 'margin: 0 auto; ')) .'</p>
		         </div>
		      </div>';?>
<!-- / Inspiracion-->

<!-- PARALLAX -->
 <div class="homepage_content clearfix">
    <div class="fullwidth-section">
      <div data-stellar-background-ratio="0.2" style="background-image: url('img/ban.png'); background-position: 50% 0px;" class="parallax">
       </div>
      <div style="background-color:rgba(0,0,0,0.4);" class="img-overlay-solid"></div>

      <div class="container animatedParent">
          <p class="font-KG-Manhattan animated fadeInDownShort" style="font-size:45px; color:#ffffff; text-align:center;">Tu compra resguardada</p>
          <div class="sixteen columns featured_links" style="margin-left: 0px;">
            <div class="section clearfix offset-by-two">
              <div class="four columns" style="text-align:center;">
                <?php echo $this->Html->image('tarjeta.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px; padding-top: 50px;'));?>
                <p class="font-KG-Manhattan" style="font-size:24px; color:#ffffff;">Compra segura</p>
                <p class="font-human" style="font-size:18px; color:#ffffff;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
              </div>

              <div class="four columns" style="text-align:center;">
                <?php echo $this->Html->image('casa.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px; padding-top: 50px;'));?>
                <p class="font-KG-Manhattan" style="font-size:24px; color:#ffffff;">Envíos</p>
                <p class="font-human" style="font-size:18px; color:#ffffff;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
              </div>

              <div class="four columns" style="text-align:center;">
                <?php echo $this->Html->image('regalo.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px; padding-top: 50px;'));?>
                <p class="font-KG-Manhattan" style="font-size:24px; color:#ffffff;">Recibe tu compra</p>
                <p class="font-human" style="font-size:18px; color:#ffffff;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
              </div>
            </div>
          </div>
        </div>
    </div>            
</div>
 <!-- /PARALLAX -->


 <!-- Inspiracion -->
 <?php echo $this->element('suscribete');?>
 <!-- / Inspiracion-->


  <!-- Contactanos -->
<div class="homepage_content clearfix" style="">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix animatedParent">
          <div style="margin: 0 auto; width:10%;"><?php //echo $this->Html->image('isologo.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px;  width: 130px; padding-top: 50px;'));?></div>
            <p class="font-KG-Manhattan titulo mint animated fadeInDownShort">Conéctatate con nosotros</p>
            <ul class="footer-suscribete">
                <li class="tamano-redes-a">
                  <a href="https://twitter.com/zelled" class="twitter"></a>
                </li> 
                <li class="tamano-redes-a">
                  <a href="https://facebook.com/zelled" class="facebook"></a>
                </li>
                <li class="tamano-redes-a">
                  <a href="https://instagram.com/zelled" class="instagram"></a>
                </li>
                <li class="tamano-redes-a">
                  <a href="https://pinterest.com/" class="pinterest"></a>
                </li>
            </ul>
        </div>
      </div>
    </div>
</div>
 <!-- / Contactanos -->