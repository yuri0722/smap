@extends('layouts.'.Session::get('nome_rota'),["active"=>"pessoa"])

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                   @include('form.busca_add',['rota'=>'bemestar.pessoa.pesquisa','listaNome'=>'Lista de pessoas','rotaNovo'=>route(Session::get('nome_rota').'.pessoa.edit')])

                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>@sortablelink('id')</th>
                                <th>@sortablelink('nome')</th>
                                <th>@sortablelink('email')</th>
                                <th>CPF</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pessoas as $pessoa)
                            <tr>
                                @if($pessoa->imagens())
                                    <td>{{$pessoa->id}} <i class="fa fa-image" title="Tem Imagem"></i></td>
                                @else
                                    <td>{{$pessoa->id}}</td>
                                @endif
                                <td>{{$pessoa->nome}}</td>
                                <td>{{$pessoa->email}}</td>
                                <td>{{formataCnpjCpf($pessoa->cpf)}}</td>
                                <td>
                                     <a class="edit" href="{{route(Session::get('nome_rota').'.pessoa.edit',$pessoa->id)}}" title="Editar pessoa">
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
