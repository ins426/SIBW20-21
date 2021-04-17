<?php
class BD{
    private static $mysqli;
/***********************************************************************************************/
    public function __construct() {
        $this->$mysqli = new mysqli("localhost","ins","123","SIBW");

        if($this->$mysqli->connect_errno){
            echo("Fallo al conectar: " . $this->$mysqli->connect_error);
        }
    }
/***********************************************************************************************/
    function getEvento(){ 

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            if(is_numeric($idEv)){
                try{
                    $q = "SELECT * FROM Eventos WHERE id = ?";
                    $statement = $this->$mysqli->prepare($q);

                    $statement->bind_param('i',$idEv);
                    $statement->execute();

                    $res = $statement->get_result();

                    if($res->num_rows > 0){
                        $row = $res->fetch_assoc();
        
                        $evento = array('nombre'=> $row['nombre'],'organizador'=>$row['organizador'],'horainicio'=>$row['horainicio'],'horafin'=>$row['horafin'],
                        'descripcion'=>$row['descripcion'],'fechainicio'=>$row['fechainicio'],'fechafin'=>$row['fechafin'],'icono'=>$row['icono']);
                    
                    }
                    else{
                        $evento = array('nombre' => 'XXX', 'organizador' => 'XXX','horainicio'=> 'X','horafin'=>'X','descripcion' => 'X',
                        'fechainicio' => 'X', 'fechafin'=>'X'); 
                    }
                }
                catch(Exception $e){
                    error_log($e);
                    exit("Error");
                }
            }
            else{
                http_response_code(500);
                die("Error estableciendo conexión con la BD");
            }
        }
        else{
            $evento = array('nombre' => 'XXX', 'organizador' => 'XXX','horainicio'=> 'X','horafin'=>'X','descripcion' => 'X',
            'fechainicio' => 'X', 'fechafin'=>'X'); 
        }
        return $evento;
    }
/***********************************************************************************************/
    function getImagenesEvento(){

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            if(is_numeric($idEv)){
                try{
                    $q = "SELECT * FROM Imagenes WHERE id_ev =? AND pie IS NOT NULL";
                    $statement = $this->$mysqli->prepare($q);

                    $statement->bind_param('i',$idEv);
                    $statement->execute();

                    $res = $statement->get_result();

                    $i = 0;
                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            $imagenes[$i]= array('nombre'=> $row['nombre'],'id_ev'=>$row['id_ev'],'pie'=>$row['pie']);
                            $i++;
                        }
                    }
                    else{
                        //??
                    }
                }
                catch(Exception $e){
                    error_log($e);
                    exit("Error");
                }   
            }
            else{
                //?
            }
        }else{
           //?
        }

        return $imagenes;
    }
/***********************************************************************************************/
    function getEventos(){

        try{
            $q = "SELECT * FROM Eventos";
            $statement = $this->$mysqli->prepare($q);

            $statement->execute();

            $res = $statement->get_result();

            $i = 1;

            while($row = $res->fetch_assoc() ){
                $eventos[$i-1] = array('nombre'=> $row['nombre'],'organizador'=>$row['organizador'],'horainicio'=>$row['horainicio'],'horafin'=>$row['horafin'],
                'descripcion'=>$row['descripcion'],'fechainicio'=>$row['fechainicio'],'fechafin'=>$row['fechafin'],'icono'=>$row['icono']);
                $i = $i+1;
                    
                $statement = $this->$mysqli->prepare("SELECT * FROM Eventos WHERE id =?");

                $statement->bind_param('i',$i);
                $statement->execute();
        
                $res = $statement->get_result();
            }
            
        }
        catch(Exception $e){
            error_log($e);
            exit("Error");
        }
        

        return $eventos;
    }
/***********************************************************************************************/
    function getComentariosEvento(){

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            try{
                $q = "SELECT * FROM Comentarios WHERE id_ev = ?";
                $statement = $this->$mysqli->prepare($q);

                $statement->bind_param('i',$idEv);
                $statement->execute();

                $res = $statement->get_result();

                $i = 0;
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        $comentarios[$i]= array('autor'=> $row['autor'],'email'=>$row['email'],'fecha'=>$row['fecha'],
                        'hora'=>$row['hora'],'comentario'=>$row['comentario']);
                        $i++;
                    }
                }
            }
            catch(Exception $e){
                error_log($e);
                exit("Error");
            }

        }else{
            //?
        } 

        return $comentarios;
    }
/***********************************************************************************************/
}

?>