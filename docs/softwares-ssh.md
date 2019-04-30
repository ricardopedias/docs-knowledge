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

### Desativar o login por senha


```
PasswordAuthentication no
```

Por padrão, todos os usuários do sistema são permitidos fazer o login pelo SSH. Uma medida que aumenta a segurança é criar uma lista de usuários permitidos. 


[Voltar para Lista de Opções](../readme.md)
