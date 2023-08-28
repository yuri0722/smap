@extends('layouts.impressora')

@section('cabecalho')
    <p><b style=" font-size: 1.3em;">ESTADO DE SANTA CATARINA</b></p>
    <p>PREFEITURA MUNICIPAL DE GAROPABA</p>
    <p>SECRETARIA DE  AGRICULTURA E  PESCA</p>
    <p><b>CENTRO DE CASTRAÇÃO DE CÃES E GATOS</b></p>

@endsection

@section('content')

    <div class="box">
        <h1>CADASTRO - AVALIAÇÃO e AUTORIZAÇÃO Nº{{$castracao->id}}</h1>
        <br>
        @if(isset($castracao->Animal->pessoa_id))
            <p>
                <b>Tutor:</b> {{ $castracao->Animal->Dono->nome}}
                <b>RG:</b>{{isset($castracao->Animal->Dono->rg)?$castracao->Animal->Dono->rg:""}}
                <b>CPF:</b>{{formataCnpjCpf($castracao->Animal->Dono->cpf)}}
                <b>Rua:</b>{{isset($castracao->Animal->Dono->endereco)?$castracao->Animal->Dono->endereco:""}}
                <b>Bairro:</b>{{isset($castracao->Animal->Dono->bairro)?$castracao->Animal->Dono->bairro:""}}
                <b>Cidade:</b>{{isset($castracao->Animal->Dono->Cidade->nome)?$castracao->Animal->Dono->Cidade->nome:""}}
                <b>UF:</b>{{isset($castracao->Animal->Dono->Cidade->Estado->sigla)?$castracao->Animal->Dono->Cidade->Estado->sigla:""}}
            </p>
        @else
            <p>
                <b>Tutor:</b> ___________________________________
                <b>RG:</b>___________________________________
                <b>CPF:</b>___________________________________
                <b>Rua:</b>___________________________________
                <b>Bairro:</b>___________________________________
                <b>Cidade:</b>___________________________________
                <b>UF:</b>___________________________________
            </p>
        @endif
        <h1>
            @if($castracao->Animal->situacao=="P")
                ANIMAL: de Rua (  )  Cuidador (  )  Proprietário ( X )
            @elseif($castracao->Animal->situacao=="R")
                ANIMAL: de Rua ( X )  Cuidador (   )  Proprietário (  )
            @else
                ANIMAL: de Rua (  )  Cuidador ( X )  Proprietário (  )
            @endif
        </h1>
        <p>
            <b>Nome:</b> {{$castracao->Animal->nome}}
            <b>CHIP:</b> {{$castracao->Animal->chip}}
            <b>Espécie:</b> {{$castracao->Animal->Especie->nome}}
            <b>Raça:</b> {{$castracao->Animal->raca}}
            <b>Idade:</b> {{$castracao->Animal->anos}} anos @if(isset($castracao->Animal->meses)) e {{$castracao->Animal->meses}} meses @endif
            <b>Pelagem:</b> {{$castracao->Animal->pelagem}}
            <b>Sexo:</b> {{sexo_escrito_animal($castracao->Animal->sexo)}}
            <b>Sinais característicos:</b> {{$castracao->Animal->caracteristicas}}
            <b>Peso:</b>  {{$castracao->Animal->kilos}} Kilos @if(isset($castracao->Animal->gramas)) e {{$castracao->Animal->gramas}} gramas @endif
            <b>Acompanhante:</b> ____________________________________
            <b>Cuidador(a):</b> _________________________________________
        </p>
        <h1>AUTORIZAÇÃO(   ) ANESTESIA E CIRURGIA</h1>
        <br>
        <p>
            Eu, <b>{{isset($castracao->Animal->pessoa_id)?$castracao->Animal->Dono->nome:"____________________________________"}}</b>, declaro que fui corretamente esclarecido de todos os benefícios e riscos dos procedimentos que o animal de minha responsabilidade será submetido. Fui informado da necessidade dos mesmos e reconheço que esta é a melhor opção para sua saúde e bem-estar.
        </p>
        <p><i>
            <b>
           - Riscos possíveis como: Sequelas ou óbito por alergia a algum medicamento ou por alguma patologia desconhecidas antes do procedimento ou ainda pela falta de exames laboratoriais como eritrograma, leucograma e perfil bioquímico.
            </b>
            </i>
        </p>
        <p>
            Autorizo a marcação com tatuagem e/ou aplicação de microchip ára identificação e controle do animal.
            Declaro ainda que concordando com os procedimentos que o paciente será submetido e ciente dos riscos
            inerentes aos procedimentos, fica o profissional executor e toda sua equipe isentos de qualquer
            responsabilidade decorrentes de tais riscos. Declaro também que após os procedimentos, na qualidade
            de responsável, cuidarei do animal, seguindo todas as instruções repassadas pelo médico veterinário.
        </p>
        <br>
        <p class="text-center">
            Garopaba, {{ date('d/m/Y') }}
        </p>
        <br> <br>
        <p class="text-center">
            ______________________________________<br>
        Assinatura do tutor
        </p>
        <p>

        </p>
    </div>


@endsection

