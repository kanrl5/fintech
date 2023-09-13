<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Histórico</h1>
    </header>
    <main>
        <form action="historico.php" method="get">
          <fieldset>
            <legend>Buscar</legend>
              Id: <input type="number" name="id" id="id" <?php if (isset($_GET['id'])) echo 'value="'.  $_GET['id'] . '"';?>>
            <input type="submit" value="procurar">
          </fieldset>
        </form>

        <?php
          require_once './classes/autoloader.class.php';

          if(isset($_GET["id"]) && $_GET["id"] != ""){

            R::setup('mysql:host=localhost;dbname=fintech', 'root', '');

            $simulacao = R::load('simulacoes', $_GET["id"]);

            if ($simulacao->id == 0){
              echo "<h2>Id não encontrado!</h2>";
            }
            else
            {
              echo "<fieldset>
                <legend>Informações</legend>
                <table>
                  <tbody>
                    <tr>
                      <td>Id</td>
                      <td>$simulacao->id</td>
                    </tr>
                    <tr>
                      <td>Cliente</td>
                      <td>$simulacao->cliente</td>
                    </tr>
                    <tr>
                      <td>Valor Inicial</td>
                      <td>R$ " . number_format($simulacao->valor_inicial,2,',','.') . "</td>
                    </tr>
                    <tr>
                      <td>Valor Mensal</td>
                      <td>R$ " . number_format($simulacao->valor_mensal,2,',','.') . "</td>
                    </tr>
                    <tr>
                      <td>Taxa</td>
                      <td>$simulacao->taxa %/mês</td>
                    </tr>
                    <tr>
                      <td>Meses</td>
                      <td>$simulacao->meses</td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>";

              echo "<fieldset><legend>Simulação</legend>";

              echo Tabela::criar($simulacao->cliente, $simulacao->valor_inicial, $simulacao->valor_mensal, $simulacao->taxa, $simulacao->meses);
          
              echo "</fieldset>";
            }
          }
                             
        ?>
      
        </fieldset>
          
        <br><br>
        <a href="index.html"><button>Página Inicial</button></a>
    </main>
    
    <footer>
      Katerine Nayara e Kheuhy Barral - &copy; 2023
    </footer>
</body>

</html>