<?php

    function setSelected( $_column, $_column_name ){
        if( !isset($_GET[$_column]) ){
            return;
        }
        if( $_GET[$_column] != $_column_name ){
            return;
        }
        echo "selected";
    }

    function setChecked( $_column, $_column_name ){
        if( !isset($_GET[$_column]) ){
            return;
        }
        if( $_GET[$_column] != $_column_name ){
            return;
        }
        echo "checked";
    }    

?>