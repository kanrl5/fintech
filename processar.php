<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulação</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Simulação de Investimento</h1>
  </header>
  <main>
    <?php
    if(isset($_GET['cliente']) && isset($_GET['valor_inicial']) && isset($_GET['valor_mensal']) && isset($_GET['taxa']) && isset($_GET['meses'])){
      if ($_GET['cliente'] == ""){
        echo "<h2>Insira o nome do cliente!</h2>";
      }
      else{
        require_once './classes/autoloader.class.php';
        R::setup('mysql:host=localhost;dbname=fintech', 'root', '');
        
        $simulacoes = R::dispense('simulacoes');

        $simulacoes->cliente = $_GET['cliente'];
        $simulacoes->valor_inicial = $_GET['valor_inicial'];
        $simulacoes->valor_mensal = $_GET['valor_mensal'];
        $simulacoes->taxa = $_GET['taxa'];
        $simulacoes->meses = $_GET['meses'];

        
        $id = R::store($simulacoes);
        
        echo "<fieldset>
                <legend>Informações</legend>
                <table>
                  <tbody>
                    <tr>
                      <td>Id</td>
                      <td>$id</td>
                    </tr>
                    <tr>
                      <td>Cliente</td>
                      <td>$simulacoes->cliente</td>
                    </tr>
                    <tr>
                      <td>Valor Inicial</td>
                      <td>R$ " . number_format($simulacoes->valor_inicial,2,',','.') . "</td>
                    </tr>
                    <tr>
                      <td>Valor Mensal</td>
                      <td>R$ " . number_format($simulacoes->valor_mensal,2,',','.') . "</td>
                    </tr>
                    <tr>
                      <td>Taxa</td>
                      <td>$simulacoes->taxa %/mês</td>
                    </tr>
                    <tr>
                      <td>Meses</td>
                      <td>$simulacoes->meses</td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>";

        echo "<fieldset><legend>Simulação</legend>";

        echo Tabela::criar($simulacoes->cliente, $simulacoes->valor_inicial, $simulacoes->valor_mensal, $simulacoes->taxa, $simulacoes->meses);
    
        echo "</fieldset>";
        

      }
    }
    ?>
    <a href="entrada.html"><button>Adicionar mais</button></a> 
    <a href="index.html"><button>Menu inicial</button></a>
    
    
  </main>
  <footer>
      Katerine Nayara e Kheuhy Barral - &copy; 2023
    </footer>
</body>
</html>