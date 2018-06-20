[Voltar para Lista de Opções](../readme.md)

# 1. Instalação do "npm" e do "nodejs"

### Ubuntu

As dependências do sistema devem ser instaladas antes. Verifique em:
[Laravel 5.5 - Novos Projetos](https://bitbucket.org/rpdesignerfly/sofia/wiki/Laravel%205.5%20-%2001%20Criando%20Novos%20Projetos) e 
[Ubuntu 17.04 Programação WEB](https://bitbucket.org/rpdesignerfly/sofia/wiki/OS%20Ubuntu%2017.04%20Programação%20WEB)

# 2 Instalação do Laravel Mix

Os pacotes para a instalação padrão do Laravel Mix estão configurados no arquivo "package.json", 
encontrado na raiz do projeto Laravel. Para instalar as dependências:

```
$ npm install                      # Instala as dependencias do Laravel Mix
c:\ npm install --no-bin-links     # || se for no windows
```
Após a instalação terminar, surgirá um diretório chamado "node_modules" na raiz do projeto Laravel.
Este diretório é muito extenso e contém todos os pacotes usados pelo Laravel Mix.

Caso você pretenda usar o GIT para armazenar seu projeto, convém lembrar que o diretório "node_modules" é ignorado por padrão das submissões ao repositório.

Isso porque os pacotes "npm" não são usados diretamente pelo site, e são úteis apenas para desenvolvimento. O Laravel Mix compila os pacotes desejados e gera os arquivos (js e css) no diretório "public" do projeto Laravel.

# 3. Usando pacotes "npm"

Os pacotes "npm" adicionam flexibilidade no desenvolvimento, possibilitando que o desenvolvedor use diretamente os projetos originais de bibliotecas como "bootstrap", "jquery" e muitos outros. Isso significa que estarão disponíveis facilmente arquivos "sass", "less", etc, que poderão ser compilados pelo Laravel Mix e adicionados automaticamente ao diretório "public" do projeto Laravel.

### Procurando pacotes

Para pesquisar pacotes "npm", basta acessar a página oficial em https://www.npmjs.com/ e procurar um pacote javascript (jquery, plugins, motools, etc) ou css (bootstrap, temas, etc).

Se preferir, existe uma maneira mais rápida usando a linha de comando:

```
$ npm search jquery
```

Uma lista como abaixo aparecerá no terminal:

```
NAME                      | DESCRIPTION          | AUTHOR          | DATE       | VERSION  | KE
jquery                    | JavaScript library…  | =dmethvin…      | 2017-03-20 |          | jq
jquery-ui                 | A curated set of…    | =devongovett…   | 2016-09-14 |          | 
object.assign             | ES6 spec-compliant…  | =ljharb         | 2016-07-04 |          | Ob
node.extend               | A port of…           | =dreamerslab…   | 2016-09-06 |          | ex
js-cookie                 | A simple,…           | =fagner…        | 2017-04-03 |          | jq
jquery-migrate            | Migrate older…       | =dmethvin…      | 2016-06-09 |          | jq
```

### Instalação pacotes

Para instalar um pacote, basta usar o nome do pacote no comando:

```
$ npm install jquery-ui
```

O comando acima fará o download do jQuery UI e armazenará o pacote no diretório "node_modules" para ser utilizado no projeto. 

### Adicionando pacotes auto-instaláveis

O arquivo "package.json" contém os pacotes "npm" que deverão ser instalados ao chamar o comando "npm install", no momento da configuração de novos projetos com Laravel Mix.

É uma boa prática adicionar os pacotes usados no seu projeto dentro deste arquivo para que, todas as vezes que o projeto for clonado do repositório, o "npm install" já instale tudo o que é necessário para o desenvolvimento.

Para fazer isso é muito simples, basta usar os parâmetros "--save" ou "--save-dev" após o comando de instalação:

```
$ npm install jquery-ui --save-dev
```
Isso adicionará automaticamente o "jquery-ui" no arquivo "package.json".


# 4. Mapeando pacotes para compilação

No arquivo 'webpack.config.js' se encontram as diretivas que informam ao Laravel Mix sobre o que fazer.
Neste arquivo é possível mandar o Mix combinar vários arquivos, interpretar arquivos sass, less, etc, ou simplesmente copiar arquivos de um pacote. Todo o processamento será destinado ao diretório "public", ficando acessível para o site:

### Copiando assets

O sistema de cópia de arquivos do Mix é muito poderoso e está presente em sua forma simples (pelo método mix.copy(), bem como dentro dos métodos de compilação (como mix.less(), mix.sass(), etc). 

Para fazer uma cópia simples de sua origem para o diretório 'public', basta adicionar a diretiva mix.copy():

```
// copia o arquivo 'theme.js' para 'public/js/theme.js'
mix.copy('resources/assets/js/theme.js', 'public/js');          

// copia o arquivo 'theme.css' para 'public/js/slin.css'
mix.copy('resources/assets/css/theme.css', 'public/js/slin.css');

// copia o diretório 'themes' e todo o seu conteudo para 'public/js/tinymce/themes'
mix.copy('node_modules/tinymce/themes', 'public/js/tinymce/themes');
```

### Compilando estilos

O Laravel Mix funciona como um compilador css que suporta vários tipos de linguagens:

```
// compila o arquivo 'theme.less' para 'public/css/theme.css'
mix.less('resources/assets/less/theme.less', 'public/css');       

// compila o arquivo 'theme.scss' para 'public/css/theme.css'
mix.sass('resources/assets/sass/theme.scss', 'public/css'); 

// compila o arquivo 'theme.styl' para 'public/css/theme.css'
mix.stylus('resources/assets/sass/theme.styl', 'public/css'); 
```

> **IMPORTANTE SOBRE A EXTENÇÃO .SASS E .SCSS:** Cada extenção se refere a duas sintaxes diferentes do SASS com as mesmas funcionalidades. A extenção '.sass' deve conter a sintaxe original do SASS que era um pouco diferente da sintaxe do CSS, sem chaves e pontos e virgulas. A extenção '.scss' (esta agora é a oficial) deve conter a nova sintaxe, que é mais parecida com a sintaxe do CSS. Na prática a escolha entre as duas é uma questão de gosto. Olhe abaixo um exemplo da sintaxe SASS e outro da sintaxe SCSS:

```
/* SASS */

#main
    color: blue
    font-size: 0.3em

    a
        font:
            weight: bold
            family: serif
        &:hover
            background-color: #eee
```

```
/* SCSS */

#main {
    color: blue;
    font-size: 0.3em;

    a {
        font: {
            weight: bold;
            family: serif;
        }
        &:hover {
            background-color: #eee;
        }
    }
}
```



Para consultar a documentação das linguagens de compilação:

* [Less](http://lesscss.org)
* [Sass](http://sass-lang.com)
* [Stylus](http://stylus-lang.com/)

### Combinando estilos

Para não precisar adicionar várias requisições a arquivos css, é possível combinar todos eles a gerar um único arquivo usando mix.styles():

```
mix.styles([
    'node_modules/tinymce/themes/light.css',
    'resources/assets/theme.css',
    'resources/assets/main.css'
], 'public/css/app.css');
```

### Trabalhando com scripts

Da mesma forma, é possível trabalhar com javascripts:

```
// processa o arquivo 'theme.js' para 'public/js/theme.js'
mix.js('resources/assets/js/theme.js', 'public/js'); 

// combina os scripts para o arquivo 'public/js/app.js'
mix.scripts([
    'node_modules/tinymce/themes/light.js',
    'resources/assets/js/theme.js',
    'resources/assets/js/main.js'
], 'public/css/app.js');
```

Mais informações podem ser encontradas na [Documentação oficial do Laravel Mix](https://laravel.com/docs/5.4/mix). 


# 5. Compilando arquivos CSS e JS

Com o arquivo 'webpack.config.js' devidamente configurado, basta executar as rotinas de compilação do Laravel Mix:


```
$ npm run dev               # compila tudo e entra em modo de observação

```

```
$ npm run production        # compila e minifica tudo

```

```
$ npm run watch             # modo de auto-compilação quando um arquivo fonte for editado

```

[Voltar para Lista de Opções](../readme.md)