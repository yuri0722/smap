@extends('layouts.agro',["active"=>"veiculo"])

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('form.busca_add',['rota'=>'agro.veiculo.pesquisa','listaNome'=>'Lista de veículos','rotaNovo'=>route('agro.veiculo.edit')])
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Img</th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($veiculos as $veiculo)
                                <tr>
                                    @if($veiculo->imagens())
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#delete{{$veiculo->id}}">
                                            <img src="/img/veiculos/{{$veiculo->id}}/p/{{$veiculo->imagens()[0]}}" class="img-fluid mb-2" alt="white sample" width="60px">
                                        </a>
                                        @include('modal.imagem',['idModal'=>'delete'.$veiculo->id,'caminho'=>"/img/veiculos/".$veiculo->id."/m/".$veiculo->imagens()[0]])
                                     </td>
                                    @else
                                      <td>
                                        <img src="/img/trator.png" class="img-fluid mb-2" alt="white sample" width="60px">
                                      </td>
                                    @endif
                                    <td>{{$veiculo->id}}</td>
                                    <td>{{$veiculo->nome}}</td>
                                    <td>{{$veiculo->marca}}</td>
                                    <td>{{$veiculo->VeiculoTipo->nome}}</td>
                                    <td>
                                        <a class="edit" href="{{route('agro.veiculo.edit',$veiculo->id)}}" title="Editar veiculo">
                                          <i class="fa  fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <nav class="text-center">
                            {!! $veiculos->appends(\Request::except('page'))->render() !!}
                        </nav>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
@endsection
