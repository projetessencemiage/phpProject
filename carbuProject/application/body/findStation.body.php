<h2>Trouver une station</h2>

<div class="row-fluid">
	<div class="span12">
		<form>
			<fieldset>
				<legend>Carburant*</legend>
				<select name="carburantType" id="carburantType">
					<option value="1">Diesel</option>
					<option value="2">SP-95</option>
					<option value="3">GPL</option>
				</select>
			</fieldset>
			<fieldset>
				<legend> Localisation </legend>
				<input type="text" name="newAdresse" id="newAdresse"
					placeholder="Saisir une nouvelle adresse" />
			</fieldset>
			<p>
				<input type="submit" value="Search"
					onClick="return validerForm()" class="btn" /> <input type="reset"
					value="Annuler" class="btn" />
			</p>
		</form>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">Form2</div>
</div>
