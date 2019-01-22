[Voltar para Lista de Opções](../readme.md)

# Atom

O editor Atom, desenvolvido pela equipe do github.com é uma ótima opção para desenvolvimento:

## 1. Instalando

### 1.1. Para instalar com apt

```
$ sudo wget -q -O - https://packagecloud.io/AtomEditor/atom/gpgkey | sudo apt-key add -;
$ sudo sh -c 'echo "deb [arch=amd64] https://packagecloud.io/AtomEditor/atom/any/ any main" > /etc/apt/sources.list.d/atom.list';
$ sudo apt-get update && sudo apt-get install -y atom;
```

### 1.2. Para instalar manualmente

É preciso baixar manualmente o Atom no site https://atom.io/.
Mais informaçes em [Instalando o Atom](https://flight-manual.atom.io/getting-started/sections/installing-atom/).

## 2. Configurando

### 2.1. Pacotes e Plugins

Em **Edit > Preferences > Install**, busque e instale os pacotes na seguinte sequência:

* atom-ide-ui 
* ide-php
* ide-html
* ide-css
* ide-json
* emmet
* atom-alignment
* project-plus
* docblockr
* platformio-ide-terminal
* atom-inline-blame

Em notebooks, os atalhos para comentar o código (Ctrl + / e Ctrl + Shift + /) não funcionarão! Para comentar, será preciso adicionar atalhos alternativos. 

Em **Edit > Preferences > Install**, busque e instale o pacote:

* quick-comment

Após instalar este pacote, basta usar o novo atalho (Shift + Alt + c) para comentar/descomentar seu código.

### 2.2. Aparência da Sintaxe

Configurando a aparência da sintaxe.

Em **Edit > Preferences > Editor**, mude os parâmetros:

* Font Size: 12px;
* Line Height: 2.5
* Tab Length: 4

Em **Edit > Preferences > Install**, busque e instale o tema:

* atom-oceanic-next-italic

Após instalar, em **Edit > Preferences > Themes**, selecione "Atom Oceanic Next Italic" no seletor "Syntax Theme".

Por fim, vá para em **Edit > Stylesheet** e o arquivo interno chamado "styles.less" será aberto. Nele adicione os estilos para personalizar ainda mais a aparência dos textos no Editor do Atom. No caso abaixo, estamos ativando a fonte "Operator Mono Book" e a fonte especial "Fira Code" para "ligaduras", um recurso muito interessante que vai aumentar a experiência visual do código fonte.

#### Novas fontes

NOTA: As fontes "Operator Mono Book" e a fonte especial "Fira Code" devem estar instaladas no sistema para o Atom identificá-las. :)

A Fira Code é gratuíta e se encontra nos repositórios do Ubuntu, podendo ser instalado com o comando:

```
sudo apt install fonts-firacode
```

Já a Operator Mono é uma fonte proprietária e custa $100,00 e pode ser encontrada em [https://www.typography.com/fonts/operator/styles](https://www.typography.com/fonts/operator/styles). As fonts otf da familia Operation Mono devem ser agrupadas em um diretório chamado 'operation-mono' e copiadas para '/usr/share/fonts/opentype'. Após a cópia, é necessário atualizar o cache de fontes:

```
sudo cp -r operator-mono /usr/share/fonts/opentype/
sudo fc-cache -f -v
```

#### Personalizando os estivos do Atom

```
atom-workspace,
atom-text-editor {
    font-family: "Operator Mono Book";
    font-size: 14px;
    font-weight: normal;
    line-height: 2.5;
}

atom-panel.tool-panel {
    font-size: 0.88em;
}

.editor .comment,
atom-text-editor.editor .syntax-comment {
    font-family: "Operator Mono Book Italic";
    font-style: normal;
}

.github-HunkView-line.github-HunkView-line {
    font-size: 0.9em;
}

/*
O código abaixo ativa as "ligaduras"
para melhorar os sinais (matemáticos, lógicos, etc) 
especiais no código.
*/

atom-workspace,
atom-text-editor {
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
}

atom-text-editor.editor {
  .syntax--storage.syntax--type.syntax--function.syntax--arrow,
  .syntax--keyword.syntax--operator:not(.accessor),
  .syntax--punctuation.syntax--definition {
    font-family: "Fira Code";
  }

  .syntax--string.syntax--quoted,
  .syntax--string.syntax--regexp {
    -webkit-font-feature-settings: "liga" off, "calt" off;
  }
}

```

### 2.3. Lista de Projetos com Project Plus

Pressionando Ctrl + Shift e escolhendo a opção "Project Plus: Edit Projects", o arquivo "projects.cson" será aberto. Nele os projetos podem ser adicionados com a seguinte sintaxe:

```
[
    {
        title: "Knowledge",
        paths: [
            "/var/www/knowledge"
        ]
    }
    {
        title: "Coding Style",
        paths: [
            "/var/www/coding-style"
        ]
    }
    {
        title: "SortableGRID",
        paths: [
            "/var/www/laravel56/packages/plexi/sortable-grid"
        ]
    }
    {
        title: "Access Control",
        paths: [
            "/var/www/laravel56/packages/plexi/access-control"
        ]
    }

    {
        title: "Report Collection"
        paths: [
            "/var/www/laravel56/packages/plexi/report-collection"
        ]
    }
    {
        title: "OLDExtended",
        paths: [
            "/var/www/laravel56/packages/plexi/old-extended"
        ]
    }
    {
        title: "Laravel56"
        paths: [
            "/var/www/laravel56"
        ]
    }
]
```

## 3. Resolvendo Problemas

Após atualização no Ubuntu 18.04 LTS, a mensagem aparece e o push não é executado:

**/usr/share/atom/resources/app.asar.unpacked/node_modules/dugite/git/libexec/git-core/git-remote-http: /usr/lib/x86_64-linux-gnu/libcurl.so.4: version CURL_OPENSSL_3' not found (required by /usr/share/atom/resources/app.asar.unpacked/node_modules/dugite/git/libexec/git-core/git-remote-http)**

Para resolver isso, é preciso instalar a versão 3 da biblioteca curl:

```
apt install libcurl3 libcurl-openssl1.0-dev
```

[Voltar para Lista de Opções](../readme.md)
