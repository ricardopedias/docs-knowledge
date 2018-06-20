[Voltar para Lista de Opções](../readme.md)

# MySQL - Canivete Suíço

## 1. Conectar ao MySQL

```
$ mysql -u username -p 
```


## 2. Trabalhando com usuários

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
$ mysqldump -u [uname] -p[pass] db_name > db_backup.sql
$ mysqldump -u [uname] -p[pass] --all-databases > all_db_backup.sql
$ mysqldump -u [uname] -p[pass] db_name table1 table2 > table_backup.sql
$ mysqldump -u [uname] -p[pass] db_name | gzip > db_backup.sql.gz
$ mysqldump -P 3306 -h [ip_address] -u [uname] -p[pass] db_name > db_backup.sql
```

Mais informações em http://dev.mysql.com/doc/refman/5.6/en/mysqldump.html

### 3.2. Importar Bancos

```
$ mysql -u username -p -h localhost DATA-BASE-NAME < data.sql
$ mysql -u sat -p -h localhost blog < data.sql
$ mysql -u username -p -h 202.54.1.10 databasename < data.sql
$ mysql -u username -p -h mysql.cyberciti.biz database-name < data.sql
$ mysql -u username -p -h 202.54.1.10 < data.sql
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

[Voltar para Lista de Opções](../readme.md)