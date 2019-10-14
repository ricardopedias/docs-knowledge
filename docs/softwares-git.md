[Voltar para Lista de Opções](../readme.md)

# Software Git
---------------------------------------------------

# 1. Instalando

## 1.1. Instalando no Windows

Faça o download e instale de http://msysgit.github.io/. Após a instalação, acesse o *Git Bash* e será aberto um terminal, com o prompt de comando.

## 1.2. Instalando no Mac

Faça o download e instale de https://code.google.com/p/git-osx-installer/downloads. Após a instalação, abra um terminal e o git estará disponível.

## 1.3. Instalando no Linux

Para instalar o *Git* no Ubuntu, ou em uma outra distribuição baseada em Debian, execute no terminal:

```
$ sudo apt-get install git
```

Para as demais distribuições do Linux, veja o comando em http://git-scm.com/download/linux

# 2. Configurando

## 2.1. Configurando o usuário 

Para que seja possível enviar arquivos (commit) para um repositório, é preciso configurar o usuário no git.
As informações deste usuário aparecerão no histórico de envios e servem para identificar quem foi o autor de determinada funcionalidade ou correção submetida ao repositório.

Isso pode ser feito de duas maneiras:

### 2.1.1. Globalmente

Significa que este usuário será usado por padrão para todos os repositórios criados com git:

```
$ git config --global user.name "Nome do Usuário Padrão"
$ git config --global user.email usuario.padrao@gmail.com
```

### 2.1.2. Localmente

Significa que este usuário estará disponível apenas para um repositório específico, sobrescrevendo as informações de usuário padrão configuradas globalmente (ver item 2.1.1). É preciso que o diretório */home/ricardo/projeto* seja um repositório do git:

```
$ cd /home/ricardo/projeto
$ git config user.name "Nome do Usuário"
$ git config user.email usuario@gmail.com
```

Estas informações são gravadas no arquivo */caminho/ate/meu/repositorio/.git/config*:

```
[user]
	email = usuario@gmail.com
	name = Nome do Usuário
```

# 3. Repositório

## 3.1. Criando repositório

Para transformar um diretório qualquer em um repositório local do Git, basta executar o comando `git init`:

```
$ cd /home/ricardo/projeto
$ git init
Initialized empty Git repository in /home/ricardo/projeto/.git/
```

Pronto, o projeto já é um repositório local vazio. Observe que foi criada uma pasta oculta com o nome *.git*. Nela estão todos os arquivos necessários para o repositório local funcionar.

```
$ cd /home/ricardo/projeto
$ ls -la
total 11
drwxr-xr-x  3 ricardo ricardo 4096 jan 21 13:29 .
drwxr-xr-x 32 ricardo ricardo 4096 jan 21 13:50 ..
drwxr-xr-x  7 ricardo ricardo 4096 jan 21 13:29 .git
```

Para sincronizar com o repositório remoto, após adicionar arquivos ao repositório local, usa-se o comando `git remote`:

```
$ cd /home/ricardo/projeto
$ git config user.name "Nome do Usuário" // Seta o nome usuário
$ git config user.email usuario@gmail.com // seta o email do usuaŕio
$ touch README.md // cria um arquivo README.md vazio
$ git add README.md // adiciona à área de rastreio
$ git commit -m "first commit" // adiciona ao repositório local
$ git remote add origin https://github.com/rpdesignerfly/git-test.git // seta a origem do repositório remoto
$ git push -u origin master // sincroniza com o repositório remoto
```

## 3.2. Removendo repositório

Para remover um repositório local, basta apagar o diretório */home/ricardo/projeto/.git* e o projeto deixará de ser um repositório para tornar-se um diretório comum.

```
$ cd /home/ricardo/projeto
$ rm -Rf .git
$ git status
fatal: not a git repository (or any of the parent directories): .git
```

## 3.3. Listando conteúdo do repositório

Para listar os arquivos que se encontram no repositório usa-se `git ls-files`
Apenas os arquivos que estejam em *Staged*, *Committed* ou *Pushed* serão listados:

```
$ git ls-files
```

## 3.4. Vendo status do repositório

Podemos ver a situação geral dos arquivos no repositório local com o comando *git status*:

```
$ git status
No ramo master
No commits yet
nada para enviar (crie/copie arquivos e use "git add" para registrar)
```

## 3.5. Vinculando repositórios

Para exibir os repositórios remotos vinculados:

```
$ git remote
$ git remote -v
```

Para vincular o repositório local com um remoto

```
$ git remote add origin git@github.com:leocomelli/curso-git.git
```
	
Para exibir informações dos repositórios remotos

```
$ git remote show origin
```

Para renomear um repositório remoto vinculado

```
$ git remote rename origin curso-git
```

Para desvincular um repositório remoto
	
```
$ git remote rm curso-git
```

# 4. Gerindo arquivos

Os arquivos de um repositório possuem quatro estados:

| Ordem | Estado        | Descrição                                                                         |
|:-----:|:-------------:|-----------------------------------------------------------------------------------|
| 1.    | **Unstaged**  | arquivo que foi salvo dentro do diretório, mas ainda não é rastreado pelo Git     |
| 2.    | **Staged**    | arquivo novo que está sendo rastreado pelo Git localmente                         |
| 3.    | **Committed** | arquivo foi enviado para dentro do repositório local                                      |
| 4.    | **Pushed**    | arquivo foi enviado para dentro do repositório remoto                                     |

## 4.1. Rastreando (Stage)

Para adicionar um arquivo não rastreado (Unstaged) ao rastreio (Staged) do repositório local:

```
$ git add heroes/ironman.txt // adiciona um único arquivo
$ git add heroes // adiciona um diretório com seus arquivos
$ git add . // adiciona todos os arquivos não rastreados
$ git add -A // adiciona todos os arquivos não rastreados
```

## 4.2. Não-rastrear (Unstage)

Para remover o rastreio (Staged) de um arquivo do repositório local:

```
$ git reset heroes/ironman.txt // remove o rastreio de um único arquivo
$ git reset heroes // remove o rastreio de um diretório com seus arquivos
$ git reset // remove o rastreio de todos os arquivos
```

## 4.3. Envio local (Commit)

Para enviar o conteúdo rastreado (Staged) no repositório local:

```
$ git commit -m "Meu comentario bem legal" // Adicionando ao repo local
$ git commit -a -m "Meu comentario bem legal" // Adicionando no stagged e em seguida ao repo local
```

## 4.4. Envio remoto (Push)

Para enviar o novo conteúdo do repositório local para o repositório remoto:

```
$ git push // envia todas as alterações locais do branch atual
$ git push origin master // envia todas as alterações locais efetuadas no branch "master"
$ git push origin meu-branch // envia todas as alterações locais efetuadas no branch "meu-branch"
```

## 4.5. Recebimento de atualizações (Pull)

Para baixar o novo conteúdo do repositório remoto para o repositório local:

```
$ git pull // Baixa todas as alterações remotas do branch atual
$ git pull origin master // Baixa todas as alterações remotas efetuadas no branch "master"
$ git pull origin meu-branch // Baixa todas as alterações remotas efetuadas no branch "meu-branch"
```

> Obs: o comando `git-pull` na verdade é um atalho para `git fetch` seguido e um `git merge`.

## 4.6. Renomeando/movendo arquivos

Para renomear ou mover um arquivo de lugar no repositório local:

```
git mv estilos.css principal.css // renomeia o arquivo
git mv principal.js js/principal.js // move o arquivo para outro diretório
```

## 4.7. Excluido arquivos/diretórios versionados

Para remover um arquivo do repositório local:

```
$ git rm heroes/ironman.txt // remove um único arquivo
$ git rm -r heroes // remove um diretório com seus arquivos
```

Para excluir completamente todo o histórico de um arquivo:

```
git filter-branch --tree-filter 'rm -f passwords.txt' HEAD
```

## 4.8. Excluido arquivos não rastreados

Para remover os arquivos locais

```
git clean -f
```

Para ver os arquivos a serem removidos, sem removê-los:

```
git clean -n -f
```

# 5. Gerindo Commits

## 5.1. Logs de envio

Para ver os envios efetuados (um por um) usa-se o comando `git log`.

```
$ cd /home/ricardo/projeto
$ git log                            // lista completa 
$ git log -n 2                       // últimos dois logs do branch
$ git log --stat                     // resumo
$ git log --oneline                  // lista completa, um em cada linha
$ git log --graph --oneline --all    // lista em forma de árvore
$ git log --pretty=format:"%h %s"    // lista bem compacta
$ git blame -L 12,22 meu_arquivo.txt // revisão e autor da última modificação
```

Variáveis para --pretty:

* %h: Abreviação do hash;
* %an: Nome do autor;
* %ar: Data;
* %s: Comentário.

Verifique as demais opções de formatação no [Git Book](http://git-scm.com/book/en/Git-Basics-Viewing-the-Commit-History)


## 5.2. Desfazendo commits

### 5.2.1. Desfazendo e movendo arquivos desfeitos para rastreio (Stage)

Para desfazer envios e voltá-los para a área de rastreio, usa-se o `git reset --soft`:

```
$ git reset --soft HEAD~1 // desfaz o último commit
$ git reset --soft HEAD~2 // desfaz os dois últimos commits
$ git reset --soft 96c6d893128f338f6a4b02b98f6ca47467f81dbb // desfaz todos os commits a partir do hash
$ git reset --soft v1.0 // desfaz todos os commits a partir da tag
```

> Obs: caso repositório local não tenha sido sincronizado pelo menos uma vez com o repositório remoto (`git push, git pull ou git fetch`), HEAD\~1, HEAD\~2, etc, deverão ser substituidos por HEAD@{1}, HEAD@{2}, etc.

> Obs 2: para ver uma lista com os HEADs de desfazer, basta usar o comando caso `git reflog`.

### 5.2.2. Desfazendo e descartando as modificações

Para desfazer envios e descartar todas as modificações contidas neles, usa-se o `git reset --hard`:

```
$ git reset --hard HEAD~1 // descarta o último commit
$ git reset --hard HEAD~2 // descarta os dois últimos commits
$ git reset --hard 96c6d893128f338f6a4b02b98f6ca47467f81dbb // descarta todos os commits a partir do hash
$ git reset --hard v1.0 // descarta todos os commits a partir da tag
$ git reset --hard origin master // descarta as alterações locais do branch "master"
```

Caso as alterações tiverem sido efetuadas em um arquivo que exista no repositório remoto, ele deverá ser atualizado de maneira "forçada". Para efetivar as mudanças no repositório remoto:

```
$ git push --force // força a atualização do branch atual
$ git push origin master --force // força a atualização do branch master
$ git push origin meu-branch --force // força a atualização do branch meu-branch
```

## 5.3. Editando mensagens

### 5.3.1. Do último commit

Para editar a mensagem do último commit efetuado:

```
$ git commit --amend -m 'Minha nova mensagem'
```

### 5.3.2. De um commit arbitrário

Para editar as mensagens de quaisquer commits:

**Etapa 1: escolher os commits**

```
$ git rebase -i HEAD~2 // escolher a partir do penúltimo comit
$ git rebase -i 96c6d893128f338f6a4b02b98f6ca47467f81dbb // escolher a partir do hash
$ git rebase -i 96c6d89 // escolher a partir do hash diminuto
$ git rebase -i v1.0 // escolher a partir da tag
```

Qualquer um dos comandos acima irá abrir o arquivo *.git/rebase-merge/git-rebase-todo* em um editor de textos. Este arquivo irá conter a lista de commits efetuados a partir da marcação especificada (HEAD\~2, 96c6d89 ou v1.0). Abaixo, um exemplo desta lista:

```
pick 96c6d89 add spidey
pick 756d95e add war
pick fcb9cf0 add thor
```

Por padrão, os commits estarão todos marcados como *pick*. Nos commits que se deseja editar, no lugar de *pick*, escreva *reword* ou simplesmente *r* e salve o arquivo sem renomeá-lo.

```
pick 96c6d89 add spidey
reword 756d95e add war
reword fcb9cf0 add thor
```


**Etapa 2: editar os commits**

No ato de salvar o arquivo *git-rebase-todo*, o editor de textos se abrirá novamente, agora no arquivo *.git/COMMIT_EDITMSG*, contendo a mensagem do primeiro commit selecionado. Basta editar esta mensagem e salvar o arquivo sem renomeá-lo para aplicar no repositório.

Ao salvar a primeira mensagem, se mais de um commit tiver sido marcado com *reword*, a mensagem do próximo commit se abrirá para edição no arquivo *.git/COMMIT_EDITMSG*. Basta repetir o mesmo processo até acabarem os commits.

Após todos os commits serem editados, uma mensagem parecida com essa aparecerá:

```
[detached HEAD 8bafbbe] add war hehe
 Date: Wed Jan 23 12:58:06 2019 -0200
 2 files changed, 0 insertions(+), 0 deletions(-)
 create mode 100644 visao.txt
 create mode 100644 warmachine.txt
[detached HEAD 1003960] add thor hehe
 1 file changed, 0 insertions(+), 0 deletions(-)
 create mode 100644 thor.txt
Successfully rebased and updated refs/heads/master.
```

## 5.4. Vendo alterações no codigo (baseando em commits)

Para analisar as mudanças ocorridas usa-se o comando *git diff*.

Para ver o código alterado até um determinado commit ou branch:

```
$ cd /home/ricardo/projeto
$ git diff c32fdd0 // mudanças até o commit c32fdd0
```

Para ver o nome dos arquivos alterados até um determinado commit ou branch:

```
$ cd /home/ricardo/projeto
$ git diff --name-only c32fdd0 // todos os arquivos até o commit c32fdd0
```

# 6. Gerindo Branchs

## 6.1. Listando branchs existentes

```
$ git branch
```

## 6.2. Usando um branch local

```
$ git checkout 7777
```

## 6.3. Usando um branch remoto

```
$ git checkout -t origin/7777
```
ou

```
git checkout -b 7777 origin/7777
```

## 6.4. Criando um novo branch

Para criar um branch, é preciso usar o comando abaixo.
O branch atual será copiado para o novo branch.

```
$ git checkout 7777 <- seta o branch atual como 7777
$ git branch 9999   <- faz uma cópia do branch 7777 e chama-o de 9999
$ git checkout 9999 <- seta o branch atual como 999
```

ou 

```
$ git checkout 7777 <- seta o branch atual como 7777
$ git branch 9999 07aeec983bfc17c25f0b0a7c1d47da8e35df7af8  <- faz uma cópia do branch 7777 no commit 07aeec...
$ git checkout 9999 <- seta o branch atual como 999
```

ou

```
$ git checkout 7777    <- seta o branch atual como 7777
$ git checkout -b 9999 <- faz uma cópia do branch 7777, chama-o de 9999 e seta-o como branch atual
```

ou

```
$ git checkout 7777    <- seta o branch atual como 7777
$ git checkout -b 9999 07aeec983bfc17c25f0b0a7c1d47da8e35df7af8 <- faz uma cópia do branch 7777 no commit 07aeec...
```


## 6.5. Enviando um branch para o repositório remoto

```
$ git push --set-upstream origin 9999
```

## 6.6. Unindo dois branchs (merge)

```
$ git checkout 7777 <- seta o branch atual como 7777
$ git merge 9999    <- pega o branch 9999 e juna-o dentro de 7777
```

Para realizar o *merge*, é necessário estar no branch que deverá receber as alterações. O *merge* pode automático ou manual. O merge automático será feito em arquivos textos que não sofreram alterações nas mesmas linhas, já o merge manual será feito em arquivos textos que sofreram alterações nas mesmas linhas.

A mensagem indicando um *merge* manual será:

	Automerging meu_arquivo.txt
	CONFLICT (content): Merge conflict in meu_arquivo.txt
	Automatic merge failed; fix conflicts and then commit the result.

## 6.7. Excluindo um branch local

```
$ git branch -D modulo_9999
```

## 6.8. Excluindo um branch remoto

```
$ git push origin modulo_9999 --delete 
```

## 6.9. Vendo alterações no codigo (baseando em branchs)

Para analisar as mudanças ocorridas usa-se o comando *git diff*.

Para ver o código alterado até um determinado commit ou branch:

```
$ cd /home/ricardo/projeto
$ git diff branch-original...meu-branch // mudanças contidas em um branch em relação ao branch que o originou
```

Para ver o nome dos arquivos alterados até um determinado commit ou branch:

```
$ cd /home/ricardo/projeto
$ git diff --name-only master...meu-branch // todos os arquivos até o branch 'meu-branch' em relação ao branch 'master'
```

Para ver apenas os arquivos alterados pelo branch especificado:

```
$ first_commit=$(diff -u <(git rev-list --first-parent meu-branch) <(git rev-list --first-parent master) | sed -ne 's/^ //p' | head -1); // encontra o primeiro commit feito no branch 'meu-branch'
$ git diff --name-only $first_commit...meu-branch // apenas os arquivos mudados pelo branch 'meu-branch'
```


# 7. Gerindo Tags

## 7.1. Criando uma tag leve

```
$ git tag v1.1
```

## 7.2. Criando uma tag anotada

```
$ git tag -a v1.1 -m "Minha versão 1.1"
```

## 7.3 Criando uma tag assinada

Para criar uma tag assinada é necessário uma chave privada (GNU Privacy Guard - GPG).

```
$ git tag -s v1.1 -m "Minha tag assinada 1.1"
```

## 7.4 Criando tag a partir de um commit (hash)

```
git tag -a v1.2 9fceb02
```
	
## 7.5 Criando tag no repositório remoto

```
$ git push origin v1.2
```
	
## 7.6. Criando todas as tags locais no repositório remoto

```
$ git push origin --tags
```

## 7.7. Removendo tag local

```
$ git tag -d v4.3.4
ou
$ git tag --delete v4.3.4
```

## 7.8. Removendo tag remota

```
$ git push --delete origin v4.3.4
ou
$ git push origin :tagname
```


# 8. Bisect

O bisect (pesquisa binária) é útil para encontrar um commit que esta gerando um bug ou uma inconsistência entre uma sequência de commits.

## 8.1. iniciar pequinsa binária

```
$ git bisect start
```
	
## 8.2. Marcar o commit atual como ruim

```
$ git bisect bad
```

## 8.3. Marcar o commit de uma tag que esta sem o bug/inconsistência

```
$ git bisect good v1.1
```

## 8.4. Marcar o commit como bom

O GIT irá navegar entre os commits para ajudar a indentificar o commit que esta com o problema. Se o commit atual não estiver quebrado, então é necessário marcá-lo como **bom**.

```
$ git bisect good
```

## 8.5. Marcar o commit como ruim

Se o commit estiver com o problema, então ele deverá ser marcado como **ruim**.

```
$ git bisect bad
```
 
## 8.6. Finalizar a pesquisa binária

Depois de encontrar o commit com problema, para retornar para o *HEAD* utilize:

```
$ git bisect reset
```



[Voltar para Lista de Opções](../readme.md)
