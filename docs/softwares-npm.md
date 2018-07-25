[Voltar para Lista de Opções](../readme.md)

# Npm

## 1. Erro do pngquant

Erro:

```
The `/var/www/laravel56/packages/plexi/admin-panel/node_modules/pngquant-bin/vendor/pngquant` binary doesn't seem to work correctly
  ⚠pngquant pre-build test failed

  ℹ compiling from source
  ✖ Error: pngquant failed to build, make sure that libpng-dev is installed
    at ChildProcess.exithandler (child_process.js:273:12)
    at ChildProcess.emit (events.js:180:13)
    at maybeClose (internal/child_process.js:936:16)
    at Process.ChildProcess._handle.onexit (internal/child_process.js:220:5)
+ pngquant-bin@3.1.1
```

Solução:

O erro acima ocorre por causa da ausência da biblioteca **libpng-dev**. Basta instalá-la.

```
$ sudo apt-get install libpng-dev -y --no-install-recommends
```

Agora o `npm install` pode rodar:


```
$ cd /var/www/meu-projeto
$ npm install
```



[Voltar para Lista de Opções](../readme.md)
