<?php

if(!function_exists('date_br')){

    function date_br($date,$retornaHora=true){
        if($date){
            if($retornaHora){
                return  date('d/m/Y H:i:s', strtotime($date));
            }else{
                return  date('d/m/Y', strtotime($date));
            }
        }

        return null;

    }
}

if(!function_exists('monta_select_ano')){

    function monta_select_ano ($data_admissao){
        $ano =  date('Y', strtotime($data_admissao));
        $select ="<select class=\"form-control\" name=\"ano\">";
        $anoAtual =date('Y');
        for($x=$anoAtual; $x>=$ano; $x--)
        {
            $select .= "<option value=".$x.">".$x."</option>";
        }
        $select .= "</select>";
        return $select;
    }
}

if(!function_exists('monta_select_mes')){

    function monta_select_mes (){
        $mes["01"] = "Janeiro";
        $mes["02"] = "Fevereiro";
        $mes["03"] = "Março";
        $mes["04"] = "Abril";
        $mes["05"] = "Maio";
        $mes["06"] = "Junho";
        $mes["07"] = "Julho";
        $mes["08"] = "Agosto";
        $mes["09"] = "Setembro";
        $mes["10"] = "Outubro";
        $mes["11"] = "Novembro";
        $mes["12"] = "Dezembro";

        $select ="<select class=\"form-control\" name=\"mes\">";
        $anoAtual =date('Y');
        foreach($mes as $key => $value)
        {
            $select .= "<option value=".$key.">".$value."</option>";
        }
        $select .= "</select>";
        return $select;
    }
}

if(!function_exists('dias_restantes')){

    function dias_restantes ($data_final){
        $hoje = date('Y-m-d');
        $data_inicial = new DateTime($hoje);
        $data_final = new DateTime($data_final);
        $diferenca = $data_inicial->diff( $data_final );
        $diferenca = $diferenca->format('%d days');
        return $diferenca;
    }
}

if(!function_exists('data_hoje')){

    function data_hoje ($data){

        if(!isset($data)){
            return false;
        }else{
            $hoje = date('Y-m-d');
            $data =  date('Y-m-d', strtotime($data));
            if($data==$hoje){
                return true;
            }
            return false;

        }

    }
}
if(!function_exists('calcula_idade')){

    function calcula_idade ($dataNascimento){
        $date = new DateTime($dataNascimento);
        $interval = $date->diff( new DateTime( date('Y-m-d') ) );
        return $interval->format( '%Y anos' );
    }
}
