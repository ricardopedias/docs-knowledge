# GitHUB

## Github Pages

O GitHub Pages tem o objetivo hospedar sites de documentação de softwares, mas também oferece a possibilidade de hospedar gratuitamente 
um site pessoal contendo sua atividade profissional.

Para tanto, é necessário criar um repositorio contendo o nome de usuário de sua conta do github.
Por exemplo, se o seu nome de usuário for "fulanobral", o repositório do site deve se chamar:

```
fulanobral.github.io
```

Criado o repositório, basta acessá-lo pelo github e clicar em Settings.
No bloco chamado "GitHub Pages", basta selecionar onde estarão os arquivos usados para o site.

Acessando http://fulanobral.github.io, será exibido o conteúdo do site.
Agora, basta clonar o repositório, fazer as modificações e adicionar os arquivos necessários para que fiquem publicos na internet.

## Domonio para o Github Pages (Registro.br)

O Registro.br é um serviço de DNS, e assim como outros serviços do gênero, com ele você pode comprar um domínio. Por exemplo, eu comprei o domínio rafael.picanco.nom.br para personalizar os domínios gratuitos oferecidos pelo GitHub Pages (cpicanco.github.io e cpicanco.github.com). Essa personalização exigiu que eu configurasse o Registro.br de acordo com as instruções e recomendações do GitHub Pages.

    O Registro.br é o departamento do NIC.br responsável pelas atividades de registro e manutenção dos nomes de domínios que usam o .br. Também executamos o serviço de distribuição de endereços IPv4 e IPv6 e de números de Sistemas Autônomos (ASN) no país. “http://www.registro.br/sobre/”

Configurar o Registro.br

Uma das recomendações mais úteis foi a de personalizar um subdomínio do Registro.br como domínio do GitHub Pages afim de tomar vantagem do CDN do GitHub Pages. Por exemplo, personalizar com este sub.dominío.exemplo.br que refere-se a este dominío.exemplo.br. Na prática, isso significou maior facilidade de compartilhar conteúdos de mídia (fotos e vídeos) nas redes sociais. O Facebook, por exemplo, possui diretrizes rigorosas para a entrega de conteúdos de mídia por meio do Open Graph. Para mais informações confira as instruções oficiais.
Pré-requisitos

Pois bem, após criar uma página no GitHub Pages e comprar o tal domínio (pré-requisitos para os passos seguintes), como configurá-lo no Registro.br?
Passo 1

Na sua página no GitHub (ou por meio de comandos git em um terminal), caso ainda não tenha feito isto, crie um novo arquivo chamado CNAME na raiz do seu diretório.
Passo 2

Adicione apenas uma linha nesse arquivo com o sub.dominío.exemplo.br de sua preferência. O subdomínio que eu escolhi, por exemplo, foi www.rafael.picanco.nom.br. Caso ainda tenha dúvidas, siga as instruções do GitHub Pages. O blog do Willian Justen também pode ajudar.
Passo 3

Faça login na sua conta no Registro.br.
Passo 4

Clique sobre o domínio de sua preferência:

Registro.br > Domínios - Página inicial
Passo 5

Clique sobre Editar Zona:

Registro.br > Domínios - Editar Zona


Passo 6

Adicione os seguintes registros:

    o seu dominío.exemplo.br deve receber dois registros A (apex) com os ip’s dos servidores do GitHub Pages (192.30.252.153 e 192.30.252.154);

    o seu sub.dominío.exemplo.br deve receber um registro CNAME com o nome da suapágina.github.io no GitHub Pages.

As minhas configurações ficaram assim:

ricardopdias.com.br 	A 	192.30.252.153
ricardopdias.com.br 	A 	192.30.252.154
www.ricardopdias.com.br 	CNAME 	ricardopedias.github.io

Registro.br > Domínios - Edição de Zona
Passo 7

Tudo Pronto! Para conferir os efeitos, aguarde o tempo recomendado pelo Registro.br (de 24h) para a atualização dos servidores e propagação das novas configurações.
