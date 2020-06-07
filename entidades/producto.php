<?php
class Producto{
    private $idproducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $descripcion;
    private $fk_idtipoproducto;
    

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
        $this->idproducto = isset($request["id"])? $request["id"] : "";
        $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] : "";
        $this->cantidad = isset($request["txtCantidad"])? $request["txtCantidad"]: "";
        $this->precio = isset($request["txtPrecio"])? $request["txtPrecio"] : "";
        $this->descripcion = isset($request["txtDescripcion"])? $request["txtDescripcion"] : "";
        $this->fk_idtipoproducto = isset($request["lstTipoProducto"])? $request["lstTipoProducto"] : "";
       
    }

    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "INSERT INTO productos (nombre, cantidad, precio, descripcion, fk_idtipoproducto) VALUES ('" . $this->nombre ."', " . $this->cantidad .", " . $this->precio . ", '" . $this->descripcion ."', ". $this->fk_idtipoproducto .");";
        $mysqli->query($sql);
        $this->idproducto = $mysqli->insert_id;
        $mysqli->close();
    }

    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM productos WHERE idproducto = " . $this->idproducto;
        $mysqli->query($sql);
        $mysqli->close();
    }

    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idproducto, nombre, cantidad, precio, descripcion, fk_idtipoproducto FROM productos WHERE idproducto = " . $this->idproducto;
        $resultado = $mysqli->query($sql);

        //Convierte el resultado
        if($fila = $resultado->fetch_assoc()){

        $this->nombre = $fila["nombre"];
        $this->cantidad = $fila["cantidad"];
        $this->precio = $fila["precio"];
        $this->descripcion = $fila["descripcion"];
        $this->fk_idtipoproducto = $fila["fk_idtipoproducto"];

        
        }
        $mysqli->close();

    }

    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE productos
                SET
                nombre = '".$this->nombre."',
                cantidad = '.$this->cantidad .',
                precio = '.$this->precio.',
                descripcion = '".$this->descripcion."',
                fk_idtipoproducto = '.$this->fk_idtipoproducto.',
                WHERE idproducto = " . $this->idproducto;
        $mysqli->query($sql);
        $mysqli->close();
    }

    public function obtenerTodos(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idproducto, nombre, cantidad, precio, descripcion, fk_idtipoproducto FROM productos";
        $resultado = $mysqli->query($sql);

        $aResultado = array();
        if($resultado){
            //Convierte el resultado en un array asociativo
            while($fila = $resultado->fetch_assoc()){
                $productoAux = new Producto();
                $productoAux->idproducto = $fila["idproducto"];
                $productoAux->nombre = $fila["nombre"];
                $productoAux->cantidad = $fila["cantidad"];
                $productoAux->precio = $fila["precio"];
                $productoAux->descripcion = $fila["descripcion"];
                $productoAux->fk_idtipoproducto = $fila["fk_idtipoproducto"];
                $aResultado[] = $productoAux;
            }
        }
        return $aResultado;
    }

    public function obtenerUnoPorId($id){
        $obj = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $consulta = "SELECT 
            idproducto,
            nombre,
            cantidad,
            precio,
            descripcion 
            FROM productos WHERE idproducto = $id";
            //print_r($consulta);exit;
        $resultado = $obj->query($consulta);

        $fila = $resultado->fetch_assoc();

        $this->idproducto = $fila["idproducto"];
        $this->nombre = $fila["nombre"];
        $this->cantidad = $fila["cantidad"];
        $this->precio = $fila["precio"];
        $this->descripcion = $fila["descripcion"];
        
        return true;
    }
    

}
