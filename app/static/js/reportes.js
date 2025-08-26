$(document).ready(function() {

// Manejadores de eventos de los botones de reporte
  $("#btn-database-backup").click(function() {
    backupDatabase();
  });

  $("#btn-sales-week").click(function() {
    ventassemana("Ventas de la Semana ");
  });

  $("#btn-sales-month").click(function() {
    ventasmes("Ventas del Mes de ");
  });

  $("#btn-sales-year").click(function() {
    ventasanio("Ventas del Año ");
  });

  $("#btn-sales").click(function() {
    ventastotales("Reporte Total de Ventas");
  });

  $("#btn-customer-phone").click(function() {
    tel("Teléfonos de los Clientes");
  });

  $("#btn-active-users").click(function() {
    usuarios("Clientes Activos");
  });


});//FIN DEL READY



function ventastotales(reportName) {
    // Simulación de carga de datos del reporte
    var reportResults = document.getElementById("report-results");

    $.ajax({
        "url" : appData.uri_ws + "backend/ventas",
        "dataType" : "json"

            })
    .done(function(obj) {
        if (obj != "hola") {
            document.getElementById("titulo").innerText = reportName;
            var tablaVentaMes = $("#tabla-venta-mes");
            tablaVentaMes.find("thead").show();
            var tbody = tablaVentaMes.find("tbody");
            var thead = tablaVentaMes.find("thead");
            tbody.empty();
            thead.empty();

            thead.append(
                '<tr class="table-info">'+
                '<th class="text-center">No. de venta</th>'+
                '<th class="text-center">Fecha</th>'+
                '<th class="text-center">Folio</th>'+
                '<th class="text-center">Monto</th>'+
                '<th class="text-center">Cliente</th>'+
                '</tr>'
                );

            $.each(obj, function(i, p) {
                tbody.append(
                    '<tr class="text-center" id="tr-' + p.id + '">' +
                    '<td>' + p.id + '</td>' +
                    '<td>' + p.fech + '</td>' +
                    '<td>' + p.folio + '</td>' +
                    '<td>$' +formatMoney(Math.trunc( p.total )) + '</td>' +
                    '<td>' + p.nombre +" "+ p.ap+" " + p.am + '</td>' +
                    '</tr>'
                );
            });
            reportResults.classList.add("show");
        } else {
            alert("No hay ventas");
        }
    })
    .fail(error_ajax);

}



function ventassemana(reportName) {
    // Simulación de carga de datos del reporte
    var reportResults = document.getElementById("report-results");

    $.ajax({
        "url" : appData.uri_ws + "backend/ventassemana",
        "dataType" : "json"

            })
    .done(function(obj) {
        if (obj.data) {

            var tit = reportName + "del "+obj.inicio+" al "+obj.fin;

            document.getElementById("titulo").innerText = tit;

            var tablaVentaMes = $("#tabla-venta-mes");
            tablaVentaMes.find("thead").show();
            var tbody = tablaVentaMes.find("tbody");
            var thead = tablaVentaMes.find("thead");
            tbody.empty();
            thead.empty();

            thead.append(
                '<tr class="table-info">'+
                '<th class="text-center">No. de venta</th>'+
                '<th class="text-center">Fecha</th>'+
                '<th class="text-center">Folio</th>'+
                '<th class="text-center">Monto</th>'+
                '<th class="text-center">Cliente</th>'+
                '</tr>'
                );

            $.each(obj.data, function(i, p) {
                tbody.append(
                    '<tr class="text-center" id="tr-' + p.id + '">' +
                    '<td>' + p.id + '</td>' +
                    '<td>' + p.fech + '</td>' +
                    '<td>' + p.folio + '</td>' +
                    '<td>$' +formatMoney(Math.trunc( p.total )) + '</td>' +
                    '<td>' + p.nombre +" "+ p.ap+" " + p.am + '</td>' +
                    '</tr>'
                );
            });
            reportResults.classList.add("show");
        } else {
            alert("No hay ventas");
        }
    })
    .fail(error_ajax);

}



function ventasmes(reportName) {
    // Simulación de carga de datos del reporte
    var reportResults = document.getElementById("report-results");

    $.ajax({
        "url" : appData.uri_ws + "backend/ventasmes",
        "dataType" : "json"

            })
    .done(function(obj) {
        if (obj.data) {

            var tit = reportName+obj.mes;

            document.getElementById("titulo").innerText = tit;

            var tablaVentaMes = $("#tabla-venta-mes");
            tablaVentaMes.find("thead").show();
            var tbody = tablaVentaMes.find("tbody");
            var thead = tablaVentaMes.find("thead");
            tbody.empty();
            thead.empty();

            thead.append(
                '<tr class="table-info">'+
                '<th class="text-center">No. de venta</th>'+
                '<th class="text-center">Fecha</th>'+
                '<th class="text-center">Folio</th>'+
                '<th class="text-center">Monto</th>'+
                '<th class="text-center">Cliente</th>'+
                '</tr>'
                );

            $.each(obj.data, function(i, p) {
                tbody.append(
                    '<tr class="text-center" id="tr-' + p.id + '">' +
                    '<td>' + p.id + '</td>' +
                    '<td>' + p.fech + '</td>' +
                    '<td>' + p.folio + '</td>' +
                    '<td>$' +formatMoney(Math.trunc( p.total )) + '</td>' +
                    '<td>' + p.nombre +" "+ p.ap+" " + p.am + '</td>' +
                    '</tr>'
                );
            });
            reportResults.classList.add("show");
        } else {
            alert("No hay ventas");
        }
    })
    .fail(error_ajax);

}



function ventasanio(reportName) {
    // Simulación de carga de datos del reporte
    var reportResults = document.getElementById("report-results");

    $.ajax({
        "url" : appData.uri_ws + "backend/ventasanio",
        "dataType" : "json"

            })
    .done(function(obj) {
        if (obj.data) {

            var tit = reportName+obj.anio;

            document.getElementById("titulo").innerText = tit;

            var tablaVentaMes = $("#tabla-venta-mes");
            tablaVentaMes.find("thead").show();
            var tbody = tablaVentaMes.find("tbody");
            var thead = tablaVentaMes.find("thead");
            tbody.empty();
            thead.empty();

            thead.append(
                '<tr class="table-info">'+
                '<th class="text-center">No. de venta</th>'+
                '<th class="text-center">Fecha</th>'+
                '<th class="text-center">Folio</th>'+
                '<th class="text-center">Monto</th>'+
                '<th class="text-center">Cliente</th>'+
                '</tr>'
                );

            $.each(obj.data, function(i, p) {
                tbody.append(
                    '<tr class="text-center" id="tr-' + p.id + '">' +
                    '<td>' + p.id + '</td>' +
                    '<td>' + p.fech + '</td>' +
                    '<td>' + p.folio + '</td>' +
                    '<td>$' +formatMoney(Math.trunc( p.total )) + '</td>' +
                    '<td>' + p.nombre +" "+ p.ap+" " + p.am + '</td>' +
                    '</tr>'
                );
            });
            reportResults.classList.add("show");
        } else {
            alert("No hay ventas");
        }
    })
    .fail(error_ajax);

}



function usuarios(reportName) {
    // Simulación de carga de datos del reporte
    var reportResults = document.getElementById("report-results");

    $.ajax({
        "url" : appData.uri_ws + "backend/usuac",
        "dataType" : "json"

            })
    .done(function(obj) {
        if (obj != "hola") {

            document.getElementById("titulo").innerText = reportName;

            var tablaVentaMes = $("#tabla-venta-mes");
            tablaVentaMes.find("thead").show();
            var tbody = tablaVentaMes.find("tbody");
            var thead = tablaVentaMes.find("thead");
            tbody.empty();
            thead.empty();

            thead.append(
                '<tr class="table-info">'+
                '<th class="text-center">Nombre</th>'+
                '<th class="text-center">Correo</th>'+
                '<th class="text-center">Nombre de Usuario</th>'+
                '</tr>'
                );

            $.each(obj, function(i, p) {
                tbody.append(
                    '<tr class="text-center" id="tr-' + p.nombre + '">' +
                    '<td>' + p.nombre +" "+p.ap+" "+p.am +'</td>' +
                    '<td><a href="mailto:'+p.correo+'">' + p.correo + '<a></td>' +
                    '<td>' + p.nombreusu + '</td>' +
                    '</tr>'
                );
            });
            reportResults.classList.add("show");
        } else {
            alert("No hay clientes activos");
        }
    })
    .fail(error_ajax);

}



function tel(reportName) {
    // Simulación de carga de datos del reporte
    var reportResults = document.getElementById("report-results");

    $.ajax({
        "url" : appData.uri_ws + "backend/telefonos",
        "dataType" : "json"

            })
    .done(function(obj) {
        if (obj != "hola") {
            document.getElementById("titulo").innerText = reportName;
            var tablaVentaMes = $("#tabla-venta-mes");
            tablaVentaMes.find("thead").show();
            var tbody = tablaVentaMes.find("tbody");
            var thead = tablaVentaMes.find("thead");
            tbody.empty();
            thead.empty();

            thead.append(
                '<tr class="table-info">'+
                '<th class="text-center">Nombre</th>'+
                '<th class="text-center">Teléfono</th>'+
                '</tr>'
                );

            $.each(obj, function(i, p) {
                tbody.append(
                    '<tr class="text-center" id="tr-' + p.nombre + '">' +
                    '<td>' + p.nombre + '</td>' +
                    '<td><a href="tel:' + p.telefono + '"> '+p.telefono+'</a></td>' +
                    '</tr>'
                );
            });
            reportResults.classList.add("show");
        } else {
            alert("No hay teléfonos");
        }
    })
    .fail(error_ajax);

}


function formatMoney(amount) {
    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}