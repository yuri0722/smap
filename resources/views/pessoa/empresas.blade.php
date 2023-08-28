@extends('layouts.bemestar',["active"=>"empresa"])


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'bemestar.pessoa.pesquisa','listaNome'=>'Lista de empresas','rotaNovo'=>route('bemestar.pessoa.edit.empresa')])

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>@sortablelink('id')</th>
                                <th>@sortablelink('nome')</th>
                                <th>@sortablelink('email')</th>
                                <th>CNPJ</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pessoas as $pessoa)
                            <tr>
                                <td>{{$pessoa->id}}</td>
                                <td>{{$pessoa->nome}}</td>
                                <td>{{$pessoa->email}}</td>
                                <td>{{formataCnpjCpf($pessoa->cnpj)}}</td>
                                <td>
                                    <a class="edit" href="{{route('bemestar.pessoa.edit.empresa',$pessoa->id)}}" title="Editar Empresa">
                                        <i class="fa  fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $pessoas->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection
