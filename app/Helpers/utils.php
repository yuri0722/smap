<?php
if(!function_exists('formataCnpjCpf')){

    function formataCnpjCpf($value)
    {
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }
}
if(!function_exists('cortaPalavras')) {

    function cortaPalavras($texto, $qtd, $final = '...')
    {
        $novo = "";
        if (strlen($texto) > $qtd) {
            for ($i = 0; $i < $qtd; $i++) {
                if ($novo == null) {
                    $novo = $texto[$i];
                } else {
                    $novo .= $texto[$i];
                }
            }
            $novo .= $final;
        } else {
            $novo = $texto;
        }
        return $novo;
    }
}

if(!function_exists('mostra_link')){

    function mostra_link($texto,$tela="chamado"){
      //  $textoNovo = $texto;

      //  str_replace("@NomeMunicipio", strtoupper(Auth::user()->Municipio->nome);
        $textoNovo = preg_replace('/(?<!\S)#([0-9a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ_]+)/', '<a href="/central/chamado/detalhe/$1">#$1</a>', $texto);

        if($tela=="chamado"){

        }

        return $textoNovo;

    }
}

if(!function_exists('pinga_terra')){

    function pinga_terra(){
        $tem = true;
        if (!$sock = @fsockopen('208.84.244.116', 80, $num, $error, 5))  {
            $tem = false;
        }

        return $tem;

    }
}

if(!function_exists('monta_select_inteiro')){

    function monta_select_inteiro ($nome,$inicio,$final){
        $select ="<select class=\"form-control\" name=\"$nome\">";
        for($x=$final; $x>=$inicio; $x--)
        {
            $select .= "<option value=".$x.">".$x."</option>";
        }
        $select .= "</select>";
        return $select;
    }
}
if(!function_exists('valida_email')) {

    function valida_email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}

if(!function_exists('busca_negrito_italico')) {

    function busca_negrito_italico($texto,$busca)
    {
        // Expressão regular para negrito.
        $reNegrito = "$busca";

        // Expressão regular para itálico.
        $reItalico = "$busca";

        // Sintaxe de substituição de expressão regular, para negrito.
        $replacementNegrito = '<b>$1</b>';

        // Sintaxe de substituição de expressão regular, para itálico.
        $replacementItalico = '<i>$1</i>';

        $pos      = strripos(strtoupper($texto), strtoupper($busca));

        if ($pos === false) {
            return $texto;
        } else {
            $texto = str_ireplace( [$busca],["<b>$busca</b>"], $texto);
            return strtoupper($texto);
        }
    }
}

if(!function_exists('sexo_escrito')) {

    function sexo_escrito($sexo)
    {
        if($sexo=='F'){
            return 'FEMININO';
        }elseif ($sexo=='M'){
            return 'MASCULINO';
        }else{
            return 'OUTRO';
        }
    }
}

if(!function_exists('sexo_escrito_animal')) {

    function sexo_escrito_animal($sexo)
    {
        if($sexo=='F'){
            return 'FÊMEA';
        }else{
            return 'MACHO';
        }
    }
}
