# API REST PHP

## Descrição

API REST desenvolvida em PHP para fins de estudos, fornecendo endpoints para geração de valores aleatórios e hashes únicos. A aplicação segue uma arquitetura simples e modular, com separação clara entre a API e a aplicação cliente.

## Estrutura do Projeto

```
project/
├── api/
│   ├── index.php       # Ponto de entrada da API
│   └── output.php      # Funções dos endpoints
└── app/
    └── app.php         # Aplicação cliente de exemplo
```

## Requisitos

- PHP 7.0 ou superior
- Extensão cURL habilitada
- Servidor web (Apache, Nginx ou servidor embutido do PHP)

## Instalação

1. Clone o repositório para o diretório desejado
2. Configure o servidor web para apontar para o diretório do projeto
3. Para desenvolvimento, utilize o servidor embutido do PHP:

```bash
php -S localhost:8000
```

## Endpoints da API

### Status da API

Verifica se a API está online e operacional.

**Requisição:**
```
GET /api?option=status
```

**Resposta:**
```json
{
    "status": "SUCCESS",
    "data": "API ONLINE!"
}
```

### Gerador de Números Aleatórios

Gera um número aleatório dentro de um intervalo especificado.

**Requisição:**
```
GET /api?option=random
GET /api?option=random&min=1&max=100
```

**Parâmetros:**
- `min` (opcional): Valor mínimo do intervalo (padrão: 0)
- `max` (opcional): Valor máximo do intervalo (padrão: 1000)

**Resposta:**
```json
{
    "status": "SUCCESS",
    "data": 42
}
```

### Gerador de Hash

Gera um hash único utilizando MD5 e SHA1.

**Requisição:**
```
GET /api?option=hash
```

**Resposta:**
```json
{
    "status": "SUCCESS",
    "data": "a1b2c3d4e5f6..."
}
```

## Estrutura de Resposta

Todas as respostas da API seguem o mesmo padrão:

```json
{
    "status": "SUCCESS|ERROR",
    "data": "valor ou mensagem"
}
```

## Exemplo de Uso

### Cliente PHP

```php
<?php
define('API_BASE', 'http://localhost:8000/api?option=');

// Requisição para o endpoint hash
$resultado = api_request('hash');

if ($resultado['status'] == 'SUCCESS') {
    echo "Hash gerado: " . $resultado['data'];
}

function api_request($option) {
    $client = curl_init(API_BASE . $option);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    return json_decode($response, true);
}
```

### Cliente JavaScript

```javascript
async function fetchHash() {
    const response = await fetch('http://localhost:8000/api?option=hash');
    const data = await response.json();
    
    if (data.status === 'SUCCESS') {
        console.log('Hash:', data.data);
    }
}
```

## Tratamento de Erros

A API retorna status `ERROR` nos seguintes casos:

1. Endpoint não encontrado
2. Parâmetros inválidos (ex: min >= max no endpoint random)
3. Requisição mal formada

Exemplo de resposta de erro:
```json
{
    "status": "ERROR",
    "data": []
}
```

## Considerações de Segurança

Este projeto foi desenvolvido para fins educacionais. Para uso em produção, considere:

1. Implementar autenticação e autorização
2. Adicionar rate limiting
3. Validar e sanitizar todos os inputs
4. Utilizar HTTPS
5. Implementar CORS adequadamente
6. Adicionar logs e monitoramento

## Extensibilidade

Para adicionar novos endpoints:

1. Crie uma nova função em `output.php`:
```php
function api_novo_endpoint(&$data) {
    define_response($data, 'resultado');
}
```

2. Adicione o case correspondente em `index.php`:
```php
case 'novo_endpoint':
    api_novo_endpoint($data);
    break;
```

## Desenvolvimento

### Executar localmente

```bash
cd project
php -S localhost:8000
```

### Testar endpoints

```bash
# Status
curl http://localhost:8000/api?option=status

# Random
curl http://localhost:8000/api?option=random&min=1&max=10

# Hash
curl http://localhost:8000/api?option=hash
```

## Licença

Este projeto foi desenvolvido para fins educacionais.

## Autor

Desenvolvido como projeto de estudos em PHP e APIs REST.