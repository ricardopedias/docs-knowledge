[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)

# Laravel 5.5 - Usando o Bootstrap 4

Por padrão o Laravel vem com o Bootstrap 3.3.x. As instruções abaixo especificam como atualizar para o novo Bootstrap 4. Leva-se em consideração que o npm esteja devidamente instalado.


## 1. Instalando o Bootstrap

Vamos levar em consideração que o projeto local se encontra em /var/www/project/. Antes de tudo, será necessário remover o Bootstrap 3. Isso pode ser feito editando manualmente o arquivo "package.json" ou simplesmente usando o npm:

```
cd /var/www/project/
npm uninstall --save-dev bootstrap-sass
```

Em seguida, é preciso instalar o novo bootstrap. No momento em que este documento é escrito, a versão mais atual é a "4.0.0-beta.2". Para saber a versão mais recente, veja a [documentação do Bootstrap](https://getbootstrap.com/docs/4.0/getting-started/download).

O novo Bootstrap precisa da biblioteca "propper.js", que pode ser instalada no mesmo comando:

```
cd /var/www/project/
npm install --save-dev bootstrap@4.0.0-beta.2 popper.js
```

Note o parâmetro "--save-dev". Esta opção, adiciona automaticamente uma linha no arquivo "package.json" quando a instalação for concluída.

## 2. Configurando o Javascript

Após instalar o novo Bootstrap, é necessário configurar o LaravelMix para utilizá-lo. Abrindo o arquivo "/var/www/project/resources/assets/js/bootstrap.js" você verá que ele começa com a seguinte implementação:


```
window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}
```

Edite-o com o seguinte conteúdo:

```
window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js');

    require('bootstrap');
} catch (e) {}
```

## 3. Configurando o Sass

A última coisa a fazer será configurar o Sass para incluir o novo Bootstrap. Abrindo o arquivo "/var/www/project/resources/assets/sass/app.scss" você verá que ele possui a seguinte implementação:

```
// Fonts
@import url("https://fonts.googleapis.com/css?family=Raleway:300,400,600");

// Variables
@import "variables";

// Bootstrap
@import "~bootstrap-sass/assets/stylesheets/bootstrap";
```

Edite o caminho da chamada para o Bootstrap:

```
// Fonts
@import url("https://fonts.googleapis.com/css?family=Raleway:300,400,600");

// Variables
@import "variables";

// Bootstrap
@import "~bootstrap/scss/bootstrap";
```

Após fazer isso, será necessário atualizar o arquivo "/var/www/project/resources/assets/sass/_variables.scss". Este arquivo contém as variáveis de personalização do Bootstrap 3 que são incompatíveis com a nova versão. Abaixo um exemplo do conteúdo:

```
// Body
$body-bg: #f5f8fa;

// Borders
$laravel-border-color: darken($body-bg, 10%); 
$list-group-border: $laravel-border-color;
$navbar-default-border: $laravel-border-color;
$panel-default-border: $laravel-border-color;
$panel-inner-border: $laravel-border-color;

// Brands
$brand-primary: #3097D1;
$brand-info: #8eb4cb;
$brand-success: #2ab27b;
$brand-warning: #cbb956;
$brand-danger: #bf5329;
...
```

O conteúdo deste arquivo deve ser atualizado. Para isso basta usar como referencia o conteúdo do arquivo fornecido pelo Boostrap 4, que pode ser encontrado em "/var/www/project/node_modules/bootstrap/scss/_variables.scss". Basta copiar o novo conteúdo e ficará tudo certo. Veja abaixo um exemplo do novo conteudo:

```
// Variables
//
// Variables should follow the `$component-state-property-size` formula for
// consistent naming. Ex: $nav-link-disabled-color and $modal-content-box-shadow-xs.


//
// Color system
//

// stylelint-disable
$white:    #fff !default;
$gray-100: #f8f9fa !default;
$gray-200: #e9ecef !default;
$gray-300: #dee2e6 !default;
$gray-400: #ced4da !default;
$gray-500: #adb5bd !default;
$gray-600: #868e96 !default;
$gray-700: #495057 !default;
$gray-800: #343a40 !default;
$gray-900: #212529 !default;
$black:    #000 !default;

$grays: () !default;
$grays: map-merge((
  "100": $gray-100,
  "200": $gray-200,
  "300": $gray-300,
  "400": $gray-400,
  "500": $gray-500,
  "600": $gray-600,
  "700": $gray-700,
  "800": $gray-800,
  "900": $gray-900
), $grays);
```

## 4. Compilando 

Agora basta usar normalmente o npm para compilar os assets:

```
npm run dev
```

[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)