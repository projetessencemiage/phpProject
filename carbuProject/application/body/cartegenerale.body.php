<h1>Qui est le moins cher ?</h1>
<iframe src="carteStations.php" name="frame" frameborder=yes width="600" height="400"></iframe>
<div>
<form action="toto.php" method="post" >

<fieldset>
 <legend> A propos des CSS : </legend>
   <p>Savez-vous ce que veut dire CSS ? : </p>
     <input type="radio" name="CSS" value="oui" id="oui"
     checked="checked" />
     <label for="oui" class="inline">oui</label>
     <input type="radio" name="CSS" value="non" id="non" />
     <label for="non" class="inline">non</label>
	 
  <label for="utilise">Si oui, les utilisez-vous plut�t : </label>
   <select name="utilise" id="utilise">
   <option value="toujours"> toujours</option>
   <option value="parfois"> parfois</option>
   <option value="jamais"> jamais</option>
   </select>
</fieldset>

<fieldset>
 <legend>Vos coordonn�es :</legend>
  <label for="email">Votre email :</label>
   <input type="email" name="email" size="20" 
   maxlength="40" value="email" id="email" />

  <label for="comments">Vos commentaires :</label>
   <textarea name="comments" id="comments" cols="20" rows="4">
   </textarea>
</fieldset>

 <p>
 <input type="submit" value="Envoyer" />
 <input type="reset" value="Annuler" />
 </p>

</form>

</div>