[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)

# Localização das mensagens para português

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
