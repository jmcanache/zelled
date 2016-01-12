<div class="homepage_content clearfix">
    <div class="container">
      <div class="sixteen columns" style="margin: 0 auto;">
        <div class="section clearfix">

					<div class="fondo_accede_column_verde" style="width: 45%; margin: 0px auto; padding: 20px; color: white;">
						<h4 class="title titulos_accede">Edita tu tienda </h4>
						<?php
							echo $this->Form->create('Tienda', array(
								'url' => array('controller' => 'tiendas', 'action' => 'edit_store'),
								'class' => 'formblock',
								'style' => '',
								'type' => 'file',
								'inputDefaults' => array(
										'class' => '',
										'div' => false,
										'label' => false
										)));?>

							<p><?php
								echo $this->Form->input('Tienda.nombre', array('placeholder' => __('Nombre')));
								echo $this->Form->hidden('Tienda.id', array('value' => $tienda_id));
							?></p>
							<p><?php
								echo $this->Form->input('Tienda.telefono', array('placeholder' => __('Telefono')));
							?></p>
							<p><?php
								echo $this->Form->input('Tienda.provincia_id', array('placeholder' => __('Estado')));
							?></p>
							<p><?php
								echo $this->Form->input('Tienda.ciudad_id', array('placeholder' => __('Ciudad')));
							?></p>
							<p><?php
								echo $this->Form->input('Tienda.slogan', array('placeholder' => __('Slogan')));
							?></p>
							<p><?php
								echo $this->Form->textarea('Tienda.bio', array('rows' => '5', 'cols' => '5', 'placeholder' => __('Bio')));
							?></p>
							<p class="choose_file">
								<span>Logo <br>min 160x160 - max 300x300</span><?php
								echo $this->Form->input('Tienda.logo', array('type' => 'file'));
							?></p>
							<p><?php
								echo $this->Form->button(__('Editar mi tienda'), array('class' => 'boton_verde', 'style' => ''));
							?></p><?php
							echo $this->Form->end();?>
					</div>

        </div>
      </div>
    </div>
  </div>
