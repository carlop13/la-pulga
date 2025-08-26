$(document).ready(function(){


var datosCargados = false; // Variable para controlar si los datos han sido cargados previamente

function datos() {
  $.ajax({
    "url" : appData.uri_ws+"backend/getdatosproductos",
    "dataType" : "json"
  })
  .done(function(obj) {
    if (obj.resultado) {
      

      // Verificar si hay alteración en los datos
      if (!datosCargados || JSON.stringify(obj.data) !== JSON.stringify(ultimoObjeto)) {
        // Vaciar la tabla
            $( "#lista-productos" ).html( "" );
        

        document.getElementById("total").innerText = obj.total;

        // Agregar los nuevos datos a la tabla
        $.each(obj.data, function(i,p){


          $( "#lista-productos" ).append( '<div class="col-md-3"> <div class="card mb-3"><h6 class="card-header">' +
          p.nombre + '</h6><div class="card-body"><img class="img-producto" src="'+appData.uri_app+'/static/images/producto/'+p.foto+'" width='+"100"+'alt="texto alternativo" style="display: block; margin: 0 auto;"  ></div>'+
          '<div class="card-footer"><br />' +
          '<small><strong>No. </strong>' +p.num+ '</small><br />' + 
          '<strong>Precio: </strong> $'+formatMoney(Math.trunc(p.prec))+'<br />' + 
          '<small><strong>Categoría: </strong>' + p.categoria + '</small><br />' + 
          '<small '+(p.cantidad == 0 ? 'class="bg-warning"' : '')+'><strong>Cantidad: </strong>' + p.cantidad + '</small><br /><br />' + 
          '<div class="d-flex justify-content-center mb-2">'+
          '<button title="Editar" class="btn btn-sm btn-primary" onclick="click_btn_edit('+p.id+')"><i class="fas fa-edit"></i></button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
          '<button title="Borrar" class="btn btn-sm btn-danger" onclick="click_btn_borrar('+p.id+')" data-bs-toggle="modal" data-bs-target="#modal-borrar" ><i class="fas fa-trash"></i></button>'+
          '</div></div></div></div>' );

        });

        // Actualizar el último objeto de datos
        ultimoObjeto = obj.data;

        // Marcar los datos como cargados
        datosCargados = true;
      }
    }
    else {
      alert("warning",obj.mensaje);
    }
  })
  .fail(error_ajax);
}

setInterval(datos, 200);




		setTimeout(function(){
	$(".alert").fadeOut(1000);
},3000);


$("#btn-agregar").click(function(){
	var accion = "alta";
  $(location).attr('href', appData.uri_app+'frontend/ab_producto/'+appData.id_usu+'/'+appData.token+'/'+accion);
  });


$("#btn-eliminar-fin").click(function(){
	$.ajax({
		"url" : appData.uri_ws+"backend/deletepro/",
		"dataType" : "json",
		"type" : "post",
		"data" : {
			"id_pro" : appData.id_proo
		}
	})
	.done(function(obj){
		if (obj.resultado) {
			alert("info", "Producto eliminado"); 
		}
		else{
			alert("warning",obj.mensaje);
		}
	})
	.fail(error_ajax);
	 });


}); //FIN DEL READY

function click_btn_edit(id_pro){
	var accion = "editar";
	var mensaje = "d";
  $(location).attr('href', appData.uri_app+'frontend/ab_producto/'+appData.id_usu+'/'+appData.token+'/'+accion+'/'+mensaje+'/'+id_pro);
  
}

function click_btn_borrar(id_pro){
	appData.id_proo = id_pro;
}

function formatMoney(amount) {
    return amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}