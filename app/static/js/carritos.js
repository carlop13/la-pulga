function click_carrito( idproducto ){

    var idpro = idproducto;
    var cant = $("#cantidad"+idpro).val();
    var maximo = $("#cantidad"+idpro).attr('max');
 

    if( cant > parseInt(maximo) ){
        alert( "la cantiad selecionada no es valida el valor max es: " + maximo);
        $("#cantidad"+idpro).val(1);
        
    }else{
        $.ajax({
            url : appData.uri_app + "../webservice/carrito/agregarcarrito",
            type : "POST",
            dataType : "json",
            data: {
                idproducto : idpro,
                idusuario : appData.idusuario,
                cantidad : cant
            },
        })
        .done( function(obj) {
            alert( obj.mensaje );
            actualizarCantidad( appData.idusuario );
        })
        .fail( error_ajax );


       
    }

}


function click_carritoD( idproducto ){

    var idpro = idproducto;
    var cant = 1;
    var maximo = 2;
 

    if( cant > parseInt(maximo) ){
        alert( "la cantiad selecionada no es valida el valor max es: " + maximo);
        $("#cantidad"+idpro).val(1);
        
    }else{
        $.ajax({
            url : appData.uri_app + "../webservice/carrito/agregarcarrito",
            type : "POST",
            dataType : "json",
            data: {
                idproducto : idpro,
                idusuario : appData.idusuario,
                cantidad : cant
            },
        })
        .done( function(obj) {
            alert( obj.mensaje );
            actualizarCantidad( appData.idusuario );
        })
        .fail( error_ajax );


       
    }

}


function click_deseo( idproducto ){
    var idpro = idproducto;
    $.ajax({
        url : appData.uri_app + "../webservice/carrito/agregardeseo",
        type : "POST",
        dataType : "json",
        data: {
            idproducto : idpro,
            idusuario : appData.idusuario
        },
    })
    .done( function(obj) {
        alert( obj.mensaje );
        actualizarCantidadD( appData.idusuario );
    })
    .fail( error_ajax );   
}

function borrar_deseos( idproducto ){
    var idlista = idproducto;
    $.ajax({
        url : appData.uri_app + "../webservice/carrito/borrardeseo",
        type : "POST",
        dataType : "json",
        data: {
            id_list : idlista,
            idusuario : appData.idusuario
        },
    })
    .done( function(obj) {
        alert( obj );
        actualizarCantidadD( appData.idusuario );
        mostrar_deseos();
    })
    .fail( error_ajax );   
}



function borrar_producto( idproducto ){
    var idp = idproducto;
    $.ajax({
        url : appData.uri_app + "../webservice/carrito/eliminarproducto",
        type : "POST",
        dataType : "json",
        data : {
            idus : appData.idusuario,
            idpro : idp
        },
    })
    .done( function( obj ) {
        alert( obj.mensaje );
        actualizarCantidad( appData.idusuario );
        mostrar_carrito();

    })
    .fail( );
}


function comprarealizada(total) {
  $.ajax({
    url: appData.uri_app + "../webservice/carrito/compracarrito",
    type: "POST",
    dataType: "json",
    data: {
      idus: appData.idusuario,
      total: total
    },
  })
  .done(function(respuesta) {
    if (respuesta.resultado) {
      document.getElementById('com').value = 2;

      var url = "https://api.callmebot.com/whatsapp.php?phone=5214423535507&text=Has hecho una venta crack&apikey=9914603";
      fetch(url);
      alert("compra exitosa");

      setTimeout(function(){
        $(location).attr("href", "");
      }, 1000);
    }
  })
  .fail();
}













function actualizarCantidad( idus ){
    var idu = idus;
    $.ajax({
        url : appData.uri_app + "../webservice/carrito/actualizarCantidad",
        type : "POST",
        dataType : "json",
        data: {
            idusuario : idu
        },
    })
    .done( function(obj) {
        if( obj.resultado == true ){
            $( "#cantidadCarrito" ).html( obj.cantidad );
        }else{
            $( "#cantidadCarrito" ).html("");
        }
    })
    .fail();
}


function actualizarCantidadD( idus ){
    var idu = idus;
    $.ajax({
        url : appData.uri_app + "../webservice/carrito/actualizarCantidadD",
        type : "POST",
        dataType : "json",
        data: {
            idusuario : idu
        },
    })
    .done( function(obj) {
        if( obj.resultado == true ){
            $( "#cantidadDeseos" ).html( obj.cantidad );
        }else{
            $( "#cantidadDeseos" ).html("");
        }
    })
    .fail();
}






function mostrar_carrito(){
	$.ajax({
		url      : appData.uri_app + "../webservice/carrito/mostrarcarrito",
		type     : "POST",
		dataType : "html",
		data     : {
			idus : appData.idusuario
		},
	})
	.done( function( respuesta ) {
        $( "#datos-carrito" ).html( respuesta );
	})
	.fail( function() {
		console.log( "error" );
	})

}


function mostrar_deseos(){
	$.ajax({
		url      : appData.uri_app + "../webservice/carrito/mostrardeseos",
		type     : "POST",
		dataType : "html",
		data     : {
			idus : appData.idusuario
		},
	})
	.done( function( respuesta ) {
        $( "#datos-deseos" ).html( respuesta );
	})
	.fail( function() {
		console.log( "error" );
	})

}


function mostrar_historial(){
    $.ajax({
		url      : appData.uri_app + "../webservice/carrito/mostrarhistorial",
		type     : "POST",
		dataType : "html",
		data     : {
			idus : appData.idusuario
		},
	})
	.done( function( respuesta ) {
        $( "#datos-historial" ).html( respuesta );
	})
	.fail( function() {
		console.log( "error" );
	})
}


function mostrar_detalles(){
    $.ajax({
		url      : appData.uri_app + "../webservice/carrito/mostrardetalles",
		type     : "POST",
		dataType : "html",
		data     : {
			idus : appData.idusuario,
            idve : appData.idven
		},
	})
	.done( function( respuesta ) {
        $( "#datos-detalles" ).html( respuesta );
	})
	.fail( function() {
		console.log( "error" );
	})
}

