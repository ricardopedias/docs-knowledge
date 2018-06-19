[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)

# Laravel 5.xx - Locaweb

## 1. A versão do PHP 

A primeira parte é ter certeza que a versão do PHP esta em acordo com a exigida pelo Laravel, neste caso a locaweb disponibiliza uma Wiki com o passo a passo para atualizar a versão sem muita dor de cabeça. Neste caso, vamas usar a versão 5.6 do PHP [clique aqui para a Wiki](https://wiki.locaweb.com.br/pt-br/Como_alterar_a_vers%C3%A3o_do_PHP). Apos atualizar a versão do PHP devemos acrescentar uma linha de codigo no final do arquivo php.ini:

```
suhosin.executor.include.whitelist = phar
```

## 2. Acesso SSH

Feito isso é preciso logar via SSH:

```
# ssh seu_usuario@seu_dominio
```

Logo depois que executar o comando irá pedir a senha,  neste ponto você estará na raiz de sua hospedagem, ao utilizar o comando 'ls' conseguira visualizar as pastas de sua raiz.

## 3. Configurando o Composer

Neste ponto iremos instalar o Composer:

```
# curl -sS https://getcomposer.org/installer | phpXX -c ~/php.ini
```

O parâmetro -c força o php a rodar com as configurações do arquivo php.ini que editamos anteriormente.
Sendo XX a versão do php que você deseja. Neste caso utilizamos a versão 5.6.

* Versão 5.4: php54
* Versão 5.5: php55
* Versão 5.6: php56

Utilize o comando abaixo para visualizar o Composer funcionando (lembre-se da versão do php)

```
# phpXX -c ~/php.ini composer.phar
```

## 4. Instalando o Laravel

Para criar uma instalação limpa do laravel, entre no diretório 'public_html' e execute:

```
# phpXX -c ~/php.ini composer.phar create-project laravel/laravel --prefer-dist [nome-do-projeto]
```

## 5. Configurando o diretório 'public' do laravel

Para configurar a pasta public (raiz do laravel) é preciso adicionar ao arquivo .htaccess:

```
Options +FollowSymlinks
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]
```
Neste ponto a aplicação já deve estar funcionando, ai é só tratar os possíveis erros como por exemplo conexão com banco de dados caso eles aconteçam.

## Rodando as migrations

```
# phpXX -c ~/php.ini artisan migrate
```

[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)