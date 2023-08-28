@extends('layouts.'.Session::get('nome_rota'),["active"=>"pessoa"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nova pessoa</h3>
            </div>

            @if(isset($pessoa))
                {!! Form::model($pessoa, ['route' => ['bemestar.pessoa.update', $pessoa->id], 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
            @else
                {!! Form::open(['route' => 'bemestar.pessoa.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            @endif
            <div class="card-body">
                {{ Form::hidden('pessoa_tipo', 'F') }}
                <div class="row">
                    <div class="col-5">
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::text('nome', null, ["class"=>"form-control","placeholder" => "Nome"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::text('email', null, ["class"=>"form-control","placeholder" => "E-mail"]) !!}

                    </div>
                        <div class="col-4">
                            {!! Form::label('cpf', 'CPF') !!}
                            {!! Form::text('cpf', null, ["class"=>"form-control maskCpf","placeholder" => "000.000.000-00"]) !!}
                        </div>
                </div>
                <div class="row">
                   <div class="col-3">
                    {!! Form::label('data_nascimento', 'Data de Nascimento') !!}
                    {!! Form::date('data_nascimento', null, ["class"=>"form-control"]) !!}
                   </div>
                    <div class="col-3">
                        {!! Form::label('rg', 'RG') !!}
                        {!! Form::text('rg', null, ["class"=>"form-control","placeholder" => "RG"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('sexo', 'Sexo') !!}
                        {!! Form::select('sexo',[ 'M' => 'Masculino','F' => 'Feminino'], null, ['class'=>'form-control boxed']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('nacionalidade', 'Nacionalidade') !!}
                        {!! Form::text('nacionalidade', null, ["class"=>"form-control","placeholder" => "Nacionalidade"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        {!! Form::label('telefone', 'Telefone') !!}
                        {!! Form::text('telefone', null, ["class"=>"form-control","placeholder" => "(48) 0000-0000"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('celular', 'Celular') !!}
                        {!! Form::text('celular', null, ["class"=>"form-control","placeholder" => "(48) 90000-0000"]) !!}
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        {!! Form::label('cidade_id', 'Cidade') !!}
                        <div class="input-group">
                        {!! Form::text('cidade_id', null, ["class"=>"form-control col-3","readonly"=>"readonly"]) !!}
                        @if(isset($pessoa->cidade_id))
                            {!! Form::text('cidade', $pessoa->Cidade->nome, ["class"=>"form-control filtraNomeAjax","placeholder" => "Cidade","autocomplete"=>"nope"]) !!}
                        @else
                            {!! Form::text('cidade', null, ["class"=>"form-control filtraNomeAjax","placeholder" => "Cidade","autocomplete"=>"nope"]) !!}

                        @endif
                        <div id="Select1"></div>
                        </div>
                    </div>

                    <div class="col-4">
                        {!! Form::label('bairro', 'Bairro') !!}
                        {!! Form::text('bairro', null, ["class"=>"form-control","placeholder" => "Bairro"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('cep', 'CEP') !!}
                        {!! Form::text('cep', null, ["class"=>"form-control","placeholder" => "00000-000"]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {!! Form::label('endereco', 'Endereço') !!}
                        {!! Form::text('endereco', null, ["class"=>"form-control","placeholder" => "Endereço"]) !!}
                    </div>

                    <div class="col-4">
                        {!! Form::label('complemento', 'Complemento') !!}
                        {!! Form::text('complemento', null, ["class"=>"form-control","placeholder" => "Complemento"]) !!}
                    </div>

                    <div class="col-2">
                        {!! Form::label('numero', 'Número') !!}
                        {!! Form::text('numero', null, ["class"=>"form-control","placeholder" => "Número"]) !!}
                    </div>
                </div>
                @if(isset( $pessoa))
                    <br>
                    <div class="row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Fotos</label>
                        <div class="col-sm-10">
                            <input type="file" name="imagem[]" id="imagem" value="" multiple>
                        </div>
                    </div>
                    @if($pessoa->imagens())
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">Fotos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php $count = 'a'; ?>

                                        @foreach($pessoa->imagens() as $foto)
                                            <?php
                                            $idModalDelete = $count . '_delete';
                                            $caminhoP = "/img/pessoas/" . $pessoa->id . "/m/" . $foto;
                                            $caminhoM = "/img/pessoas/" . $pessoa->id . "/m/" . $foto;
                                            ?>
                                            <div class="col-sm-2">
                                                <a href="#" data-toggle="modal" data-target="#{{$count}}">
                                                    <img src="/img/pessoas/{{$pessoa->id}}/p/{{$foto}}"
                                                         class="img-fluid mb-2" alt="white sample" width="150px">
                                                    <a href="#" class="control-btn remove" data-toggle="modal"
                                                       data-target="#{{$idModalDelete}}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </a>
                                            </div>
                                            @include('modal.confirm_delete_imagem',['idModal'=>$idModalDelete,'rota'=>'bemestar.pessoa.deletar_imagem','id'=>$pessoa->id,'foto'=>$foto,'caminho'=>$caminhoP])
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

