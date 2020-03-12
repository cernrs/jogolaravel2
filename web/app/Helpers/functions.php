<?php 

function notification($type, $message){

    \Session::put($type, $message);

}

function mesExtenso($iMes){

    switch ($iMes) {
        case "01" : $iMes = "Janeiro"; break;
        case "02" : $iMes = "Fevereiro"; break;
        case "03" : $iMes = "Março"; break;
        case "04" : $iMes = "Abril"; break;
        case "05" : $iMes = "Maio"; break;
        case "06" : $iMes = "Junho"; break;
        case "07" : $iMes = "Julho"; break;
        case "08" : $iMes = "Agosto"; break;
        case "09" : $iMes = "Setembro"; break;
        case "10" : $iMes = "Outubro"; break;
        case "11" : $iMes = "Novembro"; break;
        case "12" : $iMes = "Dezembro"; break;
    }
    
    return $iMes;

}