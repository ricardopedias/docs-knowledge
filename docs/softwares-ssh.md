[Voltar para Lista de Opções](../readme.md)

# SSH

## Segurança

### Mudando a porta

Quando o SSH é instalado, por padrão ele escuta a porta 22. Por medida de segurança é importante mudar essa porta 
para um número maior que 1024, pis isso vai dificultar bastante a tentativa de invasão. 

Editando o arquivo /etc/ssh/sshd_config e procure a linha onde a porta é especificada (Port 22) ou adicione-a no final.

```
# Port 22
Port 2244
```

Reinicie o serviço SSH para efetivar a configuração:

```
# /etc/init.d/ssh restart
```

A partir de então, sempre que alguém for conectar por ssh, deverá especificar a porta:

```
ssh ricardo@192.168.1.100 -p 2244
```

### Mudando o protocolo SSH

Existem duas versões do protocolo SSH, sendo que a primeira (versão 1), possui problemas de segurança 
e não é recomendada, pois permite inserção maliciosa de comandos. A segunda (versão 2) é muito mais segura.

Edite o arquivo /etc/ssh/sshd_config e procure a linha onde o protocolo é especificado (Protocol ?) ou adicione-a no final.
Em algums servidores, a opção estará como "Protocol 2,1" (precedencia com dois protocolos), em outras, como "# Protocol 2" (comentado).

Certifique-se de ativar apenas o protocolo 2:

```
Protocol 2
```

### Removendo o acesso remoto do root

Qualquer aplicação que se conecte remotamente através da internet deve possuir poderes limitados.
Portanto, não é seguro permitir que o usuário root possa se conectar por ssh. Para usar o root, 
deve-se primeiro estar logado dentro do servidor e, em seguida, usar comandos como "sudo" ou "su" para 
agir como root.

Para desativar o login SSH do root, procure a linha onde a permissão é especificada ou adicione-a no final:

```
# PermitRootLogin yes
PermitRootLogin no
```

### Reduzir o tempo de login

Por padrão, o servidor ssh irá aguardar 2 minutos antes de desconectar. 30 segundos é mais do que suficiente: 

```
# LoginGraceTime 120
LoginGraceTime 30
```

### Adicionando login por chave

#### Criando uma SSH Key para o usuario logado

Para gerar o par de chaves para o usuario logado em um computador qualquer, use (no cliente) o comando:

```
$ ssh-keygen -t rsa
```

Ao pressionar “Enter” você verá algo parecido com:

```
Generating public/private rsa key pair.
Enter file in which to save the key (/home/joaozinho/.ssh/id_rsa): 
Created directory '/home/joaozinho/.ssh'.
Enter passphrase (empty for no passphrase): 
Enter same passphrase again: 
Your identification has been saved in /home/joaozinho/.ssh/id_rsa.
Your public key has been saved in /home/joaozinho/.ssh/id_rsa.pub.
```

Na primeira linha é requisitado que você especifique onde deseja gerar a chave. 
Não é necessário alterar este local, ela será gerada na sua pasta local dentro de uma pasta oculta chamada .ssh.

Atenção: em “Enter passphrase”, digite uma senha forte e que você se lembre posteriormente. 
Essa senha sempre será utilizada para realizar a primeira conexão SSH com o servidor. 
Assim, se você perder ou alguém roubar sua chave, não conseguirá acesso ao servidor sem saber sua “senha forte”. 
Será necessário repetir essa senha na linha “Enter same passphrase again”.

#### Criando uma SSH Key para outro usuário

Caso vocẽ esteja no mesmo sistema onde o outro usuário se encontra, é possível criar as chaves para ele.
Apesar de ser algo privado de um usuário e ele mesmo deveria criar e guardar sua própria chave, você pode gerar uma chave para outro usuário apenas alterando o caminho onde ela é salva no comando explicado anteriormente.

Mas, se você tem acesso sudo no computador, pode digitar o seguinte:

```
sudo -u joaozinho ssh-keygen -t rsa
```

Apenas altere “joaozinho” para o nome de usuário que deseja criar a chave. Se você não alterar nada, as chaves pública e privada serão geradas na pasta .ssh dentro da home do usuário “joaozinho”.

#### Como ver a chave pública

Como é a chave pública que será copiada para o servidor, você só vai precisar copiar ela. Para isso, digite:

```
cat /home/joaozinho/.ssh/id_rsa.pub
```

Apenas altere “joaozinho” para o seu usuário ou nome de usuário que deseja copiar a chave.

Lembre-se que as permissões desse arquivo são voltadas para o usuário do arquivo, se você estiver criando para outro usuário, precisará usar sudo para executar esse comando.

```
sudo cat /home/joaozinho/.ssh/id_rsa.pub
```

Você vai ver muitos caracteres, começando com “ssh-rsa”. Selecione e copie todos os dados dessa linha. Essa é a chave pública do seu usuário que será copiada para o servidor.

#### Adicione chave pública no servidor remoto

Depois de criar suas chaves, você vai precisar copiar sua chave pública para o servidor. Para isso, basta criar um arquivo chamado “authorized_keys” dentro da pasta .ssh do usuário desejado dentro do servidor.

Por exemplo: suponhamos que eu queira dar autorização para o usuário “Joãozinho” (usado no linux anteriormente) para acessar o servidor remoto como o usuário “Zézinho”. Então eu digitaria o seguinte no servidor remoto:

```
sudo mkdir --mode=600 /home/zezinho/.ssh/
sudo nano /home/zezinho/.ssh/authorized_keys
```

E colocaria a chave pública do “Joãozinho” dentro do arquivo “authorized_keys” do “Zézinho”.

Agora cole os dados da sua chave pública dentro desse arquivo e pressione “CTRL” + “O” para salvar, “CTRL” + “X” para sair.

Se vários usuários poderão se conectar usando o usuário do servidor remoto, adicione uma chave pública por linha no authorized_keys.


### Configurando o OpenSSH

Para finalizar, vamos configurar o SSH para fazer os últimos ajustes e efetivar tudo. Dentro do servidor remoto, digite o seguinte:

```
sudo nano /etc/ssh/sshd_config
```

E altere as linhas:

```
# ...
PermitRootLogin no
# ...
PubkeyAuthentication yes
# ...
PasswordAuthentication no
# ...
```

* **PermitRootLogin** remove completamente o acesso do root ao servidor SSH; 
* **PubkeyAuthentication** permite o acesso via chave pública;
* **PasswordAuthentication** remove o acesso via senhas de texto.


Pressione “CTRL”+”O” para salvar e reinicie o servidor SSH:

```
sudo service ssh restart
```

Atenção: não feche sua conexão SSH atual. Para testar, abra uma nova conexão SSH, se der errado você não perderá sua conexão atual.


[Voltar para Lista de Opções](../readme.md)
