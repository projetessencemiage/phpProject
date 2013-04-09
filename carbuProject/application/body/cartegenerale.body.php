<h1>Qui est le moins cher ?</h1>
<iframe src="carteStations.php" name="frame" frameborder=yes width="600" height="400"></iframe>

<div  id="formGoogleMaps">
<form action="toto.php" method="post" >
<fieldset>
 <legend> Se situer : </legend>
  <label for="newAdresse">Adresse / Ville :</label>
   <input type="text" name="newAdresse" size="20" 
   maxlength="40" value="Tapez ici une adresse" id="newAdresse" />
</fieldset>

<fieldset>
 <legend>Paramètres :</legend>
 <label for="carburantType">Choix du carburant : </label>
   <select name="carburantType" id="carburantType">
   <option value="0"> (Tous) </option>
   <option value="1"> Gazoil </option>
   <option value="2"> SP-95</option>
   <option value="3"> GPL</option>
   </select>
</fieldset>

 <p>
 <input type="submit" value="Lancer la recherche" />
 <input type="reset" value="Annuler" />
 </p>

</form>

</div>