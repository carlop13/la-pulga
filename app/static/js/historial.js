$(document).ready(function(){
$("#tabla-productos").find("thead").hide();

$.ajax({
		"url" : appData.uri_ws+"backend/detalleventa",
		"dataType" : "json",
		"type" : "post",
		"data" : {
			"corr" : appData.correo
		}
	})
	.done(function(obj){
		if (obj!="hola") {
			$("#tabla-productos").find("thead").show();
			alert("info", "Tus compras"); 

			$.each(obj, function(i,p){

				$("#tabla-productos").find("tbody").append(
					'<tr id="tr-'+p.idven+'">'+
					'<td>'+p.idven+'</td>'+
					'<td>'+fecha_fancy(p.fech)+'</td>'+
					'<td>'+p.numproductos+ '</td>'+
					'<td>$'+formatMoney(Math.trunc(p.total)) + '</td>'+
					'<td><button title="Detalle" class="btn btn-sm btn-success btn-detalle" onclick="click_btn_detalle('+p.idven+')"><i class="fas fa-piggy-bank fa-2x"></i></button> </td>'+
					'<td><button title="PDF" class="btn btn-sm btn-danger btn-detalle-pdf" onclick="click_btn_pdf('+p.idven+')"><i class="fas fa-file-alt fa-2x"></i></button> </td>'+
					'<td><button title="XML" class="btn btn-sm btn-primary btn-detalle" onclick="click_btn_xml('+p.idven+')"><i class="fas fa-file-alt fa-2x"></i></button> </td>'+
					'</tr>'
					);
			});

		}
		else{
			$("#tabla-productos").find("thead").hide();
			alert("warning","No hay compras");
		}
	})
	.fail(error_ajax);
	//Fin de craga de personas


		setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);




}); //FIN DEL READY


function click_btn_detalle(idven){
appData.idven = idven;

$.ajax({
	"url" : appData.uri_ws+"backend/ventadetalles",
	"dataType": "json",
	"type" : "post",
	"data" : {
		"id_vent" : appData.idven
	}
})
.done(function(obj){
if (obj!="hola") {

			$(location).attr("href",appData.uri_app + "frontend/detalleventas/"+appData.id_usu+"/"+appData.token+"/"+idven);
		
		}
		else{
			
			alert("warning","No hay productos");
		}
})
.fail(error_ajax);


		setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);

}


function click_btn_pdf(idven){
appData.idven = idven;

$.ajax({
	"url" : appData.uri_ws+"backend/ventadetalles",
	"dataType": "json",
	"type" : "post",
	"data" : {
		"id_vent" : appData.idven
	}
})
.done(function(obj){
if (obj!="hola") {

			var url = appData.uri_app + "frontend/facturapdf/" + appData.id_usu + "/" + appData.token + "/" + idven;
			window.open(url, '_blank');

		}
		else{
			
			alert("warning","No hay productos");
		}
})
.fail(error_ajax);


		setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);

}





function click_btn_xml(id_inve){

$.ajax({
	"url" : appData.uri_ws+"backend/detalleventaxml/"+id_inve,
	"dataType": "xml",
		"data" : {
		"correo" : appData.correo

	},

})
.done(function(obj){
        var a = document.createElement("a");
        document.body.appendChild(a);
        a.style = "display: none";

        // var xmlDoc = new XMLSerializer().serializeToString(xml);

        

        var blob = new File([obj], "Factura-"+appData.nombre+" "+Date(),  {type: "text/xml"});
        url = appData.uri_ws+"backend/detalleventaxml/"+id_inve;
        a.href = url;
        a.download = blob.name;
        a.click();
        window.URL.revokeObjectURL(url);
     
})
.fail(error_ajax);


		setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);

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