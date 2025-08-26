function cargaMapa() {
    var mapa= new google.maps.Map(
        document.getElementById( "mapa" ),
        {
            center: {
                lat : 17.183947550243854,
                lng : -100.60823857784271
            },
            zoom: 17,
            
        }
    );



    setTimeout( function() {
       
           
           

           mapa.setCenter({
            lat : 17.183947550243854,
            lng : -100.60823857784271
           }); 

        





          // Verificar si el navegador soporta la geolocalización
if ("geolocation" in navigator) {
  // Obtener la posición actual del usuario

  navigator.geolocation.getCurrentPosition(function(position) {
    // Asignar la latitud y longitud a variables
    var lati = position.coords.latitude;
    var lngi = position.coords.longitude;
    console.log("Latitud: " + lati + ", Longitud: " + lngi);


   var marcador = new google.maps.Marker({
                position : {
                    lat : 17.183947550243854,
                    lng : -100.60823857784271
                },
                map : mapa,
                dragable : true
            });

    
  });
} else {
  console.log("Geolocalización no soportada.");
}

    }, 1000);



}


