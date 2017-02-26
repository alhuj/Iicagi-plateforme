 <?php
 echo'   <div>
        <p>
            <input type="button" value="G" />
            <input type="button" value="I" />
            <input type="button" value="Lien" />
            <input type="button" value="Image" />
            <input type="button" value="Citation" />
<select onchange="insertTag(\'<taille valeur=&quot;\' + this.options[this.selectedIndex].value + \'&quot;>\', \'</taille>\', \'textarea\');">
	<option value="none" class="selected" selected="selected">Taille</option>
	<option value="ttpetit">Très très petit</option>
	<option value="tpetit">Très petit</option>
	<option value="petit">Petit</option>
	<option value="gros">Gros</option>
	<option value="tgros">Très gros</option>
	<option value="ttgros">Très très gros</option>

</select>
<img src="http://users.teledisnet.be/web/mde28256/smiley/smile.gif" alt=":)" onclick="insertTag(\':)\', \'\', \'textarea\');" />
<img src="http://users.teledisnet.be/web/mde28256/smiley/unsure2.gif" alt=":euh:" onclick="insertTag(\':euh:\', \'\', \'textarea\');" />
        </p>
        <p>
            <input name="previsualisation" type="checkbox" id="previsualisation" value="previsualisation" />
            <label for="previsualisation">Prévisualisation automatique</label>
        </p>
    </div>

<textarea id="textarea"  onkeyup="preview(this, \'previewDiv\');" onselect="preview(this, \'previewDiv\');" id="textarea" cols="150" rows="10"></textarea>
	<div id="previewDiv"></div>

	<p>
        <input type="button" value="Visualiser" onclick="view(\'textarea\',\'viewDiv\');" />
    </p>

    <div id="viewDiv"></div>
			</div>
        </div>
	</div>

';