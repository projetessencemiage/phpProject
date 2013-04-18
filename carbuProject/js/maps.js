adelewindow.onload=function(){		
	//Declaration variables
	var myGeocoder = new google.maps.Geocoder();
	var myLatLng = new google.maps.LatLng(geoplugin_latitude(), geoplugin_longitude());
	var bounds = new google.maps.LatLngBounds();
	var var_adresse = 'Adresse';
	var var_enseigne = 'Enseigne';
	var var_icone = 'Icone';
	var var_listPrice = "ArrayPrice"

	//Recuperation des données
	var infoStations = document.getElementById('Stations').value;
	var keyCarbu = document.getElementById('carbuType').value;
	if (infoStations == "") {
		var mapOptions = {
				center: myLatLng,
				Zoom: 12, 
				mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	} else {
		//Options de la MAP
		var mapOptions = {mapTypeId: google.maps.MapTypeId.ROADMAP};
	}
	
	var myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var listeStation = getListeStations();
	parseListToMarkers(listeStation);
	//Parcours de la liste de stations pour en faire des Markers
	function parseListToMarkers(listeStations) {
		var iteStation;
		for (iteStation = 0 ; iteStation < listeStations.length ; iteStation++) {
			addMarker(listeStations[iteStation]);
		}
	}

	//Ajouter un Marker à la MAP
	function addMarker(stationToMark) {
		var adresse = stationToMark[var_adresse];	
		myGeocoder.geocode( { 'address': adresse}, function(results, status) {		
			// Si la recherche à fonctionné
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
			title: markerInfos[var_listPrice][keyCarbu] + '€'
		});
		bounds.extend(my_position);
		myMap.fitBounds(bounds);
		var affichePriceList = "";
		for (var key in markerInfos[var_listPrice]) {
			affichePriceList +=  '<br /><strong>' + key + '</strong> - ' + markerInfos[var_listPrice][key] + ' €';
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

	//Retourne la liste des stations avec toutes leurs infos
	function getListeStations() {
		//Construction de la Liste de Stations avec infos
		var splitInfoStations = infoStations.split('|');
		var listeStations = new Array();
		var i = 0;
		for (i = 0 ; i < splitInfoStations.length - 1 ; i++) {
			listeStations[i] = addStation(splitInfoStations[i]);
		}
		return listeStations;
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
		station[var_listPrice] = arrayPrice;
		//Retourne une liste TypeInfo/Données + Une Liste de prix de la station
		return station;
	}
}