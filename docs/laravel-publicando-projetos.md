[Voltar para Lista de Opções](../readme.md)

# 1. Preparação do sistema

Para desenvolver usando o Laravel é preciso que o servidor seja instalado. Para tanto, basta seguir os procedimentos a seguir:

[Ubuntu 17.04 Programaçao WEB](https://bitbucket.org/rpdesignerfly/sofia/wiki/OS%20Ubuntu%2017.04%20Programação%20WEB)

# 2. Publicando arquivos via FTP

Vamos levar em consideração que o projeto local se encontra em /var/www/project/.

Caso o servidor não possua o git, será necessário fazer o upload de todos os arquivos através de FTP.
Apenas o diretório "/var/www/project/node_modules" deve ser omitido do upload. Isso significa que todos os arquivos do Laravel (veja o documento [Criando Novos Projetos](https://bitbucket.org/rpdesignerfly/sofia/wiki/Laravel%205.5%20-%2001%20Criando%20Novos%20Projetos)), incluindo as dependências do composer em "/var/www/project/vendor" devem ser enviadas. 

# 3. Publicando arquivos via GIT

Usando o GIT, além de ser mais fácil a publicação é também mais rápida.
Basta entrar no diretório onde o projeto será instalado e clonar o projeto:

```
$ cd /meu/diretorio/da/hospedagem/
$ git clone https://xxxxxxxx/repositorio.git .
```

## 3.1. Dependências do projeto

Caso o projeto seja enviado para produção através do git, as dependências não estarão presentes e 
precisarão ser instaladas. Apenas as dependências PHP (composer) deverão ser instaladas, pois as dependências Javascript e CSS (npm) servem apenas para produção.

Para instalar as dependências PHP, basta usar o seguinte comando:

```
$ composer install    # Os pacotes serão atualizados e colocados no diretório "/vendor"
```

## 3.2. Informações importantes sobre dependências

No projeto em produção o diretório "/var/www/project/vendor" deverá estar presente, pois o sistema depende das bibliotecas armazenadas nele. Todavia, o diretório "/var/www/project/node_modules" não deverá estar presente no modo produção, ou seja, deve ser excluído ao publicar o projeto definitivamente. O "node_modules" é útil apenas para desenvolvimento, haja visto que o Laravel Mix usa estes módulos apenas no momento em que ele compila os arquivos "js" e "css" a serem publicados no site (no diretório /var/www/project/public).

Mais informações sobre o "node_modules" em [Laravel 5.5 - Laravel Mix](https://bitbucket.org/rpdesignerfly/sofia/wiki/Laravel%205.5%20-%2004%20Laravel%20Mix)


## 3.3. Arquivos de configuração

O arquivo de configuração ".env" é gerado automaticamente no processo de instalação do novo projeto (veja a seção 2. Novo projeto Laravel). Mas, no processo de publicação, o arquivo ".env" deverá ser configurado manualmente. No diretório do projeto, basta copiar o arquivo ".env.example", gerando o novo arquivo ".env":

```
$ cd /meu/diretorio/da/hospedagem/
$ cp .env.example .env
```

No arquivo ".env" é necessário adicionar as informações corretas para a conexão com banco de dados e para a url da aplicação:

``` 
.env: 
    APP_URL=http://www.project.dev.br
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=ricardo
```

É preciso também gerar a chave criptográfica:

```
$ cd /meu/diretorio/da/hospedagem/
$ php artisan key:generate # gerar a chave da aplicação
```

## 3.4. Segurança

No servidor, rodando em modo de produção, os arquivos do projeto devem possuir permissões seguras.
Isso significa que os diretórios deverão possuir permissão "755", os arquivos "644" e todos deverão pertencer ao usuário do apache "www-data":

```
$ cd /var/www/project/
$ sudo find . -type d -exec chmod 755 {} \;
$ sudo find . -type f -exec chmod 644 {} \;
$ sudo chown -R www-data:www-data .
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