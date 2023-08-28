@extends('layouts.agro',["active"=>"motorista"])


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'agro.motorista.pesquisa','listaNome'=>'Lista de motoristas','rotaNovo'=>route('agro.motorista.edit')])

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
                            @foreach($motoristas as $motorista)
                                <tr>
                                    <td>{{$motorista->id}}</td>
                                    <td>{{$motorista->Pessoa->nome}}</td>
                                    <td>{{formataCnpjCpf($motorista->Pessoa->cpf)}}</td>
                                    <td>{{$motorista->renda_anual}}</td>
                                    <td>
                                        <a class="edit" href="{{route('agro.motorista.edit',$motorista->id)}}" title="Editar motorista">
                                            <i class="fa  fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $motoristas->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection
