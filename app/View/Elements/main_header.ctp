<header id="header-container">
  <div id="header">
    <div class="header-left">
      <div id="logo">
        <?php echo $this->Html->image('logonuevo.png', array('alt' => 'TiviaStore'));?>

      </div>
    </div>
    <div class="header-right">
      <div id="cart" style="margin-right: 80px;">
        <div class="heading login" style="position: relative">
          <div>Login</div>


<!--
<div id="search" class="input-group row">
    <div class="input-group-addon first">
        <span><a data-id="#categories-menu-box" title="" class="popover-trigger" data-original-title="Categories">Categorias</a></span>
        <span class="icon-logo hidden-md hidden-sm hidden-xs"><img src="/styles/images/logo-diamante.png"></span>
    </div>
    <input type="text" placeholder="Busca aqui..." id="categories" class="form-control">
    <div class="input-group-addon last">
        <span class="icon icon-star"></span>
    </div>
</div>
-->
<?php
  echo $this->Form->create('Usuario', array(
    'url' => array('controller' => 'usuarios', 'action' => 'login'),
    'class' => 'nav-flyout-menu nav-flyout nav-arrow nav-flyout-api nav-arrow',
    'style' => 'margin-top: 10px;',
    'inputDefaults' => array(
        'class' => '',
        'div' => false,
        'label' => false
        )));
  ?>
  <p><?php
    echo $this->Form->input('Usuario.login', array('placeholder' => __('Correo')));
  ?></p>
  <p><?php
    echo $this->Form->input('Usuario.password', array('placeholder' => __('Clave')));
  ?></p>
  <p><?php
    echo $this->Form->button(__('Entrar'), array('class' => 'btnbasico', 'style' => 'margin-left: 28%; margin-top: 1%'));
  ?></p><?php
  echo $this->Form->end();
?> </div>

<div class="heading registro">
   <div>Regístrate </div><?php
    echo $this->Form->create('Usuario', array(
      'url' => array('controller' => 'usuarios', 'action' => 'registro_usuario'),
      'class' => 'nav-flyout-menu nav-flyout nav-arrow nav-flyout-api nav-arrow',
      'style' => 'margin-top: 15px;',
      'inputDefaults' => array(
          'class' => '',
          'div' => false,
          'label' => false
          )));
    ?>
    <p><?php
      echo $this->Form->input('Usuario.nombre', array('placeholder' => __('Nombre')));
    ?></p>
    <p><?php
      echo $this->Form->input('Usuario.apellido', array('placeholder' => __('Apellido')));
    ?></p>
    <p><?php
      echo $this->Form->input('Usuario.login', array('placeholder' => __('Correo electrónico')));
    ?></p>
    <p><?php
      echo $this->Form->input('Usuario.password', array('placeholder' => __('Clave')));
    ?></p>
    <p><?php
      echo $this->Form->input('Usuario.password2', array('type' => 'password', 'placeholder' => __('Repita su clave')));
    ?></p>
    <p id="radio"><?php
        $opciones = array(
            Configure::read('TIVIA_CONFIG.SEXO.FEMENINO.CODIGO') => '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.SEXO.FEMENINO.TEXTO'), true)),
            Configure::read('TIVIA_CONFIG.SEXO.MASCULINO.CODIGO') =>  '<span></span>'.ucfirst(__(Configure::read('TIVIA_CONFIG.SEXO.MASCULINO.TEXTO'), true))
        );

      $attributes = array('legend' => false, 'separator' => '', 'value' => Configure::read('TIVIA_CONFIG.SEXO.FEMENINO.CODIGO'), 'class' => '');

      echo $this->Form->radio('Usuario.sexo_id', $opciones, $attributes);
    ?></p>
    <p><?php
      echo $this->Form->button(__('Registrarme'), array('class' => 'btnbasico', 'style' => 'margin-left: 18%; margin-top: 1%'));
    ?></p><?php
    echo $this->Form->end();
  ?>
</div>
</div>
<div id="search">
<div class="button-search"></div>
<input type="text" name="search" onClick="this.placeholder = '';" placeholder="¿Que estas buscando?" value="" />
</div>
</div>
</div>
</header>

<div class="dotted-strip">
</div>
