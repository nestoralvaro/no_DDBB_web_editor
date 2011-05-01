
////////////////////////////////////
//////////// DESCRIPCIÓN - DESCRIPTION

- ES:
El código contiene un editor que edita páginas web on-the-fly. Recibe los datos de las páginas y edita los contenidos almacenando los resultados de dicha edición en la propia página que se estaba editando, de modo que no es pueden deshacer las ediciones una vez realizadas. El objetivo de este editor era editar páginas sin necesidad de tener que almacenar los contenidos en BBDD.

- EN:
This is the code of the editor, created to edit web pages on-the-fly. The editor retrieves the data from the pages and edits the contents storing the contents on hte same page that was being edited, which means that after saving a page such changes can NOT be undone. The aim of this editor was to allow the edition of web pages without needing a DDBB to store the contents


////////////////////////////////////
//////////// IDIOMAS - LANGUAGES

ESPAÑOL - ENGLISH

ESPAÑOL
    Casi todo el código esta en español. Únicamente se usa el inglés para el nombre de las variables y métodos. Casi todos los literales estan en español.

ENGLISH
    All 99% of the *code* is done in english, so it shouldn't be a problem to understand it.
    Mostly, only literals are in Spanish.
    All the rest of this file will be in Spanish, so using a translating tool to make use of this "on-the-fly" editor (doesn't store contents on any DDBB) is quite handy. For further questions or an english version of this file just contact me.


////////////////////////////////////
//////////// DETALLES

Este proyecto es un editor que permite editar determinados contenidos de las páginas que se eligan. 

NO usa BBDD y todos los contenidos editados se almacenan en la propia página. Si se dispone de acceso a BBDD sería mejor almacenar en BBDD y así se evitaría el uso de "simple_html_dom.php"

También se incluyen las clases necesarias para poder realizar el upload de fotos al servidor (de modo asíncrono: AJAX). Dichas fotos se podrán usar posteriormente para la maquetación de la web referenciando a la ruta que muestre el carrusel de fotos.

Actualmente, en los navegadores basados en WebKit no funciona correctamente, aunque en Firefox 3.5 y también Internet Explorer 8 lo muestran perfectamente (No se ha probado en más navegadores)


////////////////////////////////////
//////////// ESTRUCTURA
 - Se incluyen las 4 carpetas de idiomas así como la página de inicio de la web para la que se creo el editor. Dentro de cada carpeta estan las páginas del idioma correspondiente ("es" -> español, "en" -> inglés, "fr" -> francés y "al" -> alemán). También hay una página de inicio fuera de las carpetas "index.html" (es el index en español). También existe la carpeta "estilos" que contiene los estilos de las páginas de la web.

- Las otras 2 carpetas son necesarias para el editor (uploads contiene las fotos que se van a subir y a poder usar desde el editor, y la propia carpeta "editor", que contiene todo el editor)


////////////////////////////////////
///////////// CONFIGURACION

 - Añadir las clases del editor a las páginas web que se quieran editar (dentro de las carpetas "al", "en", "es", "fr" y también la página de index) => class="monogatari-editor"
    *Nota: Actualmente solo se recoge la primera ocurrencia de ésta clase, así que si se pusiera en 2 zonas sólo la primera se podría editar (esta es una mejora que debería realizarse)

 - Modificar los permisos de la carpeta uploads (donde se guardan las fotos). Dejarlo en 777

 - Modificar los permisos de los ficheros a editar para poder escribir en ellos. Dejarlo en 666

 - En del fichero "/editor/admin.php" se indican las rutas de las páginas a editar (deben contener la clase "monogatari-editor")

 - Al selecionar la edición de una web se accede al propio editor que recoge el contenido a editar (simple_html_dom.php), permite editarlo (ckeditor), y lo almacena en el lugar apropiado dentro de la propia página misma.

 - Al editor solo se puede acceder desde la administración ("/editor/admin.php") mediante la correcta validación del usuario, por lo que es necesario ponder las credenciales que se quiera en el fichero de validación ("/editor/validar_user.php"), en las variables:
	$storedUser = "STORED_USER";
	$storedPass = "STORED_PASS";


////////////////////////////////////
///////////// FUNCIONAMIENTO

La página web a editar se calcula una vez dentro de la página del editor ("/editor/editor.php") en función de los parámetros recibidos de la página "/editor/admin.php".

Una vez obtenida la página se recibe mediante ajax el contenido de la seccion a editar y se incrusta dentro del editor.

Para almacenar la página se invoca por AJAX a "/editor/storeChanges.php" que obtiene la página de nuevo y mediante "simple_html_dom.php" la parsea, sustituyendo los contenidos antiguos (de la clase editable: "monogatari-editor") por los nuevos contenidos (recibidos por medio de POST para enviar la limitacion de caracteres que se pueden pasar por URL).


////////////////////////////////////
///////////// MEJORAS

- Actualmente solo se recoge la primera ocurrencia de la clase que se edita (class="monogatari-editor"), así que si se aplicase dicha clase a 2 elementos sólo el primero podría ser editado (debería permitirse la edición de varias zonas separadas de la misma página)
- Sería interesante hacer una versión del editor que obtenga y almacene los contenidos de BBDD
    * En esta versión no se hizo así ya que las páginas debían ser *HTML* y no se podían obtener los contenidos por PHP
