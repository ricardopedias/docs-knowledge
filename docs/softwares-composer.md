[Voltar para Lista de Opções](../readme.md)

# Composer


## [ErrorException] file_get_contents([...]spdx-licenses.json): failed to open stream: No such file


[ErrorException]
  file_get_contents(/usr/share/php/Composer/../../data/Composer/res/spdx-licenses.json): failed to open stream: No such file or directory


validate [--no-check-all] [--no-check-lock] [--no-check-publish] [-A|--with-dependencies] [--strict] [--] [<file>]
  
  
  ***For anyone with the issue the work around is to simply create a symbolic link in /usr/share.

cd /usr/share
ln -s php/data .


[Voltar para Lista de Opções](../readme.md)
