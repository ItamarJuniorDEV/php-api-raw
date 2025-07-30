<?php

$data = []; // cria um array vazio para preenchermos

// 1. REQUEST (pede os dados pro front)
if (isset($_GET['option'])) { // verifica se o front mandou o parâmetro option na URL

    switch ($_GET['option']) { // decide o que fazer dependendo do valor do option
        case 'status': // se option for status...
            $data['status'] = 'SUCCESS'; // retorna sucesso
            $data['data'] = 'API ONLINE'; // retorna que está online
            break;

        default:
            $data['status'] = 'ERROR'; // se não tiver option, retorna erro
            break;
    }

} else {
    $data['status'] = 'ERROR'; // se não tiver option, retorna erro
}

// 2. RESPONSE (emitir a resposta com os dados da API)
response($data);

// 3. RESPONSE (mensagem de resposta da solicitação pro front)
function response($data_response)
{
    header("Content-Type:application/json"); // define que vai enviar json
    echo json_encode($data_response); // converte de array pra json
}
