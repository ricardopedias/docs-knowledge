[Voltar para Lista de Opções](../readme.md)

# Ubuntu 18.10 para Desenvolvedor Web

----------
## 1. Gerenciadores de pacotes

### 1.1. Composer (PHP)

```
$ sudo apt install -y composer
```

Pra verificar se tudo está funcionando:

```
$ sudo composer diagnose
```
Se o seguinte resultado aparecer, indicando que o composer não consegue se conectar com o servidor do packagist, será necessário desativar o IPV6:

```
Checking platform settings: OK
Checking git settings: OK
Checking http connectivity to packagist: WARNING
[Composer\Downloader\TransportException] The "http://packagist.org/packages.json" file could not be downloaded: failed to open stream: Connection timed out
Checking https connectivity to packagist: WARNING
[Composer\Downloader\TransportException] The "https://packagist.org/packages.json" file could not be downloaded: failed to open stream: Connection timed out
Checking github.com rate limit: OK
Checking disk free space: OK
```
Para desativar o ipv6, use o seguinte comando:

```
$ echo "net.ipv6.conf.all.disable_ipv6 = 1
net.ipv6.conf.default.disable_ipv6 = 1
net.ipv6.conf.lo.disable_ipv6 = 1" | sudo tee /etc/sysctl.d/99-my-disable-ipv6.conf

```
Isso irá criar o arquivo '99-my-disable-ipv6.conf', que será carregado pelo 'sysctl' e desativará o ipv6. Para aplicar as mudanças no kernel e efetivar a configuração, é preciso reiniciar os processos:

```
$ sudo service procps reload
```


### 1.2. Npm (Javascript e CSS)

Para instalar a última versão do node no Ubuntu, é preciso usar um repositório PPA. 
Para isso será preciso instalar o "curl", que fará as requições ao repositório:

```
$ sudo apt install curl
```

Abaixo o comando para instalar a versão 9:

```
$ sudo curl -sL https://deb.nodesource.com/setup_9.x | sudo -E bash -
$ sudo apt install nodejs
```

Rodando o comando acima, o repositório será automaticamente configurado e disponibilizado no sistema.

Caso já exista uma versão do "node" pré-instalada no sistema, é preciso remover esta versão antes de instalar a nova. Para verificar se existe uma versão instalada:

```
$ node -v
$ npm -v
```

Para remover e limpar todas a configurações antigas:

```
$ sudo apt purge nodejs npm
```
Em seguida, basta instalar o novo node:

```
$ sudo apt install nodejs
$ node -v
$ npm -v
```

----------
## 2. Controle de Versão

### Git

```
$ sudo apt install git
```

----------
## 3. Ferramentas de programação

### 3.1. Vim

O Vim é um poderoso editor para terminal, capaz de abrir arquivos imensos que outros editpres não conseguem:

```
$ sudo apt install vim
```

### 3.2. MySQL Workbench

Para gerenciar bancos MySQL, nada como um gerenciador desenvolvido pela própria equipe do famoso Banco de Dados.

```
$ sudo apt install mysql-workbench
```

### 3.3. ReText

Leitor e editor de textos em MarkDown (readme.md, por exemplo). 
Dica: Para uma visualização melhor, acesse o menu "Editar" e ative a opção "Utilizar renderizador Webkit"

```
$ sudo apt install retext
```
### 3.4. Atom

O editor Atom, desenvolvido pela equipe do github.com é uma ótima opção para desenvolvimento:

```
$ sudo wget -q -O - https://packagecloud.io/AtomEditor/atom/gpgkey | sudo apt-key add -;
$ sudo sh -c 'echo "deb [arch=amd64] https://packagecloud.io/AtomEditor/atom/any/ any main" > /etc/apt/sources.list.d/atom.list';
$ sudo apt-get update && sudo apt-get install -y atom;
```

[Veja configurações e mais informações sobre o Atom](softwares-atom.md)


[Diversos scripts para configuração do Ubuntu](https://github.com/erikdubois/Ultimate-Ubuntu-17.04)

[Voltar para Lista de Opções](../readme.md)
