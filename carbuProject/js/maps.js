window.onload=function(){
	//Recuperation des données
	var latSite = document.getElementById('latSite').value;
	var longSite = document.getElementById('longSite').value;
	
	var mapOptions = {
          center: new google.maps.LatLng(latSite, longSite),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
	var myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	
	var listeAdresses = [
			"10 allee Eglise 40280 Benquet", 
			"40000 Mont de Marsan",
			"49 rue Robespierrre 33400 Talence" ,
			"60 rue Robespierrre 33400 Talence" ,
			"65 rue Robespierrre 33400 Talence" ,
			"70 rue Robespierrre 33400 Talence" ,
			"85 rue Robespierrre 33400 Talence" ,
			"95 rue Robespierrre 33400 Talence" ,
			"105 rue Robespierrre 33400 Talence" ,
			"125 rue Robespierrre 33400 Talence" ,
			"135 rue Robespierrre 33400 Talence" ,
			"140 rue Robespierrre 33400 Talence" ,
			"2 rue Robespierrre 33400 Talence" ,
			"15 rue Robespierrre 33400 Talence"
			];
	
	for(var i= 0; i < listeAdresses.length; i++) {
		addMarker(listeAdresses[i]);
	}
  
	function addMarker(adresse) {
		var GeocoderOptions = {
	    'address' : adresse,
	    'region' : 'FR'
		}
		var myGeocoder = new google.maps.Geocoder();
		myGeocoder.geocode( GeocoderOptions, createMarkerWithAdresse );
	}
	function createMarker(map, my_position) {
	var myMarkerImage = new google.maps.MarkerImage('./images/station.jpg');
		var myMarker = new google.maps.Marker({
				position: my_position,
				map: map,
				icon: myMarkerImage,
				title: "Cinéma Pathé Bellecour"
			});
	}
	
	function createMarkerWithAdresse( results , status )
	{
	  // Si la recher à fonctionné
	  if( status == google.maps.GeocoderStatus.OK ) { 
	      createMarker(myMap, results[0].geometry.location);
	  } // Fin si status OK
	} // Fin de la fonction
	
	}