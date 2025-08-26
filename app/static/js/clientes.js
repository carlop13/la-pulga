$(document).ready(function(){
$("#tabla-clientes").find("thead").hide();

//Carga personas
	$.ajax({
		"url" : appData.uri_ws+"backend/getdatoscli/",
		"dataType" : "json"
	})
	.done(function(obj){
		if (obj) {
			$("#tabla-clientes").find("thead").show();

			$.each(obj, function(i,p){
				$("#tabla-clientes").find("tbody").append(
					'<tr id="tr-'+p.id+'">'+
					'<td>'+p.id+'</td>'+
					'<td>'+p.nombre+' '+p.ap+' '+p.am+'</td>'+
					'<td>'+p.nomus+'</td>'+
					'<td>'+fecha_fancy(p.f)+'</td>'+
					'<td> <a href="tel: '+p.telefono+'">'+p.telefono+'</a></td>'+
					'<td> <a href="mailto: '+p.correo+'">'+p.correo + '</a></td>'+
					'</tr>'
					);
			});

		}
		else{
			$("#tabla-clientes").find("thead").hide();
			alert("No hay clientes");
		}
	});

}); //Fin del ready

 function fecha_fancy(sFecha){
  //Convierte un String en arreglo
  aFecha = sFecha.split("-");

  aMes= ["enero","febrero","marzo","abril","mayo","junio",
      "julio","agosto","septiembre","octubre","noviembre","diciembre"]

  return new Intl.NumberFormat().format(aFecha[2]) + " de " + aMes[aFecha[1]-1]+" de "+aFecha[0];
}