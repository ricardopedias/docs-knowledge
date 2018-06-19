[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)

# 1. Preparação do sistema

Para desenvolver usando o Laravel é preciso que o servidor seja instalado. Para tanto, basta seguir os procedimentos a seguir:

[Ubuntu 17.04 Programaçao WEB](https://bitbucket.org/rpdesignerfly/sofia/wiki/OS%20Ubuntu%2017.04%20Programação%20WEB)

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

### 2.3. Localização das mensagens para português

Por padrão, o Laravel exibe as mensagens públicas em inglês. Para localizar isso, basta adicionar arquivos de linguagem no diretório "resources/lang/" que se encontra na raiz do projeto. Existe um pacote contendo as traduções e pode ser clonado facilmente:

```
$ cd /var/www/project/resources/lang/
$ git clone https://github.com/felipeporto/laravel-5.2-pt-br-localization.git ./pt-br
$ rm -rf ./pt-br/.git # remove os dados do git deste pacote 
```

Para ativar a localização, é preciso editar o arquivo "/var/www/project/config/app.php" e adicionar as diretivas do idioma:

```
# config/app.php: 

   'timezone' => 'America/Sao_Paulo',
   'locale' => 'pt-br',
   'fallback_locale' => 'pt-br',
```

### 2.4. Localização das datas para português

Antes de qualquer coisa, para que o PHP consiga exibir as datas em português, é necessário que o pacote de linguagem esteja presente no sistema operacional. Para instalar no Linux, basta usar os comandos abaixo:

```
$ sudo apt-get install language-pack-pt
$ sudo dpkg-reconfigure locales
```

O passo seguinte é ativar a localização desejada. A melhor forma de fazer isso no Laravel é adicionando a diretiva "setlocale()" no método "boot()" do provedor da aplicação:

```
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    }
    
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
```

Agora será possível exibir datas no idioma correto de duas formas:

```
# usando Carbon (saída das datas nos Models)
$date = new Carbon\Carbon('today');
echo $date->formatLocalized('%A, %d de %B de %Y');

# usando strftime
echo strftime('%A, %d de %B de %Y', strtotime('today'));
```

O resultado será: "quinta, 06 de abril de 2017"


[Mais informações na documentação oficial do Laravel]
(https://laravel.com/docs/5.5/installation)

[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)