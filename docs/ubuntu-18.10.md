
[Voltar para Lista de Opções](../readme.md)

# Guia de Instalação para Ubuntu 18.10

----------
## 1. Preparação

A primeira ação a ser feita é atualizar todos os pacotes do sistema para permanecer com as últimas atualizações:


```
$ sudo apt update && sudo apt upgrade
```

----------
## 2. Multimidia

Drivers e fontes do Windows:

```
$ sudo apt-get install -y ubuntu-restricted-extras
```

Players de video:

```
$ sudo apt install -y vlc smplayer
```

Conversor de formatos:

```
$ sudo apt-add-repository ppa:teejee2008/ppa -y
$ sudo apt-get update 
$ sudo apt install -y selene
```

----------
## 3. Internet Navegadores

### Repositórios Adicionais

#### Google Chrome

```
$ sudo sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list'
$ wget -q -O - https://dl.google.com/linux/linux_signing_key.pub | sudo apt-key add -
```

#### Vivaldi

```
$ sudo sh -c 'echo "deb http://repo.vivaldi.com/archive/deb/ stable main" >> /etc/apt/sources.list.d/vivaldi.list'
$ wget -q -O - http://repo.vivaldi.com/archive/linux_signing_key.pub | sudo apt-key add -
```

#### Opera

```
$ sudo sh -c 'echo "deb https://deb.opera.com/opera-stable/ stable non-free" >> /etc/apt/sources.list.d/opera.list'
$ wget -q -O - https://deb.opera.com/archive.key | sudo apt-key add -

```


```
$ sudo apt update && sudo apt install -y google-chrome-stable chromium-browser vivaldi-stable opera-stable
```


----------
## 4. Outras Ferramentas para Desktop

### Dropbox

```
$ echo deb http://linux.dropbox.com/ubuntu xenial main | sudo tee /etc/apt/sources.list.d/dropbox.list
$ sudo apt-key adv --keyserver pgp.mit.edu --recv-keys 5044912E
$ sudo apt update && sudo apt install dropbox
```

----------
## 5. Aparência

### 5.1. Gnome Tweak Tool

```
$ sudo apt install -y gnome-tweak-tool
```

### 5.2. Extensoes do Gnome

Dentro do gnome tweak, acessar a aba Extensões e ativar:

* Ubuntu appindicators
* Ubuntu dock

### 5.3. Tema das Janelas (Opcional)

```
$ sudo apt install -y arc-theme
```

Para as aplicações derivadas do KDE ficarem com aparência mais bonita:

```
$ sudo apt install -y kde-runtime breeze
```

No Gnome Tweak Tool, acesse "Aparência" e na seção Temas > Aplicativos, ative o tema Arc.

### 5.4. Tema de ícones (Opcional)

Baixar o tema de icones em https://github.com/snwh/paper-icon-theme. Após extrair os arquivos, copie os diretórios 'Paper' e 'Paper-Mono-Dark' na pasta '.icons' na home do usuário.

No Gnome Tweak Tool, acesse "Aparência" e na seção Temas > Ícones, ative o tema Paper.

----------
# 6. Apport

O System Error Apport é um mecanismo que a Canonical instituiu nas últimas versões do Ubuntu para que os usuários possam reportar os erros do sistema facilmente. Se você não tem interesse em reportar estes erros (o que muitas vezes não reflete em nada no funcionamento), basta remover o Apport:

```
$ sudo apt-get remove -y --purge apport && apt-get autoremove
```

Veja também: [Ubuntu 18.10 para Desenvolvedor Web](ubuntu-18.10-devel.md)



[Voltar para Lista de Opções](../readme.md)
