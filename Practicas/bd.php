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
                        'hora'=>$row['hora'],'comentario'=>$row['comentario'], 'id_ev'=>$row['id_ev'],'modificado'=>$row['modificado']);
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

        $q = "INSERT INTO Comentarios (autor,email,fecha,hora,comentario,id_ev,modificado) VALUES('$nick','$email','$fecha','$hora','$comentario',$id,0)";
        $this->mysqli->query($q);
    }

    function borrarComentario($id){
        $q = "DELETE FROM Comentarios WHERE id = $id";
        $this->mysqli->query($q);
    }

    function getComentario($id){
        $q = "SELECT * FROM Comentarios WHERE id = $id";
        $res = $this->mysqli->query($q);

        if($res->num_rows > 0){       
            $row = $res->fetch_assoc();
            $comentario = array('id'=>$row['id'],'comentario'=>$row['comentario'],'id_ev'=>$row['id_ev']);
        }else{

            $comentario = array('comentario'=>'XXXXXX','id_ev'=>-1);
        }

        return $comentario;
    }

    function editarComentario($id, $comentario){
        $q = "UPDATE Comentarios SET comentario='$comentario',modificado=1 WHERE id=$id";
        $this->mysqli->query($q);
    }

    function getComentarios(){
        $q = "SELECT * FROM Comentarios";
        $res = $this->mysqli->query($q);

        $i = 1;
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $comentarios[$i] = array('id'=>$row['id'],'comentario'=>$row['comentario'],'id_ev'=>$row['id_ev']-1, 'autor'=>$row['autor'], 'email'=>$row['email'],'modificado'=>$row['modificado'],'fecha'=>$row['fecha'],'hora'=>$row['hora']);
                $i++;
            }
        }else{
            $comentarios[$i] = array('comentario'=>'XXXXXX','id_ev'=>-1,'autor'=>'XXXXX', 'email'=>'XXXXX','modificado'=>0,'fecha'=>'XX-XX-XXXX','hora'=>'XX:XX');
        }

        return $comentarios;
    }

    function buscaComentarios($autor){
        $q = "SELECT * FROM Comentarios WHERE autor='$autor'";
        $res = $this->mysqli->query($q);

        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $comentarios[$i] = array('id'=>$row['id'],'comentario'=>$row['comentario'],'id_ev'=>$row['id_ev']-1, 'autor'=>$row['autor'], 'email'=>$row['email'],'modificado'=>$row['modificado'],'fecha'=>$row['fecha'],'hora'=>$row['hora']);
                $i++;
            }
        }else{
            $comentarios= NULL;
        }

        return $comentarios;
    }

    function uploadImagen($imagen){
        $file_size = $_FILES['icono']['size'];
        $file_tmp = $_FILES['icono']['tmp_name'];
        $file_type = $_FILES['icono']['type'];
        $file_ext = strtolower(end(explode('.',$_FILES['icono']['name'])));

        $extensions = array ('jpeg','jpg','png');

        if(in_array($file_ext,$extensions) == true && $file_size < 2097152 ){
            return true;
        }
        else{
            return false;
        }
    }

    function aniadirEvento(){

        /***************************INSERCIÓN DE LA INFORMACIÓN DEL EVENTO ************************************/
        if(isset($_FILES['icono'])){
            $file_name = $_FILES['icono']['name'];
            $file_size = $_FILES['icono']['size'];
            $file_tmp = $_FILES['icono']['tmp_name'];
        
            $subirimagen = self::uploadImagen($_FILES['icono']);

            if($subirimagen){
                move_uploaded_file($file_tmp, "img/" . $file_name);
            }else{
                $file_name = 'internacional.jpg';
            }
        }else{
            $file_name = 'internacional.jpg';
        }

        $nombre =  $_POST['nombre'];
        $organizador = $_POST['organizador'];
        $horainicio = $_POST['horainicio'];
        $horafin = $_POST['horafin'];
        $descripcion = $_POST['descripcion'];
        $fechainicio = $_POST['fechainicio'];
        $fechafin = $_POST['fechafin'];

        $q = "SELECT id FROM Eventos ORDER BY id DESC LIMIT 1";
        $res = $this->mysqli->query($q);
        $row = $res->fetch_assoc();
        $id_ultimo = $row['id'];

        $q = "ALTER TABLE Eventos AUTO_INCREMENT = $id_ultimo";
        $this->mysqli->query($q);

        $q = "INSERT INTO Eventos (nombre,organizador,horainicio,horafin,descripcion,fechainicio,fechafin,icono) VALUES ('$nombre','$organizador',
                                    '$horainicio','$horafin','$descripcion','$fechainicio','$fechafin','$file_name')";
        $this->mysqli->query($q);

        //Para obtener el id del nuevo evento insertado
        $q = "SELECT id FROM Eventos ORDER BY id DESC LIMIT 1";
        $res = $this->mysqli->query($q);
        $row = $res->fetch_assoc();
        $id = $row['id'];

        /*********************************INSERCIÓN DE ETIQUETAS************************************** */
        self::aniadirEtiquetas($id);

        /*********************************INSERCIÓN DE IMÁGENES*************************************** */
        //Para obtener la id de la última imagen insertada
        $q = "SELECT id FROM Imagenes ORDER BY id DESC LIMIT 1";
        $res = $this->mysqli->query($q);
        $row = $res->fetch_assoc();
        $id_ultimo_img = $row['id'];
        $q = "ALTER TABLE Imagenes AUTO_INCREMENT = $id_ultimo_img";
        $this->mysqli->query($q);

        /****************************************IMAGEN 1***********************************************/
        if(isset($_FILES['imagen1'])){
            $file_name = $_FILES['imagen1']['name'];
            $file_size = $_FILES['imagen1']['size'];
            $file_tmp = $_FILES['imagen1']['tmp_name'];
        
            $subirimagen = self::uploadImagen($_FILES['imagen1']);

            if($subirimagen){
               move_uploaded_file($file_tmp, "img/" . $file_name);
            }else{
                $file_name = 'internacional.jpg';
            }
        }else{
            $file_name = 'internacional.jpg';
        }
        $pie1 = $_POST['pie1'];
        $q = "INSERT INTO Imagenes(nombre,id_ev,pie) VALUES ('$file_name',$id,'$pie1')";
        $this->mysqli->query($q);
        /****************************************IMAGEN 2***********************************************/
        if(isset($_FILES['imagen2'])){
            $file_name = $_FILES['imagen2']['name'];
            $file_size = $_FILES['imagen2']['size'];
            $file_tmp = $_FILES['imagen2']['tmp_name'];
        
            $subirimagen = self::uploadImagen($_FILES['imagen2']);

            if($subirimagen){
                move_uploaded_file($file_tmp, "img/" . $file_name);
            }else{
                $file_name = 'internacional.jpg';
            }
        }else{
            $file_name = 'internacional.jpg';
        }
        $pie2 = $_POST['pie2'];
        $q = "INSERT INTO Imagenes(nombre,id_ev,pie) VALUES ('$file_name',$id,'$pie2')";
        $this->mysqli->query($q);
        /****************************************GALERÍA***********************************************/
        $n_imagenes = 2;

         for($i=0;$i<$n_imagenes;$i++){
            $filename = $_FILES['upload']['name'][$i];
            move_uploaded_file($_FILES['upload']['tmp_name'][$i], "img/" . $filename);
            
            $q = "INSERT INTO Imagenes(nombre,id_ev) VALUES ('$filename',$id)";
            $this->mysqli->query($q);
        }
    }

    function editarEvento($id){
        $nombre = $_POST['nombre'];
        $organizador = $_POST['organizador'];
        $horainicio = $_POST['horainicio'];
        $horafin = $_POST['horafin'];
        $descripcion = $_POST['descripcion'];
        $fechainicio = $_POST['fechainicio'];
        $fechafin = $_POST['fechafin'];

        $q = "UPDATE Eventos SET nombre='$nombre',organizador='$organizador',horainicio='$horainicio', horafin='$horafin',
        descripcion='$descripcion',fechainicio='$fechainicio',fechafin='$fechafin' WHERE id=$id";

        $this->mysqli->query($q);
    }

    function borrarEvento($id){
        $q = "DELETE FROM Imagenes WHERE id_ev=$id";
        $this->mysqli->query($q);
        $q = "DELETE FROM Etiquetas WHERE id_ev=$id";
        $this->mysqli->query($q);
        $q = "DELETE FROM Eventos WHERE id=$id";
        $this->mysqli->query($q);
    }

    function getEtiquetas($id){
        $q = "SELECT * FROM Etiquetas WHERE id_ev=$id";
        $res = $this->mysqli->query($q);

        $i = 0;
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $etiquetas[$i] = array('id'=>$row['id'],'texto'=>$row['texto'],'id_ev'=>$row['id_ev']);
                $i++;
            }
        }else{
            $etiquetas= NULL;
        }

        return $etiquetas;
    }

    function aniadirEtiquetas($id_ev) {
        $etiquetas = explode(',', $_POST['etiquetas']);

        if(is_array($etiquetas)) {
            foreach($etiquetas as $etiqueta) {
                $q = "INSERT INTO Etiquetas (id_ev,texto) VALUES ('$id_ev', '$etiqueta')";
                $this->mysqli->query($q);
            }
        }
        else {
            $q = "INSERT INTO Etiquetas (id_ev,texto) VALUES ('$id_ev', '$etiquetas')";
            $this->mysqli->query($q);
        }
    }

    function getUsuarios(){
        $q = "SELECT * FROM Usuarios";
        $res = $this->mysqli->query($q);

        $i = 0;
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $usuarios[$i] = array('nombre'=>$row['nick'],'super'=>$row['super'],'moderador'=>$row['moderador'],'gestor'=>$row['gestor'],'email'=>$row['email']);
                $i++;
            }
        }else{
            $usuarios= NULL;
        }

        return $usuarios;
    }

    function editarPermisos($nick,$opcion,$valor){
        switch($opcion){
            case "moderador":
                $q = "UPDATE Usuarios SET moderador='$valor' WHERE nick='$nick'";
                $this->mysqli->query($q);
                break;
            case "gestor":
                $q = "UPDATE Usuarios SET gestor='$valor' WHERE nick='$nick'";
                $this->mysqli->query($q);
                break;
            case "super":
                $q = "UPDATE Usuarios SET super='$valor' WHERE nick='$nick'";
                $this->mysqli->query($q);
                $q = "UPDATE Usuarios SET gestor='$valor' WHERE nick='$nick'";
                $this->mysqli->query($q);
                $q = "UPDATE Usuarios SET moderador='$valor' WHERE nick='$nick'";
                $this->mysqli->query($q);
                break;

        }
    }
}

?>