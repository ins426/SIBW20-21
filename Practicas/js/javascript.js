function abrirComentarios(){
    document.getElementById("comentarios").style.width = "500px";
}
/********************************************************************/
function cerrarComentarios(){
    document.getElementById("comentarios").style.width = "0px";
}
/********************************************************************/
function abrirComentarios(){
    document.getElementById("comentarios").style.width = "500px";
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
function reemplazarPalabrasFeas(palabras){

    var comentario = document.getElementById("comentario");
    var palabrasFeas = []
    try{
        palabrasFeas = JSON.parse(palabras);
    }catch(e){
        console.log(e);
    }
        
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
document.getElementById("formulario").addEventListener('input',reemplazarPalabrasFeas);