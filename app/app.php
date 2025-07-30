<?php

define('API_BASE', 'http://localhost:8000/api?option=');

echo '<p>APLICAÇÃO</H3><p>';

$resultado = api_request('status');

echo '<pre>';
print_r($resultado);

// Função de status da requisição
function api_request($option)
{
    $client = curl_init(API_BASE . $option); // Cria uma nova sessão para fazer uma requisição HTTP
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true); // Devolve string se for true
    $response = curl_exec($client);
    return json_decode($response); // Retorna em formato array associativo
}
