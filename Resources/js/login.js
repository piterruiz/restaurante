

function focusInput() {
	const input = document.getElementById('usuario');
	if (input) {
		input.focus();
	}
}
window.onload = function() {
	var vars = window.location.search;
	if (!vars) {


	}else{
		Swal.fire({
			icon: 'error',
			title: 'error...',
			text: 'No tiene permiso para ingresar a esta sede!',
			footer: '<a href="">Contacte el Administrador?</a>'
		}).then((result) => {
			if (result.isConfirmed) {
                    // Recargar la página después de cerrar el SweetAlert
				//location.reload();
				window.location.href = "index.php";
			}
		});
	}
	focusInput();
};
function handleKeyPress(event) {
	if (event.key === 'Enter') {
		event.preventDefault(); 
		validar();
	}
}
function validar(){
	let usuario= document.getElementById("usuario").value;
	let clave= document.getElementById("clave").value;
	//alert("Usuario = "+usuario+" y clave = "+clave);
	$.ajax({
		url:"co.Controlador/usuarioAjax.php",
		type:'POST',
		async:true,
		data:{iniciosesion:'',usuario:usuario,clave:clave},
		beforeSend:function(){

		},
		success:function(respuesta){

			if (respuesta=="NO") {
				Swal.fire({
					icon: 'error',
					title: 'Error...',
					text: 'Usuario o clave Incorrectos!',
					footer: '<a href="">Debe registrarse en el sistema?</a>'
				}).then((result) => {
					if (result.isConfirmed) {
                    // Recargar la página después de cerrar el SweetAlert
						location.reload();
					}
				});

			}else if(respuesta=="BLOQUEO"){
				Swal.fire({
					icon: 'error',
					title: 'Error...',
					text: 'Usuario Bloqueado',
					footer: '<a href="">Contacte al administrador?</a>'
				}).then((result) => {
					if (result.isConfirmed) {
                    // Recargar la página después de cerrar el SweetAlert
						location.reload();
					}
				});
			}else{
				let sedes = JSON.parse(respuesta);
				let options = sedes.map(sede => `<option value="${sede.idSede}">${sede.nombre}</option>`).join('');
				
				Swal.fire({
					html: `
					<form method="POST" action="co.Controlador/controlador_session.php">
					<input autocomplete="off" value="${usuario}" class="form-control" name="usuario" id="usuario" type="hidden">
					<input class="form-control" name="clave" value="${clave}" id="clave" type="hidden">
					<label For="">SEDE:</label>
					<br>
					<select name="sede" class="form-control">${options}</select>
					<br>
					<input class="btn btn-success" value="Aceptar" type="submit">
					</form>`,
					showConfirmButton:false
				});

			}

		},
		error:function(error){
			console.log(error);
		}
	})
}