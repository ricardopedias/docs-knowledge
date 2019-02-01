# Latex

## Instalando

### Intalando o texlive


### Fontes non-free

Para instalar fontes non-free (Arial, Garamont, etc), é preciso instalar o script `getnonfreefonts`:

```bash
$ sudo wget https://www.tug.org/fonts/getnonfreefonts/install-getnonfreefonts -O /tmp/install-getnonfreefonts; sudo chmod a+x /tmp/install-getnonfreefonts; sudo texlua /tmp/install-getnonfreefonts; 
```

Após a instalação, basta usar o seguinte comando para verificar a situaçao das fontes pagas no sistema:

```bash
$ getnonfreefonts --user|--sys --lsfonts
```

> Obs: A opção --user faz a busca pelas fontes instalada apenas para o usuário atual, --sys para as fontes globais do sistema.

Para instalar a fonte Arial, use o comando:


```bash
$ getnonfreefonts --user arial-urw # para instalar somente para o usuário atual
$ sudo getnonfreefonts --sys arial-urw # para instalar globalmente no sistema
```


## Documento básico

https://pt.overleaf.com/learn/latex/Bold,_italics_and_underlining

## Configurando fontes

Para listar as fontes disponíveis:

```bash
$ fc-list | grep texmf
```
