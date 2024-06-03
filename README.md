## Teste para a empresa Spassu

Criar um projeto utilizando as boas práticas de mercado e apresentar o mesmo demonstrando o passo a passo de sua criação (base de dados, tecnologias, aplicação, metodologias, frameworks, etc).

## Instalação

Para fazer a instalação, basta executar os passos abaixo:

- **git clone git@github.com:rafapaulino/spassu-livraria.git .**
- **composer install**
- **copiar o .env.example para .env e colocar o nome da aplicação e dados de acesso ao banco**
- **php artisan key:generate**
- **php artisan migrate**
- **php artisan db:seed**

## Testes

Para rodar os testes, basta executar o comando abaixo:

- **php artisan test**