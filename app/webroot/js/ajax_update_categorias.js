$("document").ready(
		function() {
		    $('#CategoriaName').bind('change', function()
		    {
		        $.ajax({
		               type: "GET",
		               url: "../../productos/updatechildlevelone/" + $(this).val(),
		               beforeSend: function() {
		                     $('#CategoriaResult').html("");
		                     },
		               success: function(msg){
		                   $('#CategoriaResult').html(msg);
		               }
		             });
		    });

		}
		);

$("document").ready(
		function() {

		    $('#UsuarioProvinciaId').bind('change', function()
		    {
		        $.ajax({
		               type: "GET",
		               url: "../../usuarios/updateselectciudad/" + $(this).val(),
		               beforeSend: function() {
		                     $('#UsuarioCiudadId').html("");
		                     },
		               success: function(msg){
		                   $('#UsuarioCiudadId').html(msg);
		               }
		             });
		        $.ajax({
		               type: "GET",
		               url: "../../usuarios/updateselectmunicipio/" + $(this).val(),
		               beforeSend: function() {
		                     $('#UsuarioMunicipioId').html("");
		                     },
		               success: function(msg){
		                   $('#UsuarioMunicipioId').html(msg);
		               }
		             });		        
		    });
			});

$("document").ready(
		function() {
		    $('#UsuarioMunicipioId').bind('change', function()
		    {
		        $.ajax({
		               type: "GET",
		               url: "../../usuarios/updateselectparroquia/" + $(this).val(),
		               beforeSend: function() {
		                     $('#UsuarioParroquiaId').html("");
		                     $('#UsuarioParroquiaId').html("");
		                     },
		               success: function(msg){
		                   $('#UsuarioParroquiaId').html(msg);
		               }
		             });
		    });

		}
		);