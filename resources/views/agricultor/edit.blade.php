@extends('layouts.agro',["active"=>"agricultor"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Novo agricultor</h3>
            </div>

            @if(isset($agricultor))
                {!! Form::model($agricultor, ['route' => ['agro.agricultor.update', $agricultor->id], 'method' => 'PUT']) !!}
            @else
                {!! Form::open(['route' => 'agro.agricultor.store', 'method' => 'POST']) !!}
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {!! Form::label('pessoa_id', 'Pessoa') !!}
                        <div class="input-group">
                            {!! Form::text('pessoa_id', null, ["class"=>"form-control col-3","readonly"=>"readonly"]) !!}
                            @if(isset($agricultor->pessoa_id))
                                {!! Form::text('pessoa', $agricultor->Pessoa->nome, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome da pessoa","autocomplete"=>"off"]) !!}
                            @else
                                {!! Form::text('pessoa', null, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome da pessoa","autocomplete"=>"off"]) !!}
                            @endif
                            <div id="Select1"></div>
                        </div>
                    </div>
                    <div class="col-3">
                        {!! Form::label('numero_sindicato', 'Nº sindicato') !!}
                        {!! Form::text('numero_sindicato', null, ["class"=>"form-control","placeholder" => "Número sindicato"]) !!}

                    </div>
                    <div class="col-3">
                        {!! Form::label('numero_epagri', 'Nº Epagri') !!}
                        {!! Form::text('numero_epagri', null, ["class"=>"form-control","placeholder" => "Epagri"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        {!! Form::label('numero_cidasc', 'Nº CIDASC') !!}
                        {!! Form::text('numero_cidasc', null, ["class"=>"form-control","placeholder" => "CIDASC"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('numero_bloco_notas', 'Nº Bloco notas') !!}
                        {!! Form::text('numero_bloco_notas', null, ["class"=>"form-control","placeholder" => "Nº Bloco notas"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('beneficio_governo', 'Beneficio Governo',['title'=>'Recebe algum benefício/programa do Governo?']) !!}
                        {!! Form::select('beneficio_governo',['N' => 'Não','S' => 'Sim'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('numero_animais', 'Nº Animais') !!}
                        {!! Form::number('numero_animais', null, ["class"=>"form-control","placeholder" => "0", "min"=>"0", "step"=>"1"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        {!! Form::label('renda_anual', 'Renda anual') !!}
                        {!! Form::number('renda_anual', null, ["class"=>"form-control","placeholder" => "0"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('nr_agro_familia', 'Nº Familiares Agro',['title'=>'Número de pessoas da família que trabalha na atividade agropecuária']) !!}
                        {!! Form::number('nr_agro_familia', null, ["class"=>"form-control","placeholder" => "0", "min"=>"0", "step"=>"1"]) !!}
                    </div>

                    <div class="col-3">
                        {!! Form::label('engenho_farinha', 'Tem engenho de farinha?') !!}
                        {!! Form::select('engenho_farinha',['N' => 'Não','S' => 'Sim'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('engenho_cana', 'Tem engenho de cana?') !!}
                        {!! Form::select('engenho_cana',['N' => 'Não','S' => 'Sim'], null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::label('producao', 'Produção') !!}
                        {!! Form::textarea('producao', null, ["class"=>"form-control",'rows' => 2,"placeholder" => "Produção"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::label('observacao', 'Observação') !!}
                        {!! Form::textarea('observacao', null, ["class"=>"form-control",'rows' => 2,"placeholder" => "Observação"]) !!}
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

