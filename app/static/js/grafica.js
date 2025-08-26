$(document).ready(function() {

  $.ajax({
    url: appData.uri_ws + "backend/ventames/",
    dataType: "json",
    success: function(response) {
      var data = response;

      var fechaActual = new Date();
      var añoActual = fechaActual.getFullYear();

      // Datos ficticios para la gráfica
      var ventasMensuales = data;

      // Preparar los datos para Highcharts
      var categories = ventasMensuales.map(function(venta) {
        return venta.mes;
      });

      var seriesData = ventasMensuales.map(function(venta) {
        return parseFloat(venta.total);
      });

      var grafica = Highcharts.chart('div-grafica', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Ventas Mensuales del año ' + añoActual
        },
        xAxis: {
          categories: categories,
          title: {
            text: 'Mes'
          }
        },
        yAxis: {
          title: {
            text: 'Total de Ventas'
          }
        },
        series: [{
          name: 'Ventas',
          data: seriesData
        }]
      });

    },
    error: function(xhr, status, error) {
      console.log("Error: " + error);
    }
  });

$("#tabla-admin").find("thead").hide();

  //Carga admin
	$.ajax({
		"url" : appData.uri_ws+"backend/getadmin/",
		"dataType" : "json"
	})
	.done(function(obj){
		if (obj) {
			$("#tabla-admin").find("thead").show();

			$.each(obj, function(i,a){
				$("#tabla-admin").find("tbody").append(
					'<tr id="tr-'+a.id+'">'+
					'<td class="text-center">'+a.id+'</td>'+
					'<td class="text-center">'+a.nombre+' '+a.ap+' '+a.am+'</td>'+
					'<td class="text-center"><a href="mailto:'+a.correo+'">'+a.correo+'</a></td>'+
					'<td class="text-center">'+a.fec_registro+'</td>'+
					'</tr>'
					);
			});

		}
	});





});
