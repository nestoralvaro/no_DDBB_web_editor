<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head> 
 

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="SHORTCUT ICON" href="../estilos/favicon.ico"> 
<title>Amasasturias</title>
<link href="../estilos/estilos.css" rel="stylesheet" type="text/css" />
</head><body>
<div id="idiomas">
<ul >
<li><a href="../fr/index_fr.html" title="Français"><img src="../estilos/imagenes/bandfra.jpg" alt="Français" /></a></li>
<li>|</li> 
<li><a href="index_en.html" title="English"><img src="../estilos/imagenes/banding.jpg" alt="English" /></a></li>
<li>|</li>
<li><a href="../al/index_al.html" title="Deutsch"><img src="../estilos/imagenes/bandale.jpg" alt="Deutsch" /></a></li>
<li>|</li>
<li><a href="../index.html" title="Castellano"><img src="../estilos/imagenes/bandesp.jpg" alt="Castellano" /></a></li>
</ul>
</div><br />
<div id="general">
<div id="cabecera"><img src="../estilos/imagenes/cabecera01.jpg" alt="Web de Amasasturias" height="100%" width="100%"></div>

<div id="menu">
<ul>
<li><a href="index_en.html">Home Page</a></li>
<li><a href="ciudades.html">City Tours</a></li>
<li><a href="itinerario.html">Itineraries</a></li>
<li><a href="servicios.html">Other Services</a></li>
<li><a href="conocenos.html">About us</a></li>
<li><a href="contacto.html"><strong>Contact details</strong></a></li>
<li><a href="enlaces.html">Links</a></li>
<li><a href="http://amasasturias.blogspot.com" target="_blank"><span class="redessociales">Blog</span></a></li>
<li><a href="http://www.facebook.com/krismonteropuntocom#!/pages/A-Asturias/178157992220403" target="_blank"><span class="redessociales">Facebook</span></a></li>
</ul>
</div>

<div id="cuerpo">
<!--<div id="banner"><img src="estilos/imagenes/banner.jpg" alt="Web de Amasasturias" height="100%" width="100%"></div>-->
<div id="titulos"> <h1> Contact Details </h1> </div>
<div id="textos" class="monogatari-editor">
<p>You can contact us at:</p>
<table style="text-align: right;" border="0" width="875">            
<tbody>      
<tr>              
<td>        

<div style="margin-left: 2em; line-height: 25px;" class="vcard">                            
<div class="fn org" style="text-align: left;"></div>                            

<div class="url" style="text-align: left;">http://www.amasasturias.com</div>                            
<div class="adr">
<div style="text-align: left;"><span class="Apple-style-span" style="font-weight: bold;">Address:</span><br></div>
<div class="street-address" style="text-align: left;">Avenida de Moreda nº7, 4ºA</div>        <span class="locality">
<div style="text-align: left;"><span class="locality">Gijón</span>, <span class="region">Asturias</span>&nbsp;&nbsp;<span class="postal-code">33212</span><br></div></span>
<div class="country-name" style="text-align: left;">Spain</div>  </div>                            
<div class="tel" style="text-align: left;"><span class="type"><strong>Telephone:</strong></span>(+34) 651 502 507</div>                            
<div style="text-align: left;"><strong>Electronic mail:</strong> <span class="email">info@amasasturias.com</span></div>  </div> </td>              
<td>                                                           
<div></div></td>    </tr>  </tbody></table>
<br />
    <style type="text/css">
        .monogatari-error {
            color:red;
            font-weight:bold;
        }
    </style>

    <?php
        $error1 = "<p><span class=\"monogatari-error\">El nombre no puede estar vac&iacute;o</span></p>";
        $error2 = "<p><span class=\"monogatari-error\">El mail no puede estar vac&iacute;o</span></p>";
        $error3 = "<p><span class=\"monogatari-error\">El tel&eacute;fono no puede estar vac&iacute;o</span></p>";
        $error4 = "<p><span class=\"monogatari-error\">Los comentarios no pueden estar vac&iacute;os</span></p>";
        $errorForm = "<p><span class=\"monogatari-error\">El formulario no se pudo enviar por contener errores</p>";
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $telf = $_POST['telf'];
        $text = $_POST['text2'];
        if ($name == "" || $mail == "" || $telf == "" || $text == "") {
            if ($name == "")
                echo $error1;
            if ($mail == "")
                echo $error2;
            if ($telf == "")
                echo $error3;
            if ($text == "")
                echo $error4;

            echo $errorForm;
        } else {
            $ref = explode("?",$_SERVER['HTTP_REFERER']);

            if (strcmp($ref[0], base64_decode("aHR0cDovL3d3dy5hbWFzYXN0dXJpYXMuY29tL2VuL2NvbnRhY3RvLmh0bWw="))!=0) {
                echo $errorForm;
                return;
            }
            $cabeceras = base64_decode("TUlNRS1WZXJzaW9uOiAxLjANCkNvbnRlbnQtdHlwZTogdGV4dC9odG1sOyBjaGFyc2V0PWlzby04ODU5LTENCkZyb206IEluZm9ybWFjaW9uIGFtYXNhc3R1cmlhcyA8aW5mb0BhbWFzYXN0dXJpYXMuY29tPg0K");

            $texto = "Consulta en <b>INGLES</b><br/>\n";
            $texto .= "La persona: <b>" . $name . "</b><br/>\n";
            $texto .= "Con e-mail: <b>" . $mail . "</b><br/>\n";
            $texto .= "Y tel&eacute;fono: <b>" . $telf . "</b><br/>\n";
            $texto .= "Realiz&oacute; la siguiente consulta: <b>" . $text . "</b><br/>\n";
	        $mail_body = wordwrap($texto, 70);
            // BEATRIZ (AMASASTURIAS)
            mail(base64_decode("aW5mb0BhbWFzYXN0dXJpYXMuY29t"),  "Consulta", $mail_body, $cabeceras);

            // Nestor:
            mail(base64_decode("bmVzdG9yYWx2YXJvQGdtYWlsLmNvbQ=="),  "Consulta", $mail_body, $cabeceras);
            // Kris:
            mail(base64_decode("ZW52aWFsb0BrcmlzbW9udGVyby5jb20="),  "Consulta", $mail_body, $cabeceras);
    ?>
        
            <p style="font-weight:bold">The request has just been sent.</p>
            <p>We will reply within a short space of time. Thank you</p>
    <?php
    }
    ?>
<br />

</div>
</div>

<div id="piedepagina"> 
<ul><li class="txtpieizq">info@amasasturias.com<br/><a href="politica.html">Privacy Policy</a></li>
<li class="txtpieder"><a href="http://www.krismontero.com/" target="_blank">Design: Kris Montero</a><br/><a href="mapaweb.html" >Site Map</a></li>
</ul>
</div>
</div>
</body></html>
