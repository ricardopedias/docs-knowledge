[Voltar para Lista de Opções](../readme.md)

# Software Git

# 1 Submetendo alterações

Para submeter todas as alterações ao Repositório online:

## 1.1. Como usuário padrão:

```
git add -A
git commit -m "Meu comentário para as alterações"
git push origin master
```
## 1.2. Como outro usuário:

```
git add -A
git commit -m "Meu comentário para as alterações"
git push https://ricardopereira@meudominio.com.br/projeto/repositorio.git master
```

# 2. Baixando Atualizações

Para baixar as atualizações do repositório online:

## 2.1. Como usuário padrão:

```
git pull origin master
```

## 2.2. Como outro usuário:

```
git pull https://ricardopereira@meudominio.com.br/projeto/repositorio.git master
```

# 3. Sincronizando

Deixando o repositório local idêntico ao repositório online:

```
git fetch origin
git reset --hard origin/master
```

Para remover os arquivos locais

```
git clean -f
```

Para ver os arquivos a serem removidos, sem removê-los:

```
git clean -n -f
```

# 4. Revertendo

Para voltar o repositório para um commit especifico:

```
git checkout 0e583fd
git push origin 0e583fd:master --force
```


[Voltar para Lista de Opções](../readme.md)