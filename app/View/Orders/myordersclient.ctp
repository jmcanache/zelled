<div class="homepage_content clearfix" style="background-color: #EAEFF5;">
	<div class="container">
		<div class="sidebar four columns">
			 <!-- estadisticas -->
			<?php echo $this->element('stadistics-buyer', array('linkto' => 'myordersstore', 'linkname' => 'Ir a historial de ventas'));?>
 			<!-- / estadisticas-->
		</div>

		<!--INICIO DOCE COLUMNAS -->
		<div class="twelve columns">
			 <!-- estadisticas -->
			<?php echo $this->element('dashboard', array('main_tittle' => 'Tu historial de compras', 'subtitulo' => 'Desde acá podrás ver un resumen de tus actividades recientes', 'options' => $options, 'parametros' => $parametros, 'hide_paginatorcount' => $hide_paginatorcount));?>
 			<!-- / estadisticas-->
		</div>
	</div>
</div>