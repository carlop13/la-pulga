$(document).ready(function(){
$("#tabla-pedidos").find("thead").hide();

var datosCargados = false; // Variable para controlar si los datos han sido cargados previamente
var sowmensaje = true;

function datos() {
//Carga personas
	$.ajax({
		"url" : appData.uri_ws+"backend/getpedidos/",
		"dataType" : "json"
	})
	.done(function(obj){
		if (obj) {
			$("#tabla-pedidos").find("thead").show();

			// Verificar si hay alteración en los datos
      if (!datosCargados || JSON.stringify(obj) !== JSON.stringify(ultimoObjeto)) {
        // Vaciar la tabla
        $("#tabla-pedidos").find("tbody").empty();

			$.each(obj, function(i,p){
				$("#tabla-pedidos").find("tbody").append(
					'<tr id="tr-'+p.id+'">'+
					'<td>'+p.id+'</td>'+
					'<td>'+fecha_fancy(p.fech)+'</td>'+
					'<td>'+p.folio+'</td>'+
					'<td>$'+formatMoney(Math.trunc(p.total))+'</td>'+
					'<td>'+p.nombre+' '+p.ap+' '+p.am+'</a></td>'+
					 '<td class="text-center" ><button title="Ver detalle" class="btn btn-sm btn-primary" onclick="click_btn_detalle('+p.id+')" data-bs-toggle="modal" data-bs-target="#modal-pedido"><i class="fas fa-file-alt fa-2x"></i></button> </td>'+
					'<td class="text-center" ><button title="Ver dirección" class="btn btn-sm btn-success" onclick="click_btn_direccion('+p.id_cli+')" data-bs-toggle="modal" data-bs-target="#modal-direccion"><i class="fas fa-map-marker-alt fa-2x"></i></button> </td>'+
          '<td class="text-center" ><button title="Ver ubicación" class="btn btn-sm btn-danger" onclick="click_btn_ubicación('+p.id_cli+')" data-bs-toggle="modal" data-bs-target="#modal-mapa"><i class="fas fa-map-pin fa-2x"></i></button> </td>'+
          '</tr>'
					);
			});

			// Actualizar el último objeto de datos
        ultimoObjeto = obj;

        // Marcar los datos como cargados
        datosCargados = true;
      }

		}
		else{
			$("#tabla-pedidos").find("thead").hide();
      if(sowmensaje){
        sowmensaje = false;
			alert("No hay pendientes");
		}}
	});

	}

setInterval(datos, 400);


}); //Fin del ready



function click_btn_ubicación(id_c){
appData.id_cl = id_c;

    if (!(typeof marcador === "undefined")) {
  marcador.setMap(null);
  marcador = null;
  
}

mapa.setZoom(15);
mapa.setCenter(centro);

    // Carga direccion
    $.ajax({
      "url": appData.uri_ws + "backend/getubi/",
      "dataType": "json",
      "type": "post",
      "data": {
        "id": appData.id_cl
      }
    })
    .done(function(obj) {
      if (obj) {
        var user = obj[0];

        if (!(typeof user.latitud === "null" && user.longitud === "null")) {

      marcador = new google.maps.Marker({
        position : {
          lat : parseFloat(user.latitud),
          lng : parseFloat(user.longitud)
        },
        map : mapa,
        dragable : true
      });

      marcador.addListener("drag",function(){
        $("#btn-guardar").prop("disabled",false);
      });
      mapa.panTo(marcador.getPosition());
    }
    else{
      alert("No hay coordenadas");
    }

      } else {

        alert("No hay datos");
      }
    });


}



function click_btn_direccion(id_c){
appData.id_cl = id_c;

$(document).ready(function() {

    $("#tabla-direccion").find("thead").hide();

    // Borra los registros antiguos
    $("#tabla-direccion").find("tbody").empty();

    // Carga direccion
    $.ajax({
      "url": appData.uri_ws + "backend/getdire/",
      "dataType": "json",
      "type": "post",
      "data": {
        "id": appData.id_cl
      }
    })
    .done(function(obj) {
      if (obj) {
        $("#tabla-direccion").find("thead").show();

        $.each(obj, function(i, p) {
          $("#tabla-direccion").find("tbody").append(
            '<tr id="tr-' + p.id + '">' +
            '<td>' + p.ciudad + '</td>' +
            '<td>' + p.col + '</td>' +
            '<td>' + p.calle +' '+p.noint+' '+p.noext+'</td>' +
            '<td>' + p.cp + '</td>' +
            '</tr>'
          );
        });
      } else {
        $("#tabla-direccion").find("thead").hide();
        alert("No hay datos");
      }
    });

  }); //Fin del ready

}


function click_btn_detalle(id_ven) {
appData.id_v = id_ven;

 $(document).ready(function() {

    $("#tabla-detalle").find("thead").hide();

    // Borra los registros antiguos
    $("#tabla-detalle").find("tbody").empty();

    // Carga detalle
    $.ajax({
      "url": appData.uri_ws + "backend/getdetalle/",
      "dataType": "json",
      "type": "post",
      "data": {
        "id": appData.id_v
      }
    })
    .done(function(obj) {
      if (obj) {
        $("#tabla-detalle").find("thead").show();

        $.each(obj, function(i, p) {
          $("#tabla-detalle").find("tbody").append(
            '<tr id="tr-' + p.id + '">' +
            '<td>' + p.nombre + '</td>' +
            '<td> <img class="img-producto" src="' + appData.uri_app + '/static/images/producto/' + p.foto + '" width=' + "150" + ' height=' + "150" + ' alt="texto alternativo" ></td>' +
            '<td>$' + formatMoney(Math.trunc(p.prec)) + '</td>' +
            '<td>' + p.cant + '</td>' +
            '<td>$' + formatMoney(Math.trunc(p.subtotal)) + '</td>' +
            '</tr>'
          );
        });
      } else {
        $("#tabla-detalle").find("thead").hide();
        alert("No hay datos");
      }
    });

  }); //Fin del ready

}


function formatMoney(amount) {
    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

 function fecha_fancy(sFecha){
  //Convierte un String en arreglo
  aFecha = sFecha.split("-");

  aMes= ["enero","febrero","marzo","abril","mayo","junio",
      "julio","agosto","septiembre","octubre","noviembre","diciembre"]

  return new Intl.NumberFormat().format(aFecha[2]) + " de " + aMes[aFecha[1]-1]+" de "+aFecha[0];
}


function cargaMapa() {

if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(pos){
      centro = {
        lat : pos.coords.latitude,
        lng : pos.coords.longitude
      };

    mapa = new google.maps.Map( 
    document.getElementById("mapa"),
    {
      center : centro,
      zoom : 15
    }
    );

if (typeof marcador === "undefined"){
     mapa.addListener("click",click_listener);
  }

    });
    
  }
  else{
    alert("danger","Tu navegador no permite geolocalización");
  }

}