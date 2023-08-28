@extends('layouts.agro',["active"=>"tipo"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Novo Subtipo de {{$tipo->nome}}</h3>
            </div>
            {!! Form::open(['route' => ['agro.os_subtipo.store',$tipo->id], 'method' => 'POST']) !!}
            <div class="card-body">
                {!! Form::hidden('ordem_servico_tipo_id', $tipo->id) !!}
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

            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th colspan="3" style="text-align:center;">Subtipos de {{$tipo->nome}}</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subtipos as $subtipo)
                        <tr>
                            <td>{{$subtipo->id}}</td>
                            <td>{{$subtipo->nome}}</td>
                            <td>
                                <a class="edit" href="{{route('agro.os_subtipos.edit',$subtipo->id)}}"
                                   title="Editar subtipo">
                                    <i class="fa  fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

