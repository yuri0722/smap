@extends('layouts.agro',["active"=>"veiculo"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Novo veículo</h3>
            </div>

            @if(isset($veiculo))
                {!! Form::model($veiculo, ['route' => ['agro.veiculo.update', $veiculo->id], 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
            @else
                {!! Form::open(['route' => 'agro.veiculo.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            @endif
            <div class="card-body">
                {{ Form::hidden('veiculo_tipo', 'F') }}
                <div class="row">
                    <div class="col-6">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, ["class"=>"form-control","placeholder" => "Nome"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('placa', 'Placa') !!}
                        {!! Form::text('placa', null, ["class"=>"form-control","placeholder" => "Placa"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('veiculo_tipo_id', 'Tipo de Veículo') !!}
                        {!! Form::select('veiculo_tipo_id', $tipos, null, ["class"=>"form-control"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        {!! Form::label('marca', 'Marca') !!}
                        {!! Form::text('marca', null, ["class"=>"form-control","placeholder" => "Marca"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('modelo', 'Modelo') !!}
                        {!! Form::text('modelo', null, ["class"=>"form-control","placeholder" => "Modelo"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('cor', 'Cor') !!}
                        {!! Form::text('cor', null, ["class"=>"form-control","placeholder" => "Cor"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('ano', 'Ano') !!}
                        {!! Form::number('ano', null, ["class"=>"form-control","placeholder" => "Ano"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('quilometragem', 'Quilometragem') !!}
                        {!! Form::number('quilometragem', null, ["class"=>"form-control","min"=>"0"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        {!! Form::label('observacao', 'Observação') !!}
                        {!! Form::textarea('observacao', null, ["class"=>"form-control",'rows' => 2,"placeholder" => "Alguma observaçao sobre o veículo?"]) !!}
                    </div>
                </div>
                @if(isset( $veiculo))
                    <br>
                    <div class="row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Fotos</label>
                        <div class="col-sm-10">
                            <input type="file" name="imagem[]" id="imagem" value="" multiple>
                        </div>
                    </div>
                    @if($veiculo->imagens())
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">Fotos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php $count = 'a'; ?>

                                        @foreach($veiculo->imagens() as $foto)
                                            <?php
                                            $idModalDelete = $count . '_delete';
                                            $caminhoP = "/img/veiculos/" . $veiculo->id . "/m/" . $foto;
                                            $caminhoM = "/img/veiculos/" . $veiculo->id . "/m/" . $foto;
                                            ?>
                                            <div class="col-sm-2">
                                                <a href="#" data-toggle="modal" data-target="#{{$count}}">
                                                    <img src="/img/veiculos/{{$veiculo->id}}/p/{{$foto}}"
                                                         class="img-fluid mb-2" alt="white sample" width="150px">
                                                    <a href="#" class="control-btn remove" data-toggle="modal"
                                                       data-target="#{{$idModalDelete}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </a>
                                            </div>
                                            @include('modal.confirm_delete_imagem',['idModal'=>$idModalDelete,'rota'=>'agro.veiculo.deletar_imagem','id'=>$veiculo->id,'foto'=>$foto,'caminho'=>$caminhoP])
                                            @include('modal.imagem',['idModal'=>$count,'caminho'=>$caminhoM])

                                            <?php $count++; ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Salvar</button>
            </div>
        {!! Form::close() !!}
        <!-- /.card-body -->
        </div>

    </div>
@endsection

