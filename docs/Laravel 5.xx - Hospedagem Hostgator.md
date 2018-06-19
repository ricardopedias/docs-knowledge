[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)

# Laravel 5.xx - Hostgator

## 1. Acesso SSH

### Usando um par de chaves pública e privada 

Estas chaves são apenas dois fragmentos de texto que contém uma combinação de caracteres em par, utilizada para descriptografar dados. O funcionamento é parecido com o de uma fechadura: somente quem possui a chave certa consegue abrir a fechadura correspondente.

A chave pública deve ser armazenada no servidor e a chave privada no computador do usuário. A chave privada não deve ser compartilhada com ninguém. Ao solicitar acesso a um servidor, ele fará um teste de criptografia usando as duas chaves. Se o resultado do teste for positivo, ou seja, se a mensagem for descriptografada com o uso das duas chaves, você poderá acessar o servidor sem precisar de um login e senha. Este método é mais seguro do que o primeiro, porque somente você possui a chave privada. Outro detalhe interessante é que a sua chave pública pode ser inserida em outros servidores. Assim, você poderá acessar diversos servidores sem precisar gerar uma nova chave. Basta, para isso, que a sua chave pública seja inserida no servidor que você deseja acessar.

### Gerando um par de chaves pública e privada 

Você pode gerar as chaves SSH de diversas maneiras. Um método é usar o comando `ssh-keygen` diretamente no terminal. Ao digitar este comando, você será questionado sobre o nome do arquivo que deseja inserir em sua chave privada. Geralmente o nome é id_rsa e ele será salvo automaticamente em um diretório oculto, de nome .ssh, localizado na raiz do diretório do usuário. Você pode apenas teclar “Enter” para manter esta configuração padrão.

Você também será questionado se deseja criar uma senha de criptografia para sua chave privada. Assim, mesmo que alguém consiga roubá-la de seu computador, ela não terá utilidade, pois precisará de uma senha para uso. Se não desejar deixar sua chave privada sem senha, basta deixar em branco e teclar “Enter”. O terminal então vai gerar o par de chaves e mostrar na tela sua localização. Uma imagem randômica também será exibida. Essa imagem é uma representação gráfica do padrão aleatório que gerou a sua chave. Em teoria, ela serve para oferecer a possbilidade de comparação visual de sua chave. Na prática você pode ignorar isso. 

### Inserindo a chave pública no servidor 

Depois de gerar o par de chaves, você precisa inserir sua chave pública no servidor. A hospedagem da Hostgator usa o painel de controle cPanel, onde há uma área para gerenciamento de chaves SSH. Para importar sua chave via cPanel, acesse o painel e localize a área para gerenciamento do SSH, em seguida, escolha a opção “Gerenciar chaves do SSH”.

Na tela de gerenciamento, clique na opção “Importar chave”. Na tela seguinte, preencha o campo nome usando o padrão, que é id_rsa. Em seguida, abra o arquivo id_rsa.pub, que está salvo em seu computador, na pasta ~/.ssh/id_rsa.pub. Use o bloco de notas ou um editor de códigos para abrir este arquivo. Copie o conteúdo do arquivo no campo “chave pública”. Você pode deixar o campo chave privada e o campo senha em branco. Ao final, conclua a importação da chave.

### Solicitar acesso SSH

Por padrão, as contas da Hostgator possuem o acesso SSH desabilitado. Para continuar, será preciso solicitar a liberação do acesso SSH (JailShell). Para isso existem três formas:

* Atendimento on-line ( https://www.hostgator.com.br/chat ) 
* Atendimento email ( suporte@hostgator.com.br ) 
* Formulário ( https://www.hostgato...mulario-ssh.php )

Após a liberação, você poderá realizar o próximo acesso SSH sem ter que digitar a senha no terminal.

```
$ ssh -p 2222 login_hostgator@meusite.com.br
```

## 2. Versão do PHP

Com acesso SSH liberado e conectado, vamos verificar a versão default do PHP no servidor da seguinte forma:

```
# php -v
PHP 5.6.14 (cli) (built: Dec  5 2015 12:18:14) 
Copyright (c) 1997-2015 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2015 Zend Technologies
    with the ionCube PHP Loader (enabled) + Intrusion Protection from ioncube24.com (unconfigured) v5.0.12, Copyright (c) 2002-2015, by ionCube Ltd.
    with Zend Guard Loader v3.3, Copyright (c) 1998-2014, by Zend Technologies
```
Se a versão do PHP <= 5.6, edite seu arquivo .bashrc que fica localizado em /home/seu_usuario/.bashrc e insira as linhas abaixo. Se o arquivo não existir, crie-o:

```
# .bashrc

# Source global definitions
if [ -f /etc/bashrc ]; then
        . /etc/bashrc
fi

# User specific aliases and functions
alias php='/opt/php56/bin/php'
export PATH="/opt/php56/bin:$PATH"
```

Descubra qual o diretório atual:

```
# pwd
/home/seu_usuario
```

Carregue a nova configuração realizada com o comando source:

```
# source /home/seu_usuario/.bashrc
```

Verifique se o alias foi carregado como mostrado abaixo:

```
# alias | egrep 'php'
alias php='/opt/php56/bin/php'
```

Verifique se o caminho '/opt/php56/bin' esta sendo exibido na variável PATH como mostrado abaixo:

```
echo $PATH | egrep '/opt/php56/bin'
/opt/php56/bin:/home/seudominio/perl5/bin:/usr/local/jdk/bin:/opt/php56/bin:/home/seudominio/perl5/bin:/usr/local/jdk/bin:/home/seudominio/perl5/bin:/usr/local/jdk/bin:/home/seudominio/perl5/bin:/usr/local/jdk/bin:/home/seudominio/perl5/bin:/usr/local/jdk/bin:/usr/local/jdk/bin:/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin:/usr/X11R6/bin:/opt/python27/bin:/usr/local/bin:/usr/X11R6/bin:/root/bin:/usr/local/bin:/usr/X11R6/bin:/usr/local/bin:/usr/X11R6/bin:/usr/local/bin:/usr/X11R6/bin:/usr/local/bin:/usr/X11R6/bin:/usr/local/bin:/usr/X11R6/bin
```

A versão do PHP deve ser sido atualizada agora:

```
# php -v
PHP 5.6.30 (cli) (built: Mar 27 2017 11:42:52) 
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies
    with the ionCube PHP Loader (enabled) + Intrusion Protection from ioncube24.com (unconfigured) v6.0.5, Copyright (c) 2002-2016, by ionCube Ltd.
    with Zend Guard Loader v3.3, Copyright (c) 1998-2014, by Zend Technologies
```

## 3. Instalação do composer

Para instalar o composer, basta usar o comando abaixo (O diretório de destino tem que existir):

```
curl -sS https://getcomposer.org/installer | php -- --install-dir=/home/seu_usuario/bin
All settings correct for using Composer
Downloading...

Composer successfully installed to: /home/seu_usuario/bin/composer.phar
Use it: php /home/seu_usuario/php/composer.phar
```

Para verificar se o composer está funcionando:

```
php /home/seu_usuario/bin/composer.phar 
```

Para facilitar a utilização do composer, podemos criar um alias para ele, editando o arquivo /home/seu_usuario/.bashrc e inserindo as linhas abaixo:

```
alias composer='/home/seu_usuario/bin/composer.phar'
```

Carregue a nova configuração realizada com o comando source:

```
# source /home/seu_usuario/.bashrc
```

Confirme se o alias foi carregado corretamente :

```
# alias | egrep composer
alias composer='/home/seu_usuario/bin/composer.phar'
```

## 4. Instalação do Laravel

Para criar uma instalação limpa do Laravel execute:

```
# composer create-project laravel/laravel --prefer-dist /home/seu_usuario/public_html
```

## 5. Versão do PHP

### Ativando os arquivos PHP 5.6

Com o seu projeto laravel criado, é preciso criar um arquivo chamado '.htaccess' no diretório da instalação do laravel com o parâmetro que ativa o php 5.6 para todos os arquivos contidos neste diretório:

```
# Ativa PHP 5.6 para Laravel
AddHandler application/x-httpd-php56 .php
```

### Ativando os arquivos PHP 7.0

# Habilitar o PHP 7.0
AddHandler application/x-httpd-php70 .php
<IfModule mod_suphp.c>
suPHP_ConfigPath /opt/php70/lib
</IfModule>

## 6. Configurando o diretório 'public' do laravel

Para configurar a pasta public (raiz do laravel) é preciso adicionar ao arquivo .htaccess:

```
Options +FollowSymlinks
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]
```

Neste ponto a aplicação já deve estar funcionando, ai é só tratar os possíveis erros como por exemplo conexão com banco de dados caso eles aconteçam.

[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)