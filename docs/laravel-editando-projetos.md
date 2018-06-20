[Voltar para Lista de Opções](../readme.md)

# 1. Preparação do sistema

Para desenvolver usando o Laravel é preciso que o servidor seja instalado. Para tanto, basta seguir os procedimentos a seguir:

[Ubuntu 18.04 para Desenvolvedor Web](ubuntu-18.04-devel.md)

# 2. Usando projetos Laravel

# 2.1. Clonando

Vamos levar em consideração que o projeto local se encontrará em /var/www/project/. Basta entrar no diretório onde o projeto será instalado e cloná-lo:

```
$ cd /var/www/project/
$ git clone https://xxxxxxxx/repositorio.git .
```

## 2.2. Dependências do projeto

Após clonar um projeto existente, as dependências não estarão presentes e 
precisarão ser instaladas:

```
$ composer update    # Os pacotes serão atualizados e colocados no diretório "/vendor"
$ npm install        # Os pacotes serão atualizados e colocados no diretório "/node_modules"
```

## 2.3. Informações importantes sobre dependências

No projeto em produção o diretório "/var/www/project/vendor" deverá estar presente, pois o sistema depende das bibliotecas armazenadas nele. Todavia, o diretório "/var/www/project/node_modules" não deverá estar presente no modo produção, ou seja, deve ser excluído ao publicar o projeto definitivamente. O "node_modules" é útil apenas para desenvolvimento, haja visto que o Laravel Mix usa estes módulos apenas no momento em que ele compila os arquivos "js" e "css" a serem publicados no site (no diretório /var/www/project/public).

Mais informações sobre o "node_modules" em [Laravel Mix](laravel-mix.md)


## 2.4. Arquivos de configuração

O arquivo de configuração ".env" é gerado automaticamente no processo de instalação do novo projeto (veja o documento [Criando Projetos Laravel](laravel-criando-projetos.md)). Mas, no processo de publicação, o arquivo ".env" deverá ser configurado manualmente. No diretório do projeto, basta copiar o arquivo ".env.example", gerando o novo arquivo ".env":

```
$ cd /var/www/project/
$ cp .env.example .env
```
## 2.4.1. Banco de Dados

Caso a aplicação utilize banco de dados, no arquivo ".env" será necessário adicionar as informações corretas para a conexão. 

Mas antes disso, o banco de dados deve existir. No terminal, acesse o prompt de comandos do MySQL:

``` 
mysql -u usuario_mysql -p
>> digite a sua senha
```

Após digitar a senha, a mensagem de boas vindas do MySQL será exibida e o prompt de comandos ("mysql>") estará logo abaixo, como no exemplo a seguir:

```
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 5
Server version: 5.7.20-0ubuntu0.16.04.1 (Ubuntu)

Copyright (c) 2000, 2017, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>
``` 

No prompt do mysql, crie o banco de dados com a seguinte cláusula SQL:

``` 
mysql> CREATE DATABASE mydatabase CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
``` 
Com o banco criado, configure as informações do arquivo ".env". 

``` 
.env: 
    APP_URL=http://www.project.dev.br
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=ricardo
```

## 2.4.2. Criação da Tableas (Migrations)

Agora que o banco de dados existe e a aplicação está conectando com sucesso, podemos rodar as migrações da aplicação para popular o banco de dados com as tabelas:

```
$ cd /var/www/project/
$ php artisan migrate
```

## 2.4.3. A Chave Criptográfica da Aplicação

Agora que o arquivo ".env" já existe, podemos gerar a chave criptográfica que a aplicação utiliza para a criação das Senhas e os Hashes temporários de comunicação:

```
$ cd /var/www/project/
$ php artisan key:generate # gera a chave da aplicação
```

## 2.5. Permissões Linux

Levaremos em consideração que o usuário local será "ricardo". Quando em desenvolvimento, de maneira a facilitar a edição dos arquivos, o usuário local deverá ser configurado nos arquivos. 

No servidor, rodando em modo de produção, os arquivos do projeto devem possuir permissões seguras. Isso significa que os diretórios deverão possuir permissão "755", os arquivos "644" e todos deverão pertencer ao usuário do apache "www-data".

Localmente, rodando em modo de desenvolvimento, o usuário deverá ser o do desenvolvedor "ricardo" e o grupo "www-data":

```
$ cd /var/www/project/
$ sudo find . -type d -exec chmod 755 {} \;
$ sudo find . -type f -exec chmod 644 {} \;
$ sudo chown -R ricardo:www-data .
```
Os diretórios "storage" e "bootstrap/cache" devem possuir permissão de escrita:

```
sudo chgrp -R www-data /var/www/project/storage
sudo chgrp -R www-data /var/www/project/bootstrap/cache

sudo chmod -R ug+rwx /var/www/project/storage
sudo chmod -R ug+rwx /var/www/project/bootstrap/cache
```


[Mais informações na documentação oficial do Laravel]
(https://laravel.com/docs/5.5/installation)

[Voltar para Lista de Opções](../readme.md)