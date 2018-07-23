[Voltar para Lista de Opções](../readme.md)

# Ubuntu 18.04 - Tomcat + Java + Banco de Dados

----------
## 1. As versões do Tomcat

Cada versão do Tomcat dá suporte a novas versões do Java. Observe na tabela abaixo:


Tomcat | Java
-------|----------
9.x.x  | 8 e anteriores
8.x.x  | 7 e anteriores
7.x.x  | 6 e anteriores

Portanto, instalar sempre a última versão disponível já resolve o problema.


----------
## 2. JDK e Banco de Dados


```
$ sudo apt install -y openjdk-8-jdk  mysql-client mysql-server
```

Caso já existam outras versões do java, você pode determinar a padrão com o seguinte comando:

```
sudo update-alternatives --config java
```

Na lista de versões disponíveis, digite o número correto e pressione enter.


----------
## 3. Instalando o Tomcat

### 3.1. Preparando o terreno

Antes de instalá-lo, é preciso criar o usuário do tomcat e dizer qual será o seu diretório:

```
$ sudo mkdir /opt/tomcat
$ sudo useradd -m -U -d /opt/tomcat -s /bin/false tomcat
```

Em seguida, instalar umas ferramentas importantes, caso não estejam instaladas ainda:

```
$ sudo apt install unzip wget
```

### 3.2. Instalando a última versão do Tomcat

Até o momento, a última versão do Tomcat é a 9.
A página do Tomcat9 pode ser encontrada em [https://tomcat.apache.org/download-90.cgi](https://tomcat.apache.org/download-90.cgi)


Entre no diretório /tmp (onde os arquivos são limpos pelo sistema periodicamente) e baixe a última versão do tomcat:

```
$ cd /tmp
$ wget http://www-us.apache.org/dist/tomcat/tomcat-9/v9.0.10/bin/apache-tomcat-9.0.10.zip
```

Em seguida, descompacte o conteudo e mova-o para o diretório do tomcat, criado na etapa anterior:

```
$ unzip apache-tomcat-*.zip
$ sudo mv apache-tomcat-*/ /opt/tomcat/
```

Para ter um controle maior sobre as versões e possiveis atualizações, crie o link simbólico `latest` apontando para o diretório de instalação do tomcat:


```
$ sudo ln -s /opt/tomcat/apache-tomcat-* /opt/tomcat/latest
```

Dessa forma, quando você fizer uma atualização na sua instalação do tomcat, basta descompactar a nova versão e apontar o link simbolico para a nova versão.

Para que o usuário do tomcat (que criamos na etapa anterior) possa acessar este diretório, é preciso dar as devidas permissões para o usuário e o grupo, e também tornar executáveis todos os scripts no diretório `bin`:

```
$ sudo chown -R tomcat: /opt/tomcat
$ sudo chmod +x /opt/tomcat/latest/bin/*.sh
```

## 4. Adicionando o Tomcat no systemd


Para rodar o Tomcat como um serviço, é preciso criar o novo arquivo `/etc/systemd/system/tomcat.service` com o seguinte conteúdo:


```
[Unit]
Description=Tomcat 8.5 servlet container
After=network.target

[Service]
Type=forking

User=tomcat
Group=tomcat

Environment="JAVA_HOME=/usr/lib/jvm/default-java"
Environment="JAVA_OPTS=-Djava.security.egd=file:///dev/urandom"

Environment="CATALINA_BASE=/opt/tomcat/latest"
Environment="CATALINA_HOME=/opt/tomcat/latest"
Environment="CATALINA_PID=/opt/tomcat/latest/temp/tomcat.pid"
Environment="CATALINA_OPTS=-Xms512M -Xmx1024M -server -XX:+UseParallelGC"

ExecStart=/opt/tomcat/latest/bin/startup.sh
ExecStop=/opt/tomcat/latest/bin/shutdown.sh

[Install]
WantedBy=multi-user.target
```

Em seguida, podemos notificar o `systemd` que o novo arquivo foi criado e iniciar o tomcat:


```
$ sudo systemctl daemon-reload
$ sudo systemctl start tomcat
```

Para checar o status do tomcat, basta executar o seguinte comando:

```
$ sudo systemctl status tomcat
```

Para que o tomcat seja executado automaticamente no boot da máquina, use o seguinte comando:

```
$ sudo systemctl enable tomcat
```


## 5. Ajustando o firewall

Se o firewall estiver em execução, e for necessário liberar acesso ao tomcat de fora da sua rede interna, será necessário abrir a porta 8080.

Para liberar o tráfego para a porta 8080, use o seguinte comando:

```
sudo ufw allow 8080/tcp
```

Ao executar um aplicativo Tomcat em um ambiente de produção, é mais provável que você precise carregar um balanceador ou um proxy reverso, pois é uma boa prática restringir o acesso à porta 8080 somente à sua rede interna.


## 6. Interface Web do Tomcat

### 6.1. Criando os usuários para acessar a interface web

Agora que o Tomcat está devidamente instalado no Ubuntu, o próximo passo é criar o usuário que acessará a **Interface Web do Tomcat** (manager-gui e admin-gui).

Os usuários e suas habilidades são definidas no arquivo `/opt/tomcat/latest/conf/tomcat-users.xml`. Neste arquivo, configure o usuário admin como no exemplo abaixo. Certifique-se de alterar o nome de usuário e a senha para algo mais seguro:

```
<tomcat-users>
    <!--
    Comments
    -->
   <role rolename="admin-gui"/>
   <role rolename="manager-gui"/>
   <user username="admin" password="admin_password" roles="admin-gui,manager-gui"/>
</tomcat-users>
```

É possível adicionar quantos usuários sejam necessários. Aqui, adicionamos apenas o admin.

### 6.2. Acessando a interface fora do localhost

Por padrão, a **Interface Web do Tomcat** é configurada para permitir acesso somente a partir do localhost. 
Liberar acesso à interface a partir de um IP remoto ou de qualquer lugar que não seja o localhost não é recomendado, pois é um risco de segurança.

Mas se você quiser mesmo assim, basta comentar o conteudo abaixo dos arquivos `context.xml` das aplicações manager e host-manager:


No arquivo `/opt/tomcat/latest/webapps/manager/META-INF/context.xml`, comente:

```
<Context antiResourceLocking="false" privileged="true" >
<!--
  <Valve className="org.apache.catalina.valves.RemoteAddrValve"
         allow="127\.\d+\.\d+\.\d+|::1|0:0:0:0:0:0:0:1" />
-->
</Context>
```

No arquivo `/opt/tomcat/latest/webapps/host-manager/META-INF/context.xml`, comente:

```
<Context antiResourceLocking="false" privileged="true" >
<!--
  <Valve className="org.apache.catalina.valves.RemoteAddrValve"
         allow="127\.\d+\.\d+\.\d+|::1|0:0:0:0:0:0:0:1" />
-->
</Context>
```


Se você precisar acessar a **Interface Web** somente a partir de um IP específico, em vez de comentar os blocos, adicione seu IP público à lista. Digamos que seu IP público seja 32.32.32.32 e você queira permitir o acesso apenas desse IP:

No arquivo `/opt/tomcat/latest/webapps/manager/META-INF/context.xml`, edite:

```
<Context antiResourceLocking="false" privileged="true" >
  <Valve className="org.apache.catalina.valves.RemoteAddrValve"
         allow="127\.\d+\.\d+\.\d+|::1|0:0:0:0:0:0:0:1|32.32.32.32" />
</Context>
```

No arquivo `/opt/tomcat/latest/webapps/host-manager/META-INF/context.xml`, edite:

```
<Context antiResourceLocking="false" privileged="true" >
  <Valve className="org.apache.catalina.valves.RemoteAddrValve"
         allow="127\.\d+\.\d+\.\d+|::1|0:0:0:0:0:0:0:1|32.32.32.32" />
</Context>
```

Os IPs liberados devem ser separados com pipe ("|") na lista especificada.

## 7. Testando a Instalação

Se a instalação funcionou, basta entrer no endereço `http://localhost:8080` e a tela de boas vindas do Tomcat aparecerá.

O painel do gerenciador de aplicativos da web do Tomcat está disponível em `http://localhost:8080/manager/html`. Neste gerenciador você pode implantar, remover a implantação, iniciar, parar e recarregar seus aplicativos.

O painel do gerenciador de virtualhosts do Tomcat está disponível em `http://localhost:8080/host-manager/html`. Neste gereciador você pode criar, excluir e gerenciar os hosts virtuais do Tomcat.

