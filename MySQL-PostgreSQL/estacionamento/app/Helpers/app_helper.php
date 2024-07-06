<?php

//Função para formatar o valor em moedas (`BRL`).


if (!function_exists('format_money_brl')) {
    function format_money_brl(float|int $num): string
    {
        return number_to_currency(num: $num / 100, currency: 'BRL', fraction: 2);
    }
}
