<h2>Trouver une station</h2>

<div class="row-fluid">
	<div class="span12">
		<fieldset>
			<legend>Type of Carburant*</legend>
			<select name="carburantType" id="carburantType">
				<option value="1">Diesel</option>
				<option value="2">SP-95</option>
				<option value="3">GPL</option>
			</select>
		</fieldset>

		<legend onclick="afficherDiv('divLocalisation')"> Search by
			localisation </legend>
		<div id="divLocalisation">
			<fieldset>
				<input type="text" name="searchVille" id="searchVille"
					placeholder="Recherche par ville"
					onChange="deleteInput('searchVille')" /> 
					<input
					type="text" class="input-mini" name="searchVilleDpt" id="searchVilleDpt"
					placeholder="Dpt"
					onChange="deleteInput('searchVille')" />
					
					&nbsp; OR &nbsp;<input
					type="text" name="searchDpt" id="searchDpt"
					placeholder="Recherche par département"
					onChange="deleteInput('searchDpt')" /> &nbsp; OR &nbsp; <input
					type="text" name="searchCP" id="searchCP"
					placeholder="Recherche par code postal"
					onChange="deleteInput('searchCP')" />
				<div>
					<input type="text" name="searchAdresse" id="searchAdresse"
						placeholder="Recherche par adresse"
						onChange="deleteInput('searchAdresse')"  class="input-xxlarge"/> <select name="rayon"
						id="rayon">
						<option value="5">5 km</option>
						<option value="10">10 km</option>
						<option value="20">20 km</option>
						<option value="50">50 km</option>
					</select>
				</div>
			</fieldset>
			<p>
				<input type="submit" value="Go to map" onClick="return validerFormSearchListStation('CarteGenerale.php')" class="btn btn-info" />
				<input type="submit" value="Go to list" onClick="return validerFormSearchListStation('ListeStations.php')" class="btn btn-info" />
				<input type="reset" value="Annuler" class="btn" />
			</p>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<legend onclick="afficherDiv('divAroundMe')">Search around me</legend>
		<div id="divAroundMe">
			<fieldset>
				<select name="rayonAroundMe" id="rayonAroundMe">
					<option value="5">5 km</option>
					<option value="10">10 km</option>
					<option value="20">20 km</option>
					<option value="50">50 km</option>
				</select>
			</fieldset>
			<p>
				<input type="submit" value="Around me"
					onClick="return validerFormArroundMe()" class="btn btn-success" />
			</p>
		</div>
	</div>
</div>

<input type="hidden" id="actionForm" name="actionForm" value="" />
