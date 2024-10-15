<link rel="stylesheet" href="../../Resources/css/Desarrollador/empresa.css">

<div class="row titulo mt-2">
	<div class="col-sm-1"></div>
	<div class="col-sm-10 d-flex justify-content-center text-white border border-primary-subtle rounded-3">
		<h1>EMPRESAS</h1>
	</div>
	<div class="col-sm-1"></div>
</div>
<br>

<div class="row">
	<div class="col-1"></div>
	<div class="col-9 d-flex justify-content-center ">
		<div class="input-group mb-3">
			<span class="input-group-text icon-search" id="basic-addon1"></span>
			<input type="text" class="form-control" placeholder="busqueda" aria-label="Username" aria-describedby="basic-addon1">
		</div>
	</div>
	<div class="col-1"><a class="add btn btn-primary icon-plus " onclick="formulariocrear()" > ADD</a></div>
	<div class="col-1"></div>
</div>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<nav aria-label="Page navigation example">
			<ul class="pagination" id="paginacion">
				<li class="page-item" >
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>		
	</div>
	<div class="col-sm-1"></div>
</div>

<div class="row">
	<div class="col-1"></div>
	<div class="col-10">
		<table class="table">
			<thead >
				<tr>
					<th>NIT</th>
					<th>NOMBRE</th>
					<th>DIRCCION</th>
					<th>TELEFONO</th>
					<th>CORREO</th>
					<th>LOGO</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="datos">
				
			</tbody>
		</table>		
	</div>
	<div class="col-1"></div>
</div>

<script src="../../Resources/js/Desarrollador/empresa.js"></script>