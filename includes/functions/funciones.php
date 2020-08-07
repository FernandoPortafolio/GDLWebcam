<?php

/**
 * productos_to_json.
 * Junta todos los productos en un JSON con la siguiente estructura:
 * {
 *   "boletos":{
 *      "1_dia":1,
 *      "pase_completo":1
 *   },
 *   "camisas":1,
 *   "etiquetas":1
 *}.
 *
 * @param mixed &$boletos   -> array posicional que viene del formulario
 * @param int   &$camisas   -> numero de camisas
 * @param int   &$etiquetas -> numero de etiquetas
 */
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

/**
 * eventos_to_json.
 * Convierte los eventos del formulario a un array con la estructura
 * {
 *   "eventos":[
 *      "conf_01",
 *      "conf_03",
 *      "taller_06",
 *      "conf_06",
 *      "sem_03",
 *      "taller_15",
 *      "conf_08"
 *   ]
 *}.
 *
 * @param mixed &$eventos -> array de eventos que viene del formulario
 */
function eventos_to_json(&$eventos)
{
    $eventos_json = [];

    foreach ($eventos as $evento) {
        $eventos_json['eventos'][] = $evento;
    }

    return json_encode($eventos_json);
}
