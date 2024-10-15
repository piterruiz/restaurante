<?php 

class Impresora
{
	public $nombre_impresora;

	public function __construct($nombre_impresora)
	{

		$this->nombre_impresora=$nombre_impresora;
		
	}
	public function nombre(){
		//$nombre_impresora="XP-58C";
		$nombre_impresora="POS-58";
		return $nombre_impresora;
	}

}
?>