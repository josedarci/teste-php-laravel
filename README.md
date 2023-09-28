![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Teste para novos candidatos (PHP/Laravel)

### Introdução

Este teste utiliza PHP 8.1, Laravel 10 e um banco de dados SQLite simples.

1. Faça o clone desse repositório;
1. Execute o `composer install`;
1. Crie e ajuste o `.env` conforme necessário
1. Execute as migrations e os seeders;

### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

Boa sorte!
-----------------------------------

```markdown
# Projeto Laravel 10 com Banco de Dados SQLite e Fila de Processamento

Este é um guia simples sobre como configurar e rodar o projeto Laravel 10 com um banco de dados SQLite e uma fila para processamento.

## Pré-requisitos

Certifique-se de que o seguinte software esteja instalado em seu sistema:

- PHP (recomendado PHP 8.0 ou superior)
- Composer
- SQLite (normalmente já está incluído com a instalação padrão do PHP)

## Passos para Configurar o Projeto

1. Clone o repositório do projeto:

   ```bash
   git clone https://seurepositorio.com/seuprojeto.git
   ```

2. Navegue até o diretório do projeto:

   ```bash
   cd seuprojeto
   ```

3. Instale as dependências do Composer:

   ```bash
   composer install
   ```

4. Copie o arquivo `.env.example` para `.env`:

   ```bash
   cp .env.example .env
   ```

5. Gere uma chave de aplicativo:

   ```bash
   php artisan key:generate
   ```

6. Configure o banco de dados SQLite em seu arquivo `.env`:

   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/caminho/para/seubanco.sqlite
   ```

   Substitua `/caminho/para/seubanco.sqlite` pelo caminho onde você deseja que o banco de dados SQLite seja criado.

7. Execute as migrações para criar as tabelas no banco de dados:

   ```bash
   php artisan migrate
   ```

8. Inicie o servidor de desenvolvimento:

   ```bash
   php artisan serve
   ```

9. Abra um navegador e acesse `http://localhost:8000` para visualizar sua aplicação Laravel em execução.

## Executando a Fila

Para processar a fila, você precisa abrir uma segunda janela do terminal e executar o worker da fila. Certifique-se de estar no diretório raiz do projeto.

```bash
php artisan queue:work
```

Isso iniciará o worker da fila e começará a processar os trabalhos na fila de processamento.

Agora você tem seu projeto Laravel 10 em execução com um banco de dados SQLite e um worker de fila processando tarefas em segundo plano.


```

