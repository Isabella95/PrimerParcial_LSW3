<?php 
class Persona{

	public $cedula = null;
 
    public function __construct($cedula)
    {
        $this->cedula = $cedula;
      
    }

    /**
     * Get the value of cedula
     */ 
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set the value of cedula
     *
     * @return  self
     */ 
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

  
}




 ?>