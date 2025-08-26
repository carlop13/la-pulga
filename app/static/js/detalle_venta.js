$(document).ready(function(){
$("#tabla-productos").find("thead").hide();

$.ajax({
	"url" : appData.uri_ws+"backend/ventadetalles",
	"dataType": "json",
	"type" : "post",
	"data" : {
		"id_vent" : appData.id_venta
	}
})
.done(function(obj){
if (obj!="hola") {
	$("#tabla-productos").find("thead").show();
var total=0;
var iva = 0;
var subtotal_siniva=0;
var precio_sin_iva=0;
var total_siniva=0;
			$.each(obj, function(i,p){
				$("#tabla-productos").find("tbody").append(
					'<tr class="text-center" id="tr-'+p.id_vent+'">'+
					'<td class="text-start">'+p.nombre+'</td>'+
					'<td>'+p.cant+'</td>'+
					'<td class="text-end pe-5">$'+formatMoney(Math.trunc(p.prec))+ '</td>'+
					'<td class="text-end pe-5">$'+formatMoney(Math.trunc(p.subtotal)) + '</td>'+
					'</tr>'
					);
				total = total +(p.prec * p.cant);
				precio_sin_iva=p.prec/1.16;
				subtotal_siniva = (precio_sin_iva * p.cant);
				total_siniva = total_siniva +subtotal_siniva;
			});

			var iva = (total_siniva*0.16);

			total=(total_siniva*1.16);


			$("#tabla-productos").find("tbody").append(
					'<tr>' +
    '<td colspan="3" class="text-end pe-5"><strong>SUBTOTAL</strong></td>' +
    '<td class="text-end pe-5 text-danger"><strong>$' + formatMoney(Math.trunc(total_siniva)) + '</strong></td>' +
    '</tr>' +
    '<tr>' +
    '<td colspan="3" class="text-end pe-5"><strong>IVA</strong></td>' +
    '<td class="text-end pe-5 text-danger"><strong>$' + formatMoney(Math.trunc(iva)) + '</strong></td>' +
    '</tr>' +
    '<tr>' +
    '<td colspan="3" class="text-end pe-5"><strong>TOTAL A PAGAR</strong></td>' +
    '<td class="text-end pe-5 text-danger"><strong>$' + formatMoney(Math.trunc(total)) + '</strong></td>' +
    '</tr>'
					);
		
		}
		else{
			
			"<p><strong>No has realizado compras compras<strong/></p>"
		}
})
.fail(error_ajax);


		setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);

});

function formatMoney(amount) {
    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}