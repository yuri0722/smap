@extends('layouts.bemestar',["active"=>"pessoa"])


@extends('layouts.bemestar',["active"=>"empresa"])


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">

                        @include('form.busca_add',['rota'=>'bemestar.pessoa.pesquisa','listaNome'=>'Lista de pessoas','rotaNovo'=>route('bemestar.pessoa.edit')])

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>email</th>
                                <th>CPF/CNPJ</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pessoas as $pessoa)
                            <tr>
                                <td>{{$pessoa->id}}</td>
                                <td>{{$pessoa->nome}}</td>
                                <td>{{$pessoa->email}}</td>
                                @if($pessoa->pessoa_tipo=="F")
                                    <td>{{$pessoa->cpf}}</td>
                                @else
                                    <td>{{$pessoa->cnpj}}</td>
                                @endif
                                <td>
                                @if($pessoa->pessoa_tipo=="F")
                                     <a class="edit" href="{{route('bemestar.pessoa.edit',$pessoa->id)}}" title="Editar pessoa">
                                        <i class="fa  fa-edit"></i>
                                     </a>
                                @else
                                    <a class="edit" href="{{route('bemestar.empresa.edit',$pessoa->id)}}" title="Editar Empresa">
                                        <i class="fa  fa-edit"></i>
                                    </a>
                                @endif
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
