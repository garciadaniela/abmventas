<?php
class Tipoproducto {
    private $idtipoproducto;
    private $nombre;

    public function __construct(){

    }
    public function __get($atributo) {
        return $this->$atributo;
        }
        
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    } 


    public function cargarFormulario($request){
        $this->idtipoproducto = isset($request["id"])? $request["id"] : "";
        $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] : "";
        
    }

    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "INSERT INTO tipo_productos (nombre) VALUES ('" . $this->nombre ."');";
        $mysqli->query($sql);
        $this->idtipoproducto = $mysqli->insert_id;
        $mysqli->close();
    }

    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM tipo_productos WHERE idtipoproducto = " . $this->idtipoproducto;
        $mysqli->query($sql);
        $mysqli->close();
    }


    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idtipoproducto, nombre FROM tipo_productos WHERE idtipoproducto = " . $this->idtipoproducto;
        $resultado = $mysqli->query($sql);

        
        //Convierte el resultado
        if($fila = $resultado->fetch_assoc()){

        $this->nombre = $fila["nombre"];
        

        }
        $mysqli->close();

    }

    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE tipo_productos
                SET
                nombre = '".$this->nombre."',
                WHERE idtipoproducto = " . $this->idtipoproducto;
        $mysqli->query($sql);
        $mysqli->close();
    }
  
    public function obtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idtipoproducto, nombre FROM tipo_productos";
        $resultado = $mysqli->query($sql);

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo
            while($fila = $resultado->fetch_assoc()){
                $tipoproductoAux = new Tipoproducto();
                $tipoproductoAux->idtipoproducto = $fila["idtipoproducto"];
                $tipoproductoAux->nombre = $fila["nombre"];
               
                $aResultado[] = $tipoproductoAux;
            }
        }
        return $aResultado;
    }




}





?>