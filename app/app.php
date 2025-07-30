<?php

define('API_BASE', 'http://localhost:8000/api?option=');
echo '<p>APLICAÇÃO</H3><p>';
for ($i = 0; $i < 10; $i++) {
    $resultado = api_request('random&min=2000&max=2100');
    // verify is response is ok (success)
    if ($resultado['status'] == 'ERROR') {
        die('Aconteceu um erro na minha chamada à API');
    }
    echo "O valor randômico: " . $resultado['data'];
}
echo "TERMINADO";
function api_request($option)
{
    $client = curl_init(API_BASE . $option); // Cria uma nova sessão para fazer uma requisição HTTP
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true); // Devolve string se for true
    $response = curl_exec($client);
    return json_decode($response); // Retorna em formato array associativo
}
