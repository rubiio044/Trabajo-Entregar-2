<?php

include "Viaje.php";

function existeViaje($viajes, $codigo){
    
  $i = 0;
  $cantidad = count($viajes);
  $existe = false;
  while ($i < $cantidad && !$existe) {
      $objViaje = $viajes[$i];
      if ($objViaje->existeViaje($codigo)) {
          $existe = true;
      }
      $i++;
  }
  return $existe;
}

function encontrarViaje($viajes, $codigo){
  $i = 0;
  $cantidad = count($viajes);
  $encontrado = false;
  while ($i < $cantidad && !$encontrado) {
      $objViaje = $viajes[$i];
      if ($objViaje->getCodigo() == $codigo) {
          $encontrado = true;
      }
      $i++;
  }
  return $objViaje;
}




function viajeNuevo($viajes){
$cantidad=count($viajes);

echo "ingrese el codigo del nuevo viaje:";
$codigo=trim(fgets(STDIN));

if (existeViaje($viajes,$codigo)){
echo "codigo existente, ingrese otro codigo \n";
}else{
  echo "ingrese el destino del viaje:";
  $destino=trim(fgets(STDIN));
  echo"ingrese cantidad maxima de pasajeros del viaje:";
  $cantMax=trim(fgets(STDIN));

$nuevoObjViaje=new Viaje($codigo,$destino,$cantMax);
$viajes[$cantidad]=$nuevoObjViaje;
echo "viaje nuevo creado";

}
return $viajes;


}


function mostrarViajes($viajes){
  $cantidad = count($viajes);
 
  foreach ($viajes as $ver) {
      echo $ver;
  }
}


function mostrarDatos($viajes){
  $cantidad = count($viajes);

  echo "ver datos \n";
  echo "################# \n";
  echo "Ingresar un codigo: ";
  $codigo = trim(fgets(STDIN));
  if (existeViaje($viajes, $codigo)) {
      $objViaje = encontrarViaje($viajes, $codigo);
      echo $objViaje;
  } else {
      echo "no existe ese: " . $codigo . "\n";
  }
}


function aniadirPasajero($viajes){
  $viajes = count($viajes);

  echo "aniadir pasajero nuevo \n";
  echo "######################## \n";
  echo "ingresar codigo: ";
  $codigo = trim(fgets(STDIN));
  if (existeViaje($viajes, $codigo)) {
      $objViaje = encontrarViaje($viajes, $codigo);

      if ($objViaje->disponibilidad()>0){
      echo "Ingresar dni: ";
      $dni = trim(fgets(STDIN));
      if ($objViaje->existeDni($dni)) {
          echo "pasajero ya existe \n";
      } else {
          echo "Ingrese el nombre: ";
          $nombre = trim(fgets(STDIN));
          echo "Ingrese el apellido: ";
          $apellido = trim(fgets(STDIN));
          echo "Ingrese el telefono: ";
          $telefono = trim(fgets(STDIN));
          $objViaje->agregarPasajero($nombre, $apellido, $dni, $telefono);
      }     
    }
  }
}
    function mostrarPasajeros($viajes){
      $cantidad = count($viajes);
  
      echo "pasajeros abordo del viaje \n";
      echo "#################################\n";
      echo "Ingrese un codigo : ";
      $codigo = trim(fgets(STDIN));
      if (existeViaje($viajes, $codigo)) {
          $objViaje = encontrarViaje($viajes, $codigo);
          echo $objViaje->mostrarPasajeros();
      } else {
          echo "codigo incorrecto:" . $codigo . "\n";
      }
  }

  function modificarDatosViaje ($viajes){
    $cantidad = count($viajes);

    echo "*************************** \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($viajes, $codigo)) {
        $objViaje = encontrarViaje($viajes, $codigo);
        echo $objViaje;
        echo "Ingrese destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingrese cantidad de pasajeros maxima: ";
        $cantidad = trim(fgets(STDIN));
        $objViaje->setDestino($destino);
        $objViaje->setCantMaxPasajeros($cantidad);
        echo"viaje modificado vuelva pronto \n";
        echo $objViaje;
    } else {
        echo "codigo incorrecto: " . $codigo . "\n";
    }
  }

    function modificarDatosPasajero($viajes){
      $cant = count($viajes);
  
      echo "modificar datos \n";
      echo "################################ \n";
      echo "Ingrese un codigo: ";
      $codigo = trim(fgets(STDIN));
      if (existeViaje($viajes, $codigo)) {
          $objViaje =encontrarViaje($viajes, $codigo);
          echo $objViaje;
          echo "Ingrese el DNI del pasajero: ";
          $eseDni=trim(fgets(STDIN));
          if ($objViaje->existeDni($eseDni)){
              echo "Ingrese nuevo Nombre: ";
              $nuevoNombre=trim(fgets(STDIN));
              echo "Ingrese nuevo Apellido: ";
              $nuevoApellido=trim(fgets(STDIN));
              echo "Ingrese nuevo DNI: ";
              $nuevoDni=trim(fgets(STDIN));
              echo "Ingrese nuevo Telefono: ";
              $nuevoTelefono=trim(fgets(STDIN));
              
              $objViaje->modificarPasajero($eseDni,$nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono);
  
          }else{
              echo$eseDni." NO EXISTE \n";
          }
      }
  }
  
//la mayoria de los viajes guardados no tienen responsables
//esta apcion de agregarlos
function AniadirResponsable($viajes){
    $cantidad=count($viajes);

    echo "RESPONSABLE DEL VIAJE \n";
    echo "################################ \n";
    echo "Ingrese un codigo : ";
    $codigo = trim(fgets(STDIN));
    if (existeViaje($viajes, $codigo)) {
        $objViaje = encontrarViaje($viajes, $codigo);
        
       
        echo "Ingrese Nombre: ";
        $nombre=trim(fgets(STDIN));
        echo "Ingrese Apellido: ";
        $apellido=trim(fgets(STDIN));
        echo "Ingrese numero Legajo: ";
        $numLegajo=trim(fgets(STDIN));
        echo "Ingrese numero Licencia: ";
        $numLicencia=trim(fgets(STDIN));

        $objResponsable=new ResponsableV($nombre,$apellido,$numLegajo,$numLicencia);
        $objViaje->setResponsable($objResponsable);

    }}

function menu(){
  /** @var int $opcion 
   *@var boolean $esValido */
  $esValido = false;

  echo "--------------------------------------------------------------";
  echo "\n ( 1 ) Nuevo viaje";
  echo "\n ( 2 ) Modificar datos del viaje";
  echo "\n ( 3 ) Modificar datos de los pasajeros";
  echo "\n ( 4 ) Ver los datos del viaje";
  echo "\n ( 5 ) Ver todos los viajes";
  echo "\n ( 6 ) cargar al responsable del viaje";
  echo "\n ( 7 ) salir del programa";
  echo "\n--------------------------------------------------------------\n";
  echo "\n"." Ingrese una opcion: " . "\n";

  do {
      $opcion = trim(fgets(STDIN));

      if ($opcion >= 1 && $opcion <= 7) {
          $esValido = true;
      } else {
          echo "Ingrese una opcion valida." . "\n";
      }
  } while (!$esValido);

  return $opcion;
}







        //menu principal
#######################################################################################       





//**********coleccion de viajes*****************/

$viajes = [];
$viajes[0]=new Viaje ("1","neuquen",3);
$viajes[1]=new Viaje ("2","cipolleti",5);
$viajes[2]=new Viaje ("10","cinco saltos",1);
$viajes[3]=new Viaje ("23","catriel",2);

$viajes[3]->agregarPasajero("jorge","luck",368415417,2995229821);
$viajes[3]->agregarPasajero("lionel","messi",36816768,2995229822);


$viajes[0]->agregarPasajero("cristiano","ronaldo",36816769,2995229823);
$viajes[0]->agregarPasajero("charly","garcia",36816763,2995229824);
$viajes[0]->agregarPasajero("luca","prodan",36816764,2995229825);

$viajes[1]->agregarPasajero("amadeuz","mozart",36816765,2995229826);
$viajes[1]->agregarPasajero("carlos","solari",36816769,2995229832);   
$viajes[1]->agregarPasajero("leonardo","ponzio",36816769,2995229845);

$viajes[2]->agregarPasajero("marcelo","gallardo",36816769,2995229812);


    //Switch creado para elejir entre las opciones del menu
    do {
        $opcion = menu();
      
        switch ($opcion) { 
            case 1: 
              viajeNuevo($viajes);
            break;
            
            case 2:

              modificarDatosViaje($viajes);
                break;
            case 3:
              modificarDatosPasajero($viajes);
                break;
          
            case 4:
              mostrarDatos($viajes);
              break;

            case 5:
              mostrarViajes($viajes);
              break;
          
            case 6: 
              AniadirResponsable($viajes);
                 
            break;
            case 7: 
            echo "usted a salido del programa \n";
            echo "nadie te quiere";
                 
            break;
            }
          }
          
              
      
    
    while ($opcion !=7);