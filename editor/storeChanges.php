<?php

include_once("validar_user.php");

$validado = validar_user();
if ($validado == 0 || $validado == 1) {
    // example of how to use basic selector to retrieve HTML contents
    include('simple_html_dom.php');
     
    // get DOM from URL or file
    $url_editable = $_POST['url'];
    $edited_contents = $_POST['editedContents'];
    //echo $url_editable;
    $html = file_get_html($url_editable);

    $html->find('.monogatari-editor', 0)->innertext = $edited_contents;

    $newdata = $html->outertext;
    //echo $newdata;

    // open file 
    $fw = fopen($url_editable, 'w') or die('No se puede abrir el fichero!');
    // write to file
    // added stripslashes to $newdata
    $fb = fwrite($fw,stripslashes($newdata)) or die('No se puede escribir en el fichero!');
    // close file
    fclose($fw);
    echo "Pagina editada correctamente.";
}
?> 
