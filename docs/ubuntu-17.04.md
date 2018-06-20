[Voltar para Lista de Opções](../readme.md)

NOTA: Existe um bug gerado pela atualização do release de longo suporte (LTS) do Ubuntu. 
Para corrigir acesse [Correção do Release](http://wimantis.ninja/fixing-ubuntu-17-04-apt-get-update-release-file-not-found/).

# 1. Desktop e Produtividade

A primeira ação a ser feita é atualizar todos os pacotes do sistema para permanecer com as últimas atualizações:

```
$ sudo apt update && sudo apt upgrade
```

### 1.1. Multimidia

```
$ sudo apt-get install ubuntu-restricted-extras
```
```
$ sudo apt install vlc
$ sudo apt install smplayer
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

### 2.1. Extensoes do Gnome

Dentro do gnome tweak, acessar a aba Extensões e ativar:

* Launch new instance
* Places status indicator
* Removable drive menu
* User Themes

Clicando em "Obter mais extensões", é possível instalar extensoes pela internet. O navegador será invocado.
Para que o navegador se comunique com o gnome, clique em "Click here to install browser extension" para instanar o plugin.

Após a instalação, basta clicar na extensão desejada e ativá-la. As seguintes extensões devem ser ativadas:

* Media player indicator
* Dash to Dock

### 2.2. Botões da janela

Abra o dconf editor e encontre o registro '/org/gnome/desktop/wm/preferences/button-layout'.
No campo "Valor Personalizado" basta inverter a ordem dos elementos, separados por virgula:

```
close,minimize,maximize:appmenu
```

### 2.3. Tema das Janelas

```
$ sudo apt install arc-theme
```
Para as aplicações derivadas do KDE ficarem com aparência mais bonita:

```
$ sudo apt install kde-runtime breeze
```

### 2.4. Tema de ícones

Baixar o tema de icones em https://github.com/snwh/paper-icon-theme. Após extrair os arquivos, copie os diretórios 'Paper' e 'Paper-Mono-Dark' na pasta '.icons' na home do usuário.

## 3. Apport

O System Error Apport é um mecanismo que a Canonical instituiu nas últimas versões do Ubuntu para que os usuários possam reportar os erros do sistema facilmente. Se você não tem interesse em reportar estes erros (o que muitas vezes não reflete em nada no funcionamento), basta remover o Apport:

```
$ sudo apt-get purge apport
```

[Voltar para Lista de Opções](../readme.md)