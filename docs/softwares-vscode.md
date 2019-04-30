[Voltar para Lista de Opções](../readme.md)

# Visual Studio Code

Criado pela Microsoft, o Visual Studio Code é uma mistura de tecnologias de código aberto baseadas na web, como o Chromium, 
o Electron app framework do GitHub, e próprio editor Monaco, da Microsoft. Esta ferramenta tem crescido cada vez mais na comunidade 
e hoje é uma ótima opção para desenvolvimento:

## 1. Instalando

### 1.1. Para instalar com apt

```
$ sudo curl https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > microsoft.gpg;
$ sudo sh -c 'echo "deb [arch=amd64] https://packages.microsoft.com/repos/vscode stable main" > /etc/apt/sources.list.d/vscode.list'
$ sudo apt-get update && sudo apt-get install -y code;
```

### 1.2. Para instalar manualmente

É preciso baixar manualmente o Visual Studio Code no site https://code.visualstudio.com/.

## 2. Configurando

### 2.1. Pacotes e Plugins

Em View > Extensions, busque e instale os pacotes na seguinte sequência:

Custom CSS and JS Loader

...

### 2.2. Aparência da Sintaxe

Configurando a aparência da sintaxe.

Em File > Preferences > Settings, mude os parâmetros para:

```
Font Family: 'Fira Code', 'monospace', monospace, 'Droid Sans Fallback'
Font Size: 13px;
Line Height: 30
Tab Size: 4
```

Em File > Preferences > Color Theme, busque, instale e aplique o tema:

```
Oceanic Next
```

Adicionando estilos especiais ao tema:

```
"vscode_custom_css.imports": ["/home/ricardo/.vscode/style.css"],
"vscode_custom_css.policy": true
```

```
/* Ligatures */
.mtk26,
.mtk16,
.mtk36,
.mtk39 {  
   font-family: "Fira Code";
} 

/* Keywords, decorators, comments */
.mtk5,
.mtk6,
.mtk8,
.mtk34,
.mtki {  
    font-family: "Operator Mono";  
    font-style: italic;  
    font-size: 1em;
}
```

```
{
    "git.autofetch": true,
    "editor.fontLigatures": true,
    "editor.fontFamily": "'Fira Code', 'monospace', monospace, 'Droid Sans Fallback'",
    "workbench.colorTheme": "Oceanic Next",
    "editor.lineHeight": 30,
    "editor.suggestLineHeight": 3,
    "editor.fontSize": 13,
    "vscode_custom_css.imports": ["file:///home/ricardo/.vscode/style.css"],
    "vscode_custom_css.policy": true,
    "files.watcherExclude": {
        "**/.git/objects/**": true,
        "**/.git/subtree-cache/**": true,
        "**/node_modules/*/**": true
    }
}
```

Por fim, vá para em Edit > Stylesheet e o arquivo interno chamado "styles.less" será aberto. Nele adicione os estilos para personalizar ainda mais a aparência dos textos no Editor do Atom. No caso abaixo, estamos ativando a fonte "Operator Mono Book" e a fonte especial "Fira Code" para "ligaduras", um recurso muito interessante que vai aumentar a experiência visual do código fonte.


[Voltar para Lista de Opções](../readme.md)
