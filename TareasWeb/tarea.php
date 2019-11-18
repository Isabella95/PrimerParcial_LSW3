<?php 
class Tarea{

    public $nombre = null;
    public $fechaCreacion = null;
    public $estado = null;

    public function __construct($nombre,$fechaCreacion,$estado)
    {
        $this->nombre = $nombre;
        $this->fechaCreacion = $fechaCreacion;
        $this->estado = $estado;
        
    }


    public static function crearTarea($arreglo){
        $tareas = new Tarea($arreglo["nombre"],$arreglo["fechaCreacion"],$arreglo["estado"]);
        return $tareas;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */ 
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }
}







 ?>