@extends('layouts.bemestar',["active"=>"animal"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                @if(isset($animal))
                    <h3 class="card-title">Editar {{$animal->nome}}</h3>
                    {!! Form::model($animal, ['route' => ['bemestar.animal.update', $animal->id], 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
                @else
                    <h3 class="card-title">Novo animal</h3>
                    {!! Form::open(['route' => 'bemestar.animal.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        {!! Form::label('pessoa_id', 'Dono') !!}
                        <div class="input-group">
                            {!! Form::text('pessoa_id', null, ["class"=>"form-control col-3","readonly"=>"readonly"]) !!}
                            @if(isset($animal->pessoa_id))
                                {!! Form::text('pessoa', $animal->Dono->nome, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome do dono","autocomplete"=>"off"]) !!}
                            @else
                                {!! Form::text('pessoa', null, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome do dono","autocomplete"=>"off"]) !!}
                            @endif
                            <div id="Select1"></div>
                        </div>
                    </div>
                    <div class="col-4">
                        {!! Form::label('nome', 'Nome do animal') !!}
                        {!! Form::text('nome', null, ["class"=>"form-control","placeholder" => "Nome"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('situacao', 'Animal de:') !!}
                        {!! Form::select('situacao',[ 'P' => 'Proprietário','R' => 'Rua','C'=>'Cuidador(a)'], null, ['class'=>'form-control boxed']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        {!! Form::label('especie_id', 'Espécie') !!}
                        {!! Form::select('especie_id', $especieAnimal, null, ["class"=>"form-control"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('porte_id', 'Porte') !!}
                        {!! Form::select('porte_id', $porteAnimal, null, ["class"=>"form-control"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('sexo', 'Sexo') !!}
                        {!! Form::select('sexo',[ 'M' => 'Macho','F' => 'Fêmea'], null, ['class'=>'form-control boxed']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('raca', 'Raça') !!}
                        {!! Form::text('raca', null, ["class"=>"form-control","placeholder" => "Raça"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <legend>Peso</legend>
                        <div class="input-group">
                            <div class="col-6">
                                {!! Form::label('kilos', 'Kilos') !!}
                                {!! Form::number('kilos', null, ["class"=>"form-control","min"=>"0"]) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('gramas', 'Gramas') !!}
                                {!! Form::number('gramas', null, ["class"=>"form-control","min"=>"0"]) !!}

                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <legend class="">Idade</legend>
                        <div class="input-group">
                            <div class="col-6">
                                {!! Form::label('anos', 'Anos') !!}
                                {!! Form::number('anos', null, ["class"=>"form-control","min"=>"0"]) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('meses', 'Meses') !!}
                                {!! Form::number('meses', null, ["class"=>"form-control","min"=>"0"]) !!}

                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-3">
                        {!! Form::label('chip', 'CHIP') !!}
                        {!! Form::text('chip', null, ["class"=>"form-control","placeholder" => "CHIP"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('pelagem', 'Pelagem') !!}
                        {!! Form::text('pelagem', null, ["class"=>"form-control","placeholder" => "Pelagem"]) !!}
                    </div>
                    <div class="col-4">
                        {!! Form::label('caracteristicas', 'Sinais característicos') !!}
                        {!! Form::text('caracteristicas', null, ["class"=>"form-control","placeholder" => "Sinais característicos"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('castrado', 'Castrado') !!}
                        {!! Form::select('castrado',[ 'N' => 'Não','S' => 'Sim'], null, ['class'=>'form-control']) !!}
                    </div>

                </div>
                @if(isset( $animal))
                    <br>
                    <div class="row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Fotos</label>
                        <div class="col-sm-10">
                            <input type="file" name="imagem[]" id="imagem" value="" multiple>
                        </div>
                    </div>
                    @if($animal->imagens())
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">Fotos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php $count = 'a'; ?>

                                        @foreach($animal->imagens() as $foto)
                                            <?php
                                            $idModalDelete = $count . '_delete';
                                            $caminhoP = "/img/animals/" . $animal->id . "/m/" . $foto;
                                            $caminhoM = "/img/animals/" . $animal->id . "/m/" . $foto;
                                            ?>
                                            <div class="col-sm-2">
                                                <a href="#" data-toggle="modal" data-target="#{{$count}}">
                                                    <img src="/img/animals/{{$animal->id}}/p/{{$foto}}"
                                                         class="img-fluid mb-2" alt="white sample" width="150px">
                                                    <a href="#" class="control-btn remove" data-toggle="modal"
                                                       data-target="#{{$idModalDelete}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </a>
                                            </div>
                                            @include('modal.confirm_delete_imagem',['idModal'=>$idModalDelete,'rota'=>'bemestar.animal.deletar_imagem','id'=>$animal->id,'foto'=>$foto,'caminho'=>$caminhoP])
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

