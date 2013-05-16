window.onload=function(){		
	//Declaration variables
	var myGeocoder = new google.maps.Geocoder();
	var bounds = new google.maps.LatLngBounds();
	var oldImage = null;
	var oldMarker = null;
	var var_adresse = 'Adresse';
	var var_enseigne = 'Enseigne';
	var var_icone = 'Icone';
	var var_listPrice = "ArrayPrice";
	var var_lat = "Lat";
	var var_lng = "Lng";
	var var_phone = "Phone";
	var var_id = "ID";
	var centrerCarte = false;

	//Recuperation des données
	var infoStations = document.getElementById('Stations').value;
	//ID to Change Marker
	var idToChangeMarker = document.getElementById('stationToAfficheInfoID').value;
	//Par default, GeoCentrage
	var myLatLng = new google.maps.LatLng(geoplugin_latitude(), geoplugin_longitude());
	//Centrage de la carte si Recherche par adresse sans résultat
	if (document.getElementById('CoordCarte')) {
		var split = document.getElementById('CoordCarte').value;
		var lat = split.split('@')[0];
		var lng = split.split('@')[1];
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
		centrerCarte = true;
	}
	var myMap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var listeStation = getListeStations();
	parseListToMarkers(listeStation);
	
	
	if (document.getElementById('CoordCarte')) {
	new google.maps.Marker({
		position: myLatLng,
		map: myMap,
		title: 'Ma position'
		});
	}
	
	//Parcours de la liste de stations pour en faire des Markers
	function parseListToMarkers(listeStations) {
		var iteStation;
		for (iteStation = 0 ; iteStation < listeStations.length ; iteStation++) {
			createMarker(listeStations[iteStation]);
		}
		
		// Don't zoom in too far on only one marker
	    if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
	       var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.01, bounds.getNorthEast().lng() + 0.01);
	       var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.01, bounds.getNorthEast().lng() - 0.01);
	       bounds.extend(extendPoint1);
	       bounds.extend(extendPoint2);
	    }
	    if (centrerCarte) {
	    	myMap.fitBounds(bounds);
	    }
	}

	//Creation d'un MARKER sur la map
	function createMarker(markerInfos) {
		//Gestion image
		if (markerInfos[var_id] == idToChangeMarker) {
			var urlSelect = markerInfos[var_icone].replace('.png', '_E.png');
			var url = './images/' + urlSelect;
		} else {
			var url = './images/' + markerInfos[var_icone];
		}
		var myMarkerImage = new google.maps.MarkerImage(url);
		var my_position = new google.maps.LatLng(markerInfos[var_lat], markerInfos[var_lng]);
		//Gestion affichage Prix au survol Icon
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

		google.maps.event.addListener(myMarker, 'click', function() {
			addDivStation(markerInfos);
			document.getElementById('stationToAfficheInfoID').value = markerInfos[var_id];
			if (oldMarker == null || oldMarker != myMarker) {
				var image = myMarker.getIcon();
				var url = myMarker.getIcon().url;
				var newUrl = url.replace('.png', '_E.png');
				myMarker.setIcon(newUrl);
				if (oldMarker != null) {
					oldMarker.setIcon(oldImage);
				}
				oldMarker = myMarker;
				oldImage = image;
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
		//Parcours de chaque donnees
		for (j = 0 ; j < splitInfos.length-1 ; j++) {
			var keyValue = splitInfos[j].split('@@@');
			//Si Donn�es relative au prix
			if (keyValue[0].startsWith("PriceKey")) {
				var key = keyValue[0].substring(keyValue[0].indexOf('PriceKey:')+9);
				var value = keyValue[1].substring(keyValue[1].indexOf('Value:')+6);
				var maj = keyValue[2].substring(keyValue[2].indexOf('Maj:')+4);
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
		document.getElementById('stationToUpdatePrice').value = marker[var_id];
	}
	
	function affichePriceList(listPrice) {
		var affichePriceList = "";
		for (var key in listPrice) {
			var redClass = "";
			if (keyCarbu == key) {
				redClass = "class='redClass'";
			}
			var nbJour = nbJourToString(listPrice[key]['Maj']);
			affichePriceList +=  '<br /><strong ' + redClass + '>' + key + '</strong> - ' + listPrice[key]['Prix'] + ' € <span class="majPrix">' + nbJour + '</span>';
		}
		if (affichePriceList == "") {
			affichePriceList = "Prix non disponible";
		}
		return affichePriceList;
	}
	
	function nbJourToString(nbJour) {
		if (nbJour == 0) return "MàJ Aujourd'hui";
		if (nbJour == 1) return "MàJ Hier";
		else return 'MàJ il y a ' + nbJour + 'j';
		
	}
}
