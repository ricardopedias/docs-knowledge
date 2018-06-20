[Voltar para Lista de Opções](../readme.md)

# 1. Preparando o terreno

As versões distintas do php podem ser instaladas através de um repositório especial criado por [Ondrej Sury](https://github.com/oerdnj).
Para disponibilizá-lo para o sistema, basta executar o seguinte comando:

```
$ sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php; sudo apt update
```

Caso o comando "add-apt-repository" não esteja disponível, será preciso instalá-lo:

```
$ sudo apt-get install software-properties-common python-software-properties
```

# 2. Servidor HTTP 

### Apache2

```
$ sudo apt install apache2

```
# 3. As versões do PHP

Para instalar as versões 5.6, 7.0, 7.1 e 7.2 do PHP:

```
$ sudo apt-get install php5.6-fpm php5.6 php5.6-dev php5.6-cli php5.6-mbstring php5.6-mcrypt php5.6-gd php5.6-curl php5.6-xml php5.6-mysql php5.6-zip
$ sudo apt-get install php7.0-fpm php7.0 php7.0-dev php7.0-cli php7.0-mbstring php7.0-mcrypt php7.0-gd php7.0-curl php7.0-xml php7.0-mysql php7.0-zip
$ sudo apt-get install php7.1-fpm php7.1 php7.1-dev php7.1-cli php7.1-mbstring php7.1-mcrypt php7.1-gd php7.1-curl php7.1-xml php7.1-mysql php7.1-zip
$ sudo apt-get install php7.2-fpm php7.2 php7.2-dev php7.2-cli php7.2-mbstring php7.2-gd php7.2-curl php7.2-xml php7.2-mysql php7.2-zip
```
Nota: A partir do php 7.2, a extensão mcrypt foi removida. 
Para mains informações veja a [Notificação Oficial do PHP](https://wiki.php.net/rfc/mcrypt-viking-funeral)

# 4. Ativação dos módulos necessários

Alguns módulos do Apache precisam ser ativados:

```
$ sudo a2enmod rewrite actions proxy_fcgi setenvif; 
```

---------------------------------
# 5. Configurando o PHP padrão

Para setar a versão padrão do PHP a ser usada pelo servidor, use os seguintes comandos:

```
$ sudo a2enconf php5.6-fpm
```

ou

```
$ sudo a2enconf php7.0-fpm
```

ou 

```
$ sudo a2enconf php7.1-fpm
```

ou 

```
$ sudo a2enconf php7.2-fpm
```
Para aplicar a nova versão padrão, é necessário recarregar as configurações o Apache:

```
$ sudo service apache2 reload
```
ou

```
$ systemctl reload apache2
```

Para setar a versão padrão do PHP a ser usada pelo sistema, use os seguintes comandos:

```
$ sudo update-alternatives --set php /usr/bin/php5.6
```

ou

```
$ sudo update-alternatives --set php /usr/bin/php7.0
```

ou 

```
$ sudo update-alternatives --set php /usr/bin/php7.1
```

ou 

```
$ sudo update-alternatives --set php /usr/bin/php7.2
```

Para conferir a versão padrão do PHP em execução, basta criar um arquivo "info.php" na raiz do servidor e acessá-lo pelo navegador.

Nota: o comando abaixo deve ser executado como root, pois o ubuntu possui um sistema de segurança que impede a criação como usuário comum, mesmo sendo via sudo.

```
# echo '<?php phpinfo(); ?>' > /var/www/html/info.php
```
Agora basta entrar na url http://localhost/info.php.

---------------------------------
# 6. Ativar a versão do PHP via configuração do virtualhost

Dentro de um virtualhost, basta adicionar o handler do php. Lembrando de trocar
a notação "php7.2" pela versão desejada:

```
<VirtualHost *:80>

	...

	<FilesMatch ".+\.ph(ar|p|tml)$">
        SetHandler "proxy:unix:/run/php/php7.2-fpm.sock|fcgi://localhost"
	</FilesMatch>

</VirtualHost>
```

# 7. Reiniciando o Apache e o PHP

```
$ sudo service apache2 restart
```

Todas as vezes que for editada alguma diretiva no arquivo php.ini, será necessário reiniciar o serviço do php-fpm através de um dos comandos abaixo (de acordo com a versão em execução). 

```
$ sudo service php5.6-fpm restart # start|stop|status|restart|reload|force-reload
```

ou

```
$ sudo service php7.0-fpm restart # start|stop|status|restart|reload|force-reload
```

ou

```
$ sudo service php7.1-fpm restart # start|stop|status|restart|reload|force-reload
```

ou

```
$ sudo service php7.2-fpm restart # start|stop|status|restart|reload|force-reload
```

# 8. Servidor de Banco de Dados

```
$ sudo apt install mysql-server mysql-client
```

# 9. Gerenciadores de pacotes

### Composer (PHP)

```
$ sudo apt install composer
```
No Ubuntu 17.04, o sistema vem com o ipv6 habilitado, ocasionando uma falha no download de pacotes com o composer. Para verificar se isto esta acontecendo, basta usar o seguinte comando:

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


### Npm (Javascript e CSS)

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

# 10. Controle de Versão

### Git

```
$ sudo apt install git
```

# 11. Preparação do Ambiente para Desenvolver

### Configurando as permissões do servidor HTTP:

```
$ sudo adduser ricardo www-data
$ sudo chown ricardo:www-data -R /var/www
$ sudo chmod 755 -R /var/www
```

### Criando um VirtualHost (Método Manual)

Os VirtualHosts possibilitam desenvolver e servir um projeto como se estivesse na hospedagem, usando um domínio (como http://www.meuprojeto.dev.br). Para criar um VirtualHost, basta adicionar um arquivo com sua configuração no diretório "/etc/apache2/sites-available", onde o Apache verifica para disponibilizar.

Levando em conta que o projeto seja colocado no diretório "/var/www/meuprojeto", a configuração do 
VirtualHost deve ficar assim:

``` 
# /etc/apache2/sites-available/meuprojeto.conf

<VirtualHost *:80>
     ServerName www.meuprojeto.dev.br
     DocumentRoot /var/www/meuprojeto/public
     <Directory /var/www/meuprojeto/public>
         Options Indexes FollowSymLinks MultiViews
         AllowOverride all
         Order allow,deny
         allow from all
     </Directory>
</VirtualHost>
```

Para ativar a configuração no servidor, é preciso carregar o "meuprojeto.conf". Isso pode ser feito de duas formas:

```
# fazendo um link manualmente para o diretório "/etc/apache2/sites-enabled/"
$ sudo ln -s /etc/apache2/sites-available/meuprojeto.conf /etc/apache2/sites-enabled/
```

```
# usando o ativador de sites do apache
$ sudo a2ensite meuprojeto.conf
```
 
Por fim, para que o host "www.meuprojeto.dev.br" seja acessível no navegador é preciso adicioná-lo no arquivo "/etc/hosts":

```
127.0.0.1	localhost

127.0.0.1       meuprojeto.dev.br
127.0.0.1       www.meuprojeto.dev.br
```

Basta reiniciar o servidor e o host estará acessível.

```
$ sudo service apache2 restart
```

### Criando um VirtualHost (Método Automatizado)

Para criar VirtualHosts de forma automática, é preciso instalar um script no sistema. Para isso basta rodar o comando abaixo:

```
$ wget https://raw.githubusercontent.com/RoverWire/virtualhost/master/virtualhost.sh -O /tmp/virtualhost.sh; sudo chmod a+x /tmp/virtualhost.sh; sudo cp /tmp/virtualhost.sh /usr/local/bin/virtualhost; 
```

Para utilizar:

```
# Cria um novo VirtualHost
$ sudo virtualhost create www.meuprojeto.dev.br
```
O comando acima criará o VirtualHost apontando para o diretório /var/www/wwwmeuprojetodevbr. Para personalizar o diretório, basta especificá-lo no final do comando:

```
# Cria um novo VirtualHost com diretório personalizado:
$ sudo virtualhost create meuprojeto.dev.br meuprojeto
```

Usando o comando acima, o VirtualHost será criado e apontadoi para /var/www/meuprojeto.

```
# Deleta um VirtualHost
$ sudo virtualhost delete meuprojeto.dev.br
```

O comando acima remove o VirtualHost mas deixa o diretório /var/www/meuprojeto intocado.
Para remover também o diretório, especifique-o no final do comando:

```
# Deleta um VirtualHost e também o diretório
$ sudo virtualhost delete meuprojeto.dev.br meuprojeto
```


# 12. Ferramentas de programação

```
$ sudo apt install vim
```

### Sublimetext

Instala a chave pública para o repositório do SublimeText:

```
$ wget -qO - https://download.sublimetext.com/sublimehq-pub.gpg | sudo apt-key add -
```

Adiciona o repositório no sistema:

```
$ sudo apt-get install apt-transport-https
$ echo "deb https://download.sublimetext.com/ apt/stable/" | sudo tee /etc/apt/sources.list.d/sublime-text.list
```

Instala o SUblimeText:

```
$ sudo apt-get update
$ sudo apt-get install sublime-text
```

#### Dica sobre os comentários

Em notebooks, os atalhos para comentar o código (Ctrl + / e Ctrl + Shift + /) não funcionarão! Para comentar, será preciso adicionar atalhos alternativos. Faça isso acessando Preferences -> Key Bindings. Na tela de edição, adicione na tela da direita o seguinte trecho com os novos atalhos:

```
{ "keys": ["ctrl+7"], "command": "toggle_comment", "args": { "block": false } },
{ "keys": ["ctrl+shift+7"], "command": "toggle_comment", "args": { "block": true } }
```
Após salvar este arquivo, basta usar os novos atalhos (Ctrl + 7 e Ctrl + Shift + 7) para comentar seu código.


### MySQL Workbench

Para gerenciar bancos de dados MySQL.

```
$ sudo apt install mysql-workbench
```

### ReText

Leitor e editor de textos em MarkDown (readme.md, por exemplo). 
Dica: Para uma visualização melhor, acesse o menu "Editar" e ative a opção "Utilizar renderizador Webkit"

```
$ sudo apt install retext
```

[Diversos scripts para configuração do Ubuntu](https://github.com/erikdubois/Ultimate-Ubuntu-17.04)

[Voltar para Lista de Opções](../readme.md)