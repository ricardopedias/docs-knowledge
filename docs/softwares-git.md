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

Estas informações são graavdas no arquivo */caminho/ate/meu/repositorio/.git/config*:

```
[user]
	email = usuario@gmail.com
	name = Nome do Usuário
```

# 3. Repositório

## 3.1. Criando

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

## 3.2. Removendo

Para remover um repositório local, basta apagar o diretório */home/ricardo/projeto/.git* e o projeto deixará de ser um repositório para tornar-se um diretório comum.

```
$ cd /home/ricardo/projeto
$ rm -Rf .git
$ git status
fatal: not a git repository (or any of the parent directories): .git
```

## 3.3. Listando conteúdo

Para listar os arquivos que se encontram no repositório usa-se `git ls-files`
Apenas os arquivos que estejam em *Staged*, *Committed* ou *Pushed* serão listados:

```
$ git ls-files
```

## 3.4. Vendo Status

Podemos ver a situação geral dos arquivos no repositório local com o comando *git status*:

```
$ git status
No ramo master
No commits yet
nada para enviar (crie/copie arquivos e use "git add" para registrar)
```

# 4. Gerindo Arquivos

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

## 4.2. Não-rastreando (Unstage)

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

## 4.7. Excluido arquivos

Para remover um arquivo do repositório local:
```
$ git rm heroes/ironman.txt // remove um único arquivo
$ git rm heroes // remove um diretório com seus arquivos
```

# 5. Gerindo Commits

## 5.1. Logs de envio

Para ver os envios efetuados (um por um) usa-se o comando `git log`.

```
$ cd /home/ricardo/projeto
$ git log // lista completa 
$ git log -n 2 // últimos dois logs do branch
$ git log --oneline // lista completa, um em cada linha
$ git log --graph --oneline --all // lista em forma de árvore
$ git log --pretty=format:"%h %s" // lista bem compacta
```

## 5.2. Desfazendo commits

### 5.2.1. Voltando os arquivos modificados para rastreio (Stage)

Para desfazer envios e voltá-los para a área de rastreio, usa-se o `git reset --soft`:

```
$ git reset --soft HEAD~1 // desfaz o último commit
$ git reset --soft HEAD~2 // desfaz os dois últimos commits
$ git reset --soft 96c6d893128f338f6a4b02b98f6ca47467f81dbb // desfaz todos os commits a partir do hash
$ git reset --soft v1.0 // desfaz todos os commits a partir da tag
```

> Obs: caso repositório local não tenha sido sincronizado pelo menos uma vez com o repositório remoto (`git push, git pull ou git fetch`), HEAD\~1, HEAD\~2, etc, deverão ser substituidos por HEAD@{1}, HEAD@{2}, etc.

> Obs 2: para ver uma lista com os HEADs de desfazer, basta usar o comando caso `git reflog`.

### 5.2.2. Descartando as modificações

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

### 3.4.9. Sincronizando

Para sincronizar o histórico recente do repositorio remoto:

```
$ git fetch // Baixa o historico inteiro
$ git fetch origin master // Baixa o histórico remoto no branch "master"
$ git fetch origin meu-branch // Baixa o histórico remoto no branch "meu-branch"
```

Se o repositório local estiver a frente do remoto e desejar descartar as alterações locais:

```
$ git reset --hard // Descarta todas as alterações locais
$ git reset --hard origin master // Descarta as alterações locais do branch "master"
$ git reset --hard origin meu-branch // Descarta as alterações locais do branch "meu-branch"
```

# 4. Repositório (Avançado)


## 3.3. Verificando mudanças




### 3.3.3. Git Diff (ver alterações no codigo)

Para analisar as mudanças ocorridas usa-se o comando *git diff*.

Para ver o código alterado até um determinado commit ou branch:

```
$ cd /home/ricardo/projeto
$ git diff c32fdd0 // mudanças até o commit c32fdd0
$ git diff branch-original...meu-branch // mudanças contidas em um branch em relação ao branch que o originou
```

Para ver o nome dos arquivos alterados até um determinado commit ou branch:

```
$ cd /home/ricardo/projeto
$ git diff --name-only c32fdd0 // todos os arquivos até o commit c32fdd0
$ git diff --name-only master...meu-branch // todos os arquivos até o branch 'meu-branch' em relação ao branch 'master'
```

Para ver apenas os arquivos alterados pelo branch especificado:

```
$ first_commit=$(diff -u <(git rev-list --first-parent meu-branch) <(git rev-list --first-parent master) | sed -ne 's/^ //p' | head -1); // encontra o primeiro commit feito no branch 'meu-branch'
$ git diff --name-only $first_commit...meu-branch // apenas os arquivos mudados pelo branch 'meu-branch'
```


## 4.1. Criando Branchs


|||||||||||||||||||||||||||||||||





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


#GIT

## Estados

* Modificado (modified);
* Preparado (staged/index)
* Consolidado (comitted);

## Ajuda

##### Geral
	git help
	
##### Comando específico
	git help add
	git help commit
	git help <qualquer_comando_git>
	

## Configuração

### Geral

As configurações do GIT são armazenadas no arquivo **.gitconfig** localizado dentro do diretório do usuário do Sistema Operacional (Ex.: Windows: C:\Users\Documents and Settings\Leonardo ou *nix /home/leonardo).

As configurações realizadas através dos comandos abaixo serão incluídas no arquivo citado acima.

##### Setar usuário
	git config --global user.name "Leonardo Comelli"

##### Setar email
	git config --global user.email leonardo@software-ltda.com.br
	
##### Setar editor
	git config --global core.editor vim
	
##### Setar ferramenta de merge
	git config --global merge.tool vimdiff

##### Setar arquivos a serem ignorados
	git config --global core.excludesfile ~/.gitignore

##### Listar configurações
	git config --list

### Ignorar Arquivos

Os nomes de arquivos/diretórios ou extensões de arquivos listados no arquivo **.gitignore** não serão adicionados em um repositório. Existem dois arquivos .gitignore, são eles:

* Geral: Normalmente armazenado no diretório do usuário do Sistema Operacional. O arquivo que possui a lista dos arquivos/diretórios a serem ignorados por **todos os repositórios** deverá ser declarado conforme citado acima. O arquivo não precisa ter o nome de **.gitignore**.

* Por repositório: Deve ser armazenado no diretório do repositório e deve conter a lista dos arquivos/diretórios que devem ser ignorados apenas para o repositório específico.

## Repositório Local

### Criar novo repositório

	git init

### Verificar estado dos arquivos/diretórios

	git status

### Adicionar arquivo/diretório (staged area)

##### Adicionar um arquivo em específico

	git add meu_arquivo.txt

##### Adicionar um diretório em específico

	git add meu_diretorio

##### Adicionar todos os arquivos/diretórios
	
	git add .	
	
##### Adicionar um arquivo que esta listado no .gitignore (geral ou do repositório)
	
	git add -f arquivo_no_gitignore.txt
	
### Comitar arquivo/diretório

##### Comitar um arquivo
	
	git commit meu_arquivo.txt

##### Comitar vários arquivos

	git commit meu_arquivo.txt meu_outro_arquivo.txt
	
##### Comitar informando mensagem

	git commit meuarquivo.txt -m "minha mensagem de commit"

### Remover arquivo/diretório

##### Remover arquivo

	git rm meu_arquivo.txt

##### Remover diretório

	git rm -r diretorio

### Visualizar hitórico

##### Exibir histórico
	
	git log
	
##### Exibir histórico com diff das duas últimas alterações

	git log -p -2
	
##### Exibir resumo do histórico (hash completa, autor, data, comentário e qtde de alterações (+/-))

	git log --stat
	
##### Exibir informações resumidas em uma linha (hash completa e comentário)

	git log --pretty=oneline
	
##### Exibir histórico com formatação específica (hash abreviada, autor, data e comentário)

	git log --pretty=format:"%h - %an, %ar : %s"
	
* %h: Abreviação do hash;
* %an: Nome do autor;
* %ar: Data;
* %s: Comentário.

Verifique as demais opções de formatação no [Git Book](http://git-scm.com/book/en/Git-Basics-Viewing-the-Commit-History)

##### Exibir histório de um arquivo específico

	git log -- <caminho_do_arquivo>

##### Exibir histórico de um arquivo específico que contêm uma determinada palavra

	git log --summary -S<palavra> [<caminho_do_arquivo>]

##### Exibir histórico modificação de um arquivo

	git log --diff-filter=M -- <caminho_do_arquivo>

* O <D> pode ser substituido por: Adicionado (A), Copiado (C), Apagado (D), Modificado (M), Renomeado (R), entre outros.

##### Exibir histório de um determinado autor

	git log --author=usuario

##### Exibir revisão e autor da última modificação de uma bloco de linhas

	git blame -L 12,22 meu_arquivo.txt 

### Desfazendo operações

##### Desfazendo alteração local (working directory)
Este comando deve ser utilizando enquanto o arquivo não foi adicionado na **staged area**. 

	git checkout -- meu_arquivo.txt

##### Desfazendo alteração local (staging area)
Este comando deve ser utilizando quando o arquivo já foi adicionado na **staged area**.

	git reset HEAD meu_arquivo.txt

Se o resultado abaixo for exibido, o comando reset *não* alterou o diretório de trabalho. 

	Unstaged changes after reset:
	M	meu_arquivo.txt

A alteração do diretório pode ser realizada através do comando abaixo:
	
	git checkout meu_arquivo.txt

## Repositório Remoto

### Exibir os repositórios remotos

	git remote
	
	git remote -v

### Vincular repositório local com um repositório remoto

	git remote add origin git@github.com:leocomelli/curso-git.git
	
### Exibir informações dos repositórios remotos

	git remote show origin
	
### Renomear um repositório remoto 

	git remote rename origin curso-git
	
### Desvincular um repositório remoto
	
	git remote rm curso-git

### Enviar arquivos/diretórios para o repositório remoto

O primeiro **push** de um repositório deve conter o nome do repositório remoto e o branch.

	git push -u origin master
	
Os demais **pushes** não precisam dessa informação

	git push
	

### Atualizar repositório local de acordo com o repositório remoto

##### Atualizar os arquivos no branch atual

	git pull
	
##### Buscar as alterações, mas não aplica-las no branch atual

	git fecth
	
### Clonar um repositório remoto já existente

	git clone git@github.com:leocomelli/curso-git.git
	
### Tags

##### Criando uma tag leve

	git tag vs-1.1

##### Criando uma tag anotada

	git tag -a vs-1.1 -m "Minha versão 1.1"

##### Criando uma tag assinada
Para criar uma tag assinada é necessário uma chave privada (GNU Privacy Guard - GPG).

	git tag -s vs-1.1 -m "Minha tag assinada 1.1"

##### Criando tag a partir de um commit (hash)

	git tag -a vs-1.2 9fceb02
	
##### Criando tags no repositório remoto

	git push origin vs-1.2
	
##### Criando todas as tags locais no repositório remoto

	git push origin --tags
	
### Branches

O **master** é o branch principal do GIT.

O **HEAD** é um ponteiro *especial* que indica qual é o branch atual. Por padrão, o **HEAD** aponta para o branch principal, o **master**.

##### Criando um novo branch

	git branch bug-123
	
##### Trocando para um branch existente

	git checkout bug-123
	
Neste caso, o ponteiro principal **HEAD** esta apontando para o branch chamado bug-123.

##### Criar um novo branch e trocar 

	git checkout -b bug-456
	
##### Voltar para o branch principal (master)

	git checkout master
	
##### Resolver merge entre os branches

	git merge bug-123
	
Para realizar o *merge*, é necessário estar no branch que deverá receber as alterações. O *merge* pode automático ou manual. O merge automático será feito em arquivos textos que não sofreram alterações nas mesmas linhas, já o merge manual será feito em arquivos textos que sofreram alterações nas mesmas linhas.

A mensagem indicando um *merge* manual será:

	Automerging meu_arquivo.txt
	CONFLICT (content): Merge conflict in meu_arquivo.txt
	Automatic merge failed; fix conflicts and then commit the result.


##### Apagando um branch

	git branch -d bug-123

##### Listar branches 

###### Listar branches

	git branch

###### Listar branches com informações dos últimos commits

	git branch -v

###### Listar branches que já foram fundidos (merged) com o **master**

	git branch --merged

###### Listar branches que não foram fundidos (merged) com o **master**

	git branch --no-merged

##### Criando branches no repositório remoto

###### Criando um branch remoto com o mesmo nome

	git push origin bug-123

###### Criando um branch remoto com nome diferente

	git push origin bug-123:new-branch

##### Baixar um branch remoto para edição

	git checkout -b bug-123 origin/bug-123


##### Apagar branch remoto

	git push origin:bug-123

### Rebasing

Fazendo o **rebase** entre um o branch bug-123 e o master.

	git checkout experiment
	
	git rebase master
	

Mais informações e explicações sobre o [Rebasing](http://git-scm.com/book/en/Git-Branching-Rebasing)

###Stash

Para alternar entre um branch e outro é necessário fazer o commit das alterações atuais para depois trocar para um outro branch. Se existir a necessidade de realizar a troca sem fazer o commit é possível criar um **stash**. O Stash como se fosse um branch temporário que contem apenas as alterações ainda não commitadas.

##### Criar um stash
	
	git stash
	
##### Listar stashes

	git stash list

##### Voltar para o último stash

	git stash apply

##### Voltar para um stash específico
	
	git stash apply stash@{2}
	
Onde **2** é o indíce do stash desejado.

##### Criar um branch a partir de um stash

	git stash branch meu_branch

### Reescrevendo o histórico

##### Alterando mensagens de commit

	git commit --amend -m "Minha nova mensagem"

##### Alterar últimos commits
Alterando os três últimos commits

	git rebase -i HEAD~3

O editor de texto será aberto com as linhas representando os três últimos commits.

	pick f7f3f6d changed my name a bit
	pick 310154e updated README formatting and added blame
	pick a5f4a0d added catfile

Altere para edit os commits que deseja realizar alterações.

	edit f7f3f6d changed my name a bit
	pick 310154e updated README formatting and added blame
	pick a5f4a0d added catfile

Feche o editor de texto.

Digite o comando para alterar a mensagem do commit que foi marcado como *edit*.

	git commit –amend -m “Nova mensagem”

Aplique a alteração

	git rebase --continue

**Atenção:** É possível alterar a ordem dos commits ou remover um commit apenas
mudando as linhas ou removendo.


##### Juntando vários commits
Seguir os mesmos passos acima, porém marcar os commtis que devem ser juntados com **squash*
	
##### Remover todo histórico de um arquivo

	git filter-branch --tree-filter 'rm -f passwords.txt' HEAD
	
	
### Bisect
O bisect (pesquisa binária) é útil para encontrar um commit que esta gerando um bug ou uma inconsistência entre uma sequência de commits.

##### Iniciar pequinsa binária

	git bisect start
	
##### Marcar o commit atual como ruim

	git bisect bad

##### Marcar o commit de uma tag que esta sem o bug/inconsistência

	git bisect good vs-1.1

##### Marcar o commit como bom
O GIT irá navegar entre os commits para ajudar a indentificar o commit que esta com o problema. Se o commit atual não estiver quebrado, então é necessário marca-lo como **bom**.

	git bisect good

##### Marcar o commit como ruim
Se o commit estiver com o problema, então ele deverá ser marcado como **ruim**.

 	git bisect bad
 
##### Finalizar a pesquisa binária
Depois de encontrar o commit com problema, para retornar para o *HEAD* utilize:
	
	git bisect reset
 	


[Voltar para Lista de Opções](../readme.md)
