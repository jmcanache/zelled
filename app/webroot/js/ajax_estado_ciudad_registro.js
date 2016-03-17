$("document").ready(
		function() {
		    $('#TiendaProvinciaID').bind('change', function()
		    {
		        $.ajax({
		               type: "GET",
		               url: "../tiendas/updateselectciudad/" + $(this).val(),
		               beforeSend: function() {
		                     $('#TiendaCiudadId').html("");
		                     },
		               success: function(msg){
		                   $('#TiendaCiudadId').html(msg);
		               }
		             });
		    });

		}
		);