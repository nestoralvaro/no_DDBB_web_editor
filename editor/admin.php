<?php
    include_once("validar_user.php");
    include("cabecera.php");
    include_once("getPagesArrays.php");

$validado = validar_user();
if ($validado == 0 || $validado == 1) {


    function startLanguageCount($lang) {
        $id = 0;
        if ($lang == "es")
            $id = 100;
        else if ($lang == "fr")
            $id = 200;
        else if ($lang == "al")
            $id = 300;
        else if ($lang == "en")
            $id = 400;
        return $id;
    }


    function generateLinks($lang) {
            $idCount = startLanguageCount($lang);
            $array = getPages($lang);
            $count = count($array);
            for ($i = 0; $i < $count; $i++) {
               $idCount++;
               echo "<li>
                    <a href=\"editor.php?url=" . $lang . "-" . $array[$i] . "&id=" . $idCount . "\">" . $lang . " - " . $array[$i] . "&nbsp;&nbsp;<img src=\"images/edit.png\" alt=\"editar\" title=\"editar\" style=\"border:0;\"/></a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a target=\"_blank\" href=\"../" . $lang . "/" . $array[$i] . ".html\">Ver p&aacute;gina&nbsp;&nbsp;<img src=\"images/view.png\" alt=\"ver\" title=\"ver\" style=\"border:0;\"/></a>
                </li>";
            }
        }
	?>

		<p>Usuario validado Correctamente</p>
		<p>1- Eliga el idioma a editar: </p>
		<p>
            <a href="javascript:mostrar('al')">Alem&aacute;n</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="javascript:mostrar('en')">Ingl&eacute;s</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="javascript:mostrar('es')">Espa&ntilde;ol</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="javascript:mostrar('fr')">Franc&eacute;s</a>
        </p>

		<p>2- Eliga la p&aacute;gina a editar: </p>        
            <!-- GERMAN -->
            <ul id="al" style="display:none;">
                <?php 
                    generateLinks("al");
                ?>
            </ul>
            <!-- ENGLISH -->
            <ul id="en" style="display:none;">
                <?php 
                    generateLinks("en");
                ?>
            </ul>
            <!-- SPANISH -->
            <ul id="es" style="display:none;">
                <!-- INDEX -->
                <li>
                    <a href="editor.php?url=es-index&id=0">es - index&nbsp;&nbsp;<img src="images/edit.png" alt="editar" title="editar" style="border:0;"/></a> 
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a target="_blank" href="../index.html">Ver p&aacute;gina&nbsp;&nbsp;<img src="images/view.png" alt="ver" title="ver" style="border:0;"/></a>
                </li>
                <?php 
                    generateLinks("es");
                ?>
            </ul>
            <!-- FRENCH -->
            <ul id="fr" style="display:none;">
                <?php 
                    generateLinks("fr");
                ?>
            </ul>

	    <p><a href="./log_out.php">Desconectar <img src="images/logout.png" alt="log out" title="log out" style="border:0;"/></a></p>

<?php
}
else {
?>
	Usuario no validado

	<form action="#" method="post">

		<fieldset>
			Usuario: <input name="user_login" type="text" id="user_login" class="textfield"  />
			<br />
			Password: <input name="password_login" type="password" id="password_login" class="textfield" />
			<br />
			<input name="submit" type="submit" id="submit_login" class="submit" value="Continuar" />
		</fieldset>
	</form>


<?php
}
?>

	</div><!-- fin cuerpo -->

<?php
    include("pie.php");
?>

</div>

<script>

function ocultarTodos(){
    document.getElementById("al").style.display="none";
    document.getElementById("en").style.display="none";
    document.getElementById("es").style.display="none";
    document.getElementById("fr").style.display="none";
}

function mostrar(id){
    ocultarTodos();
    document.getElementById(id).style.display="block";
}
</script>

</body>
</html>
