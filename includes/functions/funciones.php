<?php

function productos_to_json(&$boletos, &$camisas = 0, &$etiquetas = 0)
{
    $dias = ['1_dia', 'pase_completo', 'pase_dos_dias'];

    //convertimos en un array asociativo el array $boletos
    $total_boletos = array_combine($dias, $boletos);
    $json = [];

    foreach ($total_boletos as $key => $boletos) {
        //si compro al menos un boleto de ese tipo
        if ((int) $boletos > 0) {
            $json['boletos'][$key] = (int) $boletos;
        }
    }

    $camisas = (int) $camisas;
    if ($camisas > 0) {
        $json['camisas'] = $camisas;
    }

    $etiquetas = (int) $etiquetas;
    if ($etiquetas > 0) {
        $json['etiquetas'] = $etiquetas;
    }

    return json_encode($json);
}

function eventos_to_json(&$eventos){
    $eventos_json = [];

    foreach($eventos as $evento){
        $eventos_json['eventos'][] = $evento;
    }

    return json_encode($eventos_json);
}