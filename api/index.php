<?php

// prepara response
$data['status'] = 'ERROR';
$data['data'] = null;

// request
if (isset($_GET['option'])) { // verifica se o front mandou o parâmetro option na URL

    switch ($_GET['option']) {
        case 'status':
            define_response($data, 'API ONLINE!');
            break;

        case 'random':
            $min = 0;
            $max = 1000;

            /*
            verifica se vem min e / ou max no GET
            */
            if (isset($_GET['min'])) {
                $min = intval($_GET['min']);
            }

            if (isset($_GET['min'])) {
                $max = intval($_GET['max']);
            }

            if ($min >= $max) {
                response($data);
                return;
            }

            define_response($data, rand($min, $max));
            break;
    }
}

// 2. RESPONSE (emitir a resposta com os dados da API)
response($data);
// =========================================================================
function define_response(&$data, $value)
{
    $data['status'] = 'SUCCESS';
    $data['data'] = $value;
}

// =========================================================================
// 3. RESPONSE (mensagem de resposta da solicitação pro front)
function response($data_response)
{
    header("Content-Type:application/json"); // define que vai enviar json
    echo json_encode($data_response); // converte de array pra json
}
