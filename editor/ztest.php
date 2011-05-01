<?php

    $edited_contents= "%3Cp%3E%0A%09%3Cstrong%3EA%20Asturias%3C/strong%3E%20es%20una%20joven%20empresa%20dedicada%20al%20desarrollo%20de%20vi%26aacute%3B%26eacute%3B%26ntilde%3B%26Ntilde%3B%26ntilde%3B%7B%7D%252Bs++itas%20guiadas%20de%20car%3C/p%3E%0A";
    $edited_contents = str_replace($edited_contents, '%2B', '+');
    echo $edited_contents;

?>
