[Voltar para Lista de Opções](../readme.md)

# Comandos Linux

## Versão do Linux

```
cat /etc/issue
```

## Espaço em disco

```
df -h – Ele será exibido em um formato humano melhor e mais legível. Usando este comando, o espaço em disco será mostrado em GB (a menos que seja menor que um GB, então ele será exibido em MB ou mesmo B).
df -m – Pode ser usado para exibir informações de uso do sistema de arquivos em MB.
df -k – Mesmo que o anterior, pode ser usado para exibir informações de uso do sistema de arquivos em KB.
df -T – Esta opção mostrará o tipo de sistema de arquivos (uma nova coluna aparecerá).
df -ht /home – Usando esta opção, você pode exibir informações sobre um sistema de arquivos específico (em um formato legível por humanos).
```
    
## Maiores arquivos /diretórios


```
du -hsx ~/.config/* | sort -rh | head -10
```

Dissecando o comando:

    du -h — quebra os números e os representa na forma de Kb, Mb, Gb etc.
    du -s — apresenta apenas um total sumarizado de cada item.
    du -x — pula os diretórios que, porventura, se encontrem em sistemas de arquivos diferentes.
    sort -r — inverte a ordem de exibição dos valores.
    sort -h — torna mais amigável a exibição da lista.
    head -10 — restringe a exibição da lista aos 10 primeiros itens.
    
    
find . -size +500M

    
sudo apt-get install ncdu

```
$ ncdu
```


[Voltar para Lista de Opções](../readme.md)
