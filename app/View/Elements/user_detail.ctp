<div class=" homepage_content clearfix franja-perfil height-franja-perfil-P" style="" id="UserBio">
  <div class="container mint" style="padding-top: 10px;">   
    <div class="five columns">
      <div class="section clearfix">
         <?php echo $this->Html->image('shape.jpg', array('alt' => 'TiviaStore',	'class' => 'profile-pic'));?>
      </div>
    </div>
    <div id="p_human" class="five columns margen-perfil-usuario">
      <div class="section clearfix ">
        <div class="" style="font-size:36px;"> <?php $nombre = $data['Usuario']['nombre'] . ' ' . $data['Usuario']['apellido'];?>
          <span class="font-KG-Manhattan mint"><?php echo $this->Html->link($nombre, array('controller' => 'usuarios', 'action' => 'perfil_usuario'), array('escape' => false, 'style' => 'color:#109998;'))?></span>
          <p class="font-human grey relleno-10" style="margin-bottom: 0px; padding-top: 10px; font-size: 16px; line-height: 18px; padding-bottom: 10px;">
          <?php echo $data['Usuario']['bio']; ?>
          <?php echo $this->Html->link('<span class="font-human" style="font-weight: bold;color: #69388d;">Editar</span>', array('controller' => 'usuarios', 'action' => 'edit_bio_modal'),	array('escape' => FALSE, 'id'=>'editBiolink', 'data-toggle' =>'modal', 'data-target'=>'#ModalBio', 'style' => 'text-decoration: none;'));?>	
          </p>      
        </div>
      </div>
      <div class="section clearfix">
    	<ul class="menu-store">
  			<li class="margen-info-favoritos" style="display: inline-block;"> <span class="font-human" style="padding-left: 40px; line-height:35px; font-size: 22px;font-weight: bold;"><?php //echo $data['Tienda']['seguidores'];?> 56	<span style="margin-left: 10px; margin-top: 0px; padding-top: 0px; width: 100px; display: block;"> Seguidores </span> </span></li>
        	<li style="display: inline-block;"> <span class="font-human" style="padding-left: 40px; line-height:35px; font-size: 22px;font-weight: bold;"><?php //echo $data['Tienda']['seguidores'];?> 48   <span style="margin-left: 10px; margin-top: 0px; padding-top: 0px; width: 100px; display: block;"> Siguiendo </span> </span></li>
        	 
        </ul>
      </div>
    </div>
    
    <div id="p_human" class="six columns margen-perfil-usuario" style="text-align: center"><?php 
      if(empty($actualUser['Tienda']['id']))
      {
        echo $this->Html->link($this->Html->image('openstore.png', array('alt' => 'openstore', 'class' => 'open_store_img')), array('controller' => 'tiendas', 'action' => 'open_store'), array('escape' => false));
      }
      else
      {
        echo $this->Html->link($this->Html->image('gestiona.png', array('alt' => 'gestion', 'style' => '')), array('controller' => 'tiendas','action' => 'view_store', $actualUser['Tienda']['id'], 'gestionTienda'), array('escape' => false));
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