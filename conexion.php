<?php

class Conexion
{
    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $bd = "album";
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->bd", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return "Falla de conexión" . $e;
        }
    }

    public function ejecutar($sql) // Insertar,Delete,Actualizar
    {
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }
    public function consultar($sql) //Consultar
    {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        // fetchAll retorna todos los registros
        return $sentencia->fetchAll();
    }
}
