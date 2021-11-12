<!--

    @author: Ítalo Magalhães da Silva
    @contact: italo.ufsj@gmail.com
    @version: 0.1


-->

<!DOCTYPE html>

<!-- Style CSS -->
<style type="text/css">
    table.bordaSimples {
        border-collapse: collapse; 
        background: #FFFFF0;
    }
    
    table.bordaSimples td {
        border: 1px solid black;
    }
    
    table.bordaSimples th {
        border: 1px solid black;
        background: #F0FFF0;
    }
</style>    

<!-- Connectando ao DataBase -->
<?php

    /**Definiçao váriaveis**/
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "desafiotecnico";
    $table = "questionarios";
    $count_steps = 0;
    

    /**Conectando ao Banco de Dados**/
    $mysqli = mysqli_connect($hostname, $username, $password);
    if (!$mysqli) {
        echo "Error: " . mysqli_connect_errno();
    } else {
        echo "<script>alert('Conexão realizada com sucesso');</script>";
    }

    /**Selecionando o Banco de Dados**/
    mysqli_select_db($mysqli, $dbname);

    /**Estruturando a query no banco de dados**/
    $query = "SELECT * FROM $table";

    /**Executando a query do banco de dados**/
    $result = mysqli_query($mysqli, $query);

    /**Copiando todos os dados do banco de dados**/
    $dataArray =  array();
    while($rowData = mysqli_fetch_array($result)){
        $dataArray[] = $rowData;
    }

    /**
     * Árvore de Decisão - Decision Tree
     * A árvore armazena o caminho correto que uma pessoa deveria fazer ao percorrer o questionário 
     * */

    /**Classe Nó **/
    class Node{
        public  $name;
        public  $edges = array();

        /**Construtor**/
        public function __construct($name){
            $this->name = $name;
        }
    };

    /**Classe Aresta**/
    class Edge{
        public $node;
        public $values = array();
        
        /*Construtor*/
        public function __construct($node, $values){
            $this->node = $node;
            $this->values = $values;
        }
    };

    /*Instanciando os Nós*/
    $v1 = new Node('v1');
    $v2 = new Node('v2');
    $v3 = new Node('v3');
    $v4 = new Node('v4');
    $v5 = new Node('v5');
    $v6 = new Node('v6');
    $v7 = new Node('v7');
    $v8 = new Node('v8');
    $v9 = new Node('v9');
    $v10 = new Node('v10');
    $v11 = new Node('v11');
    $v12 = new Node('v12');
    $v13 = new Node('v13');
    $v14 = new Node('v14');
    $v15 = new Node('v15');
    $v16 = new Node('v16');

    /*Ligando os Nós nas Arestas*/
    $v1->edges = array(
        new Edge($v2, array('1')),
        new Edge($v7, array('2'))
    );

    $v2->edges = array(
        new Edge($v3,array('1')),
        new Edge($v7,array('2'))
    );

    $v3->edges = array(
        new Edge($v4,array('1','2','3'))
    );

    $v4->edges = array(
        new Edge($v5,array('1')),
        new Edge($v6, array('2'))
    );

    $v5->edges = array(
        new Edge($v6,array('2','3')),
        new Edge($v8,array('1'))
    );

    $v6->edges = array(
        new Edge($v7,array('1','2','3','4','5'))
    );

    $v7->edges = array(
        new Edge($v8,array('1')),
        new Edge($v14,array('2'))
    );

    $v8->edges = array(
        new Edge($v9,array('1')),
        new Edge($v14,array('2'))
    );

    $v9->edges = array(
        new Edge($v10,array('1','2'))
    );

    $v10->edges = array(
        new Edge($v11,array('1','2'))
    );

    $v11->edges = array(
        new Edge($v12,array('1','2'))
    );
    
    $v12->edges = array(
        new Edge($v13,array('1','2'))
    );

    $v13->edges = array(
        new Edge($v14,array('1','2'))
    );

    $v14->edges = array(
        new Edge($v15,array('1','2','3','4','5','6','7','8','9','10'))
    );

    $v15->edges = array(
        new Edge($v16,array('1','2','3','4','5'))
    );

    $v16->edges = array(
        new Edge(NULL,array('1','2','3','4','5'))
    );

    /** Percorrendo a árvore de resultados de acordo com o questionário da pessoa **/
    function walkingTree($node, $values){
        
        global $count_steps;
        $count_steps++;
        if($node == NULL){
            return;
        }        
        $anwser = $values[$node->name];

        /**Percorre cada aresta de um nó**/
        foreach($node->edges as $edge){

            /** verifica cada valor presente nas arestas **/
            if(in_array($anwser,$edge->values)){
                
                walkingTree($edge->node,$values);
                break;
            }
            
        } 
    }
    

?>

<!--Código escrito em HTML para exibir os resultados-->
<html>

    <head>
        <meta charset="utf8">
        <title>Desafio Tecnico</title>
    </head>

    <body>

        <!--Botões de opções-->
        <button onclick="mostrarTabela()">Exibir Base de Dados</button><br/><br/>
        <button onclick="ocultarTabela()">Ocultar Base de Dados </button><br/><br/>
        <button onclick="mostrarResultados()">Mostrar Resultados</button><br/><br/>
        <button onclick="ocultarResultados()">Ocultar Resultados</button><br/><br/>

        <!--Tabela que exibe os dados do Data Base-->
        <table id="dataTable" style="display: none;" class="bordaSimples" border="1">
            <tr>
                <td>ID</td>
                <td>V1</td>
                <td>V2</td>
                <td>V3</td>
                <td>V4</td>
                <td>V5</td>
                <td>V6</td>
                <td>V7</td>
                <td>V8</td>
                <td>V9</td>
                <td>V10</td>
                <td>V11</td>
                <td>V12</td>
                <td>V13</td>
                <td>V14</td>
                <td>V15</td>
                <td>V16</td>
            </tr>
            
            <?php foreach($dataArray as $row){ ?>
                <tr>
                    <td> <?php echo $row['id'] ?> </td>
                    <td> <?php echo $row['v1'] ?> </td>
                    <td> <?php echo $row['v2'] ?> </td>
                    <td> <?php echo $row['v3'] ?> </td>
                    <td> <?php echo $row['v4'] ?> </td>
                    <td> <?php echo $row['v5'] ?> </td>
                    <td> <?php echo $row['v6'] ?> </td>
                    <td> <?php echo $row['v7'] ?> </td>
                    <td> <?php echo $row['v8'] ?> </td>
                    <td> <?php echo $row['v9'] ?> </td>
                    <td> <?php echo $row['v10'] ?> </td>
                    <td> <?php echo $row['v11'] ?> </td>
                    <td> <?php echo $row['v12'] ?> </td>
                    <td> <?php echo $row['v13'] ?> </td>
                    <td> <?php echo $row['v14'] ?> </td>
                    <td> <?php echo $row['v15'] ?> </td>
                    <td> <?php echo $row['v16'] ?> </td>
                </tr>
   
            <?php }?>
        </table>
        
        <!--Exibe os resultados de cada pesquisa de acordo com a ordem correta no formulário-->
        <div id="results" style="display: none;">
            <?php 
                foreach($dataArray as $line){  
                    $values = array(
                        "v1" =>  $line['v1'],
                        "v2" =>  $line['v2'],
                        "v3" =>  $line['v3'],
                        "v4" =>  $line['v4'],
                        "v5" =>  $line['v5'],
                        "v6" =>  $line['v6'],
                        "v7" =>  $line['v7'],
                        "v8" =>  $line['v8'],
                        "v9" =>  $line['v9'], 
                        "v10" => $line['v10'],
                        "v11" => $line['v11'],
                        "v12" => $line['v12'],
                        "v13" => $line['v13'],
                        "v14" => $line['v14'],
                        "v15" => $line['v15'],
                        "v16" => $line['v16'],
                    );

                    /**Contagem de elementos presentes em cada questionário**/
                    $totalValores = array_reduce($values, function ($total, $anwser) {
            
                        if($anwser != NULL){
                            $total+=1;
                        }
                        return $total;
                    }, 0);

                    echo "Pessoa :".strval($line['id'])."</br>";
                    echo "<b>Respondeu: </b>".$totalValores." perguntas - ";
                    $count_steps = -1;
                    walkingTree($v1,$values);
                    echo "<b>Deveria ter respondido: </b>".$count_steps." perguntas</br>";
                }
            ?>
        </div>    

    </body>

    <script>

        function mostrarTabela(){
            document.getElementById('dataTable').style.display = '';
        }

        function ocultarTabela(){
            document.getElementById('dataTable').style.display = 'none';

        }

        function mostrarResultados(){
            document.getElementById('results').style.display = '';
        }

        function ocultarResultados(){
            document.getElementById('results').style.display = 'none';
        }

    </script>

</html>