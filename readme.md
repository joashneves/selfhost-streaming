# 🎬 API de Filmes em PHP

Este projeto é uma API REST simples feita com PHP puro, organizada de forma modular para demonstrar boas práticas de separação entre **rota**, **lógica de negócio** e **modelo de dados**.

---

## 📁 Estrutura de Pastas

```bash
/
├── api/
│ ├── index.php # Roteador das rotas da API
│ ├── filmes.php # Lida com rotas relacionadas a filmes
│ └── status.php # Status da API
├── data
│ ├── db.json # Banco de dados
│ └── db.php # Funções de acesso ao banco de dados
├── models/
│ └── tipos/ # Armazena os tipos que compõem o filme
│   └── Genero.php
│   └── Id.php
│   └── Publicacao.php
│   └── Sinopse.php
│   └── Titulo.php
│ └── filmeModels.php # Classe Filme
├── utils/ # Armazena classes úteis
│ ├── responderJson.php # Formata a resposta json
├── index.php # Arquivo de entrada principal (roteador geral)
```

---

## 🚀 Como usar

### 📦 Pré-requisitos

-   PHP 7.4 ou superior
-   Servidor local como Apache, Nginx ou PHP embutido

### ▶️ Executando

Você pode rodar com o servidor embutido do PHP:

```bash
php -S localhost:8000
```

Acesse no navegador:
http://localhost:8000/

---

## 📚 Rotas disponíveis

| Método | Rota             | Descrição                                                        |
| ------ | ---------------- | ---------------------------------------------------------------- |
| GET    | /                | Página de boas-vindas (HTML)                                     |
| GET    | /api             | Boas-vindas à API (JSON)                                         |
| GET    | /api/status      | Status da API                                                    |
| GET    | /api/filmes      | Retorna todos os filmes disponíveis                              |
| GET    | /api/filmes/{id} | Retorna um filme específico por ID                               |
| POST   | /api/filmes      | Cria um novo filme (campos: titulo, genero, sinopse, publicacao) |
| PUT    | /api/filmes/{id} | Atualiza um filme existente                                      |
| DELETE | /api/filmes/{id} | Remove um filme do banco                                         |

---

## 📬 Exemplos de Requisições

#### 👋 Mensagem de bem vindo

```bash
GET http://localhost:8000/api
```

- Resposta:

```bash
{
  "mensagem": "Bem-vindo à API"
}
```
____________________________________________

#### ✅ Status da api

```bash
GET http://localhost:8000/api/status
```

- Resposta:

```bash
{
  "status": "ok",
  "hora": "14:34:37"
}
```
____________________________________________

#### 🔍 Retorno de todos os filmes cadastrados

```bash
GET http://localhost:8000/api/filmes
```

- Resposta:

```bash
{
  "success": true,
  "message": "Lista de filmes",
  "data": [
    {
      "id": "1",
      "titulo": "Matrix",
      "genero": "Ficção científica",
      "sinopse": "Um programador descobre que o mundo é uma simulação.",
      "publicacao": "1999-03-31"
    },
    {
      "id": 2,
      "titulo": "Interestelar",
      "genero": "Ficção",
      "sinopse": "Gravidade, buracos negros e lágrimas no espaço: o manual de como plantar milho, atravessar galáxias e tentar entender o final com um diploma de física quântica nas mãos.",
      "publicacao": "06/11/2014"
    },
  ]
}
```
____________________________________________

#### 🎞️ Retorno um filme específico por ID

```bash
GET http://localhost:8000/api/filmes/{id}
```

- Resposta:

```bash
{
  "success": true,
  "message": "Filme encontrado",
  "data": {
    "id": "1",
    "titulo": "O Poderoso Chefão",
    "genero": "Drama",
    "sinopse": "Don Corleone resolve tudo com um olhar mortal e propostas que você literalmente não pode recusar. Um guia prático de negócios, família e tapas de luva de pelica.",
    "publicacao": "24/03/1972"
  }
}
```
____________________________________________

#### ➕ Criação de novo filme

```bash
POST http://localhost:8000/api/filmes
```

- Corpo da requisição

```bash
{
  "titulo": "Matrix",
  "genero": "Ficção científica",
  "sinopse": "Um programador descobre que o mundo é uma simulação.",
  "publicacao": "1999-03-31"
}
```

- Resposta:

```bash
{
  "success": true,
  "message": "Filme criado com sucesso",
  "data": {
    "id": "9",
    "titulo": "Matrix",
    "genero": "Ficção científica",
    "sinopse": "Um programador descobre que o mundo é uma simulação.",
    "publicacao": "1999-03-31"
  }
}
```
____________________________________________

#### 📝 Atualização de filme existente

```bash
PUT http://localhost:8000/api/filmes/{id}
```

- Corpo da requisição

```bash
{
  "titulo": "Interestelar (Versão estendida)",
  "genero": "Ficção científica",
  "sinopse": "Missão espacial épica com novos elementos.",
  "publicacao": "2014-11-07"
}
```

- Resposta:

```bash
{
  "success": true,
  "message": "Filme atualizado com sucesso",
  "data": {
    "id": "2",
    "titulo": "Interestelar (Versão estendida)",
    "genero": "Ficção científica",
    "sinopse": "Missão espacial épica com novos elementos.",
    "publicacao": "2014-11-07"
  }
}
```
____________________________________________

#### ❌ Remoção de filme existente

```bash
DELETE http://localhost:8000/api/filmes/{id}
```

- Resposta:

```bash
{
  "success": true,
  "message": "Filme removido com sucesso"
}
```
____________________________________________
