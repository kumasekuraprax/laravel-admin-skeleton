# Laravel Admin Skeleton

Framework adaptado para desenvolvimento BackOffice, instalado juntamente com AdminLTe, Docker, ACL.

*************************************************************
_Ambiente desenvolvimento com Docker_
*************************************************************

## Pré-Requisitos
 - Docker
 - Docker-Compose
 - PHP ^7.0
 - Composer

--- via Linux
> sudo apt install docker docker-compose php composer

--- via Windows
> Habilitar virtualização, instalar Docker (https://www.docker.com/docker-windows)

## Passo a Passo

### 1. Tardis
Realize o clone do projeto da Tardis (https://github.com/madeiramadeirabr/tardis)

### 2. LAS
Baixe o pacote do Laravel-Admin-Skeleton na mesmo diretorio da Tardis, atraves do comando
> composer create-project anluizmm/laravel-admin-skeleton {project_name}

### 3. Subindo o Ambiente
Acesse o diretorio do seu projeto principal e execute o comando > ./env/runenv.sh (linux) ou exec ./env/runenv.sh (windows)
As imagens serão baixadas (pode levar algum tempo na primeira vez) e o ambiente já estará pronto.

### 4. Configurações Adicionais
Realize o migrate do banco de dados da Tardis, para isso acesse a pasta do projeto Tardis e execute o comando > php artisan migrate
acesse a URl do projeto http://localhost:8000/admin e faça o login com o usuario temporario (login: 11111111111 / pass: admin!@#)

Acesse a área de sistemas e crie o vinculo com o seu projeto, isso irá gerar os tokens de request e encrypt. Copie esses tokens no seu
projeto no arquivo .env

Ainda na Tardis, na área de usuários, vincule o seu usuario ao seu projeto.
Por fim na pasta do seu projeto realize o migrate com o comando > php artisan migrate

OBS: Você pode adicionar o seu usuário no arquivo de migration da tabela usuarios, ou então adicionar manualmente no banco de dados

Acesse seu projeto pela URL http://localhost:8881

### Caso queira alterar a porta, altere o arquivo docker-compose.yml
### Você pode alterar os hosts para nomear seus projetos


> Duvidas, criticas, sugestões, melhorias -> andre.silva@madeiramadeira.com.br

*************************************************************
