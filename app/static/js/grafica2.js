$(document).ready(function(){
 $.ajax({
    url: appData.uri_ws + "backend/ventamesdin/",
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

      var grafica = Highcharts.chart('div-grafica2', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Dinero Adquirido Mensual del año ' + añoActual
  },
  xAxis: {
    categories: categories,
    title: {
      text: 'Mes'
    }
  },
  yAxis: {
    title: {
      text: 'Dinero Adquirido'
    }
  },
  series: [{
    name: 'Dinero',
    data: seriesData
  }]
});



    },
    error: function(xhr, status, error) {
      console.log("Error: " + error);
    }
  });

});