[Voltar para Lista de Opções](../readme.md)

# 1. Desktop e Produtividade

A primeira ação a ser feita é atualizar todos os pacotes do sistema para permanecer com as últimas atualizações:

```
$ sudo apt update && sudo apt upgrade
```

### 1.1. Multimidia

Drivers e fontes do Windows:

```
$ sudo apt-get install ubuntu-restricted-extras
```
```
$ sudo apt install vlc
$ sudo apt install smplayer
```

Conversor de formatos:

```
$ sudo apt-add-repository ppa:teejee2008/ppa -y
$ sudo apt-get update
$ sudo apt-get install selene
```

### 1.2. Internet Navegadores

#### Google Chromium

```
$ sudo apt install chromium-browser
```

#### Google Chrome

Para instalar o Google Chrome no Ubuntu 17.04, execute os comandos a seguir no terminal:

```
$ sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
$ wget -q -O - https://dl.google.com/linux/linux_signing_key.pub | sudo apt-key add -
$ sudo apt update && sudo apt install google-chrome-stable
```

#### Vivaldi

```
$ sudo sh -c 'echo "deb http://repo.vivaldi.com/archive/deb/ stable main" >> /etc/apt/sources.list.d/vivaldi.list'
$ wget -q -O - http://repo.vivaldi.com/archive/linux_signing_key.pub | sudo apt-key add -
$ sudo apt update && sudo apt install vivaldi-stable
```

#### Opera

Para instalar o Opera no Ubuntu, adicione o repositório no sistema:

```
$ sudo sh -c 'echo "deb https://deb.opera.com/opera-stable/ stable non-free" >> /etc/apt/sources.list.d/opera.list'
$ wget -q -O - https://deb.opera.com/archive.key | sudo apt-key add -
$ sudo apt update && sudo apt install opera-stable
```

### 1.3. Outras Ferramentas para Desktop

#### Dropbox

```
$ echo deb http://linux.dropbox.com/ubuntu xenial main | sudo tee /etc/apt/sources.list.d/dropbox.list
$ sudo apt-key adv --keyserver pgp.mit.edu --recv-keys 5044912E
$ sudo apt update && sudo apt install dropbox
```
# 2. Aparência

### 2.1. Gnome Tweak Tool

```
$ sudo apt install gnome-tweak-tool
```

### 2.2. Extensoes do Gnome

Dentro do gnome tweak, acessar a aba Extensões e ativar:

* Ubuntu appindicators
* Ubuntu dock

### 2.3. Botões da janela

Abra o dconf editor e encontre o registro '/org/gnome/desktop/wm/preferences/button-layout'.
No campo "Valor Personalizado" basta inverter a ordem dos elementos, separados por virgula:

```
close,minimize,maximize:appmenu
```

### 2.4. Tema das Janelas

```
$ sudo apt install arc-theme
```
No Gnome Tweak Tool, acesse "Aparência" e na seção Temas > Aplicativos, ative o tema Arc.

Para as aplicações derivadas do KDE ficarem com aparência mais bonita:

```
$ sudo apt install kde-runtime breeze
```

### 2.5. Tema de ícones

Baixar o tema de icones em https://github.com/snwh/paper-icon-theme. Após extrair os arquivos, copie os diretórios 'Paper' e 'Paper-Mono-Dark' na pasta '.icons' na home do usuário.

No Gnome Tweak Tool, acesse "Aparência" e na seção Temas > Ícones, ative o tema Paper.

## 3. Apport

O System Error Apport é um mecanismo que a Canonical instituiu nas últimas versões do Ubuntu para que os usuários possam reportar os erros do sistema facilmente. Se você não tem interesse em reportar estes erros (o que muitas vezes não reflete em nada no funcionamento), basta remover o Apport:

```
$ sudo apt-get purge apport
```

[Voltar para Lista de Opções](../readme.md)