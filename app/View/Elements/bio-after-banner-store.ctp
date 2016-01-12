<div class="container content" style="padding-top:0"></div>
<div class="homepage_content clearfix" style="height: 200px;">
  <div class="container" style="padding-top: 10px;">
    <div class="three columns">
      <div class="section clearfix">
        <?php echo $this->Html->image('thumb.png', array('alt' => 'TiviaStore', 'class' => 'profile-pic'));?>
      </div>
    </div>
    <div class="five columns">
      <div class="section clearfix" style="padding-left: 10px;">
        <div style="font-weight:bold; margin:0; color:#423E3B; font-size:30px;"><?php echo $data['Tienda']['nombre'];?><span class="font-human" style="display:block; line-height:28px; color: #686563; font-size: 22px;"><?php echo $data['Tienda']['slogan'];?></span></div>
          <p class="fa fa-star" style=" margin-bottom: 0px; padding-top: 5px; font-size:22px; color:#8E226F"><span class="font-human">Tienda favorita</span></p><br>
          <div style="display: block">
            <ul style="display: inline;list-style: none outside;">
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
            </ul>
            <p class="font-human" style="display:inline">123 seguidores</p>
          </div>
      </div>
    </div>
    <div class="eight columns">
      <div class="section clearfix">
        <div style="font-weight:bold; margin:0; color:#423E3B; font-size:20px;">BIO:</div>
        <p style="color: #5E5E5E;line-height: 1.5em;"><?php echo $data['Tienda']['bio'];?></p>
        <?php echo $this->Html->link('Leer más', '#',  array('style' => 'float:right', 'target' => '_blank'));?>
      </div>
    </div>
  </div>
</div>
