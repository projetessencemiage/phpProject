<h2>Qui est le moins cher ?</h2>
<div class="row-fluid">
	<div class="span6">
		<iframe src="carteStations.php" name="frame" frameborder=yes
			width="500" height="400"></iframe>
		;
	</div>
	<div class="span6">
		<form>
			<fieldset>
				<legend> Se situer </legend> 
				<input type="text" name="newAdresse" id="newAdresse" placeholder="Saisir une nouvelle adresse"/>
			</fieldset>

			<fieldset>
				<legend>Paramètres</legend>
				<label for="carburantType">Choix du carburant : </label> 
				<select	name="carburantType" id="carburantType">
					<option value="0">(Tous)</option>
					<option value="1">Gazoil</option>
					<option value="2">SP-95</option>
					<option value="3">GPL</option>
				</select>
			</fieldset>

			<p>
				<input type="submit" value="Lancer la recherche"
					onClick="return validerForm()" class="btn" /> 
				<input type="reset"
					value="Annuler" class="btn" />
			</p>
		</form>
	</div>
</div>
