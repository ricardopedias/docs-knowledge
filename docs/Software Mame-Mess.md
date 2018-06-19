# Software Mame/Mess

As versões mais recentes do Mame incluem o código do Mess em seu interior. Portanto, o Mame agora é responsável pela emulação, além das máquinas de Arcade, também pelos consoles domésticos como Super Nintendo, Mega Drive, etc.

## 1. Instalação

Para instalar o mame no Ubuntu, basta executar no terminal:

```
$ sudo apt install mame mame-data
```

## 2. Execução Inicial

O Mame possui uma interface gráfica que é chamada ao digitar no terminal:

```
$ mame
```

## 3. Configuração

A primeira coisa a se fazer é configurar os diretórios para que o Mame consiga encontrar as ROMS, ou seja, os jogos (arquivos .zip). Isso pode ser feito de duas formas:

## 3.1. Maneira Tradicional

Ao executar o Mame pela primeira vez, um diretório oculto chamado **.mame** será criado na pasta do usuário (/home/usuario/.mame). Neste diretório se encontram os arquivos de configuração.

Abra o arquivo mame.ini e encontre a linha com a opção **"rompath"**. Será algo parecido com o exemplo abaixo:

```
rompath  "$HOME/mame/roms;/usr/local/share/games/mame/roms;/usr/share/games/mame/roms;"
```
Note que os caminhos são separados por vírgulas. Basta adicionar aqui os diretórios onde se encontram seus jogos e o mame os encontrará, exibindo-os na lista da interface gráfica.

### 3.2. Maneira Visual

Nas versões mais novas é possível configurar o Mame diretamente da interface gráfica, bastando acessar o menu **Configure Options > Configure Diretories > ROMS**. Nesta tela aparecerá uma lista com os diretórios padrões que o mame buscará por jogos. Acessando a opção **Add Folder**, é possível adicionar novos diretórios.

### 3.3. Bios

Para que os jogos (ROMS) possam ser interpretados, o emulador precisa primeiro carregar o sistema (BIOS) que interpretará o jogo. Existem várias bios disponiveis (arquivos .zip) e cada uma possui o nome do sistema que será executado: 

* Arcade: neogeo.zip, decocass.zip, naomi.zip, etc
* Consoles: 3do.zip, snes.zip, n64.zip, etc

Juntamente com os diretórios de ROMS (como explicado acima) deverão ser colocados os diretórios onde se encontram as BIOS para as máquinas e consoles e o Mame estará pronto para ser utilizado.

## 4. Execução dos Jogos

### 4.1. Arcade

Para executar um jogo de Arcade (como Mortal Kombat ou Street Fighter II), basta executar o Mame no terminal e escolher o jogo através da interface visual.

### 4.2. Consoles Caseiros

Para executar um jogo de console (como Super Mário, TopGear ou Sonic), através da interface visual é preciso primeiro selecionar o console, digitando por exemplo "Super Nintendo Entertainment...". Após selecionar o console, basta selecionar o jogo desejado.

Lembrando que o jogo tem que estar disponível na configuração de diretórios, como mostrado anteriormente.

### 4.3. Consoles Caseiros via Terminal

Para executar diretamente pelo terminal, basta usar os comandos abaixo:

#### Nintendinho

```
$ mame nes -cart /caminho/para/o/jogo.nes
```

#### Super Nintendo

```
$ mame snes -cart /caminho/para/o/jogo.zip
```

#### Mega Drive

```
$ mame megadriv -cart /caminho/para/o/jogo.zip
```

#### Gamegear

```
$ mame gamegear -cart /caminho/para/o/jogo.zip
```

#### Gameboy

```
$ mame gameboy -cart /caminho/para/o/jogo.zip
```


#### Gameboy Color

```
$ mame gbcolor -cart /caminho/para/o/jogo.zip
```

#### Gameboy Advanced

```
$ mame gba -cart /caminho/para/o/jogo.zip
```

#### Atari 2600

```
$ mame a2600 -cart /caminho/para/o/jogo.zip
```

#### Atari 5200

```
$ mame a5200 -cart /caminho/para/o/jogo.zip
```