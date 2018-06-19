# Instalando o Tema


https://github.com/chrisburton/Jeffrey-Way-Theme
https://github.com/equinusocio/material-theme





Abra a paleta de comando "Tools -> Command Palette" (ou Ctr + Shift + P) e escolha "Package Control: Install Package".
Escolha o tema "Theme - Spacegray" e pressione "Enter" para instalar.

# Ativando o Tema

Para ativa o tema é preciso modificar o arquivo de preferências do usuário, acessando o menu "Sublime Text -> Preferences -> Settings - User".

No Arquivo de configuração, adicione as seguintes diretivas, (dependendo do tema desejado, pis o spacegray possui diversas variações):

## Spacegray

```
{
  "theme": "Spacegray.sublime-theme",
  "color_scheme": "Packages/Theme - Spacegray/base16-ocean.dark.tmTheme"
}
```

## Spacegray Light

```
{
  "theme": "Spacegray Light.sublime-theme",
  "color_scheme": "Packages/Theme - Spacegray/base16-ocean.light.tmTheme"
}
```

## Spacegray Eighties

```
{
  "theme": "Spacegray Eighties.sublime-theme",
  "color_scheme": "Packages/Theme - Spacegray/base16-eighties.dark.tmTheme"
}
```

Mais informações sobre o tema Spacegray podem ser encontradas em [https://github.com/kkga/spacegray](https://github.com/kkga/spacegray)

# Autocompletar

Primeiro verifique no menu "Preferences ->Settings-User" se existe opção "auto_complete" e se o seu valor é "true":

```
{
  "auto_complete": true
}
```

Com esta opção ativada, é preciso instalar os plugins necessários para fazer o efeito de autocomplete.
Abra a paleta de comando "Tools -> Command Palette" e escolha "Package Control: Install Package". Em seguida, procure os pacotes a seguir e pressione "Enter" para instalar (um por um):

* Emmet 
* CSS Extended Completions
* Sublime​Linter

# Melhorias na Barra lateral

Para adicionar comandos úteis na barra lateral do SublimeText, entre no PackageControl e instale:

* Sidebar Enhancements


# Outras ferramentas 

* Alignment - Para alinhar variáveis
* Trimmer - Para remover linhas em branco

```
Terminal
http://sweetme.at/2014/04/07/glue-a-terminal-for-sublime-text/
```

* Converter Tabs para Espaços

```
{
    "translate_tabs_to_spaces": true,
    "tab_size": 4
}
```