@extends('layouts.bemestar',["active"=>"animal"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulário de castração do animal <b>{{$animal->nome}}</b></h3>
            </div>
            @if(isset($castracao))
                {!! Form::model($castracao, ['route' => ['bemestar.animal.castrar.update', $castracao->id], 'method' => 'PUT']) !!}
            @else
                {!! Form::open(['route' => ['bemestar.animal.castrar'], 'method' => 'POST']) !!}
                {{ Form::hidden('animal_id', $animal->id) }}
            @endif

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        {!! Form::label('pessoa_id', 'Dono') !!}
                        <div class="input-group">
                            {!! Form::text('pessoa_id', null, ["class"=>"form-control col-3","readonly"=>"readonly"]) !!}
                            @if(isset($animal->pessoa_id))
                                {!! Form::text('pessoa', $animal->Dono->nome, ["class"=>"form-control","readonly" => "readonly"]) !!}
                            @else
                                {!! Form::text('pessoa', null, ["class"=>"form-control","readonly" => "readonly"]) !!}
                            @endif

                        </div>
                    </div>
                    <div class="col-3">
                        {!! Form::label('nome', 'Nome do animal') !!}
                        {!! Form::text('nome', $animal->nome, ["class"=>"form-control","readonly" => "readonly"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('especie', 'Espécie') !!}
                        {!! Form::text('especie', $animal->Especie->nome, ["class"=>"form-control","readonly" => "readonly"]) !!}
                    </div>
              </div>

              <div class="row">
                  <div class="col-8">
                        {!! Form::label('anestesia', 'Animal já realizou algum tipo de procedimento envolvendo anestesia?') !!}
                        {!! Form::select('anestesia',[ 'S' => 'SIM','N' => 'NÃO'], null, ['class'=>'form-control col-3']) !!}
                 </div>
                  <div class="col-4">
                      {!! Form::label('anestesia_descricao', 'Procedimento') !!}
                      {!! Form::text('anestesia_descricao', null, ["class"=>"form-control","placeholder" => "Procedimento"]) !!}
                  </div>
              </div>

                <div class="row">
                    <div class="col-4">
                        {!! Form::label('doente_recente', 'O animal esteve doente recentemente?') !!}
                        {!! Form::select('doente_recente',[ 'S' => 'SIM','N' => 'NÃO'], null, ['class'=>'form-control col-3']) !!}
                    </div>
                    <div class="col-8">
                        {!! Form::label('doente_recente_descricao', 'Diagnóstico') !!}
                        {!! Form::text('doente_recente_descricao', null, ["class"=>"form-control","placeholder" => "Qual o diagnóstico e tratamento efetuado"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        {!! Form::label('convulsao', 'O animal apresenta quadros de convulsão? Está sendo tratado?') !!}
                        {!! Form::select('convulsao',[ 'S' => 'SIM','N' => 'NÃO'], null, ['class'=>'form-control col-3']) !!}
                    </div>
                    <div class="col-7">
                        {!! Form::label('diarreia_vomito', 'O animal apresentou diarreia/vômito 7 dias anteriores a data de castração') !!}
                        {!! Form::select('diarreia_vomito',[ 'S' => 'SIM','N' => 'NÃO'], null, ['class'=>'form-control col-3']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {!! Form::label('sensibilidade_medicamento', 'Sensibilidade a algum tipo de medicamento?') !!}
                        {!! Form::select('sensibilidade_medicamento',[ 'S' => 'SIM','N' => 'NÃO'], null, ['class'=>'form-control col-3']) !!}
                    </div>
                    <div class="col-6">
                        {!! Form::label('sensibilidade_medicamento_descricao', 'Qual?') !!}
                        {!! Form::text('sensibilidade_medicamento_descricao', null, ["class"=>"form-control","placeholder" => "Qual sensibilidade"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        {!! Form::label('alimentacao_normal', 'Alimentação normal?') !!}
                        {!! Form::select('alimentacao_normal',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-4">
                        {!! Form::label('vermifugado', 'Desvermifugado?') !!}
                        {!! Form::select('vermifugado',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-4">
                        {!! Form::label('vacinado', 'Vacinas estão em dia?') !!}
                        {!! Form::select('vacinado',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        {!! Form::label('comportamento_anormal', 'Apresentado alguma anormalidade comportamental?') !!}
                        {!! Form::select('comportamento_anormal',[ 'S' => 'SIM','N' => 'NÃO'], null, ['class'=>'form-control col-3']) !!}
                    </div>
                    <div class="col-6">
                        {!! Form::label('comportamento_anormal_descricao', 'Qual?') !!}
                        {!! Form::text('comportamento_anormal_descricao', null, ["class"=>"form-control","placeholder" => "Qual anormalidade"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        {!! Form::label('falhas_nos_pelos', 'Falhas nos pelos?') !!}
                        {!! Form::select('falhas_nos_pelos',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('secrecao_vaginal', 'Secreção vaginal?') !!}
                        {!! Form::select('secrecao_vaginal',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('secrecao_olhos', 'Secreção nos olhos?') !!}
                        {!! Form::select('secrecao_olhos',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('coceira', 'Costuma se coçar muito?') !!}
                        {!! Form::select('coceira',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
               <br> <h4 class="text-center">PARÂMETROS CLÍNICOS BÁSICOS (preenchimento pelo veterinário)  </h4>
                <div class="row">
                    <div class="col-2">
                        <label>ECC <i class="fa fa-question-circle" aria-hidden="true" title="ECC – Escore de Cond. Corporal"></i></label>
                        {!! Form::number('ecc', null, ["class"=>"form-control","min"=>"1"]) !!}
                    </div>
                    <div class="col-2">
                        <label>TPC <i class="fa fa-question-circle" aria-hidden="true" title="TPC – Tempo de Preenchimento"></i></label>
                        {!! Form::number('tpc', null, ["class"=>"form-control","min"=>"1"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('temperatura', 'Temperatura Corporal') !!}
                        {!! Form::number('temperatura', null, ["class"=>"form-control"]) !!}
                    </div>
                    <div class="col-2">
                        <label>FC <i class="fa fa-question-circle" aria-hidden="true" title="FC – Frequência Cardíaca"></i></label>
                        {!! Form::number('bpm', null, ["class"=>"form-control","min"=>"1"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('pulso', 'Pulso') !!}
                        {!! Form::select('pulso',[ 'FORTE' => 'FORTE','FRACO' => 'FRACO'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <label>FR <i class="fa fa-question-circle" aria-hidden="true" title="FR – Frequência Respiratória"></i></label>
                        {!! Form::number('fr', null, ["class"=>"form-control","min"=>"1"]) !!}
                    </div>
                    <div class="col-4">
                        {!! Form::label('mucosas', 'Mucosas') !!}
                        {!! Form::text('mucosas', null, ["class"=>"form-control","placeholder" => "Mucosas"]) !!}
                    </div>
                    <div class="col-4">
                        {!! Form::label('hidratacao', 'Hidratação') !!}
                        {!! Form::text('hidratacao', null, ["class"=>"form-control","placeholder" => "Hidratação"]) !!}
                    </div>
                    <div class="col-2">
                        <label>Castrou? <i class="fa fa-question-circle text-danger" aria-hidden="true" title="Por padrão castrado Sim, se não favor marcar não"></i></label>
                        {!! Form::select('castrado',[ 'S' => 'Sim','N' => 'Não'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::label('observacao', 'Observação') !!}
                        {!! Form::textarea('observacao', null, ["class"=>"form-control",'rows' => 2,"placeholder" => "Alguma observaçao sobre o animal?"]) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Salvar</button>
            </div>
        {!! Form::close() !!}
        <!-- /.card-body -->
        </div>

    </div>
@endsection

