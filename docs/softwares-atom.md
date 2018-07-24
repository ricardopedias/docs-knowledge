[Voltar para Lista de Opções](../readme.md)

# Atom


O editor Atom, desenvolvido pela equipe do github.com é uma ótima opção para desenvolvimento:

```
$ sudo wget -q -O - https://packagecloud.io/AtomEditor/atom/gpgkey | sudo apt-key add -;
$ sudo sh -c 'echo "deb [arch=amd64] https://packagecloud.io/AtomEditor/atom/any/ any main" > /etc/apt/sources.list.d/atom.list';
$ sudo apt-get update && sudo apt-get install -y atom;

# Atom
# https://flight-manual.atom.io/getting-started/sections/installing-atom/
# curl -sL https://packagecloud.io/AtomEditor/atom/gpgkey | sudo apt-key add -;


É preciso baixar manualmente o Atom no site https://atom.io/
Em Edit > Preferences > Install, busque e instale os pacotes na seguinte sequência:

- atom-ide-ui 
- ide-php
- ide-html
- ide-css
- ide-json
- emmet
- atom-alignment
- project-plus
- docblockr
- platformio-ide-terminal

Configurando a aparência da sintaxe.

Em Edit > Preferences > Editor, mude os parâmetros:

- Font Size: 12px;
- Line Height: 2.5
- Tab Length: 4

Em Edit > Preferences > Install, busque e instale o tema:

- atom-oceanic-next-italic

Após instalar, em Edit > Preferences > Themes, selecione "Atom Oceanic Next Italic" no seletor "Syntax Theme".

Por fim, vá para em Edit > Stylesheet e o arquivo interno chamado "styles.less" será aberto. Nele adicione os estilos para personalizar ainda mais a aparência dos textos no Editor do Atom. No caso abaixo, estamos ativando a fonte "Operator Mono Book" e a fonte especial "Fira Code" para "ligaduras", um recurso muito interessante que vai aumentar a experiência visual do código fonte:

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

NOTA: As fontes "Operator Mono Book" e a fonte especial "Fira Code" devem estar instaladas no sistema para o Atom identificá-las. :)

## Dica sobre os comentários

Em notebooks, os atalhos para comentar o código (Ctrl + / e Ctrl + Shift + /) não funcionarão! Para comentar, será preciso adicionar atalhos alternativos. 

Em Edit > Preferences > Install, busque e instale o pacote:

- quick-comment

Após instalar este pacote, basta usar o novo atalho (Shift + Alt + c) para comentar/descomentar seu código.

## Dica sobre o pacote Project Plus

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



[Voltar para Lista de Opções](../readme.md)