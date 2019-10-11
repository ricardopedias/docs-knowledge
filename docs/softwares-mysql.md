[Voltar para Lista de Opções](../readme.md)

# MySQL - Canivete Suíço


## 1. Entrando no servidor

```
$ mysql -u username -h 192.168.0.1 --port=3306 -p 

ou

$ mysql --user=username --host=192.168.0.1 --port=3306 --password
```

Quando for preciso especificar o host para concetar localmente, se o "localhost" for fornecido,
o MySQL tentará usar sockets e poderá disparar um erro do tipo ERROR 2002 (HY000):

```
$ mysql -u username -h localhost --port=3306 -p
ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)
```

Para não receber essa mensagem e conectar normalmente, use "127.0.0.1" no lugar de "localhost":

```
$ mysql -u username -h 127.0.0.1 --port=3306 -p
```

## 2. Descobrindo informações

### 2.1. Versão do servidor

Via terminal, digite:

```
$ mysql -V
```

Na linha de comando do mysql, digite:

```
mysql> SHOW VARIABLES LIKE "%version%";
```

## 3. Trabalhando com usuários

### 3.1. Listando os usuários do sistema

```
mysql> SELECT User, Host, Password FROM mysql.user;

ou

mysql> SELECT CONCAT(User,'@',Host) as user, Password FROM mysql.user;
```

### 3.2. Criando/removendo um usuário:

Para criar um usuário que acessa apenas de 'localhost':

```
mysql> CREATE USER 'usuario_escolhido'@'localhost' IDENTIFIED BY 'minha senha bem dificil';
```

Apenas de um IP específico:

```
mysql> CREATE USER 'usuario_escolhido'@'192.168.0.112' IDENTIFIED BY 'minha senha bem dificil';
```

Em uma faixa de IP específica:

```
mysql> CREATE USER 'usuario_escolhido'@'192.168.0.%' IDENTIFIED BY 'minha senha bem dificil';
```

Para excluir:

```
mysql> DROP USER 'usuario_escolhido'@'localhost';
```

### 3.3. Mudando a senha do usuario:


Para mudar a senha do usuário em versões **iguais ou maiores que 5.7.6**:

```
mysql> ALTER USER user IDENTIFIED BY 'novasenha';
```

ou

```
mysql> SET PASSWORD FOR 'usuario_escolhido'@'localhost' = PASSWORD('novasenha');
```

Para versões **inferiores a 5.7.6**, apenas a sintaxe *SET PASSWORD* está presente.

Para efetivas a mudança de senha, use *FLUSH PRIVILEGES*:

```
mysql> FLUSH PRIVILEGES
```

> **Dica:** Prefira, se possível, a sintaxe ALTER USER. Pois de acordo com a documentação oficial: *"Em algumas circunstâncias, SET PASSWORD pode ser registrado nos logs do servidor ou no lado do cliente em um arquivo de histórico, como ~ / .mysql_history, o que significa que as senhas de texto puro podem ser lidas por qualquer pessoa que tenha acesso de leitura a essas informações"* Para mais informações [clique aqui](https://dev.mysql.com/doc/refman/8.0/en/set-password.html).


### 4.3. Vendo as permissões de um usuário

```
mysql> SHOW GRANTS FOR banco_escolhido@localhost;
```

### 4.4. Permissão total

Para conceder permissão, usa-se o comando *GRANT*. O usuário pode ser especificado usando a sintaxe:

* 'usuario_escolhido'@'localhost': para permitir apenas para o usuário 'usuario_escolhido' via 'localhost';
* 'usuario_escolhido': para permitir acesso a todos os hosts do usuaprio 'usuario_escolhido';

Permissão total a todos os bancos:

```
mysql> GRANT ALL PRIVILEGES ON *.* TO 'usuario_escolhido'@'localhost';
```

Permissão total a um banco específico:

```
mysql> GRANT ALL PRIVILEGES ON 'banco_escolhido'.* TO 'usuario_escolhido'@'localhost';
```

Permissão a uma tabela específica:

```
mysql> GRANT ALL PRIVILEGES ON 'banco_excolhido'.'tabela_escolhida' TO 'usuario_escolhido'@'localhost';
```

Permissão para vários usuários:

```
mysql> GRANT ALL PRIVILEGES ON 'banco_excolhido'.'tabela_escolhida' TO usuario_1, 'usuario_2'@'localhost', usuario_3;
```

Para aplicar as permissões, use *FLUSH PRIVILEGES*:

```
mysql> FLUSH PRIVILEGES;
```

### 4.5. Concedendo/revogando permissões específicas

Para conceder permissão, usa-se o comando GRANT e para revogar, o comando REVOKE.

```
GRANT [tipo de permissão] ON [banco_excolhido].[tabela_escolhida] TO '[usuario_escolhido]'@'localhost';
REVOKE [tipo de permissão] ON [banco_excolhido].[tabela_escolhida] FROM '[usuario_escolhido]'@'localhost';
```

Os tipos de permissões são:


- **ALL PRIVILEGES** - como vimos anteriormente, isso daria a um usuário do MySQL todo o acesso a uma determinada base de dados (ou se nenhuma base de dados for selecionada, todo o sistema).

Privilégios simples:

- **ALTER** - permite alterar tabelas existentes
- **CREATE TEMPORARY TABLES** - permite a criação de tabelas temporárias
- **CREATE** - permite criar novas tabelas ou bases de dados
- **DROP** - permite deletar tableas ou bases de dados
- **DELETE** - permite deletar linhas das tabelas
- **INSERT** - permite inserir linhas nas tabelas
- **SELECT** - permite utilizar o comando Select para ler bases de dados
- **UPDATE** - permite atualizar linhas das tabelas

Privilégios avançados:

- **EXECUTE** - Not implemented
- **FILE** - Enables use of SELECT ... INTO OUTFILE and LOAD DATA INFILE
- **INDEX** - Enables use of CREATE INDEX and DROP INDEX
- **INSERT** - Enables use of INSERT
- **LOCK TABLES** - Enables use of LOCK TABLES on tables for which you have the SELECT privilege
- **PROCESS** - Enables the user to see all processes with SHOW PROCESSLIST
- **REFERENCES** - Not implemented
- **RELOAD** - Enables use of FLUSH
- **REPLICATION CLIENT** - Enables the user to ask where slave or master servers are
- **REPLICATION SLAVE** - Needed for replication slaves (to read binary log events from the master)
- **SHOW DATABASES** - SHOW DATABASES shows all databases
- **SHUTDOWN** - Enables use of MySQLadmin shutdown
- **SUPER** - Enables use of CHANGE MASTER, KILL, PURGE MASTER LOGS, and SET GLOBAL statements, the MySQLadmin debug command; allows you to connect (once) even if max_connections is reached
- **USAGE** - Synonym for privileges
- **GRANT OPTION** - permite conceder ou revogar privilégios de outros usuários 

Por exemplo, para conceder permissão apenas para SELECTs:

```
mysql> GRANT SELECT ON 'banco_excolhido'.* TO 'novousuario'@'localhost';
```

Para revogar:

```
mysql> REVOKE SELECT ON 'banco_excolhido'.* TO 'novousuario'@'localhost';
```

Para aplicar as permissões, use *FLUSH PRIVILEGES*:

```
mysql> FLUSH PRIVILEGES;
```

## 5. Trabalhando com bancos

### 5.1. Criando

```
mysql> CREATE DATABASE IF NOT EXISTS meu_banco CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

### 5.2. Backup do banco

Através do terminal, para fazer um backup usa-se o *mysqldump*:

```
$ mysqldump [arguments] > file_name
```

Para salvar todos os bancos de dados:

```
$ mysqldump --all-databases > dump.sql
```

Para salvar bancos específicos:

```
$ mysqldump --databases db1 db2 db3 > dump.sql
```

Para salvar um único banco:

```
$ mysqldump --databases test > dump.sql

ou

$ mysqldump test > dump.sql
```

### 5.3. Restaurando vários bancos de dados

Pela linha de comando do MySQL, basta usar o comando *source*:

```
mysql> source dump.sql
```

Através do terminal, para fazer a restauração de um backup usa-se o próprio executável do *mysql*:

```
$ mysql < dump.sql
```

### 5.4. Restaurando um único bancos de dados

Se o backup tover sido feito de um único banco de dados, então o arquivo *dump.sql* não conterá as instruções *CREATE DATABASE* e *USE*. Sendo assim, será necessário especificar o banco para o qual o backup será restaurado.

Pela linha de comando do MySQL:

```
mysql> CREATE DATABASE IF NOT EXISTS novo_banco;
mysql> USE novo_banco;
mysql> source dump.sql
```

Através do terminal:

```
$ mysql novo_banco < dump.sql
```








# Problemas do Ubuntu


## 1. Abrir o prompt do MySQL

```
$ mysql -u username -p 
$ mysql --user=username --host=192.168.0.1 --port=1234 --password=ricardo
```

### Acesso root no Ubuntu <= 18.04

```
$ mysql -u root -p 
```

### Acesso root no Ubuntu >= 18.10

```
$ sudo mysql
```

Nas versões anteriores, após a instalação do mysql, uma janela pedia para o usuário digitar a senha de root do mysql. A partir desta nova versão, isso não acontece mais. Isso porque o mysql passou a usar um plugin chamado 'auth_socket' para que o usuário do sistema possa se conectar diretamente. Isso pode ser conferido na tabela mysql.user do sevidor:

```
$ sudo mysql
$ mysql> SELECT user, authentication_string, plugin, host FROM mysql.user;
+------------------+-------------------------------------------+-----------------------+-----------+
| user             | authentication_string                     | plugin                | host      |
+------------------+-------------------------------------------+-----------------------+-----------+
| root             |                                           | auth_socket           | localhost |
| mysql.session    | *THISISNOTAVALIDPASSWORDTHATCANBEUSEDHERE | mysql_native_password | localhost |
| mysql.sys        | *THISISNOTAVALIDPASSWORDTHATCANBEUSEDHERE | mysql_native_password | localhost |
| debian-sys-maint | *CC744277A401A7D25BE1CA89AFF17BF607F876FF | mysql_native_password | localhost |
+------------------+-------------------------------------------+-----------------------+-----------+
4 rows in set (0.00 sec)
```

Para abrir o prompt root do mysql no Ubuntu 18.10 (ou superiores) como nas versões anteriores, será necessário configurar, usando o comando abaixo:

```
$ sudo mysql
$ mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'senha_nova';
```

Agora será possivel entrar no servidor sem o sudo.

```
$ mysql -u root -p 
```


## 2. Ubuntu 18.10: Conectando como usuário root

No ubuntu 18.04 e anteriores, o usuário root possui vários hosts diferentes por padrão:

```
mysql> SELECT Host, User FROM mysql.user;
+-----------+------------------+
| Host      | User             |
+-----------+------------------+
| %         | root             |
| localhost | root             |
| 127.0.0.1 | root             |
| ::1       | root             |
| localhost | debian-sys-maint |
| localhost | mysql.session    |
| localhost | mysql.sys        |
+-----------+------------------+
5 rows in set (0.00 sec)
```

A partir do ubuntu 18.10, o usuário root possui apenas um host:

```
mysql> SELECT Host, User FROM mysql.user;
+-----------+------------------+
| Host      | User             |
+-----------+------------------+
| localhost | root             |
| localhost | debian-sys-maint |
| localhost | mysql.session    |
| localhost | mysql.sys        |
+-----------+------------------+
5 rows in set (0.00 sec)
```

Isso será um problema para os sistemas que executem pelo usuário root com Triggers, Procedures ou Functions atreladas a um determinado host, como por exemplo, o root@'%'.

Por exemplo, se o sistema tentar executar uma Procedure atrelada ao usuário 'root'@'%' (que não existe no ubuntu 18.10), a seguinte mensagem de erro será emitida:

>> The user specified as a definer (‘root’@’%’) does not exist

Embora não seja aconselhável a utilização do usuário root para conexões sistemicas, se for realemnet necessário utilizá-lo, será preciso criar o host especifico para ele:

```
mysql> CREATE USER 'root'@'%';
mysql> GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
mysql> FLUSH PRIVILEGES;
```

## 3. Mudando a senha de usuários


shell> mysql -u root -p
mysql> SET PASSWORD FOR 'root'@'localhost' = PASSWORD('newpwd');
mysql> SET PASSWORD FOR 'root'@'127.0.0.1' = PASSWORD('newpwd');
mysql> SET PASSWORD FOR 'root'@'::1' = PASSWORD('newpwd');
mysql> SET PASSWORD FOR 'root'@'host_name' = PASSWORD('newpwd');

If you wanted to update them all at once you can use UPDATE

shell> mysql -u root -p
mysql> UPDATE mysql.user SET Password = PASSWORD('newpwd')
    ->     WHERE User = 'root';
mysql> FLUSH PRIVILEGES;

The third way if to use the mysqladmin tool

shell> mysqladmin -u root password "newpwd"
shell> mysqladmin -u root -h host_name password "newpwd"

If using this method, you need to make note:

The mysqladmin method of setting the root account passwords does not work for the 'root'@'127.0.0.1' or 'root'@'::1' account. Use the SET PASSWORD method shown earlier.






1 – Identificar a versão do bando de dados
A maioria das distribuições GNU/Linux está vindo com MariaDB, que é um fork do MySQL. Dependendo do banco de dados que você está usado e sua versão, você precisará usar comandos diferentes para recuperar a senha de root.

Você pode verificar sua versão com o seguinte comando:

MySQL:

mysql --version
MariaDB:

 mariadb --version
Anote qual banco de dados e versão que você está executando, pois você vai usar mais tarde. Em seguida, você precisa parar o banco de dados para poder acessá-lo manualmente.

2 – Parando o servidor de banco de dados
Para alterar a senha do root, você precisa parar o servidor de banco de dados com antecedência.

Você pode fazer isso para o MySQL, com esse comando:

sudo systemctl stop mysql
Você pode fazer isso para o MariaDB, com esse comando:


sudo systemctl stop mariadb
Depois que o servidor de banco de dados for parado, você o pode acessar ele manualmente para redefinir a senha de root. Caso você queira saber mais sobre o systemctl, temos esse arigo falando mais sobre o assunto.

3 -Reiniciando o servidor de banco de dados sem verificação de permissão
Se você executar o MySQL e o MariaDB sem carregar informações sobre privilégios de usuário, ele permitirá que você acesse a linha de comando do banco de dados com privilégios de root sem fornecer uma senha. Isso permitirá que você obtenha acesso ao banco de dados.

Para fazer isso, você precisa parar o banco de dados de carregar as tabelas de permissões (grant tables), que armazenam informações de privilégios de usuário. Como isso é um risco de segurança, você também deve desativar a conexão pela internet, para evitar que outros clientes se conectem ou pessoas mal-intencionadas.

Inicie o banco de dados sem carregar as tabelas de permissões e sem conexão a rede:

sudo mysqld_safe --skip-grant-tables --skip-networking &
O “e” comercial no final desse comando é para o processo seja executado em segundo plano para que você possa continuar a usar seu terminal.

Agora você pode se conectar ao banco de dados como o usuário root, sem que ele peça sua senha.

mysql -u root
Agora que você tem acesso root, você pode alterar a senha do root.

4- Alterando a senha do root
Uma maneira simples de alterar a senha do root para versões recentes do MySQL é usando o comando ALTER USER. No entanto, esse comando não funcionará agora porque as tabelas de permissões não estão carregadas.

Vamos dizer ao servidor de banco de dados para recarregar as tabelas de permissões emitindo o comando FLUSH PRIVILEGES.

FLUSH PRIVILEGES;
Para o MySQL 5.7.6 e mais recentes, bem como o MariaDB 10.1.20 e mais recentes, use o seguinte comando:

ALTER USER 'root'@'localhost' IDENTIFIED BY 'nova-senha';
Para o MySQL 5.7.5 e mais antigo, bem como o MariaDB 10.1.20 e mais antigo, use:

SET PASSWORD FOR 'root'@'localhost' = PASSWORD('nova-senha');
Certifique-se de substituir nova-senha pela senha que você vai querer colocar para o seu usuário root.

Nota: Se o comando ALTER USER não funcionar, geralmente é indicativo de um problema maior. No entanto, você pode tentar UPDATE … SET para redefinir a senha de root.
 UPDATE mysql.user SET authentication_string = PASSWORD(nova-senha') WHERE User = 'root' AND Host = 'localhost';
Se você usou o comando anterior o UPDATE … SET, lembre-se de recarregar as tabelas de permissões depois disso, com esse comando:
FLUSH PRIVILEGES;
Feito isso, saia do prompt do bando de dados:

exit;
Em ambos os casos, você deve ver a confirmação de que o comando foi executado com sucesso.

5- Reiniciando o bando de dados
Primeiro, pare a instância do servidor de banco de dados que você iniciou manualmente na Etapa 3. Esse comando procura pelo PID, ou processo ID, do processo MySQL ou MariaDB e envia SIGTERM para que ele saia sem problemas após executar as operações de limpeza.

Para o MySQL, use:

sudo kill `cat /var/run/mysqld/mysqld.pid`
Para MariaDB, use:

sudo kill `/var/run/mariadb/mariadb.pid`
Em seguida, inicie o servidor.

Para MySQL, use:

sudo systemctl start mysql
Para MariaDB, use:

sudo systemctl start mariadb
Agora você pode confirmar que a nova senha foi aplicada corretamente executando:

mysql -u root -p
O comando anterior vai solicitar a senha, você deve informar a senha que você acabou de configurar. Com isso, você vai obter acesso ao prompt do banco de dados conforme o esperado.





## 2. Trabalhando com usuários


Atenção: Execute estes comando no terminal do servidor.

abra um terminal e digite
sudo vi /etc/mysql/my.cnf
comente as linhas
bind-address = 127.0.0.1
skip-external-locking
reinicie o servidor com o comando
/etc/init.d/mysql restart
sudo service mysql restart
entre no prompt do mysql com o comando:
mysql –u root –p
Será solicitado a senha do usuário root para servidor MySQL
no prompt do MySQL digite:
GRANT ALL ON *.* TO root@’%’ IDENTIFIED By ‘senhadoroot’;
FLUSH PRIVILEGES;
O comando acima irá permitir acesso a todos os bancos de dados de qualquer máquina remota ao usuário root.
OBS.: Os comandos acima foram testados no Ubuntu 10.04 Server rodando o servidor MySQL 5.1.41


### 2.1. Mudar a senha de root








O processo é feito parando o servidor padrão e iniciando-o em modo monousuário. Primeiro é preciso parar o MySQL:

```
$ sudo service mysql stop
```

É preciso criar o diretório do "mysqld" e atribuir a ele as permissões para o usuário "mysql":

```
$ sudo mkdir -p /var/run/mysqld
$ sudo chown mysql:mysql /var/run/mysqld
```

Para entrar em modo de monousuário:

```
$ sudo mysqld_safe --skip-grant-tables --skip-networking &
```

Feito isso, será possível conectar ao servidor sem especificar uma senha:

```
mysql -u root

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>
```

Conectado ao MySQL, é hora de alterar a senha:

```
FLUSH PRIVILEGES;

UPDATE mysql.user SET authentication_string = PASSWORD('novasenha') WHERE User = 'root' AND Host = 'localhost';

quit;
```

Com a senha alterada, é preciso sair do modo monousuário, bastando para isso matar o processo do mysqld:

```
$ sudo pkill mysqld
```

Para finalizar, reinicia-se o servidor:

```
$ sudo service mysql start
```

### 2.2. Criar Usuário

Conectado no servidor:

```
CREATE USER 'ricardo'@'localhost' IDENTIFIED BY 'senhalegal';
GRANT ALL PRIVILEGES ON * . * TO 'ricardo'@'localhost';
FLUSH PRIVILEGES;
```

### 2.3. Editar Usuário e Senha

Conectado no servidor:

```
UPDATE mysql.user SET user='ricardonaitis', password=PASSWORD('senhamudada') WHERE user='ricardo';
FLUSH PRIVILEGES;
```

### 2.4. Remover Usuário

```
DROP USER ‘ricardo’@‘localhost’;
```

## 3. Trabalhando com Bancos de Dados

### 3.1. Exportar Bancos

```
$ mysqldump -u [uname] -p[pass] --routines -v db_name > db_backup.sql
$ mysqldump -u [uname] -p[pass] --routines -v --all-databases > all_db_backup.sql
$ mysqldump -u [uname] -p[pass] --routines -v db_name table1 table2 > table_backup.sql
$ mysqldump -u [uname] -p[pass] --routines -v db_name | gzip > db_backup.sql.gz
$ mysqldump -P 3306 -h [ip_address] -u [uname] -p[pass]  --routines -v db_name > db_backup.sql
```

Mais informações em http://dev.mysql.com/doc/refman/5.6/en/mysqldump.html

### 3.2. Importar Bancos

Para importar pelo terminal:

```
$ mysql -u username -p -h localhost DATA-BASE-NAME < data.sql
$ mysql -u sat -p -h localhost blog < data.sql
$ mysql -u username -p -h 202.54.1.10 databasename < data.sql
$ mysql -u username -p -h mysql.cyberciti.biz database-name < data.sql
$ mysql -u username -p -h 202.54.1.10 < data.sql
```

Para importar de dentro do prompt do mysql-client, usando `source`:

```
$ mysql -u root -p

mysql> create database mydb;
mysql> use mydb;
mysql> source db_backup.dump; 
```

### 3.3. Gerando a diferença entre bancos

```
$ sudo apt-get install mysql-utilities
```

```
# dois servidores:
$ mysqldiff --server1=user:pass@host1 --server2=user:pass@host2 test:test        
$ mysqldiff --server1=user:pass@host1 --server2=user:pass@host2 testdb:anotherdb
$ mysqldiff --server1=user:pass@host1 --server2=user:pass@host2 testdb.table1:anotherdb.anothertable

# mesmo servidor:
$ mysqldiff --server1=user:pass@host1 testdb1:testdb2
$ mysqldbcompare --server1=root:pass@localhost --server2=root:pass@backup_host:3310 inventory:inventory

# https://dev.mysql.com/doc/mysql-utilities/1.6/en/mysqldiff.html
$ mysqldump --skip-comments --skip-extended-insert -u root -p dbName1>file1.sql
$ mysqldump --skip-comments --skip-extended-insert -u root -p dbName2>file2.sql
$ diff file1.sql file2.sql
```

# 4. Queries

Formatar CPF:

```
SELECT 
  INSERT( INSERT( INSERT( users.cpf, 10, 0, '-' ), 7, 0, '.' ), 4, 0, '.' ) as cpf
FROM users
```
Formatar CNPJ:

```
SELECT
  INSERT(INSERT(INSERT(INSERT(users.cnpj, 13, 0, '-' ), 9, 0, '/' ), 6, 0, '.' ), 3, 0, '.' ) as cnpj
from users
```

[Voltar para Lista de Opções](../readme.md)
