[Voltar para Lista de Opções](../readme.md)

# 1. Preparação do sistema

Para desenvolver usando o Laravel é preciso que o servidor seja instalado. Para tanto, basta seguir os procedimentos a seguir:

* [Ubuntu 18.04 para Desenvolvedor Web](ubuntu-18.04-devel.md)
* [Ubuntu 17.10 para Desenvolvedor Web](ubuntu-17.10-devel.md)
* [Ubuntu 17.04 para Desenvolvedor Web](ubuntu-17.04-devel.md)

# 2. Novo projeto Laravel (Modo Desenvolvimento)

Os comandos abaixo são usados para novas instalações do Laravel. Note que as permissões são destinadas para ambiente de desenvolvimento. Em modo de produção os arquivos devem pertencer ao usuário do apache "www-data" com permissões seguras, como será explicado mais adiante.

### 2.1. Criação do novo projeto

```
$ chmod -Rf 777 /var/www/project
$ composer create-project --prefer-dist laravel/laravel /var/www/project/
$ cd /var/www/project
$ php artisan key:generate # gerar a chave da aplicação
$ php artisan config:clear # limpar as configurações
```

### 2.2. Permissões de escrita

```
$ sudo chmod -Rf 777 storage
$ sudo chmod -Rf 777 bootstrap/cache
```

### 2.3. Dependências do projeto

```
$ composer update    # Os pacotes serão atualizados e colocados no diretório "/vendor"
$ npm install        # Os pacotes serão atualizados e colocados no diretório "/node_modules"
```

### 2.2. Arquivos de configuração

O arquivo de configuração ".env" foi gerado automaticamente no processo de instalação do novo projeto.
Nele é necessário adicionar as informações corretas para a conexão com banco de dados e para a url da aplicação:

```
.env:
    APP_URL=http://www.project.dev.br
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=ricardo
```

[Voltar para Lista de Opções](../readme.md)
