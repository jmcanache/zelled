<div class=" homepage_content clearfix franja-perfil height-franja-perfil-P" style="" id="imagebanner">
  <div class="container" style="padding-top: 10px;">
    <div class="five columns">
      <div class="section clearfix">
          <?php echo $this->Html->image('logo/' . $data['Tienda']['logo'], array('alt' => 'TiviaStore', 'class' => 'profile-pic'));?>
      </div>
    </div>
    <div id="p_human" class="eight columns">
      <div class="section clearfix">
        <div style="font-size:36px;">
          <span class="font-KG-Manhattan mint"><?php echo $data['Tienda']['nombre'];?></span>
          <span class="location"><?php echo $data['Ciudad']['descripcion'];?></span>
          <span class="font-human relleno-10" style="color:#59A09A; display:block; line-height:25px; font-size: 20px;"><?php echo $data['Tienda']['slogan'];?></span></div>
          <p id="dataBio" class="font-human relleno-20 grey" style="margin-bottom: 0px; padding-top: 5px; font-size: 16px; line-height: 18px; padding-bottom: 10px;">
          	<?php echo $data['Tienda']['bio'];?>       
          </p>
  
          <div class="row">
            <div class="two columns" style="text-align: center">
                <?php echo $this->Html->image('shop.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'padding-top: 0px; margin-left: 20px;'));?>
                <span class="font-human mint" style="font-weight: bold; display:inline-block;"><?php 
                    $now = new DateTime(date('Y-m-d H:i:s'));
                    $dias = new DateTime($data['Tienda']['created']);
                    $interval = $now->diff($dias);
                    echo $interval->format('%d dias abierta');?>
                </span>
            </div>
            <div class="two columns" style="text-align: center">
              <?php echo $this->Html->image('tag.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'padding-top: 0px; margin-left: 20px;'));?>
              <span class="font-human mint" style="font-weight: bold; display:inline-block;"><?php
                echo $cantidad_de_productos . ' productos';?>
              </span> 
            </div>
            <div class="two columns" style="text-align: center"><?php 
              echo $this->Html->image('bag.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'padding-top: 0px; margin-left: 20px;'));?>
                    <span class="font-human mint" style="font-weight: bold; display:inline-block;"> <?php echo $data['Tienda']['ventas_totales'] . ' ventas totales'; ?></span> 
            </div>
          </div>

         
     </div>
    </div>
    <div id="p_human" class="three columns" style="background-color: white">
      <div class="section clearfix">
        <?php 
          if($data['Usuario']['Sexo']['es_mujer'] == true)
          {
            $disenador = 'Diseñadora';
            $foto_user = 'shape.jpg';
          }
          else
          {
            $disenador = 'Diseñador';
            $foto_user = 'shape.jpg';
          }
        
         echo $this->Html->image($foto_user, array('alt' => 'TiviaStore', 'class'=>'profile-pic-min',  'style' => 'width: 70px;'));?>
          <p class="mint font-KG-Manhattan mint" style="text-align: center; font-size: 20px; margin-bottom: 0px;"><?php echo $data['Usuario']['nombre'] . ' ' . $data['Usuario']['apellido']?></p>
      <p class="font-human grey" style="text-align: center; font-size: 16px; line-height: 1em;margin-bottom: 0px;">
        <?php echo $disenador;?>
      </p>
      </div>
      <div class="section clearfix info-store">
        <p class="grey" style="font-size: 12px;margin-top: 5px;"> SEGUIDORES <span class="number"><?php echo  $data['Tienda']['seguidores'];?></span></p>
          <?php
          if(!$esdueno and !$follow_unfollow)
          {
          echo '<p class="mint">' . $this->Html->link('¡Síguelos!', array('controller' => 'seguidores', 'action' => 'follow_store', $data['Tienda']['id']), array('class' => 'follow bck-morado')). '</p>';
          }
          elseif(!$esdueno and $follow_unfollow)
          {
          echo '<p class="mint">' . $this->Html->link('Dejar de seguir', array('controller' => 'seguidores', 'action' => 'follow_store', $data['Tienda']['id']), array('class' => 'follow bck-gray')). '</p>';
          }
          ?>

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalBio" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id="ModalBody" >
      		
      </div>
     </div>
  </div>
</div>
