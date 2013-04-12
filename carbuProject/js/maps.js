window.onload=function(){		
	//Declaration variables
	var markerToWork;
	var myGeocoder = new google.maps.Geocoder();
	var myMap;
	var myLatLng = new google.maps.LatLng(geoplugin_latitude(), geoplugin_longitude());
	var var_adresse = 'Adresse';
	var var_enseigne = 'Enseigne';
	var var_icone = 'Icone';

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
	//Station avec toutes ces infos.
	function addStation(stationToAdd) {
		//Split des infos
		var splitInfos = stationToAdd.split("--");
		var station =  new Array();
		var arrayPrice = new Array();
		var j = 0;
		//Parcours de chaque données
		for (j = 0 ; j < splitInfos.length-1 ; j++) {
			var keyValue = splitInfos[j].split('@@@');
			//Si Données relative au prix
			if (keyValue[0].startsWith("PriceKey")) {
				var key = keyValue[0].substring(keyValue[0].indexOf('PriceKey:')+9);
				var value = keyValue[1].substring(keyValue[1].indexOf('Value:')+6);
				arrayPrice[key] = value;
			} else {
				//Else autre donnée
				var key = keyValue[0].substring(keyValue[0].indexOf('Key:')+4);
				var value = keyValue[1].substring(keyValue[1].indexOf('Value:')+6);
				station[key] = value;
			}
		}
		//Ajout Liste des Prix
		station['ArrayPrice'] = arrayPrice;
		//Retourne une liste TypeInfo/Données + Une Liste de prix de la station
		return station;
	}

	//Ajouter un Marker à la MAP
	function addMarker(stationToMark) {
		var adresse = stationToMark[var_adresse];	
		myGeocoder.geocode( { 'address': adresse}, function(results, status) {		
			// Si la recher à fonctionné
			if( status == google.maps.GeocoderStatus.OK ) { 
				createMarker(myMap, results[0].geometry.location, stationToMark);
			} // Fin si status OK		
		});
	}


	//Creation d'un MARKER sur la map
	function createMarker(map, my_position, markerInfos) {
		var myMarkerImage = new google.maps.MarkerImage('./images/' + markerInfos[var_icone]);
		var myMarker = new google.maps.Marker({
			position: my_position,
			map: map,
			icon: myMarkerImage,
			title: markerInfos[var_enseigne]
		});
		
		var affichePriceList = "";
		for (var key in markerInfos['ArrayPrice']) {
			affichePriceList +=  '<br />' + key + ' - ' + markerInfos['ArrayPrice'][key] + ' €';
		}
		//Ajout Fenetre 
		var myWindowOptions = {
				content:
					'<p>'
					+ '<address>'
					+ ' <strong>' +  markerInfos[var_enseigne] + '</strong><br>'
					+  markerInfos[var_adresse] + '<br>'
					+ ' <abbr title="Phone">P:</abbr> (123) 456-7890'
					+ ' </address>'
					+ ' </p>'
					+ '<p>Price: '
					+ affichePriceList
					+ '</p>'
		};

		// Création de la fenêtre
		var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);
		google.maps.event.addListener(myMarker, 'click', function() {
			myInfoWindow.open(myMap,myMarker);
		});
	}
}