<?php
class BD{
    private static $instancia=null;

    public static function crearInstancia(){
        if(!isset(self::$instancia)){
            $opcionesPDO[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION;
            self::$instancia= new PDO('mysql:host=localhost;dbname=restaurantemesas','root','Evensoft41243509', $opcionesPDO);
            //echo "Conectado con exito";
        }
        return self::$instancia;
    }
}
    
?>