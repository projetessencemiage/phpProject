window.onload=function(){	
	//Declaration variables
	var markerToWork;
	var myGeocoder = new google.maps.Geocoder();
	var myMap;
	var myLatLng = new google.maps.LatLng(geoplugin_latitude(), geoplugin_longitude());
	
	//Recuperation des données
	var infoStations = document.getElementById('Stations').value;
	
	//Construction de la Liste de Stations avec infos
	var splitInfoStations = infoStations.split('|');
	var listeStations = new Array();
	var i = 0;
	for (i = 0 ; i < splitInfoStations.length - 1 ; i++) {
		listeStations[i] = addStation(splitInfoStations[i]);
	}

	//Parcours de la liste de stations pour en faire des Markers
	function parseListToMarkers() {
		var iteStation;
		for (iteStation = 0 ; iteStation < listeStations.length ; iteStation++) {
			markerToWork = listeStations[iteStation];
			addMarker(markerToWork);
		}
	}
	

	if (document.getElementById('newAdresse')) {
		myGeocoder.geocode( { 'address': document.getElementById('newAdresse').value}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		    	  createMap(results[0].geometry.location);
		      } else {
		        alert("Geocode was not successful for the following reason: " + status);
		      }
		    });
	} else {
		createMap(myLatLng);	
	}
	
		
	function createMap(LatLngMap) {
		//Options de la MAP
		var mapOptions = {
				center: LatLngMap,
				zoom: 12,
				mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		parseListToMarkers();
	}

	//Ajouter une station à la liste des stations
	function addStation(stationToAdd) {
		var splitInfos = stationToAdd.split("--");
		var station =  new Array();
		var j = 0;
		if (splitInfos.length >= 2) {
			for (j = 0 ; j < splitInfos.length-1 ; j++) {
				station[j] = splitInfos[j];
			}
		}
		return station;
	}

	//Ajouter un Marker à la MAP
	function addMarker(stationToMark) {
		var adresse = stationToMark[0];	
		myGeocoder.geocode( { 'address': adresse}, function(results, status) {		
			// Si la recher à fonctionné
			if( status == google.maps.GeocoderStatus.OK ) { 
				createMarker(myMap, results[0].geometry.location, stationToMark);
			} // Fin si status OK		
		});
	}


	//Creation d'un MARKER sur la map
	function createMarker(map, my_position, markerInfos) {
		var myMarkerImage = new google.maps.MarkerImage('./images/station.jpg');
		var myMarker = new google.maps.Marker({
			position: my_position,
			map: map,
			icon: myMarkerImage,
			title: markerInfos[1]
		});
		//Ajout Fenetre 
		var myWindowOptions = {
				content:
					'<p>'
					+ '<address>'
					+ ' <strong>' +  markerInfos[1] + '</strong><br>'
					+  markerInfos[0] + '<br>'
					+ ' <abbr title="Phone">P:</abbr> (123) 456-7890'
					+ ' </address>'
					+ ' </p>'
		};

		// Création de la fenêtre
		var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);
		google.maps.event.addListener(myMarker, 'click', function() {
			myInfoWindow.open(myMap,myMarker);
		});
	}
}