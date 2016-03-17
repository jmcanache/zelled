<?php
    //$this->log('entro en updateselect');
	//$this->log($options);
	//Para actualizar combos por medio de ajax
		//$this->log('updateselect elemento');
		//$this->log($options);
	// /app/views/elements/update_select.ctp
	echo '<option value="-1">--Seleccione--</option>';
	if (!empty($options))
	{
		foreach($options as $k => $v)
		{
			echo '<option value="' . $k . '">' . $v . '</option>';
		}
	}
 ?>