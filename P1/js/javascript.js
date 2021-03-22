function abrirComentarios(){
    document.getElementById("comentarios").style.width = "500px";
}
/********************************************************************/
function cerrarComentarios(){
    document.getElementById("comentarios").style.width = "0px";
}
/********************************************************************/
function aniadirComentario(){

    if(mail.value == '' || nombre.value == '' || comentario.value == '')
    {
        alert("Todos los campos han de ser rellenados. ");
        document.getElementById("formulario").reset();
    }
    else{
        var em = mail.value;
        console.log(mail.value);
        if(!validarEmail(em)){
            alert("La dirección de email es incorrecta.");
        }
        else{
            var nom = usuario.value;
            var coment= comentario.value;
        
            var fecha = new Date();
            //Año
            y = fecha.getFullYear();
            //Mes
            m = fecha.getMonth()+1;
            //Día
            d = fecha.getDate();
            //Hora
            h = fecha.getHours();
            //Minutos
            min = fecha.getMinutes();
        
            var html = "<div class='mensaje-contenedor'><img id= 'user' src='../img/user.png'><div id='mensaje'><h3>"+nom+", "+ em + "<br>" +d + "/" + m + "/" + y+ " "+ h + ":"+ min+"</h3><p>"+coment+"</p></div></div>";
            document.getElementById("comentarios-enviados").innerHTML += html;
        
            document.getElementById("formulario").reset();
        }
    }
}
/********************************************************************/
function validarEmail(valor) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
     return true;
    } else {
     return false;
    }
  }

/********************************************************************/
function reemplazarPalabrasFeas(event){
    event.preventDefault();
    var comentario = document.getElementById("comentario");
    var palabrasFeas = ['imbecil','bocachancla','chupacables','gorrino','parguelas','tolai',
'cabezabuque','pagafantas','desgraciao','estupido'];
    var censurado = censura(comentario.value,palabrasFeas);
    comentario.value = censurado;
}

function censura(cadena, filtros){
    var regex = new RegExp(filtros.join("|"));
    return cadena.replace(regex,function(match){
        var stars = '';
        for(var i = 0; i < match.length;i++){
            stars += '*';
        }
        return stars;
    });
}
/********************************************************************/
document.getElementById("icono-comentarios").onclick = abrirComentarios;
document.getElementById("cerrar").onclick = cerrarComentarios;
document.getElementById("enviar").onclick = aniadirComentario;
document.getElementById("formulario").addEventListener('input',reemplazarPalabrasFeas);