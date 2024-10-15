window.onload = function() {

	$.ajax({
		url: '../../co.Controlador/controladorAjax/controladorEmpresa.php',
		type: "POST",
		dataType: 'html',
		async:true,
		data: {empresas:''},	
	}).done(function(respuesta){
		$("#datos").html(respuesta);
	}).fail(function(){
		console.log("error");
	});
	$.ajax({
		url: '../../co.Controlador/controladorAjax/controladorEmpresa.php',
		type: "POST",
		dataType: 'html',
		async:true,
		data: {paginacion:''},	
	}).done(function(respuesta){
		$("#paginacion").html(respuesta);
	}).fail(function(){
		console.log("error");
	});
	
};
function pasarpagina(id){
	$.ajax({
		url: '../../co.Controlador/controladorAjax/controladorEmpresa.php',
		type: "POST",
		dataType: 'html',
		async:true,
		data: {empresaspagina:'',p:id},	
	}).done(function(respuesta){
		$("#datos").html(respuesta);
	}).fail(function(){
		console.log("error");
	});
	$.ajax({
		url: '../../co.Controlador/controladorAjax/controladorEmpresa.php',
		type: "POST",
		dataType: 'html',
		async:true,
		data: {paginacionpagina:'',t:id},	
	}).done(function(respuesta){
		$("#paginacion").html(respuesta);
	}).fail(function(){
		console.log("error");
	});
}
function formulariocrear(){
	swal.fire({
		html:''+
		'<form method="POST" action="?controlador=empresa&accion=crear" enctype="multipart/form-data">'+
		'<div class="row"><div class="col-sm-1"></div>'+
		'<div class="col-sm-10">'+
		'<label for="" id="titulo" class="d-flex justify-content-center p-2 rounded-3 bg-secondary text-white">Agregar Negocio</label>'+
		'</div><div class="col-sm-1"></div></div><div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><h6>NIT: </h6></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><input class="form-control"  type="text"  name="nit" placeholder="Nit"></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><h6>NOMBRE: </h6></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><input class="form-control" type="text" name="nombre" placeholder="Nombre"></div><div class="col-sm-1"></div></div><div class="row">'+
		'<div class="col-sm-1"></div><div class="col-sm-10"><h6>DIRECCION: </h6></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><input class="form-control" type="text" name="direccion" placeholder="Direccion"></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><h6>TELEFONO: </h6></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><input class="form-control" type="text" name="telefono" placeholder="Telefono"></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><h6>CORREO: </h6></div><div class="col-sm-1"></div></div>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><input class="form-control" type="email" name="correo" placeholder="Correo"></div><div class="col-sm-1"></div></div><br/>'+
		'<div class="row"><div class="col-sm-1"></div><div class="col-sm-10"><input class="btn btn-secondary form-data" type="file" name="archivo[]" id="archivo[]" single="" required="true" ></div><div class="col-sm-1></div></div>'+
		'<div class="row"><div class="col-sm-1"></div></br><input class="btn btn-primary btn-mg " id="botonlg" type="submit" value="Crear"></div><div class="col-sm-5"></div><div class="col-sm-1"></div></div></form>',
		showConfirmButton:false
	})
}