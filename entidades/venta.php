<?php

class Venta
{

    private $idventa;
    private $fk_idcliente;
    private $fk_idproducto;
    private $fecha;
    private $cantidad;
    private $preciounitario;
    private $total;


    public function __construct()
    {
    }
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
        return $this;
    }


    public function cargarFormulario($request)
    {

        $this->idventa = isset($request["id"]) ? $request["id"] : "";
        $this->fk_idcliente = isset($request["lstCliente"]) ? $request["lstCliente"] : "";
        $this->fk_idproducto = isset($request["lstProducto"]) ? $request["lstProducto"] : "";
        $this->fecha = isset($request["txtFecha"]) ? $request["txtFecha"] . " " . $request["txtHora"] : "";
        $this->cantidad = isset($request["txtCantidad"]) ? $request["txtCantidad"] : "";
        $this->preciounitario = isset($request["txtPrecioUnitario"]) ? $request["txtPrecioUnitario"] : "";
        $this->total = isset($request["txtTotal"]) ? $request["txtTotal"] : "";
    }

    public function insertar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "INSERT INTO ventas (fk_idcliente, fk_idproducto, fecha, cantidad, preciounitario, total) 
                VALUES 
               (" . $this->fk_idcliente . ",
                " . $this->fk_idproducto . ", 
                '" . $this->fecha . "', 
                " . $this->cantidad . ",
                " . $this->preciounitario . ",
                " . $this->total . "
        );";
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        
        $this->idventa = $mysqli->insert_id;
        $mysqli->close();
    }

    public function eliminar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "DELETE FROM ventas WHERE idventa = " . $this->idventa;
        $mysqli->query($sql);
        $mysqli->close();
    }

    public function obtenerPorId()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idventa, fk_idcliente, fk_idproducto, fecha, cantidad, preciounitario, total FROM ventas WHERE idventa = " . $this->idventa;
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        //Convierte el resultado
        if ($fila = $resultado->fetch_assoc()) {

            $this->fk_idcliente = $fila["fk_idcliente"];
            $this->fk_idproducto = $fila["fk_idproducto"];
            $this->fecha = $fila["fecha"];
            $this->cantidad = $fila["cantidad"];
            $this->preciounitario = $fila["preciounitario"];
            $this->total = $fila["total"];
        }
        $mysqli->close();
    }

    public function actualizar()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "UPDATE ventas
                SET
                fk_idcliente = '.$this->fk_idcliente.',
                fk_idproducto = '.$this->fk_idproducto.',
                fecha = '" . $this->fecha . "',
                cantidad = '.$this->cantidad .',
                preciounitario = '.$this->preciounitario.',
                total = '.$this->total.',
                WHERE idventa = " . $this->idventa;


        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerTodos()
    {
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        $sql = "SELECT idventa, fk_idcliente, fk_idproducto, fecha, cantidad, preciounitario, total FROM ventas";
        if (!$resultado = $mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $aResultado = array();
        if ($resultado) {
            //Convierte el resultado en un array asociativo
            while ($fila = $resultado->fetch_assoc()) {
                $ventaAux = new Venta();
                $ventaAux->idventa = $fila["idventa"];
                $ventaAux->fk_idcliente = $fila["fk_idcliente"];
                $ventaAux->fk_idproducto = $fila["fk_idproducto"];
                $ventaAux->fecha = $fila["fecha"];
                $ventaAux->cantidad = $fila["cantidad"];
                $ventaAux->preciounitario = $fila["preciounitario"];
                $ventaAux->total = $fila["total"];
                $aResultado[] = $ventaAux;
            }
        }
        return $aResultado;
    }
}
