<div>
  <div id="header" class="mm-fixed-top">
    <a href="#nav" class="icon-menu"> <span>Menu</span></a>
    <a href="#cart" class="icon-cart right"> <span>Cesta</span></a>
  </div>

  <div class="hidden"></div>

  <div class="header header_bar"> <!-- clase mm-fixed-top lo fija -->
    <div class="container">
      <div class="four columns logo">
        <?php echo $this->Html->link( $this->Html->image('fulllogo.png', array('alt' => 'TiviaStore', 'style' => 'padding-top: 8%;')),
                    array('controller' => 'pages', 'action' => 'display'), array('escape' => false));?>
      </div>
      <div class="eight columns">

         <?php
          echo $this->Form->create(array(
            'url' => array('controller' => 'productos', 'action' => 'motor_de_busqueda')));
        //  echo $this->Form->input('field', array('options' => array('Productos', 'Tiendas'), 'label' => false));
          echo '<div class="search-box" style="background-color:#69388d">
                  <span class="fa fa-sort-desc fix-desc"></span>' .
                  $this->Form->input('field', array('options' => array('Productos', 'Tiendas'), 'label' => false, 'style' => 'cursor: pointer;
    display: block; font-family: arial,sans-serif; height: 35px; left: 0; margin: 0; opacity: 0; outline: 0 none; padding: 0;  position: absolute; top: -1px;  visibility: visible; width: auto;')).'
                </div>';
          echo '<span class="fa fa-search search-submit morado">'.$this->Form->submit(__('', true), array('style' => 'background: none repeat scroll 0 0 rgba(0, 0, 0, 0);  border: medium none;  color: #fff;  cursor: pointer;  display: block;  font-size: 14px;  height: 100%;  line-height: 1px;  margin: 0;  outline: 0 none;  padding: 0;  position: relative;  text-indent: -1000px;')).'</span>';
          echo $this->Form->input('nombre', array('placeholder' => __('Busca Tiendas, productos, colecciones, etc.'), 'label' => false, 'id'=>'box', 'style'=>"width: 90%; color:#794F99;"));
         // echo $this->Form->submit(__('Search', true));
          echo $this->Form->end();
        ?>

      </div>





         <div class="four columns mobile_hidden">
     <?php echo $this->Html->image('cinta.png', array('alt' => 'TiviaStore', 'class'=>'',  'style' => 'position: relative; top: -5px'));?>
     <?php  
              $countItems = 0;             
              $c = '<p id="carrito" class="morado">' . $countItems .' </p>';
               if($this->Session->read('cart')){				
                foreach( $this->Session->read('cart') as $product){                
                    $countItems=$countItems+$product;                  
                }
                $c = '<p id="carrito" class="pink">' . $countItems .' </p>';  
                }                
            echo $this->Html->link($c, array('controller' => 'carritos', 'action' => 'view_cart','cart'),
    													 array('escape' => FALSE, 'id'=>'cartElement'));?> 
    <!--   <ul class="menu" style="width: 28px; margin-bottom: 0px; position: relative; top: -35px; left: 20px; display: inline-block;">
          
          <li><a href="#cart" class="icon-menu morado" style="font-size: 26px"></a></li>

        </ul>  -->
     <?php
     if ($this->Session->read('Auth.User'))
     {
       //echo $this->Html->link('Salir', array('controller' => 'usuarios','action' => 'logout'), array('class' => 'accede'));
 		 echo $this->element('user-link', array('user_data' => $this->viewVars['actualUser']));    
                
     } else
     {
       echo $this->Html->link('Accede', array('controller' => 'usuarios','action' => 'accede'), array('class' => 'accede'));
      	//echo $this->element('user-link', array('user_data' => $this->viewVars['actualUser']));       
     }
     ?>
      </div>

      <!-- Menu del original
      <div class="twelve columns nav mobile_hidden">
        <ul class="menu">
          <li><a href="http://retina-theme-amsterdam.myshopify.com/" title="Home" class="top-link active">Home</a></li>
          <li><a href="http://retina-theme-amsterdam.myshopify.com/collections/all" title="Catalog" class="sub-menu  ">Catalog <span class="arrow">?</span></a>
            <div class="dropdown ">
              <ul>
                <li><a href="http://retina-theme-amsterdam.myshopify.com/collections/tables" title="Tables">Tables</a></li>
                <li><a href="http://retina-theme-amsterdam.myshopify.com/collections/chairs" title="Chairs">Chairs</a></li>
                <li><a href="http://retina-theme-amsterdam.myshopify.com/collections/benches" title="Benches">Benches</a></li>
                <li><a href="http://retina-theme-amsterdam.myshopify.com/collections/lighting" title="Lighting">Lighting</a></li>
              </ul>
            </div>
          </li>
          <li><a href="http://retina-theme-amsterdam.myshopify.com/blogs/blog" title="Blog" class="top-link ">Blog</a></li>
          <li><a href="http://retina-theme-amsterdam.myshopify.com/pages/theme-features" title="Theme Features" class="top-link ">Theme Features</a></li>
          <li><a href="https://twitter.com/outofthesandbox" title="Retina Theme Amsterdam on Twitter" rel="me" target="_blank" class="icon-twitter"></a></li>
          <li><a href="https://www.facebook.com/" title="Retina Theme Amsterdam on Facebook" rel="me" target="_blank" class="icon-facebook"></a></li>
          <li><a href="http://www.pinterest.com/" title="Retina Theme Amsterdam on Pinterest" rel="me" target="_blank" class="icon-pinterest"></a></li>
          <li><a href="http://instagram.com/shopify" title="Retina Theme Amsterdam on Instagram" rel="me" target="_blank" class="icon-instagram"></a></li>
          <li>
            <a href="http://retina-theme-amsterdam.myshopify.com/account" title="My Account " class="icon-user"></a>
          </li>
          <li>
            <a href="http://retina-theme-amsterdam.myshopify.com/search" title="Search" class="icon-search" id="search-toggle"></a>
          </li>
          <li>
              <select id="currencies" name="currencies">
                <option value="USD" selected="selected">USD</option>
                <option value="CAD">CAD</option>
                <option value="AUD">AUD</option>
                <option value="GBP">GBP</option>
                <option value="EUR">EUR</option>
                <option value="JPY">JPY</option>
              </select>
          </li>
          <li>
            <a href="#cart" class="icon-cart cart-button"> <span>Cart</span></a>
          </li>
        </ul>
      </div> -->
    </div>
  </div>
</div>
