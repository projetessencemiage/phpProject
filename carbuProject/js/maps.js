window.onload=function(){		
	//Declaration variables
	var myGeocoder = new google.maps.Geocoder();
	var bounds = new google.maps.LatLngBounds();
	var oldInfoBulle= null;
	var oldMarker = null;
	var var_adresse = 'Adresse';
	var var_enseigne = 'Enseigne';
	var var_icone = 'Icone';
	var var_listPrice = "ArrayPrice";
	var var_lat = "Lat";
	var var_lng = "Lng";
	var var_phone = "Phone";
	var var_id = "ID";

	//Recuperation des données
	var infoStations = document.getElementById('Stations').value;
	//Par default, GeoCentrage
	var myLatLng = new google.maps.LatLng(geoplugin_latitude(), geoplugin_longitude());
	//Centrage de la carte si Recherche par adresse sans résultat
	if (document.getElementById('CoordCarte')) {
		var split = document.getElementById('CoordCarte').value;
		var lat = split.split('-')[0];
		var lng = split.split('-')[1];
		if (lat != "") {
			var myLatLng = new google.maps.LatLng(lat, lng);
		}
	}
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
			createMarker(listeStations[iteStation]);
		}
	}

	//Ajouter un Marker � la MAP
	function addMarker(stationToMark) {
		var adresse = stationToMark[var_adresse];	
		myGeocoder.geocode( { 'address': adresse}, function(results, status) {		
			// Si la recherche à fonctionné
			if( status == google.maps.GeocoderStatus.OK ) { 
				createMarker(stationToMark);
			} // Fin si status OK		
		});
	}

	//Creation d'un MARKER sur la map
	function createMarker(markerInfos) {
		var myMarkerImage = new google.maps.MarkerImage('./images/' + markerInfos[var_icone]);
		var my_position = new google.maps.LatLng(markerInfos[var_lat], markerInfos[var_lng]);
		if (markerInfos[var_listPrice][keyCarbu] == null) {
			var titlePrice = "Non disponible";
		} else {
			var titlePrice = markerInfos[var_listPrice][keyCarbu]['Prix'] + ' €';
		}
		var myMarker = new google.maps.Marker({
			position: my_position,
			map: myMap,
			icon: myMarkerImage,
			title: titlePrice
		});
		bounds.extend(my_position);
		myMap.fitBounds(bounds);
		var affichePriceList = "";
		for (var key in markerInfos[var_listPrice]) {
			affichePriceList +=  '<br /><strong>' + key + '</strong> - ' + markerInfos[var_listPrice][key]['Prix'] + ' € (' + markerInfos[var_listPrice][key]['Maj'] + ')';
		}
		if (affichePriceList == "") {
			affichePriceList = "Prix non disponible";
		}
		var infoBulles = '<p>'
			+ '<address>'
			+ ' <strong>' +  markerInfos[var_enseigne] + '</strong><br>'
			+  markerInfos[var_adresse] + '<br>'
			+ ' <abbr title="Phone">Tel: </abbr>' + markerInfos[var_phone]
			+ ' </address>'
			+ ' </p>'
			+ '<p>Price: '
			+ affichePriceList
			+ '</p>'
			
		//Ajout Fenetre 
		var myWindowOptions = {
				content: infoBulles
		};

		// Création de la fenêtre
		var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);
		google.maps.event.addListener(myMarker, 'click', function() {
			addDivStation(markerInfos);
			if (oldInfoBulle != null) {
				oldInfoBulle.close(myMap, oldMarker);
				
			}
			if (oldInfoBulle != myInfoWindow) {
				myInfoWindow.open(myMap,myMarker);
				oldInfoBulle = myInfoWindow;
				oldMarker = myMarker;
			} else {
				oldInfoBulle = null;
			}
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

	//Ajouter une station � la liste des stations
	//Station avec toutes ces infos.
	function addStation(stationToAdd) {
		//Split des infos
		var splitInfos = stationToAdd.split("--");
		var station =  new Array();
		var arrayPrice = new Array();
		var j = 0;
		//Parcours de chaque donn�es
		for (j = 0 ; j < splitInfos.length-1 ; j++) {
			var keyValue = splitInfos[j].split('@@@');
			//Si Donn�es relative au prix
			if (keyValue[0].startsWith("PriceKey")) {
				var key = keyValue[0].substring(keyValue[0].indexOf('PriceKey:')+9);
				var value = keyValue[1].substring(keyValue[1].indexOf('Value:')+6);
				var maj = keyValue[2].substring(keyValue[1].indexOf('Maj:')+4);
				arrayPrice[key] = new Array();
				arrayPrice[key]['Prix'] = value;
				arrayPrice[key]['Maj'] = maj;
			} else {
				//Else autre donn�e
				var key = keyValue[0].substring(keyValue[0].indexOf('Key:')+4);
				var value = keyValue[1].substring(keyValue[1].indexOf('Value:')+6);
				station[key] = value;
			}
		}
		//Ajout Liste des Prix
		station[var_listPrice] = arrayPrice;
		//Retourne une liste TypeInfo/Donn�es + Une Liste de prix de la station
		return station;
	}
	
	function addDivStation(marker) {
		var divStation = '<p>'
			+ '<address>'
			+ ' <strong>' +  marker[var_enseigne] + '</strong><br>'
			+  marker[var_adresse] + '<br>'
			+ ' <abbr title="Phone">Tel: </abbr>' + marker[var_phone]
			+ ' </address>'
			+ ' </p>'
			+ '<p>Price: '
			+ 	affichePriceList(marker[var_listPrice])
			+ '</p>'
		document.getElementById('divStation').style.display = 'block';
		document.getElementById('divInfoStation').innerHTML = divStation;
		document.getElementById('stationToChange').value = marker[var_id];
	}
	
	function affichePriceList(listPrice) {
		var affichePriceList = "";
		for (var key in listPrice) {
			affichePriceList +=  '<br /><strong>' + key + '</strong> - ' + listPrice[key]['Prix'] + ' € (' + listPrice[key]['Maj'] + ')';
			affichePriceList += ' <i class="icon-edit"></i>'
		}
		if (affichePriceList == "") {
			affichePriceList = "Prix non disponible";
		}
		return affichePriceList;
	}
}
