[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)

# Laravel 5.5 - Factories e Seeders

Os seeders e os factories são mecanismos de automação muito úteis para desenvolvimento, pois populam facilmente as tabelas com informações padrões.

## 1. Factory para usuários

```
# database/factories.php

$factory->define(App\User::class, function (Faker\Generator $faker) {
   
   return [
       'name' => $faker->name,
       'email' => $faker->unique()->safeEmail,
       'password' => bcrypt('secret'),
       'remember_token' => str_random(10),
   ];
});
```

## 2. Seeder para a tabela de usuários 

```
# database/seeds/UsersTableSeeder.php

<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
   public function run()
   {
       DB::table('users')->delete();
       factory(App\User::class, 8)->create();
   }
}
```

## 3. Chamada do seeder

``` 
# database/seeds/DatabaseSeeder.php

use Illuminate\Database\Seeder,
    Illuminate\Database\Eloquent\Model;

public function run()
{
   Model::unguard();
   $this->call(UsersTableSeeder::class);
   Model::reguard();
}
```

## 4. Criação das tabelas

```
$ cd /var/www/projeto_laravel
$ php artisan migrate      # cria as tabelas no banco de dados
$ composer dump-autoload   # regenerar o autoloader para os seeders serem localizados
$ php artisan db:seed      # popula as tabelas com todos os seeders
$ php artisan db:seed --class=UsersTableSeeder # popula as tabelas com o seeder especificado
```

[Voltar para Lista de Opções](https://bitbucket.org/rpdesignerfly/sofia/wiki/browse/)