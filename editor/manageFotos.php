<?php
    include_once("./cabecera.php");
    include_once("validar_user.php");

    $validado = validar_user();
    if ($validado == 0 || $validado == 1) {
?>


    <table style="margin:auto; background:#cccccc">
        <tr>
            <td style="background:white;">
                <p>Subir fotos:</p>
                <?php
                include("subirFoto.php");
                ?>
            </td>
            <td>
                <p>Fotos disponibles:</p>
                <div id="picture_gallery">
                    <?php
                    include("gallery.php");
                    ?>
                </div>
            </td>
        </tr>
    <table>

<?php
 } else {
    include("admin.php");
}
?>
