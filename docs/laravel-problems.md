[Voltar para Lista de Opções](../readme.md)

# Laravel: Resolução de Problemas

## 1. Specified key was too long

A partir da versão 5.4, o Laravel fez uma mudança no conjunto de caracteres padrão do banco de dados para utf8mb4, que inclui suporte para armazenamento de emojis. Isso afeta apenas apenas as novas aplicações.

Mas esta mudança pode afetar o comportamento do MySQL. Para versões do MySQL iguais ou superiores a 5.7.7, nenhum problema deverá ocorrer, mas as versões mais antigas, tanto do MySQL como do MariaDB poderão apresentar erro ao tentar executar migrações:

```
[Illuminate\Database\QueryException]
SQLSTATE [42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table users add unique users_email_unique (email))

[PDOException]
SQLSTATE [42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
```

Para corrigir isso, conforme descrito no [guia de migrações](https://laravel.com/docs/master/migrations#creating-indexes), basta editar o arquivo **AppServiceProvider.php** e, dentro do método **boot()**, definir o tamanho padrão da string:

```
use Illuminate\Support\Facades\Schema;

public function boot ()
{
    Schema::defaultStringLength(191);
}
```

Depois disso tudo deve funcionar normalmente.


## 2. Syntax error or access violation: 1055 Error

Por padrão o Laravel conecta ao MySQL em modo estrito, para aumentar a performance das consultas. O problema é que o modo estrito não permite o agrupamento de resultados com especificação de apenas colunas específicas, forçando a cláusula a conter todas as colunas da tabela a ser agrupada no GROUP BY. Se todas elas não estiverem no GROUP BY o erro 1055, de violação de acesso, será disparado.

Para solucionar isso, basta editar o arquivo config/database.php e setar o parâmetros `strict` para false:

```
'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null
    ]
```

Outra forma é desativar apenas o modo de FULL GROUP BY, para manter o modo estrito e poder setar menos campos no GROUP BY.
Abaixo, um exemplo com todos os modos setados por padrão na conexão do Laravel. Basta comentar aquela que não se desejar:

```
'mysql' => [
       ...
       ....
       'strict' => true,
       'modes' => [
            //'ONLY_FULL_GROUP_BY', // Desativa isso para liberar o agrupamaneto por única coluna
            'STRICT_TRANS_TABLES',
            'NO_ZERO_IN_DATE',
            'NO_ZERO_DATE',
            'ERROR_FOR_DIVISION_BY_ZERO',
            'NO_AUTO_CREATE_USER',
            'NO_ENGINE_SUBSTITUTION'
        ],
 ]
 ```

## 3. Logando todas as queries executadas pelo Eloquent

Para logar todas as queries que o Eloquent envia para o servidor de Banco de Dados, basta o \DB::listen no AppServiceProvider. Após esta configuração, as queries passarão a ser adicionadas no arquivo de log do Laravel em /storage/laravel.log. Observe no exemplo abaixo:

```
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        \DB::listen(function($query) {
            \Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }
    
    // ...
}
```

[Voltar para Lista de Opções](../readme.md)
