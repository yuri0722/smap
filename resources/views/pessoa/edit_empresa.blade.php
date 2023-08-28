@extends('layouts.bemestar',["active"=>"empresa"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nova empresa</h3>
            </div>

            @if(isset($pessoa))
                {!! Form::model($pessoa, ['route' => ['bemestar.pessoa.update', $pessoa->id], 'method' => 'PUT']) !!}
            @else
                {!! Form::open(['route' => 'bemestar.pessoa.store', 'method' => 'POST']) !!}
            @endif
            <div class="card-body">
                {{ Form::hidden('pessoa_tipo', 'J') }}
                <div class="row">
                    <div class="col-5">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, ["class"=>"form-control","placeholder" => "Nome"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::text('email', null, ["class"=>"form-control","placeholder" => "E-mail"]) !!}

                    </div>
                    <div class="col-4">
                        {!! Form::label('cnpj', 'CNPJ') !!}
                        {!! Form::text('cnpj', null, ["class"=>"form-control maskCNPJ","placeholder" => "99.999.999/9999-99"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        {!! Form::label('data_nascimento', 'Data de Criação') !!}
                        {!! Form::date('data_nascimento', null, ["class"=>"form-control"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('telefone', 'Telefone') !!}
                        {!! Form::text('telefone', null, ["class"=>"form-control","placeholder" => "(48) 0000-0000"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('celular', 'Celular') !!}
                        {!! Form::text('celular', null, ["class"=>"form-control","placeholder" => "(48) 90000-0000"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        {!! Form::label('cidade_id', 'Cidade') !!}
                        {!! Form::text('cidade', null, ["class"=>"form-control","placeholder" => "Cidade"]) !!}
                    </div>

                    <div class="col-4">
                        {!! Form::label('bairro', 'Bairro') !!}
                        {!! Form::text('bairro', null, ["class"=>"form-control","placeholder" => "Bairro"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('cep', 'CEP') !!}
                        {!! Form::text('cep', null, ["class"=>"form-control","placeholder" => "00000-000"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {!! Form::label('endereco', 'Endereço') !!}
                        {!! Form::text('endereco', null, ["class"=>"form-control","placeholder" => "Endereço"]) !!}
                    </div>

                    <div class="col-4">
                        {!! Form::label('complemento', 'Complemento') !!}
                        {!! Form::text('complemento', null, ["class"=>"form-control","placeholder" => "Complemento"]) !!}
                    </div>

                    <div class="col-2">
                        {!! Form::label('numero', 'Número') !!}
                        {!! Form::text('numero', null, ["class"=>"form-control","placeholder" => "Número"]) !!}
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

