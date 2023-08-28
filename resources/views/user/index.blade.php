@extends('layouts.admin',["active"=>"users"])

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'admin.user.pesquisa','listaNome'=>'Lista de usuários','rotaNovo'=>route('admin.user.edit')])
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>@sortablelink('id')</th>
                                <th>@sortablelink('name','Nome')</th>
                                <th>@sortablelink('email','E-mail')</th>
                                <th>@sortablelink('is_motorista','Motorista')</th>
                                <th>Módulos</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->is_motorista)
                                        <td>SIM</td>
                                    @else
                                        <td>NÃO</td>
                                    @endif
                                    <td>{!! $user->Modulos !!}</td>
                                    <td>
                                        <a class="edit" href="{{route('admin.user.edit',$user->id)}}" title="Editar user">
                                          <i class="fa  fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $users->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection
