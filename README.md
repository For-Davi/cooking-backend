# Cooking Backend

Este projeto é um backend desenvolvido em Laravel, utilizando o Laravel Sail para facilitar o ambiente de desenvolvimento com Docker.

## Requisitos

- [Docker](https://www.docker.com/)
- [Laravel Sail](https://laravel.com/docs/10.x/sail)

## Como rodar o projeto

1. **Clone o repositório:**
	```bash
	git clone <url-do-repositorio>
	cd cooking-backend
	```

2. **Copie o arquivo de exemplo do .env:**
	```bash
	cp .env.example .env
	```


3. **Configure o Mailhog no .env:**
	Adicione ou ajuste as seguintes variáveis no seu `.env` para utilizar o Mailhog:
	```env
	MAIL_MAILER=smtp
	MAIL_HOST=smtp
	MAIL_PORT=1025
	MAIL_USERNAME=null
	MAIL_PASSWORD=null
	MAIL_ENCRYPTION=null
	MAIL_FROM_ADDRESS="hello@example.com"
	MAIL_FROM_NAME="${APP_NAME}"
	```

4. **Configure o banco de dados no .env:**
	Ajuste as variáveis de conexão com o banco de dados conforme necessário, por exemplo:
	```env
	DB_CONNECTION=mysql
	DB_HOST=mysql
	DB_PORT=3306
	DB_DATABASE=cooking
	DB_USERNAME=sail
	DB_PASSWORD=password
	```

	> Os valores acima são os padrões do Laravel Sail para MySQL. Altere conforme sua necessidade.

5. **Suba os containers com o Sail:**


6. **Instale as dependências do Composer:**
	```bash
	./vendor/bin/sail composer install
	```

7. **Gere a chave da aplicação:**
	```bash
	./vendor/bin/sail artisan key:generate
	```

8. **Crie o link simbólico do storage:**
	```bash
	./vendor/bin/sail artisan storage:link
	```

9. **Rode as migrations:**
	```bash
	./vendor/bin/sail artisan migrate
	```

## Acessando o Mailhog

O Mailhog estará disponível em [http://localhost:8025](http://localhost:8025) para visualizar os e-mails enviados pela aplicação.
