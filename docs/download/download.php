<?php
    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'download':

               $my_file = '../userfiles/collab-center-file.txt';
               $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
               $data = stringval($_POST['arguments'][0];)
               fwrite($handle, $data);

               break;

               
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    json_encode($aResult);

?>