[Voltar para Lista de Opções](../readme.md)

# Windows - Apache + PHP + Banco de Dados

----------
## 1. Preparando o Terreno

Para organizar o ambiente, cre o diretório chamado C:\SERVER, onde serão instalados os softwares necessários para o ambiente do servidor. 

----------
## 2. As versões do PHP

### 2.1. Instalando múltiplas versões do PHP

Crie um novo diretório chamado C:\SERVER\PHP. Efetue o download das "últimas" versões desejadas do PHP em http://windows.php.net/download/. Escolha apenas versões "Non Thread Safe". 

Por exemplo:

* php-5.6.40-nts-Win32-VC11-x64
* php-7.0.33-nts-Win32-VC14-x64
* php-7.1.27-nts-Win32-VC14-x64
* php-7.2.16-nts-Win32-VC15-x64
* php-7.3.3-nts-Win32-VC15-x64

Extraia todas as versões do PHP dentro do diretório C:\SERVER\PHP, nomeando os subdiretórios de acordo com a versão, por exemplo, C:\SERVER\PHP\5.6 para a última versão do PHP 5.6, C:\SERVER\PHP\7.3 para a última versão do PHP 7.3, e assim por diante.

Dentro do diretório de cada versão do PHP, copie php.ini-development para php.ini e edite para corresponder às suas preferências. Há uma mudança importante que é obrigatória, como mostra o exemplo a seguir.

Supondo que o php.ini seja do PHP 5.6, encontre a linha:

```
; extension_dir = "ext"
```

e mude para:

```
extension_dir = "C:\SERVER\PHP\5.6\ext"
```

>> Atenção: certifique-se de usar o caminho correto por número de versão. Caso contrário, o PHP não será iniciado.

### 2.2. Adicionando a versão padrão do PHP no escopo global do windows

Acesse o "Painel de Controle" do Windows e siga para "Sistema e Segurança" > "Sistema" (ou pressione o atalho WIN + BREAK no teclado). 
Clique em "Configurações Avançadas do Sistema" e em seguida, no botão "Variáveis de Ambiente". 
No topo da seção (“Variáveis de usuário para "xxxxx"), dê um duplo clique na variável "Path".

>> Atenção: Dependendo da versão do windows, a forma de configurar será diferente. Em versões mais novas existirá um gerenciador de caminhos, em versões mais antigas existirá um campo texto, separando os caminhos por ";".

Nesta tela, adicione o caminho completo para a versão desejada do PHP, para torná-la disponivel no prompt de comando do windows:

Para adicionar o PHP 7.3:

```
C:\SERVER\PHP\7.3
```

Caso esteja usando o modo texto, adicione cada versão no final do valor, prefixando o seperador ";":

```
;C:\SERVER\PHP\7.3
```

----------
## 3. Servidor de Banco de Dados

### 3.1. Instalando o MySQL

Crie um novo diretório chamado C:\SERVER\MYSQL. Efetue o download da versão "comunidade" do mysql em https://dev.mysql.com/downloads/mysql/. Baixe a versão ZIP.

Po exemplo:

* mysql-8.0.15-winx64.zip (Windows (x86, 64-bit), ZIP Archive)

Extraia o conteudo dentro do diretório C:\SERVER\MYSQL.

### 3.2. Adicionando o MySQL no escopo global do windows

Acesse o "Painel de Controle" do Windows e siga para "Sistema e Segurança" > "Sistema" (ou pressione o atalho WIN + BREAK no teclado). 
Clique em "Configurações Avançadas do Sistema" e em seguida, no botão "Variáveis de Ambiente". 
No topo da seção (“Variáveis de usuário para "xxxxx"), dê um duplo clique na variável "Path".

Nesta tela, adicione o caminho completo para o diretório "bin" do mysql:

Por exemplo:

```
C:\SERVER\MYSQL\bin
```

----------
## 4. Servidor HTTP 

### 4.1. Instalando o Apache

Crie um novo diretório chamado C:\SERVER\APACHE24. Efetue o download da última versão do Apache no site https://www.apachelounge.com/download. Certifique-se de baixar os binários VCXX.

Por exemplo:

* httpd-2.4.38-win64-VC15.zip   

>> O sufixo VCXX (por exemplo VC15) corresponde à versão do Visual C++ da Microsoft que precisa estar previamente instalada para que o Apache possa funcionar. Caso precise instalar o VCXX, baixe-o em http://www.microsoft.com/en-us/download/details.aspx?id=30679. Você será questionado sobre qual arquitetura baixar. Se o Windows for 64bits, baixe "VSU_4\vcredist_x64.exe", por exemplo.

Extraia o pacote httpd-x.x.xx e copie o seu conteudo do subdiretório Apache24 para C:\SERVER\APACHE24.

Edite o arquivo C:\SERVER\APACHE24\conf\httpd.conf e altere a linha:

```
Define SRVROOT "c:/Apache24"
```

para:

```
Define SRVROOT "C:\SERVER\APACHE24"
```

### 4.2. Adicionando o Apache no escopo global do windows

Acesse o "Painel de Controle" do Windows e siga para "Sistema e Segurança" > "Sistema" (ou pressione o atalho WIN + BREAK no teclado). 
Clique em "Configurações Avançadas do Sistema" e em seguida, no botão "Variáveis de Ambiente". 
No topo da seção (“Variáveis de usuário para "xxxxx"), dê um duplo clique na variável "Path".

Nesta tela, adicione o caminho completo para os binários do Apache:

```
C:\SERVER\APACHE24\bin
```

### 4.3. Adicionando o Apache como um serviço do Windows

Pressione a tecla "Windows" e digite "cmd". Dê um clique direito sobre "Prompt de comando" e escolha "Executar como administrador". Isso abre um prompt de comando "root". 

Digite o seguinte comando para adicionar o apache como serviço operável do sistema:

```
httpd -k install
```

Para remover o serviço do sistema:

```
httpd -k uninstall
```

### 4.4. Gerenciando o Apache em modo texto

Uma vez que o apache é um serviço do sistema, basta usar um dos comandos para gerenciá-lo:

Iniciar o Apache:

```
httpd -k start
```

Parar o Apache:

```
httpd -k stop
```

Reiniciar o Apache:

```
httpd -k restart
```

### 4.4. Gerenciando o Apache em modo visual

Basta executar o programa C:\SERVER\APACHE24\bin\ApacheMonitor.exe. Após executá-lo, o monitor aparecerá na bandeja do windows, permitindo iniciar e parar o Apache facilmente.

### 4.5. Autostart Apache Monitor na inicialização

Abra uma janela do Windows Explorer no diretório C:\SERVER\APACHE24\bin e uma segunda janela no diretório C:\Users\SeuNomeDeUsuario\AppData\Roaming\Microsoft\Windows\Menu Iniciar\Programas\Startup.

>> Obviamente, SeuNomeDeUsuario é o seu nome de usuário no Windows.

Mantendo pressionada a tecla ALT, arraste o ApacheMonitor da primeira janela para a segunda.

Isso iniciará automaticamente o ícone do Apache Monitor da bandeja do windows.

### 4.6. Instalando o modulo FastCGI

Para o PHP funcionar no servidor com multiplas versões simultâneas, é necessário instalar o módulo do Apache chamado FastCGI (conhecido no Linux como PHP FPM). Baixe o módulo do apache em  https://www.apachelounge.com/download:

Por exemplo: 

* mod_fcgid-2.3.9-win64-VC15.zip 

Extraia o pacote ZIP e copie o arquivo "mod_fcgid.so" para o diretório C:\SERVER\APACHE24\modules.

Edite o arquivo C:\SERVER\APACHE24\conf\httpd.conf e altere as seguintes linhas, removendo o # na frente delas:

de:

```
# LoadModule include_module modules/mod_include.so
# LoadModule vhost_alias_module modules/mod_vhost_alias.so
```

para:

```
LoadModule include_module modules/mod_include.so
LoadModule vhost_alias_module modules/mod_vhost_alias.so
```

Na seção de módulos, adicione no final da lista a invocação do módulo Fast CGI:

```
LoadModule fcgid_module modules/mod_fcgid.so
```

### 4.6. Definindo a versão padrão do PHP

Ainda no arquivo C:\SERVER\APACHE24\conf\httpd.conf, remova o comentario da seguinte linha:

de:

```
# Include conf/extra/httpd-default.conf
```

para

```
Include conf/extra/httpd-default.conf
```

Em seguida, para adicionar o PHP 7.3 como PHP padrão do sistema, edite o arquivo C:\SERVER\APACHE24\conf\extra\httpd-default.conf e adicione as seguintes linhas no final:

```
FcgidInitialEnv PATH "C:/SERVER/PHP/7.3;C:/WINDOWS/system32;C:/WINDOWS;C:/WINDOWS/System32/Wbem;"
FcgidInitialEnv SystemRoot "C:/Windows"
FcgidInitialEnv SystemDrive "C:"
FcgidInitialEnv TEMP "C:/WINDOWS/Temp"
FcgidInitialEnv TMP "C:/WINDOWS/Temp"
FcgidInitialEnv windir "C:/WINDOWS"
FcgidIOTimeout 64
FcgidConnectTimeout 16
FcgidMaxRequestsPerProcess 1000
FcgidMaxProcesses 50
FcgidMaxRequestLen 8131072
# Location of php.ini
FcgidInitialEnv PHPRC "C:/SERVER/PHP/7.3"
FcgidInitialEnv PHP_FCGI_MAX_REQUESTS 1000
<Files ~ "\.php$">
  AddHandler fcgid-script .php
  FcgidWrapper "C:/SERVER/PHP/7.3/php-cgi.exe" .php
  Options +ExecCGI
  order allow,deny
  allow from all
  deny from none
</Files>
```

Você pode colocar qualquer versão como padrão, bastando alterar as chamadas a "C:/SERVER/PHP/7.3" para o caminho da versão desejada.

### 4.7. Usando uma versão do PHP via virtualhost





----------
## 3. Configurando o Apache


### 3.1. Ativando módulos

Alguns módulos do Apache precisam ser ativados:

```
$ sudo a2enmod proxy_fcgi setenvif rewrite actions
```

### 3.2. Recarregando configurações do Apache

Sempre que alguma configuração do Apache for editada, será necessário recarregar as novas configurações no serviço em execução. Isso pode ser feito através do comando service :

```
$ sudo service apache2 restart
```

As opções disponiveis são start|stop|graceful-stop|restart|reload|force-reload

----------
## 4. Configurando o PHP


### 4.1. Determinando o PHP padrão do servidor HTTP

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

Para conferir a versão padrão do PHP em execução, basta criar um arquivo "info.php" na raiz do servidor e acessá-lo pelo navegador.

Nota: o comando abaixo deve ser executado como root, pois o ubuntu possui um sistema de segurança que impede a criação como usuário comum, mesmo sendo via sudo.

```
# echo '<?php phpinfo(); ?>' > /var/www/html/info.php
```
Agora basta entrar na url http://localhost/info.php.


### 4.2. Determinando a versão do PHP de um virtualhost

Dentro de um virtualhost, basta adicionar o handler do php. Lembrando de trocar
a notação "php7.2" pela versão desejada (php5.6, php7.1, etc...):

```
<VirtualHost *:80>

	...

	<FilesMatch ".+\.ph(ar|p|tml)$">
        SetHandler "proxy:unix:/run/php/php7.2-fpm.sock|fcgi://localhost"
	</FilesMatch>

</VirtualHost>
```


### 4.3. Determinando o PHP padrão do sistema (cli)

Para setar a versão padrão do PHP a ser usada pelo sistema, ou seja, pelos scripts executados via terminal, use os seguintes comandos:

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

### 4.4. Recarregando configurações do PHP


Assim como o servidor Apache, sempre que alguma configuração do PHP for editada, como por exemplo alguma diretiva no arquivo php.ini, será necessário recarregar as novas configurações no serviço em execução. Isso pode ser feito através do comando service:

```
$ sudo service php5.6-fpm restart
```

ou

```
$ sudo service php7.0-fpm restart
```

ou

```
$ sudo service php7.1-fpm restart
```

ou

```
$ sudo service php7.2-fpm restart
```

As opções disponiveis são start|stop|status|restart|reload|force-reload.


----------
## 5. Preparação do Ambiente para Desenvolver

### 5.1. Configurando as permissões do servidor HTTP

O diretório /var/www deve ser liberado para o usuário que vai desenvolver.
Nos comandos abaixo, troque o "ricardo" pelo seu nome de usuário do ubuntu:

```
$ sudo adduser ricardo www-data
$ sudo chown ricardo:www-data -R /var/www
$ sudo chmod 755 -R /var/www
```

### 5.2. Criando um VirtualHost (Método Manual)

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

### 5.3. Criando um VirtualHost (Método Automatizado)

Para criar VirtualHosts de forma automática, é preciso instalar um script no sistema. Para isso basta rodar o comando abaixo:

```
$ wget https://raw.githubusercontent.com/rpdesignerfly/virtualhost/master/virtualhost.sh -O /tmp/virtualhost.sh; sudo chmod a+x /tmp/virtualhost.sh; sudo cp /tmp/virtualhost.sh /usr/local/bin/virtualhost; 
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

[Voltar para Lista de Opções](../readme.md)
