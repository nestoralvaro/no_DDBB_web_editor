    <script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="./js/jquery-galleryview-1.1/jquery.galleryview-1.1.js"></script>
    <script type="text/javascript" src="./js/jquery-galleryview-1.1/jquery.timers-1.1.2.js"></script>
    <script type="text/javascript" src="./js/gallery-settings.js"></script>
<?php
    //path to directory to scan
    $directory = "../uploads/";
    $images = glob($directory . "*");
?>
<div id="gallery_wrap">
<div id="photos" class="galleryview">
    <?php
        foreach($images as $image) {
            echo "<div class=\"panel\">";
            echo "<img src=\"" . $image . "\" />";
            echo "<div class=\"panel-overlay\">";
            echo "<h2>" . $image . "</h2>";
            echo "</div>";
            echo "</div>";
        }
    ?>
  <ul class="filmstrip">
    <?php
    //print each file name
        foreach($images as $image) {
            echo "<li><img src=\"" . $image ."\" width=\"100px\" height=\"38px\"  alt=\"" . substr(strrchr($image, "/"),1) . "\" title=\"" . substr(strrchr($image, "/"),1) . "\" /></li>";
        }
    ?>
  </ul>
</div>
</div>
<br/>
<style type="text/css">
.panel {
	background: #cccccc;
}
.panel img {
    float:none;
	margin:auto;
    text-align:center;
}
</style>

