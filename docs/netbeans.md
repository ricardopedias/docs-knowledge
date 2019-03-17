# Netbeans

Este fato parece ser um problema básico que ocorre em todas as aplicações Java. De qualquer forma, aqui está a solução para o NetBeans (pra outras aplicações não sei se posso ajudar):

No diretório de instalação do NetBeans, em etc há um arquivo netbeans.conf, procure e abra ele pra edição pois nele vamos achar uma linha começando com netbeans_default_options=" …

Dentro das aspas, adicionar estas opções no final da linha:

    -J-Dswing.aatext=TRUE -J-Dawt.useSystemAAFontSettings=on

Salve o arquivo, reinicie o NetBeans, e você deve ter bom fontes suavizadas. Eu sugiro usar uma fonte monoespaçada agradável como Droid Sans Mono ou mesmo a Monaco.
