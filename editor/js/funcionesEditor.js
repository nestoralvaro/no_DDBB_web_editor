    (function(){
        var paginaWeb;
        // Store the contents of the page on a JS variable
        jQuery.ajax({
            type: "GET",
            async:false,
            url: "<?php echo $chosenPage;?>",
            success: function(datosRetorno){
                paginaWeb = datosRetorno;
            }
        });
        // Set contents on hidden DIV
        jQuery("#hiddenContents").html(paginaWeb);
        var editable = jQuery("#hiddenContents .monogatari-editor").html();

        CKEDITOR.replace( 'editor1',
					    {
						    skin : 'kama',
					        toolbar : [ [ 'Bold', 'Italic', 'Underline', 'Strike'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Link','-','Image'],
                                        '/',
                                        ['Styles','Format','Font','FontSize'],
                                        ['TextColor','BGColor']
                                    ]
				    });

        jQuery("#editor1").html(editable);
    })();

    function storeContents() {
	    // Get the editor instance that we want to interact with.
	    var oEditor = CKEDITOR.instances.editor1;
	    // Get the editor contents
//	    alert( oEditor.getData() );
        // Recuperar los contenidos del div alterado
//        var cambios = jQuery("#editor1").html();
        var cambios = escape(oEditor.getData());
        var datos = "url=<?php echo $chosenPage?>";
        datos = datos + "&editedContents=" + cambios;
//        alert(datos);

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
