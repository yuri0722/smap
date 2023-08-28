@extends('layouts.agro',["active"=>"agricultor"])


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'agro.agricultor.pesquisa','listaNome'=>'Lista de agricultores','rotaNovo'=>route('agro.agricultor.edit')])

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Renda anual</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agricultors as $agricultor)
                                <tr>
                                    <td>{{$agricultor->id}}</td>
                                    <td>{{$agricultor->Pessoa->nome}}</td>
                                    <td>{{formataCnpjCpf($agricultor->Pessoa->cpf)}}</td>
                                    <td>{{$agricultor->renda_anual}}</td>
                                    <td>
                                        <a class="edit" href="{{route('agro.agricultor.edit',$agricultor->id)}}" title="Editar agricultor">
                                            <i class="fa  fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $agricultors->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection
