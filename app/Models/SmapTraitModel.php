<?php namespace App\Models;

use Illuminate\Support\Facades\File;

trait SmapTraitModel
{


    public function validaCPF($cpf) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }

    public function validaCNPJ($cnpj){
        // Extrai somente os números
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14){
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 11.111.111/1111-11
        if (preg_match('/(\d)\1{10}/', $cnpj)) {
            return false;
        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function cortaPalavras($texto, $qtd, $final = '...'){
        $novo = "";
        if(strlen($texto) > $qtd){
            for($i = 0; $i < $qtd; $i++){
                if($novo == null){
                    $novo = $texto[$i];
                }else{
                    $novo .= $texto[$i];
                }
            }
            $novo .= $final;
        }else{
            $novo = $texto;
        }
        return $novo;
    }

    public function arrumaCamposCreate($dados){
        foreach ($dados as $dado => $value) {
            if ($value == "") {
                $dados[$dado] = NULL;
            }
        }
        return $dados;
    }

    public function arrumaCamposUpdate($dados){
        foreach ($dados["attributes"] as $dado => $value) {
            if ($value == "") {
                $dados->$dado = NULL;
            }
            if ($value == null) {
                $dados->$dado = NULL;
            }
        }
        return $dados;
    }

    public function validaEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }
    /**
     * Autor: Danilo
     * Função para deixar os dados de uma variavel simples com o texto no padrão,
     * tudo maiusculo e sem acento, igual a receita federal.
     */
    public function nomePadrao($dado,$espaco=true,$upper=true){
        if(!empty($dado)){
            $dado = strtr($dado,
                array (
                    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
                    'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
                    'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
                    'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
                    'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'R' => 'R',
                    'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
                    'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
                    'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                    'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                    'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
                    'þ' => 'b', 'ÿ' => 'y', 'r' => 'r', 'º' => '', '°' => '', '`' => ' ',
                    '&' => 'E',));
        }
        if ($espaco){
            $dado =  trim($dado);
        }
        if($upper){
            $dado =  strtoupper($dado);
        }
        $dado = str_replace("'", " ", $dado);
        $dado = utf8_encode($dado);
        return $dado;
    }

    /**
     * Autor: Danilo
     * Função para deixar os dados de um array com o texto no padrão,
     * tudo maiusculo e sem acento, igual a receita federal.
     */
    public function nomePadraoArray($dados){
        foreach ($dados as $dado => $value) {
            if($dado != "email" && $dado != "geom" && $dado != "campoAlterados" && $dado != "campoAlterados1" && $dado != "_token" && $dado != "filename"){
                if(!empty($value)){
                    $dados[$dado] = strtr($value,
                        array (
                            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
                            'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
                            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
                            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
                            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'R' => 'R',
                            'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
                            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
                            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                            'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
                            'þ' => 'b', 'ÿ' => 'y', 'r' => 'r', 'º' => '', '°' => '', '`' => ' ',
                            '&' => 'E',));
                }

                $dados[$dado] =  strtoupper(trim($dados[$dado]));
                $dados[$dado] = str_replace("'", " ", $dados[$dado]);
                $dados[$dado] = utf8_encode($dados[$dado]);
            }
        }
        return $dados;
    }

    /**
     * Autor: Danilo
     * Função que retorna só os numeros de uma variavel.
     */
    public function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    /**
     * Autor: Danilo
     * Função que retorna o slug de um texto.
     */
    public function slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '_', $string);
        return $slug;
    }

    /**
     * @author Danilo Luiz
     * @param $url
     * @return bool|mixed|string
     */
    public function buscaJson($url,$retornaEmJson=true)
    {
        //  inicia o curl
        $curl = curl_init();
        // desabilita verificação SSL
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        // vai retornar a resposta, se for falsa, imprime a resposta
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // seta a url
        curl_setopt($curl, CURLOPT_URL, $url);
        // executa
        $response=curl_exec($curl);
        // fecha
        curl_close($curl);

        if($retornaEmJson){
            $response = json_decode($response, true);
        }

        return $response;
    }
    /**
     * Autor: Danilo
     * Função: buscar o endereco no www.viacep.com.br passando o cep como parametro. retorno via json
     */
    public function buscar_endereco_cep($cep){
        $cep = str_replace("-", "", $cep);
        $url = "https://viacep.com.br/ws/".$cep."/json/";
        $response = $this->buscaJson($url);
        return $response;
    }

    /**
     * @Autor: Danilo Luiz
     * Função: buscar o cep no www.viacep.com.br passando o endereco como parametro. retorno via json
     */
    public function buscar_cep_endereco($uf, $cidade, $rua){
        $url = "https://viacep.com.br/ws/".$uf."/".$cidade."/".$rua."/json/";
        $response = $this->buscaJson($url);
        return $response;
    }

    public function temInternet(){
        $tem = true;
        if (!$sock = @fsockopen('www.google.com.br', 80, $num, $error, 5))  {
            $tem = false;
        }

        return $tem;
    }

    public function completaCampo($numero = null, $valor_preencher = null, $valor = null){
        for($i = 0; $i <= $numero; $i++){
            if(strlen($valor) == $numero){
                return $valor;
            }else{
                $valor =  $valor_preencher.$valor;
            }
        }

    }

    public function buscaImagensApresenta($pasta = null, $src=null, $pasta_base = 'img'){
        //$src = "img/imovel/".$src;
        if($src != null){
            $src = $pasta_base."/".$pasta."/".$src."/p/";
        }else{
            $src = $pasta_base."/".$pasta."/p/";
        }

        File::exists($src) or File::makeDirectory($src, 0777, true);
        ini_set("max_execution_time", 1000);
        //$ponteiro  = opendir($src.'/p');
        $ponteiro  = opendir($src);
        while ($nome_itens = readdir($ponteiro)) {
            $itens[] = $nome_itens;
        }
        sort($itens);
        foreach ($itens as $listar) {
            if ($listar!="." && $listar!=".."){
                if (!is_dir($listar)) {
                    $arquivos[]=$listar;
                }
            }
        }
        if (isset($arquivos)){
            return $arquivos;
        }
    }

    public function buscaArquivos($pasta = null, $src=null, $pasta_base = 'img'){
        //$src = "img/imovel/".$src;
        if($src != null){
            $src = $pasta_base."/".$pasta."/".$src."/";
        }else{
            $src = $pasta_base."/".$pasta."/";
        }
        // File::exists($src) or File::makeDirectory($src, 0777, true);
        ini_set("max_execution_time", 1000);
        //$ponteiro  = opendir($src.'/p');
        $ponteiro  = opendir($src);
        while ($nome_itens = readdir($ponteiro)) {
            $itens[] = $nome_itens;
        }
        sort($itens);
        foreach ($itens as $listar) {
            if ($listar!="." && $listar!=".."){
                if (!is_dir($listar)) {
                    $arquivos[]=$listar;
                }
            }
        }
        if (isset($arquivos)){
            return $arquivos;
        }
    }

    /**
     * Autor: Danilo
     * Função para pegar os documentos de uma pasta e apresentar.
     */
    public function buscaImagensApresentaDocumentos($pasta = null, $src=null){
        //$src = "img/imovel/".$src;
        $src = "img/".$pasta."/".$src."/documentos/";
        File::exists($src) or File::makeDirectory($src, 0777, true);
        ini_set("max_execution_time", 1000);
        //$ponteiro  = opendir($src.'/p');
        $ponteiro  = opendir($src);
        while ($nome_itens = readdir($ponteiro)) {
            $itens[] = $nome_itens;
        }
        sort($itens);
        foreach ($itens as $listar) {
            if ($listar!="." && $listar!=".."){
                if (!is_dir($listar)) {
                    $arquivos[]=$listar;
                }
            }
        }
        if (isset($arquivos)){
            return $arquivos;
        }
    }

    private function removeMacAddressMikroTik($mac_address)//MikroTik
    {
        return shell_exec('ssh -o StrictHostKeyChecking=no -p 8836 -i /home/mikrotik/.ssh/id_rsa mikrotik@10.1.10.1 "/ip hotspot host remove [find where mac-address='.$mac_address.'];/ip dhcp-server lease remove [find where mac-address='.$mac_address.']"');
    }

    private function removeManyMacAddressMikroTik($list_mac_address)
    {
        $comando  =  "ssh -o StrictHostKeyChecking=no -p 8836 -i /home/mikrotik/.ssh/id_rsa mikrotik@10.1.10.1 ";
        $comando .='"';
        foreach ($list_mac_address as $mac_address){
            $comando .='/ip hotspot host remove [find where mac-address='.$mac_address.'];/ip dhcp-server lease remove [find where mac-address='.$mac_address.'];';
        }
        $comando .="}";
        $comando = str_replace(";}","",$comando);
        $comando .='"';
        ///ip dhcp-server lease remove [find where mac-address=70:4D:7B:2B:6F:3E]
        return shell_exec($comando);
    }

    private function removeUserMikroTik($login)
    {
       // dd("chegou aqui");
        //depois de mudar as permissoes devo deslogar do mk
        $comando ='ssh -o StrictHostKeyChecking=no -p 8836 -i /home/mikrotik/.ssh/id_rsa mikrotik@10.1.10.1 "/ip hotspot active remove [find where user='.$login.']"';
        return shell_exec($comando);
    }
    public function date_br($date,$retornaHora=true){
        if($date){
            if($retornaHora){
                return  date('d/m/Y H:i:s', strtotime($date));
            }else{
                return  date('d/m/Y', strtotime($date));
            }
        }

        return null;

    }

    public function nomeSetorSpark($nome,$sigla)
    {
        $nome = str_replace(" - ADM", "", $nome);
        $nome = str_replace(" - SDS", "", $nome);
        $nome = str_replace(" - Saúde", "", $nome);
        $nome = str_replace(" - SME", "", $nome);
        $nome = str_replace(" - ADM", "", $nome);
        $nome = str_replace(" - SPTMA", "", $nome);
        $nome = str_replace(" - SAS", "", $nome);
        $nome = str_replace(" - Infra", "", $nome);
        $nome = str_replace("Setor do ", "", $nome);
        $nome = str_replace("Setor de ", "", $nome);
        $nome = str_replace("Setor da ", "", $nome);
        $nome = str_replace("Setor ", "", $nome);
        $nome = str_replace(" / ", " ", $nome);
        $nome = str_replace(" - ", " ", $nome);
        $nome = str_replace(" ", "-", $nome);
        $nome = $this->nomePadrao($nome,false,false);
        $nome = $sigla.'-'.$nome;

        return $nome;
    }
}
