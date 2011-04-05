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

        <h1>Editar contenidos:</h1>
    	<textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>

        <p><a href="#" onclick="storeContents()">Guardar cambios <img src="images/save.png" alt="guardar" title="guardar" style="border:0;"/></a></p>
	    <p><a href="./admin.php">Volver <img src="images/back.png" alt="volver" title="volver" style="border:0;"/></a></p>
	    <p><a href="./log_out.php">Desconectar <img src="images/logout.png" alt="log out" title="log out" style="border:0;"/></a></p>
        <?php
            include("pie.php");
        ?>
        <div id="hiddenContents" style="display:none"></div>
    </div> <!-- style="background:white" -- >
	<script type="text/javascript">
	//<![CDATA[
(function(){var a;jQuery.ajax({type:"GET",async:false,url:"<?php echo $chosenPage;?>",success:function(c){a=c}});jQuery("#hiddenContents").html(a);var b=jQuery("#hiddenContents .monogatari-editor").html();CKEDITOR.replace("editor1",{width: '780',height: '250', skin:"kama",toolbar:[["Bold","Italic","Underline","Strike"],["JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock"],["Link","-","Image"],"/",["Styles","Format","Font","FontSize"],
["TextColor","BGColor"]]});jQuery("#editor1").html(b)})();function storeContents(){if(!confirm("Realmente deseas guardar los cambios?")){return false}var c=CKEDITOR.instances.editor1;var a=escape(c.getData());var b="url=<?php echo $chosenPage?>";b=b+"&editedContents="+a;jQuery.ajax({type:"POST",async:true,data:b,url:"./storeChanges.php",success:function(d){alert(d)}})};
	//]]>
	</script>
    </body>
    </html>

<?php
}
else {
    include("admin.php");
    }
?>
