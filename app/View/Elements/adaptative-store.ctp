<!-- Menu desktop -->
<div class="mm-menu mm-horizontal mm-black mm-ismenu mm-offcanvas mm-right" id="cart">
  <ul id="mm-2" class="mm-list mm-panel mm-opened mm-current">
      <li class="mm-subtitle"><a class="mm-subclose continue" href="#cart">Continuar comprando</a></li>

    <?php // Si no esta loggeado
      if(empty($user))
      {
        echo '<li class="mm-selectedx">' .
               $this->Html->link('Inicio', array('controller' => 'pages','action' => 'home'), array('class' => '')) .
            '</li>
             <li>' . 
              $this->Html->link('Galería de productos', array('controller' => '','action' => ''), array('class' => '')) .
            '</li>
             <li>' . 
               $this->Html->link('Galería de tiendas', array('controller' => '','action' => ''), array('class' => '')) .
             '</li>';            
      }
      else
      {
        //si esta loggeado
        //Si no tiene tiene tienda
        if(empty($actualUser['Tienda']['id'])){
          echo '<li>' . 
                 $this->Html->link('Crear tienda', array('controller' => 'tiendas','action' => 'open_store'), array('class' => ''))
              .'</li>';
        }
        else{ // Si tiene tienda
          echo '<li>' . 
                 $this->Html->link('Gestionar tienda', array('controller' => 'tiendas','action' => 'view_store', $actualUser['Tienda']['id'], 'gestionTienda'), array('class' => ''))
              .'</li>
               <li>'.
                $this->Html->link('Panel de pedidos', array('controller' => 'orders','action' => 'myordersstore'), array('class' => ''))
              .'</li>
                <li>' . 
                  $this->Html->link('Ver tienda', array('controller' => 'tiendas','action' => 'view_store', $actualUser['Tienda']['id']), array('class' => ''))
              .'</li>
                <li>'.
                 $this->Html->link('Cargar un producto', array('controller' => 'productos','action' => 'listing'), array('class' => ''))
 			        .'</li>';
        }

        echo '<li>' .
                $this->Html->link('Mi perfil', array('controller' => 'usuarios','action' => 'perfil_usuario'), array('class' => '')) .
              '</li>
              <li>'.
                $this->Html->link('Panel de compras', array('controller' => 'orders', 'action' => 'myordersclient'), array('class' => ''))
              .'</li>
              <li>' .  
                $this->Html->link('Productos favoritos', array('controller' => 'likes','action' => 'ver_favoritos'), array('class' => '')) .
              '</li>
              <li>' .
                 $this->Html->link('Tiendas que sigo', array('controller' => 'Seguidores','action' => 'ver_seguidores'), array('class' => '')) .
              '</li>
              <li>' . 
              $this->Html->link('Galería de productos', array('controller' => 'productos','action' => 'gallery'), array('class' => '')) .
              '</li>
              <li>' .
                 $this->Html->link('Salir', array('controller' => 'usuarios','action' => 'logout'), array('class' => '')) .
          '</li>';
      }
?>



  </ul>
</div>

<!-- Menu del responsive-->
<div class="mm-menu mm-horizontal mm-black mm-ismenu mm-offcanvas mm-hassearch" id="nav">
  <div class="mm-search">
    <input placeholder="Buscar..." autocomplete="off" type="text">
  </div>
  <ul id="mm-0" class="mm-list mm-panel mm-opened mm-current">
    <li class="mm-selected"><?php 
      echo $this->Html->link('Inicio', array('controller' => 'pages','action' => 'home'), array('class' => ''));?>
    </li>
    <?php // Si no tiene tienda
    if(empty($actualUser['Tienda']['id'])){
      echo '<li>' . 
             $this->Html->link('Crear tienda', array('controller' => 'usuarios','action' => 'perfil_usuario'), array('class' => ''))
          .'</li>';
    }
    else{ // Si tiene tienda
      echo '<li>' . 
             $this->Html->link('Ver tienda', array('controller' => 'tiendas','action' => 'view_store', $actualUser['Tienda']['id']), array('class' => ''))
          .'</li>
            <li>' . 
             $this->Html->link('Editar tienda', array('controller' => 'tiendas','action' => 'edit_store', $actualUser['Tienda']['id']), array('class' => ''))
          .'</li>
            <li>' . 
             $this->Html->link('Cargar un producto', array('controller' => 'productos','action' => 'listing'), array('class' => ''))
          .'</li>'
          ;
    }?>
    <li><?php 
      echo $this->Html->link('Mi perfil', array('controller' => 'usuarios','action' => 'perfil_usuario'), array('class' => ''));?>
    </li>
    <li><?php 
      echo $this->Html->link('Favoritos', array('controller' => 'likes','action' => 'ver_favoritos'), array('class' => ''));?>
    </li>
    <li><?php 
      echo $this->Html->link('Galería de productos', array('controller' => '','action' => ''), array('class' => ''));?>
    </li>
    <li><?php 
      echo $this->Html->link('Galería de tiendas', array('controller' => '','action' => ''), array('class' => ''));?>
    </li>
    <li><?php
         echo $this->Html->link('Salir', array('controller' => 'usuarios','action' => 'logout'), array('class' => ''));?>
    </li>
  </ul>
</div>
