[Voltar para Lista de Opções](../readme.md)

# MySQL - Canivete Suíço

## 1. Abrir o prompt do MySQL

```
$ mysql -u username -p 
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
