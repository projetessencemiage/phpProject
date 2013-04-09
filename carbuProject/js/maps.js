window.onload=function(){	
	//Recuperation des données
	var latSite = geoplugin_latitude();
	var longSite = geoplugin_longitude();
	var infoStations = document.getElementById('Stations').value;
	
	//Declaration variables
	var markerToWork;
	
	//Construction de la Liste de Stations avec infos
	var splitInfoStations = infoStations.split('|');
	var listeStations = new Array();
	var i = 0;
	for (i = 0 ; i < splitInfoStations.length - 1 ; i++) {
		listeStations[i] = addStation(splitInfoStations[i]);
	}
	
	//Parcours de la liste de stations pour en faire des Markers
	var iteStation;
	for (iteStation = 0 ; iteStation < listeStations.length ; iteStation++) {
		markerToWork = listeStations[iteStation];
		addMarker(markerToWork);
	}
	
	//Options de la MAP
	var mapOptions = {
          center: new google.maps.LatLng(latSite, longSite),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
	var myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	
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
		var GeocoderOptions = {
	    'address' : adresse,
	    'region' : 'FR'
		}
		var myGeocoder = new google.maps.Geocoder();
		myGeocoder.geocode( GeocoderOptions, function(results, status) {		
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
			'<h6>' + markerInfos[1] + '</h6>'+
			'<p></p>'
		};
		 
		// Création de la fenêtre
	var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);
	google.maps.event.addListener(myMarker, 'click', function() {
	myInfoWindow.open(myMap,myMarker);
	});
	}		
	
	}