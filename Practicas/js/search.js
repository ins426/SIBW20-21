function searching(palabra){
    $.ajax({
        data: {palabra},
        url: 'search.php',
        type:'get',
        success: function(respuesta){
            gestionarRespuesta(respuesta);
        }
    });
}

function gestionarRespuesta(respuesta){
    var json = JSON.parse(respuesta);

    if(Object.keys(json).length == 0){
        document.getElementById("resultados").innerHTML = "";
        document.getElementById("resultados").style.border ="0px";
        return;
    }

    var res = ""
    for(var i = 0; i < Object.keys(json).length; ++i ){
        res += "<a href=\"/evento.php?ev=" + json[i]['id'] + "\">" + json[i]['nombre'] + "</a><br>";
    }

    document.getElementById("resultados").style.display="block";
    $("#resultados").html(res);
}