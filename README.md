📝 [Notas]
Uma aplicação CRUD de notas desenvolvida em PHP com Laravel.

📖 Sobre o Projeto
Este é um sistema simples para gerenciamento de notas. Os usuários podem se registrar, fazer login e gerenciar suas próprias notas. A aplicação permite realizar todas as operações básicas de um CRUD (Create, Read, Update, Delete):

Cadastrar Usuário: Criação de uma conta de usuário.

Login: Acesso à área de notas com as credenciais cadastradas.

Adicionar Nota: Criação de novas notas.

Visualizar/Listar Notas: Exibição das notas cadastradas.

Editar Nota: Atualização do conteúdo de uma nota existente.

Excluir Nota: Remoção de uma nota do banco de dados.

⚙️ Tecnologias Utilizadas
Linguagem: PHP

Framework: Laravel 6.0

Banco de Dados: MySQL (gerenciado com HeidiSQL)

Gerenciamento de Pacotes: Composer

Front-end: HTML, CSS, JavaScript (padrão)

🚀 Instalação e Execução
Siga os passos abaixo para configurar e rodar o projeto em sua máquina local.

Pré-requisitos
- PHP 8.2 ou superior
- Versão atualizada do Apache
- Versão atualizada do C++
- Laravel Herd
- Composer
- NodeJS
- HeidiSQL

Passo a Passo
Clone o repositório: https://github.com/FabianaSanves/meu-projeto-laravel.git

Bash

git clone [Link para o Repositório]
cd [Notes]
Instale as dependências do Composer: 

Bash

composer install
Configure o arquivo de ambiente:

Copie o arquivo .env.example e renomeie-o para .env.

Abra o arquivo .env e configure as credenciais do seu banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_notes_fabi
DB_USERNAME=user_laravel_notes_fabi2
DB_PASSWORD=27Go4AguwEBON83o834ur2Hoc68ecE

Bash

php artisan key:generate
Rode as migrações para criar as tabelas no banco de dados:

Bash

php artisan migrate
Inicie o servidor de desenvolvimento do Laravel:

Bash

php artisan serve
A aplicação estará acessível em http://127.0.0.1:8000.
