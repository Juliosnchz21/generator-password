function guardarPass(){
			
	var datos=new FormData($('#formPassword')[0]);
		datos.append("action","insertar");
		$.ajax(
			{
			url: './controlador/controladorPasswords.php',
			method: 'POST',
			timeout: 10000,
			data: datos,
			dataType: "json",
			processData: false,
			contentType: false,
			success: function(data){
				if (data.codErr!=0){
					console.log(data.msgErr);
				} else {
					listCodes();
				}
			}
		});


}
function del(id){
			
		if (confirm("¿Estás Seguro?")) {
	
			$.ajax(
				{
				url: './controlador/controladorPasswords.php',
				method: 'POST',
				timeout: 10000,
				data: {action:'delete', id:id},
				dataType: "json",
				success: function(data){
					if (data.codErr!=0){
						alert(data.msgErr);
					} else {
						listCodes();
					}
				}
			});
		}


}

function listCodes(){
	var datos=new FormData($('#formPassword')[0]);
		datos.append("action","listar");
		$.ajax(
			{
			url: './controlador/controladorPasswords.php',
			method: 'POST',
			timeout: 10000,
			data: datos,
			dataType: "json",
			processData: false,
			contentType: false,
			success: function(data){
				$("#resultlist").empty();
				$.each(data.codes, function(index, item){
					html="<tr><td>"+item.code+"</td><td>"+item.descripcion+"</td><td><a href='Javascript:del("+item.idCode+")'>Borrar</a></td></tr>";
					$("#resultlist").append(html);
				})
			}
		});


}

function generarPass() {

	// Obtener los valores de los checkboxes y la longitud.
	const mayusculas = $("#mayusculas").prop("checked");
	const minusculas = $("#minusculas").prop("checked");
	const numeros = $("#numeros").prop("checked");
	const simbolos = $("#simbolos").prop("checked");
	const longitud = $("#longitud").val();

	 if ((mayusculas || minusculas || numeros || simbolos) && (longitud >= 8 && longitud <= 20)) {
		var datos=new FormData($('#formPassword')[0]);
		datos.append("action","generar");
		$.ajax(
			{
			url: './controlador/controladorPasswords.php',
			method: 'POST',
			timeout: 10000,
			data: datos,
			dataType: "json",
			processData: false,
			contentType: false,
			success: function(data){
				if (data.codErr!=0){
					console.log(data.msgErr);
				} else {
					$("#pass").val(data.msg);
				}
			}
		});
	}else {
		alert("Por favor, asegúrese de seleccionar al menos 3 opciones y que la longitud esté entre 8 y 20 caracteres.");
	}
}

$(document).ready(function(){
	listCodes();
})