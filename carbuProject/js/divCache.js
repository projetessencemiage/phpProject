function apparaitre(){

    var valeur_visibility = document.getElementById("texte").style.visibility;
        if (valeur_visibility == "hidden")
           {
                   document.getElementById("texte").style.visibility = "";
				  document.getElementById("afficher_cacher").innerHTML = "<a href='#' onclick='apparaitre();'>Retour</a>";
           }
            else
           {
                   document.getElementById("texte").style.visibility = "hidden";
                  document.getElementById("afficher_cacher").innerHTML = "<a href='#' onclick='apparaitre();'>Modifier mes informations</a>";
           }
}
