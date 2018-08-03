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
> sudo apt install docker docker-compose

--- via Windows
> Habilitar virtualização, instalar Docker (https://www.docker.com/docker-windows)

## Como rodar?
Execute o comando 
> composer create-project anluizmm/laravel-admin-skeleton {your-project-name}

--- via Linux
> ./env/runenv.sh

--- via Windows
> exec ./env/runenv.sh

## O que acontece?
Na primeira execução, levará algum tempo até ser realizado o download das imagens do NGINX, PHP e MYSQL. Já nas próximas serão bem rapidas.

--- Acesso
Através de http://localhost:8881

Caso queira alterar a porta, altere o arquivo docker-compose.yml

*************************************************************
