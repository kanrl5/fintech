<?php

class Tabela{
    public static function criar($cliente, $valor_inicial, $valor_mensal, $taxa, $meses){
    $html  = "<table>";
    $html .= "<thead><tr><th>Mês</th><th>Valor Inicial</th><th>Valor Mensal</th><th>Rendimento Mensal</th><th>Saldo Total</th></tr></thead>";
    $html .= "<tbody>";

    for ($mes = 1; $mes <= $meses; $mes++) {
        $html .= "<tr>";
        $html .= "<td> $mes </td>";
        $html .= "<td>R$ ". ($mes > 1 ? number_format($valor_inicial,2,',','.') : "--------"). "</td>";
        $html .= "<td>R$ " . number_format($valor_mensal,2,',','.') . "</td>";
        $html .= "<td>R$ " . number_format(($valor_inicial * $taxa / 100),2,',','.') . "</td>";

        $valor_inicial = ($valor_inicial * $taxa / 100) + $valor_inicial;

        $html .= "<td>R$ " . number_format($valor_inicial,2,',','.') . "</td>";

        $valor_inicial += $valor_mensal;

        $html .= "</tr>";
    }

    $html .= "</tbody>";
    $html .= "</table>";

    return $html;
  }
}