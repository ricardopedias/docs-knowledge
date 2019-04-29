[Voltar para Lista de Opções](../readme.md)

# Comandos Linux

## Criar usuário ssh e desabilitar o root

Importante: sugiro que a todo momento mantenha-se logado em uma janela de seu SSH como root e sempre faça testes em um novo terminal.

### 1. Criando usuário com permissão de acesso ao ssh

Efetue login como root no ssh de seu servidor, a seguir digite(mude adminserver para outro nome que desejar) :

```
# adduser adminserver
```

A seguir crie uma senha

```
# passwd adminserver
```

Será solicitado que digite uma senha e a confirme após o “enter”.

> Importante: para números, NÃO utilize o teclado numerico a esquerda de seu teclado.

Ok, agora vamos determinar que este usuário poderá efetuar login no ssh.

```
# gpasswd -a adminserver wheel
```

Neste tempo você terá um novo usuário que poderá efetuar login no ssh , porém este usuário nao possui privilégios de root.

### 2. Desabilitando o acesso direto ao root no SSH.

Edite o arquivo de configuração do SSH.

```
# vi /etc/ssh/sshd_config
```

Mude as linhas:

De:

```
# Protocol 2, 1
```

Para:

```
# Protocol 2
```

e de:

```
# PermitRootLogin yes
```

Para:

```
# PermitRootLogin no
```

Salve as modificações(ctrl+wq)

Reinicie o ssh:

```
# service sshd restart
```

NÃO efetue logoff, tente efetuar login com o usuário e senha que criou anteriormente e a seguir, no prompt de comando digite :

```
# su - root
```
(ou apenas su – , costuma funcionar em algumas distribuições linux)

informe a senha do root.

Se tudo correu bem , você deverá sempre efetuar login com o usuário criado e a seguir informar a senha do root.

Se algo saiu errado , edite novamente o arquivo de configuração do SSH , mude “PermitRootLogin no” para “PermitRootLogin yes” e reinicie novamente o ssh.


## Descobruindo a versão do Linux

```
cat /etc/issue
```

## Espaço em disco

```
df -h – Ele será exibido em um formato humano melhor e mais legível. Usando este comando, o espaço em disco será mostrado em GB (a menos que seja menor que um GB, então ele será exibido em MB ou mesmo B).
df -m – Pode ser usado para exibir informações de uso do sistema de arquivos em MB.
df -k – Mesmo que o anterior, pode ser usado para exibir informações de uso do sistema de arquivos em KB.
df -T – Esta opção mostrará o tipo de sistema de arquivos (uma nova coluna aparecerá).
df -ht /home – Usando esta opção, você pode exibir informações sobre um sistema de arquivos específico (em um formato legível por humanos).
```
    
## Maiores arquivos /diretórios


```
du -hsx ~/.config/* | sort -rh | head -10
```

Dissecando o comando:

    du -h — quebra os números e os representa na forma de Kb, Mb, Gb etc.
    du -s — apresenta apenas um total sumarizado de cada item.
    du -x — pula os diretórios que, porventura, se encontrem em sistemas de arquivos diferentes.
    sort -r — inverte a ordem de exibição dos valores.
    sort -h — torna mais amigável a exibição da lista.
    head -10 — restringe a exibição da lista aos 10 primeiros itens.
    
    
find . -size +500M

    
sudo apt-get install ncdu

```
$ ncdu
```


[Voltar para Lista de Opções](../readme.md)
