[Voltar para Lista de Opções](../readme.md)

# PHP

## Ativando o log de erros

### PHP-fpm no Ubuntu 18.04

Primeiro é preciso editar o arquivo www.conf. Mude a versão '7.2' para a versão do php desejada:

```
$ sudo vim etc/php/7.2/fpm/pool.d/www.conf
```

Em seguida, no final do arquivo, é preciso configurar os parâmetros como a seguir:

```
catch_workers_output = yes
php_flag[display_errors] = on
php_admin_value[error_log] = /var/log/fpm-php.www.log
php_admin_flag[log_errors] = on
```
Por fim, é preciso criar o arquivo de log e dar permissão a ele:

```
$ sudo touch /var/log/fpm-php.www.log && chmod 777 /var/log/fpm-php.www.log
```

Após reiniciar os servidores, será possivel acompanhar o arquivo sendo populado com logs do interpretador php:

```
$ sudo service php7.2-fpm restart
$ sudo service apache2 restart
```

Um comando legal para ficar "observando" os logs em tempo real é o tail:

```
$ tail -f /var/log/fpm-php.www.log
```
Os erros logados se parecerão como a seguir:

```
[09-Aug-2018 23:14:31 America/Sao_Paulo] PHP Parse error:  syntax error, unexpected 'define' (T_STRING) in /var/www/laravel56/public/index.php on line 10
[09-Aug-2018 23:14:31 America/Sao_Paulo] PHP Parse error:  syntax error, unexpected 'define' (T_STRING) in /var/www/laravel56/public/index.php on line 10
```




[Voltar para Lista de Opções](../readme.md)
