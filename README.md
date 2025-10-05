# JHE Project

Sistema de gerenciamento de clientes desenvolvido em Laravel com API REST.

## Sobre o Projeto

Este projeto é uma API REST para gerenciamento de clientes e endereços, desenvolvida com Laravel. O sistema permite:

- Cadastro de clientes com informações completas
- Gerenciamento de endereços (relacionamento 1:1 com clientes)
- API REST para integração com front-end

## Requisitos

- PHP 8.1 ou superior
- Composer
- SQLite

## Instalação

### 1. Clone o repositório
```bash
git clone https://github.com/GuiLeit/jhe-project.git
cd jhe-project
```

### 2. Instale as dependências
```bash
composer install
```

### 3. Configure o arquivo de ambiente
```bash
# Copie o arquivo de exemplo
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### 5. Execute as migrações
```bash
php artisan migrate
```

### 6. (Opcional) Execute os seeders para dados de teste
```bash
php artisan db:seed
```

## Executando a Aplicação

### Servidor de Desenvolvimento
```bash
php artisan serve
```

A aplicação estará disponível em: `http://localhost:8000`

### API Endpoints

#### Clientes
- `GET /api/clients` - Lista todos os clientes
- `POST /api/clients` - Cria um novo cliente

#### Exemplo de payload para criação de cliente:
```json
{
    "name": "Acme Corporation",
    "email": "contact@acme.co",
    "cnpj": "12345678901235",
    "observation": "Important client",
    "contract_value": 50000.00,
    "address": {
        "street": "Main Street",
        "number": "123",
        "postal_code": "12345-678",
        "complement": "Suite 100",
        "neighborhood": "Downtown",
        "city": "New York"
    }
}
```

### Coleção Postman para testes

[Visualizar Coleção Postman para testes]([https://cloudy-capsule-729676.postman.co/workspace/My-Workspace~a2625005-5a3b-4c5f-8b95-8de63b2d0b30/collection/26099050-9bc634ce-2a8d-4b01-9c1a-751e2a7d9d8a?action=share&creator=26099050](https://www.postman.com/cloudy-capsule-729676/workspace/guilherme-leite/collection/26099050-9bc634ce-2a8d-4b01-9c1a-751e2a7d9d8a?action=share&creator=26099050))

### Exemplos cURL

```bash
# Listar clientes

curl --location 'localhost:8000/api/clients'
```

```bash
# Criar cliente com endereço

curl --location 'localhost:8000/api/clients' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Acme Corporation",
    "email": "contact@acme.co",
    "cnpj": "12345678901235",
    "observation": "Important client",
    "contract_value": 50000.01,
    "address": {
        "street": "Main Street",
        "number": "123",
        "postal_code": "12345-678",
        "complement": "Suite 100",
        "neighborhood": "Downtown",
        "city": "New York"
    }
}'
```

## Testes

### Executar todos os testes
```bash
php artisan test
```
