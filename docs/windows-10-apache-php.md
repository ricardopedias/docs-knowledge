[Voltar para Lista de Opções](../readme.md)

# Windows 10 - Apache + PHP + Banco de Dados

----------
## 1. Preparando o Terreno

Para organizar o ambiente, crie um diretório chamado C:\SERVER, onde serão instalados os softwares necessários para o ambiente do servidor. 

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

> Atenção: certifique-se de usar o caminho correto por número de versão. Caso contrário, o PHP não será iniciado.

### 2.2. Adicionando a versão padrão do PHP no escopo global do windows

Acesse o "Painel de Controle" do Windows e siga para "Sistema e Segurança" > "Sistema" (ou pressione o atalho WIN + BREAK no teclado). 
Clique em "Configurações Avançadas do Sistema" e em seguida, no botão "Variáveis de Ambiente". 
No topo da seção (“Variáveis de usuário para "xxxxx"), dê um duplo clique na variável "Path".

> Atenção: Dependendo da versão do windows, a forma de configurar será diferente. Em versões mais novas existirá um gerenciador de caminhos, em versões mais antigas existirá um campo texto, separando os caminhos por ";".

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

Por exemplo:

* mysql-8.0.15-winx64.zip (Windows (x86, 64-bit), ZIP Archive)

Extraia o conteúdo dentro do diretório C:\SERVER\MYSQL.

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

> O sufixo VCXX (por exemplo VC15) corresponde à versão do Visual C++ da Microsoft que precisa estar previamente instalada para que o Apache possa funcionar. Caso precise instalar o VCXX, baixe-o em http://www.microsoft.com/en-us/download/details.aspx?id=30679. Você será questionado sobre qual arquitetura baixar. Se o Windows for 64bits, baixe "VSU_4\vcredist_x64.exe", por exemplo.

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


Na Barra de Tarefas, digite a palavra "executar" no campo de buscas e abra o aplicativo "Executar", que será exibido no topo da lista. Esse caminho pode ser encurtado pressionando as teclas "Windows + R" no seu teclado.

No campo "Abrir", insira %AppData%\Microsoft\Windows\Start Menu\Programs\Startup e clique em "OK". Uma nova janela será aberta, no diretório "Start".

Clique com o botão direito do mouse sobre o plano de fundo do Windows Explorer e então descanse a seta sobre “Novo”. Em seguida, selecione a opção “Atalho”. Na caixa de diálogo que vai aparecer, selecione o local do programa (C:\SERVER\APACHE24\bin\ApacheMonitor.exe) e clique em “Avançar”.

Isso iniciará automaticamente o ícone do Apache Monitor da bandeja do windows.

> Para verificar se o Apache Monitor realmente vai ser iniciado junto com o sistema. Clique com botão direito do mouse sobre a Barra de Tarefas e vá em "Gerenciador de Tarefas". Selecione a aba "Inicializar". É aqui que você visualiza uma relação de todos os programas e aplicações que iniciam assim que você liga o seu Windows 10. Se quiser remover alguma ferramenta da lista, é só clicar em cima dela e depois em "Desabilitar".

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

Para criar um virtualhost que responda por uma determinada versão do PHP, é preciso fazer os seguintes passos:

#### 4.7.1. Adicionar entrada no hosts do Windows

Primeiro é preciso alterar o arquivo "hosts" do windows, que se encontra em "C:\Windows\System32\drivers\etc\hosts".
Neste arquivo, adicione os dominios desejados, apontando para o IP local do computador.

```
127.0.0.1 local.web www.local.web 
127.0.0.1 local56.web www.loca56.web
127.0.0.1 local70.web www.local70.web
```

#### 4.7.2. Adicionar o diretório no Apache

No diretório C:\SERVER\APACHE24\htdocs, crie os diretórios para os dominios acima, deixando a estrutura assim:

* C:\SERVER\APACHE24\htdocs\local
* C:\SERVER\APACHE24\htdocs\local56
* C:\SERVER\APACHE24\htdocs\local70

Dentro de cada diretório, crie um arquivo chamado index.php, contendo o seguinte conteúdo:

```
<?php phpinfo();
```

#### 4.7.3. Adicionar o virtualhost no Apache

Por fim, é necessário configurar os virtualhosts no apache.

Edite o arquivo C:\SERVER\APACHE24\conf\httpd.conf e altere a linha:

```
# Include conf/extra/httpd-vhosts.conf
```

para:

```
Include conf/extra/httpd-vhosts.conf
```

Em seguida, edite o arquivo C:\SERVER\APACHE24\conf\extra\httpd-vhosts.conf, adaptando-o e adicionando os virtualhost desejados:


```
# PHP padrão (local.web) - 7.3
<VirtualHost *:80>

    ServerAdmin webmaster@local.web
    ServerName local.web
    ServerAlias www.local.web
    DocumentRoot "C:/SERVER/APACHE24/htdocs/local"
    
    <Directory />
	AllowOverride All
    </Directory>
    
    <Directory C:/SERVER/APACHE24/htdocs/local>
	Options Indexes FollowSymLinks MultiViews
	AllowOverride all
	Require all granted
	
    </Directory>
    
    ErrorLog C:/SERVER/APACHE24/log/local.web-error.log
    LogLevel error
    CustomLog C:/SERVER/APACHE24/log/local.web-access.log combined

</VirtualHost>

# PHP 5.6 (local56.web)
<VirtualHost *:80>

    ServerAdmin webmaster@local56.web
    ServerName local56.web
    ServerAlias www.local56.web
    DocumentRoot "C:/SERVER/APACHE24/htdocs/local56"
    
    <Directory />
	AllowOverride All
    </Directory>
    
    <Directory C:/SERVER/APACHE24/htdocs/local56>
	Options Indexes FollowSymLinks MultiViews
	AllowOverride all
	Require all granted
	
	<Files ~ "\.php$"> 
	    AddHandler fcgid-script .php 
	    FcgidWrapper "C:/SERVER/PHP/5.6/php-cgi.exe" .php 
	    Options +ExecCGI 
	    order allow,deny 
	    allow from all 
	    deny from none 
	</Files> 
	
    </Directory>
    
    ErrorLog C:/SERVER/APACHE24/log/local56.web-error.log
    LogLevel error
    CustomLog C:/SERVER/APACHE24/log/local56.web-access.log combined

</VirtualHost>


# PHP 7.0 (local70.web)
<VirtualHost *:80>

    ServerAdmin webmaster@local70.web
    ServerName local70.web
    ServerAlias www.local70.web
    DocumentRoot "C:/SERVER/APACHE24/htdocs/local70"
    
    <Directory />
	AllowOverride All
    </Directory>
    
    <Directory C:/SERVER/APACHE24/htdocs/local70>
	Options Indexes FollowSymLinks MultiViews
	AllowOverride all
	Require all granted
	
	<Files ~ "\.php$"> 
	    AddHandler fcgid-script .php 
	    FcgidWrapper "C:/SERVER/PHP/7.0/php-cgi.exe" .php 
	    Options +ExecCGI 
	    order allow,deny 
	    allow from all 
	    deny from none 
	</Files> 
	
    </Directory>
    
    ErrorLog C:/SERVER/APACHE24/log/local70.web-error.log
    LogLevel error
    CustomLog C:/SERVER/APACHE24/log/local70.web-access.log combined

</VirtualHost>
```

Agora basta reiniciar o Apache e acessar os dominios:

* www.local.web (para usar o PHP 7.3 - padrão do sistema)
* www.loca56.web (para usar o PHP 5.6)
* www.local70.web (para usar o PHP 7.0)



[Voltar para Lista de Opções](../readme.md)
