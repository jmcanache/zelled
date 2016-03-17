<div class="col-lg-12 col-md-12 col-sm-6" style="color: #363636">
	<p class="title light" style="text-align:center; font-size: 15px;font-weight: normal;">ESTADISTICAS</p>
	<div class="balance widget widget-lg">
		<div class="widget-heading">
			<h1 class="title light"><?php echo 4?></h1>
			<small class="subtitle"><?php echo $titulo_estadistica?></small>
			<div ui-charts="chartDemo" class="ng-isolate-scope ui-chart c3" style="max-height: 100px; position: relative;">
			<?php echo $this->Html->image('svgimage.png', array('alt' => 'TiviaStore'));?><div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none;"></div></div>
		</div>
		<div class="widget-body">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4 text-blocked text-center">
					<p class="bold"><?php echo count($ds_orders)?></p> Exitosas
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 text-blocked text-center">
					<p class="bold">1</p> Activa
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 text-blocked text-center">
					<p class="bold">1</p> Lista
				</div>
			</div>
		</div>
	</div>
	<div>
		<article class="panel panel-default">
			<header class="panel-heading">Leyenda de estatus</header>
			<section class="panel-body">
				<div class="form-group"><?php 						
					$status_description = Configure::read($leyenda.'.1');
					echo '<span class="label '.$status_description['class'].'">'.$status_description['status'].'</span><span style="font-size:12px"> '.$status_description['descripcion'].' </span><br>';

					$status_description = Configure::read($leyenda.'.2');
					echo '<span class="label '.$status_description['class'].'">'.$status_description['status'].'</span><span style="font-size:12px"> '.$status_description['descripcion'].'</span><br>';

					$status_description = Configure::read($leyenda.'.3');
					echo '<span class="label '.$status_description['class'].'">'.$status_description['status'].'</span><span style="font-size:12px"> '.$status_description['descripcion'].'</span><br>';


					$status_description = Configure::read($leyenda.'.4');
					echo '<span class="label '.$status_description['class'].'">'.$status_description['status'].'</span><span style="font-size:12px"> '.$status_description['descripcion'].'</span><br>';

					$status_description = Configure::read($leyenda.'.5');
					echo '<span class="label '.$status_description['class'].'">'.$status_description['status'].'</span><span style="font-size:12px"> '.$status_description['descripcion'].'</span><br>';
					?>
				</div>
			</section>
		</article>
	</div>
	<p class="well ng-binding" style="text-align: center"><?php
		echo $this->Html->link($linkname, array('controller' => 'orders', 'action' => $linkto), array('style' =>'border-left:none; color:#5c8cca'));?>
	</p>
</div>					