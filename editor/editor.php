<?php
    include_once("validar_user.php");
    include("cabecera.php");
    include_once("getPagesArrays.php");

$validado = validar_user();
if ($validado == 0 || $validado == 1) {
?>

    <div style="background:white;">
        <p style="float:right; font-size:small; margin-right:10px;">
            <a href="#" onclick="storeContents()">Guardar cambios <img src="images/save.png" alt="guardar" title="guardar" style="border:0;"/></a>
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="./admin.php">Volver <img src="images/back.png" alt="volver" title="volver" style="border:0;"/></a>
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="./log_out.php">Desconectar <img src="images/logout.png" alt="log out" title="log out" style="border:0;"/></a>
        </p>

        <br/>
	    <h1>
		    Editor de la p&aacute;gina&nbsp;<span style="color:blue;font-style:italic">
            <?php 

                function getIt($id) {
                    $page = "";
                    $lang = "";
                    $pagId = 0;
//                    if ($id > 100)
                    $page = "../";
                
                    if ($id <= 100) {
//                        echo "<br/> Admin <br/>";
                    } else if ($id < 200) { // 100 - 199
                        $lang = "es";
                        $pageId = $id%100;
                    } else if ($id < 300) { // 200 - 299
                        $lang = "fr";
                        $pageId = $id%100;
                    } else if ($id < 400) { // 300 - 399
                        $lang = "al";
                        $pageId = $id%100;
                    } else if ($id < 500) { // 400 - 499
                        $lang = "en";
                        $pageId = $id%100;
                    }
                    
                    if ($id == 0) {
                        $page .= "index.html";
                    } else {
                        $array = getPages($lang);
                        $page .= $lang . "/";
                        $page .= $array[$pageId - 1];
                        $page .= ".html";
                    }
	                return $page;
                }

                $chosenPage = getIt($_REQUEST['id']);
                $pageName = $_REQUEST['url'];
                echo $pageName;

            ?>
            </span>
	    </h1>
        <br/>
        <h1>Gestionar las fotos:</h1>
        <?php
            include("manageFotos.php");
        ?>

        <h1>
            Editar contenidos:
            <div id="imgLoader" style="color:red;">
                Cargando contenidos...
                <br/>
                <img src="./images/loader_light_blue.gif" alt="Cargando..." title="Cargando..." />
            </div>
        </h1>
        
    	<textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>

        <p><a href="#" onclick="storeContents()">Guardar cambios <img src="images/save.png" alt="guardar" title="guardar" style="border:0;"/></a></p>
	    <p><a href="./admin.php">Volver <img src="images/back.png" alt="volver" title="volver" style="border:0;"/></a></p>
	    <p><a href="./log_out.php">Desconectar <img src="images/logout.png" alt="log out" title="log out" style="border:0;"/></a></p>
        <?php
            include("pie.php");
        ?>
        <div id="hiddenContents" style="display:none"></div>
    </div>
	<script type="text/javascript">
    

    function storeContents() {
        if (!confirm("Realmente deseas guardar los cambios?")) {
            return false;
        }
	    // Get the editor instance that we want to interact with.
	    var oEditor = CKEDITOR.instances.editor1;
	    // Get the editor contents
//	    alert( oEditor.getData() );
        // Recuperar los contenidos del div alterado
//        var cambios = jQuery("#editor1").html();


        var cambiosTemp = oEditor.getData();
//        var cambios = escape(cambiosTemp);
//        cambiosTemp = cambiosTemp.replace('+','%252B'); // Escape this special sequence
//        var cambios = escape(cambiosTemp);
        var cambios = encodeURIComponent(cambiosTemp);
//        var cambios = escape(oEditor.getData());
        var datos = "url=<?php echo $chosenPage?>";
        datos = datos + "&editedContents=" + cambios;
//        alert(datos);
//        alert(cambios);

        jQuery.ajax({
            type: "POST",
            async:true,
            data:datos,
            url: "./storeChanges.php",
            success: function(datosRetorno){
                alert(datosRetorno);
            }
        });

    }

    function initEditor(){
        var paginaWeb;
        // Store the contents of the page on a JS variable
        jQuery.ajax({
            type: "GET",
            async:false,
            url: "<?php echo $chosenPage;?>",
            success: function(datosRetorno){
                paginaWeb = datosRetorno;
                // Set contents on hidden DIV
                jQuery("#hiddenContents").html(paginaWeb);
                var editable = jQuery("#hiddenContents .monogatari-editor").html();

                CKEDITOR.replace( 'editor1',
					            {
						            skin : 'kama',
					                toolbar : [ ['Source'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                ['Link','-','Image'],
                                                '/',
                                                ['Bold', 'Italic', 'Underline', 'Strike'],
                                                ['Font','FontSize'],
                                                ['TextColor','BGColor']
                                            ]
				                });
                jQuery("#editor1").html(editable);
                jQuery("#imgLoader").hide();
            } // success
        });
    }

    initEditor();

	</script>
    </body>
    </html>

<?php
}
else {
    include("admin.php");
    }
?>
