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

[Voltar para Lista de Opções](../readme.md)
