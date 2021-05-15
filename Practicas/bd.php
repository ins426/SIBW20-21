<?php
class BD{
    private static $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli("localhost","ins","123","SIBW");

        if($this->mysqli->connect_errno){
            echo("Fallo al conectar: " . $this->mysqli->connect_error);
        }
    }

    function getEvento(){ 

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            if(is_numeric($idEv)){
                try{
                    $q = "SELECT * FROM Eventos WHERE id = ?";
                    $statement = $this->mysqli->prepare($q);

                    $statement->bind_param('i',$idEv);
                    $statement->execute();

                    $res = $statement->get_result();

                    if($res->num_rows > 0){
                        $row = $res->fetch_assoc();
        
                        $evento = array('id'=>$row['id'],'nombre'=> $row['nombre'],'organizador'=>$row['organizador'],'horainicio'=>$row['horainicio'],'horafin'=>$row['horafin'],
                        'descripcion'=>$row['descripcion'],'fechainicio'=>$row['fechainicio'],'fechafin'=>$row['fechafin'],'icono'=>$row['icono']);
                    
                    }
                    else{
                        $evento = array('nombre' => 'XXX', 'organizador' => 'XXX','horainicio'=> 'X','horafin'=>'X','descripcion' => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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

    function getImagenesEvento(){

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            if(is_numeric($idEv)){
                try{
                    $q = "SELECT * FROM Imagenes WHERE id_ev =? AND pie IS NOT NULL";
                    $statement = $this->mysqli->prepare($q);

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
                        $imagenes[0]= array('nombre'=> 'internacional.jpg','id_ev'=>'1','pie'=>NULL);
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
        }else{
            $imagenes[0]= array('nombre'=> 'internacional.jpg','id_ev'=>'1','pie'=>NULL);
        }

        return $imagenes;
    }

    function getImagenesGaleria(){

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            if(is_numeric($idEv)){
                try{
                    $q = "SELECT * FROM Imagenes WHERE id_ev =? AND pie IS NULL";
                    $statement = $this->mysqli->prepare($q);

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
                        $imagenes[0]= array('nombre'=> 'internacional.jpg','id_ev'=>'1','pie'=>NULL);
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
        }else{
            $imagenes[0]= array('nombre'=> 'internacional.jpg','id_ev'=>'1','pie'=>NULL);
        }

        return $imagenes;
    }

    function getEventos(){

        try{
            $q = "SELECT * FROM Eventos";
            $statement = $this->mysqli->prepare($q);

            $statement->execute();

            $res = $statement->get_result();

            $i = 1;

            while($row = $res->fetch_assoc() ){
                $eventos[$i-1] = array('id' => $row['id'],'nombre'=> $row['nombre'],'organizador'=>$row['organizador'],'horainicio'=>$row['horainicio'],'horafin'=>$row['horafin'],
                'descripcion'=>$row['descripcion'],'fechainicio'=>$row['fechainicio'],'fechafin'=>$row['fechafin'],'icono'=>$row['icono']);
                $i = $i+1;
                    
                $statement = $this->mysqli->prepare("SELECT * FROM Eventos WHERE id =?");

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

    function getComentariosEvento(){

        if(isset($_GET['ev'])){
            $idEv = $_GET['ev'];

            try{
                $q = "SELECT * FROM Comentarios WHERE id_ev = ?";
                $statement = $this->mysqli->prepare($q);

                $statement->bind_param('i',$idEv);
                $statement->execute();

                $res = $statement->get_result();

                $i = 0;
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        $comentarios[$i]= array('id'=>$row['id'],'autor'=> $row['autor'],'email'=>$row['email'],'fecha'=>$row['fecha'],
                        'hora'=>$row['hora'],'comentario'=>$row['comentario']);
                        $i++;
                    }
                }
            }
            catch(Exception $e){
                error_log($e);
                exit("Error");
            }

        } 

        return $comentarios;
    }

    function getPalabrasProhibidas(){
        $q = "SELECT * FROM PalabrasProhibidas";
        $res = $this->mysqli->query($q);

        $i = 0;
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $palabras[$i] = array($row['palabra']);
                $i++;
            }
        }

        return $palabras;

    }

    function checkLogin($nick,$pass){
        $q = "SELECT * FROM Usuarios";
        $res = $this->mysqli->query($q);

        while($row = $res->fetch_assoc()){
            if($nick == $row['nick']){
                if(password_verify($pass,$row['pass'])){
                    return true;
                }
            }
        }
        return false;
    }

    function registrarUsuario($nick,$pass,$email){
        $comprobacion_nick = "SELECT * FROM Usuarios WHERE nick='".$nick."'";
        $comprobacion_email = "SELECT * FROM Usuarios WHERE nick='".$email."'";
        
        $res1 = $this->mysqli->query($comprobacion_nick);
        $res2 = $this->mysqli->query($comprobacion_email);

        if($res1->$num_rows > 0 || $res2->$num_rows > 0){
            return false;
        }
        else{
            $password = password_hash($pass,$PASSWORD_DEFAULT);
            $moderador = "false";
            $gestor = "false";
            $super = "false";

            $inserta = "INSERT INTO Usuarios (nick,pass,super,moderador,gestor,email) VALUES('".$nick."', '".$password."',".$super.",".$moderador.",".$gestor.",'".$email."')";
            $res = $this->mysqli->query($inserta);
            return true;
        }
        
    }

    function getUsuario($nick){
        $q = "SELECT * FROM Usuarios WHERE nick='".$nick."'";
        $res = $this->mysqli->query($q);

        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $usuario = array('nick'=>$row['nick'],'email'=>$row['email'],'super'=>$row['super'],'moderador'=>$row['moderador'],'gestor'=>$row['gestor'],'pass'=>$row['pass']);
            return $usuario;
        }
        else{
            $usuario = array('nick'=>'XXX','email'=>'XXX','super'=>0,'moderador'=>0,'gestor'=>0);
            return $usuario;
        }
        
    }

    function editarUsuario($nick,$email,$pass, $usuario_anterior){

        $comprobacion = "SELECT * FROM Usuarios WHERE nick='$nick'";
        $res = $this->mysqli->query($comprobacion);

        if($res->num_rows > 0){
            return false;
        }
        else{
            if($email == NULL){
                $email = $usuario_anterior['email'];
            }
    
            if($pass == NULL){
                $contraseña = $usuario_anterior['pass']; 
            }
            else{
                $contraseña = password_hash($pass,$PASSWORD_DEFAULT);
            }
    
            if($nick == NULL){
                $nick =  $usuario_anterior['nick'];
            }
    
            $q = "UPDATE Usuarios SET email='$email',nick='$nick',pass='$contraseña' WHERE nick='$usuario_anterior[nick]'";
            $this->mysqli->query($q);

            return true;
        }
       
    }

    function aniadirComentario($id, $nick,$email, $comentario){
        $fecha = date("d/m/Y");
        $hora = date("H:i");

        $q = "INSERT INTO Comentarios (autor,email,fecha,hora,comentario,id_ev) VALUES('$nick','$email','$fecha','$hora','$comentario',$id)";
        $this->mysqli->query($q);
    }

    function borrarComentario($id){
        $q = "DELETE FROM Comentarios WHERE id = $id";
        echo "HOLAAAAAAA $q";
        $this->mysqli->query($q);
    }

}

?>