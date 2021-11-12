# Desafio Tecnico Innovare Pesquisa

A descrição do desafio é a seguinte:

*Nossos entrevistadores ligaram para clientes da Empresa X e aplicaram o questionário anexo.
O questionário traz instruções de pulo para o entrevistador dependendo das respostas recebidas.
Por exemplo, se na pergunta 1 uma pessoa diz não ter celular, o entrevistador deve pular para a
pergunta 7, porque não faz sentido aplicar as perguntas 2 a 6 para pessoas que não tenham
celular.
Depois de finalizadas todas as entrevistas, elas foram digitadas num arquivo Excel. Esse arquivo
é enviado para a área de programação, que deve consistir os dados para detectar possíveis erros
no preenchimento de algum questionário.
Você precisa importar os dados do arquivo Excel (também anexado) para um banco de dados
MySQL e escrever um código em PHP que percorra todos os questionários e imprima na tela
qualquer problema encontrado.*

**Exemplo de um problema:** *uma pessoa que não tem telefone celular (v1=2) respondeu à
pergunta 2. Ou então o contrário: uma pessoa que tem celular não respondeu à pergunta 2. Na
tela, deve aparecer o ID do questionário e o problema encontrado. Além de verificações desse
tipo (se os pulos do questionário foram seguidos), também é possível implementar verificações
de respostas que estão devidamente preenchidas, mas que não façam sentido.*

*A pergunta 9 tem um formato que pode ser complicado de entender, então vou dar alguns
exemplos do preenchimento:*

Tem conta no Facebook e no Twitter 
| v9  | 1 |
|-----|---|
| v10 | 1 |
| v11 | 2 |
| v12 | 2 |
| v13 | 2 |

Não tem conta em nenhuma rede social
| v9  | 2 |
|-----|---|
| v10 | 2 |
| v11 | 2 |
| v12 | 2 |
| v13 | 2 |

Tem conta em todas as redes sociais da lista e no Google Plus, que entra como "Outra"
| v9  | 1 |
|-----|---|
| v10 | 1 |
| v11 | 1 |
| v12 | 1 |
| v13 | 1 |
