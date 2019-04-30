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

* Git Lens
* PHP Namespace Resolver
* PHP Getters & Setters
* PHP DocBlock Generator
* Laravel Extra Intellisense
* IntelliSense for CSS, SCSS class and ID names in HTML

### 2.2. Aparência

Em File > Preferences > Color Theme, busque, instale e aplique o tema:

```
Oceanic Next
```

Configurando a aparência da sintaxe.

Em File > Preferences > Settings, mude os parâmetros para:

```
Font Family: 'Fira Code', 'monospace', monospace, 'Droid Sans Fallback'
Font Size: 13
Line Height: 30
Tab Size: 4
```


Se preferir, basta setar todas as configurações de uma só vez, acesse File > Preferences > Settings > Associations > Edit in settings.json. O arquivo de configuração se abrirá. Nele cole os parâmetros abaixo:


```
{
    "git.autofetch": true,
    "editor.fontLigatures": true,
    "editor.fontFamily": "'Fira Code', 'monospace', monospace, 'Droid Sans Fallback'",
    "workbench.colorTheme": "Oceanic Next",
    "editor.lineHeight": 30,
    "editor.suggestLineHeight": 3,
    "editor.fontSize": 13,
    "files.watcherExclude": {
        "**/.git/objects/**": true,
        "**/.git/subtree-cache/**": true,
        "**/node_modules/*/**": true
    }
}
```

[Voltar para Lista de Opções](../readme.md)
