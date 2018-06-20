[Voltar para Lista de Opções](../readme.md)

# 1. Preparação do sistema

Para desenvolver usando o Laravel é preciso que o servidor seja instalado. Para tanto, basta seguir os procedimentos a seguir:

* [Ubuntu 18.04 para Desenvolvedor Web](ubuntu-18.04-devel.md)
* [Ubuntu 17.10 para Desenvolvedor Web](ubuntu-17.10-devel.md)
* [Ubuntu 17.04 para Desenvolvedor Web](ubuntu-17.04-devel.md)

# 2. Usando projetos Laravel existentes

# 2.1. Clonando

Vamos levar em consideração que o projeto local se encontrará em /var/www/project/. Basta entrar no diretório onde o projeto será instalado e cloná-lo:

```
$ cd /var/www/project/
$ git clone https://xxxxxxxx/repositorio.git .
```

## 2.2. Dependências do projeto

Após clonar um projeto existente, as dependências não estarão presentes e precisarão ser instaladas:

```
$ composer update    # Os pacotes serão atualizados e colocados no diretório "/vendor"
$ npm install        # Os pacotes serão atualizados e colocados no diretório "/node_modules"
```

## 2.3. Arquivo de configuração

O arquivo *".env"* deverá ser criado e configurado manualmente. No diretório do projeto, basta copiar o arquivo *".env.example"* para *".env"*. **Importante**: nunca exclua o arquivo *".env.example"*.

> Nota: O arquivo de configuração ".env" é gerado automaticamente no processo de instalação do novo projeto (veja o documento [Criando Projetos](docs/laravel-criando-projetos.md)), mas em projetos existentes isso não acontece.

```
$ cd /var/www/project/
$ cp .env.example .env
```

## 2.4. A Chave Criptográfica da Aplicação

Agora que o arquivo *".env"* já existe, podemos gerar a chave criptográfica que a aplicação utiliza para a criação das Senhas e os Hashes temporários de comunicação:

```
$ cd /var/www/project/
$ php artisan key:generate # gera a chave da aplicação
```

## 2.5. Banco de Dados

Caso a aplicação utilize banco de dados, será necessário adicionar as informações corretas para a conexão no arquivo *".env"*.

### 2.5.1. Criando o Banco de dados

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

Com o banco criado, configure as informações do arquivo *".env"*.

```
.env:
    APP_URL=http://www.project.dev.br
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=ricardo
```

### 2.5.1. Criando o as Tabelas (Migrations)

Agora que o banco de dados existe e a aplicação está conectando com sucesso, podemos rodar as migrações da aplicação para popular o banco de dados com as tabelas:

```
$ cd /var/www/project/
$ php artisan migrate
```


## 2.6. Permissões Linux para desenvolvimento

Quando em desenvolvimento, de maneira a facilitar a edição dos arquivos, o usuário local deverá ser configurado nos arquivos do projeto. Levaremos em consideração que o usuário local seja *"ricardo"*. Neste caso, em modo de desenvolvimento, o usuário deverá ser o do desenvolvedor *"ricardo"* e o grupo *"www-data"*. O grupo *"www-data"* é o grupo do servidor http e deve estar presente para que o Apache possa ter acesso aos arquivos:

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