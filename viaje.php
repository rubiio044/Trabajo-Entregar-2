<?php
include "Pasajero.php";
include "ResponsableV.php";
class Viaje{
  
        //Atrivutos
        private $codigo;
        private $destino;
        private $cantMax;
        private $objPasajeros;
        private $Responsable;
        
        
        //Metodos
        public function __construct($codigo,$destino,$cantMax,){
          $this->codigo = $codigo;
          $this->destino = $destino;
          $this->cantMax = $cantMax;
          $this->objPasajeros =[]; 
          $this->Responsable = new ResponsableV("","","","");
        }
        public function getCodigo(){
          return $this->codigo;
        }
        public function getDestino(){
          return $this->destino;
        }
        public function getObjPasajeros(){
          return $this->objPasajeros;
        }
        public function getCantMax(){
          return $this->cantMax;
        }
        public function getResponsable(){
          return $this->Responsable;
        }
        public function setCodigo($codigo){
          $this->codigo = $codigo;
        }
        public function setDestino($destino){
          $this->destino = $destino;
        }
        public function setObjPasajeros($objPasajeros){
          $this->objPasajeros = $objPasajeros;
        }
        public function setResponsable($Responsable){
          $this->Responsable=$Responsable;
        }
        public function setCantMax($canMax){
          return $this->canMax = $canMax;
        }

        public function __toString(){
          $objResponsable=$this->getResponsable();
          $datosResponsable=$objResponsable->__toString();
          return ("Codigo: ".$this->getCodigo()."\n".
                  "Destino: ".$this->getDestino()."\n".
                  " Cantidad Maxima de Pasajeros: ".$this->getCantMax()."\n"
                  ."Pasajeros: \n".$this->mostrarPasajeros()."\n"
                  ."DATOS DEL RESPONSABLE: ".$datosResponsable."\n");
        }

      public function mostrarPasajeros(){
        $coleccion=$this->getObjPasajeros();
        $pasajeros="";

        for ($i=0;$i<count($coleccion);$i++){
            $personas=$coleccion[$i];
            $pasajeros=$pasajeros.$personas->__toString()."\n";
        }
        return $pasajeros;
      }


        //verifica si existe lugares disponibles para el viaje
              public function hayLugar(){
                return ($this->getCantMax() - count($this->getObjPasajeros()));
            }
          
          
            public function existeViaje($ingresoCodigo){
              return ($this->getCodigo()==$ingresoCodigo);
          }

          public function existeLugar(){
            return ($this->getCantMax()>count($this->getObjPasajeros()));
        }

        public function existeDni ($eseDni){
          $existe=false;
          $aux=$this->getObjPasajeros();
          $i=0;

          while($i<count($aux) && !$existe){
              $objPasajero=$aux[$i];
              if ($objPasajero->getDni()==$eseDni){
                  $existe=true;
              }
              $i++;
          }

          return $existe;
        }
        private function buscarDni($eseDni){
          $indice = -1;
          foreach ($this->getObjPasajeros() as $indice=>$elemento){
              if ($elemento->getDni()==$eseDni){
                  $indice=$indice;
              }
          }
          return $indice;
      }






    public function modificar($eseDni,$nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono){
      $indiceMod=$this->buscarDni($eseDni);
      if ($indiceMod > -1){
          $arrPasajeros=$this->getObjPasajeros();
          $objPasajero=$arrPasajeros[$indiceMod];
          $objPasajero->setNombre($nuevoNombre);
          $objPasajero->setApellido($nuevoApellido);
          $objPasajero->setDni($nuevoDni);
          $objPasajero->setTelfono($nuevoTelefono);
          $this->setObjPasajeros($arrPasajeros);
       }
     }
      public function agregarPasajero($Nombre,$Apellido,$Dni,$Telefono){
        $coleccion=$this->getObjPasajeros();        
        $nuevoPasajero=new Pasajero($Nombre,$Apellido,$Dni,$Telefono);
        $posicion=count($coleccion);

        $coleccion[$posicion]=$nuevoPasajero;
        $this->setObjPasajeros($coleccion);}
}

?>