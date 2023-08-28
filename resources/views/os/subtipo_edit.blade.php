@extends('layouts.agro',["active"=>"tipo"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edição do subtipo </h3>
            </div>
            {!! Form::model($subtipo, ['route' => ['agro.os_subtipos.update', $subtipo->id], 'method' => 'PUT']) !!}
            <div class="card-body">

                <div class="row">
                    <div class="col-5">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, ["class"=>"form-control","placeholder" => "nome"]) !!}
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

