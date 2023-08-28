@extends('layouts.agro',["active"=>"os_tipos"])


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'agro.os_tipos.pesquisa','listaNome'=>'Tipos de tipo de serviço','rotaNovo'=>route('agro.os_tipos.edit')])

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipos as $tipo)
                                <tr>
                                    <td>{{$tipo->id}}</td>
                                    <td>{{$tipo->nome}}</td>
                                    <td>
                                        <a class="edit" href="{{route('agro.os_tipos.edit',$tipo->id)}}" title="Editar tipo">
                                            <i class="fa  fa-edit"></i>
                                        </a>
                                        <a class="edit" href="{{route('agro.os_subtipo',$tipo->id)}}" title="Subtipo">
                                            <i class="fa fa-tractor text-success"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $tipos->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection

