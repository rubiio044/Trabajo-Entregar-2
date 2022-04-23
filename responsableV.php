<?php
class ResponsableV{
    private $nombre;
    private $apellido;
    private $numEmpleado;
    private $numLicencia;

//setters   
    public function setNumLicencia($numLicencia){
        $this->numLicencia = $numLicencia;
    }
    public function setNumEmpleado($numEmpleado){
        $this->numEmpleado = $numEmpleado;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
//getters 
    public function getNombre(){
        return $this->nombre;
    } 
    public function getApellido(){
        return $this->apellido;
    } 
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }
    public function getNumLicencia(){
        return $this->numLicencia;
    }

	public function __construct($nombre,$apellido,$numEmpleado,$numLicencia)
	{
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numEmpleado = $numEmpleado;
		$this->numLicencia = $numLicencia;
	}

	public function __toString()
	{
		return ("Responsable del viaje es: ".$this->getNombre()."\n".
				"Apellido: ".$this->getApellido()."\n".
				"Numero de empleado: ".$this->getNumEmpleado()."\n".
				"Numero de licencia: ".$this->getNumLicencia()."\n");
	}

}
?>