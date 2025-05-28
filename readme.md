# 🎬 API de Filmes em PHP

Este projeto é uma API REST simples feita com PHP puro, organizada de forma modular para demonstrar boas práticas de separação entre **rota**, **lógica de negócio** e **modelo de dados**.

---

## 📁 Estrutura de Pastas

```bash
/
├── index.php # Arquivo de entrada principal (roteador geral)
├── api/
│ ├── index.php # Roteador das rotas da API
│ ├── filmes.php # Lida com rotas relacionadas a filmes
│ └── status.php # Status da API
├── models/
│ └── filmeModels.php # Classe Filme e dados mockados
```

---

## 🚀 Como usar

### 📦 Pré-requisitos

- PHP 7.4 ou superior
- Servidor local como Apache, Nginx ou PHP embutido

### ▶️ Executando

Você pode rodar com o servidor embutido do PHP:

```bash
php -S localhost:8000
```
Acesse no navegador:
http://localhost:8000/

---

# Rotas disponiveis

|Metodo|Rota|Descrição|
|---|---|---|
|GET| / | Página de boas-vindas (HTML) |
|GET| /api | Boas-vindas à API (JSON) |
|GET| /api/status | Status da API |
|GET| /api/filmes | Retorna todos os filmes disponíveis |
|GET| /api/filmes/{id} | Retorna um filme específico por ID |
