# Prova Prática Programador PHP II

## Guia para execução da aplicação

**Requisitos**
- Docker + Docker Compose (versão 3.1)
- Node (versão 18) + Npm

### 1. Clonar o repositório
```
$ git clone https://github.com/VictorTurraF/tray-test-sales.git
# ou com ssh
$ git@github.com:VictorTurraF/tray-test-sales.git 

$ cd tray-test-sales
```
Abrir com o editor de código de preferência

### 2. Configurar arquivo .env

No diretório do projeto basta criar um cópia do arquivo `.env.example`.
Em seguida renomeá-lo para `.env`.

Para o envio dos email será necessário a configuração do smtp (ou driver de preferência)

> Por padrão fiz utilizando o driver do mailgun

```
MAILGUN_DOMAIN=
MAILGUN_SECRET=
MAIL_FROM_ADDRESS=
```

ou com SMTP
```
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. Iniciar os containers do docker

Com `docker compose` basta rodar o seguinte comando para iniciar os serviços
```bash
docker compose up -d
```

### 4. Instalar as dependências

Rode o seguinte comando para instalar as dependências com composer.
```bash
docker compose exec app composer install
```
> O comando será executado dentro do container tendo o php 8.1 e composer instalados

### 5. Gerar chave da aplicação
```bash
docker compose exec app php artisan key:generate
```

### 6. Gerar banco de dados (Migrations)
```bash
docker compose exec app php artisan migrate
```

### 7. Popular banco de dados
```bash
docker compose exec app php artisan db:seed
```

### 8. Compilar o fron-end (Aplicação)

#### 8.1. Instalar dependências do node
```bash
npm install
```

#### 8.2. Fazer o build dos arquivos estáticos
```bash
npm run build
```

Desta forma a aplicação estará rodando em `http://localhost:8000/`


## Comandos do Artisan criados

Comando de envio de relatório pelo ID do vendedor:
```bash
docker compose exec app php artisan app:send-daily-sales-report-to-seller 1
```

Comando de envio de relatório geral de vendas ao admin:
```bash
docker compose exec app php artisan app:send-daily-sales-summary turra667@gmail.com
```

Comando de envio de relatório pelo ID do vendedor com data:
```bash
docker compose exec app php artisan app:send-daily-sales-report-to-seller 1 --date=2023-08-24
```

Comando de envio de email para todos os vendedores do sistema:
```bash
docker compose exec app php artisan app:send-daily-sales-report
```

## Testes

Para rodar os testes são necessárias as seguintes etapas:

### 1. Geração de arquivo banco de dados .sqlite no diretório do projeto
```bash
touch database/database.sqlite
```

### 2. Migração das tabelas no banco do sqlite
```bash
docker compose exec app php artisan migrate --env=testing
```

### 3. Execução dos testes (PHP Unit)
```bash
docker compose exec app php artisan test
```

### Agendamentos
Com o task scheduling do laravel está agendada a rotina de envio de emails a todos os vendedores do sistema.

Para verificar o agendamento de tarefas basta rodar o seguinte comando:

```bash
docker compose exec app php artisan schedule:list
```

O agendamento deste do comando `app:send-daily-sales-report` está definido para rodar diariamente às 23H59
