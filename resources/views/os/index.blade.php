@extends('layouts.agro',["active"=>"ordem"])


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'agro.os.pesquisa','listaNome'=>'Lista de ordemes','rotaNovo'=>route('agro.os.edit')])

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
                            @foreach($ordems as $ordem)
                                <tr>
                                    <td>{{$ordem->id}}</td>
                                    <td>{{$ordem->Pessoa->nome}}</td>
                                    <td>{{formataCnpjCpf($ordem->Pessoa->cpf)}}</td>
                                    <td>{{$ordem->renda_anual}}</td>
                                    <td>
                                        <a class="edit" href="{{route('agro.ordem.edit',$ordem->id)}}" title="Editar ordem">
                                            <i class="fa  fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $ordems->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection

