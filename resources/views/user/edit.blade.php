@extends('layouts.admin',["active"=>"users"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">

                @if(isset($user))
                    <h3 class="card-title">Editar <b>{{$user->name}}</b></h3>
                    {!! Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'PUT']) !!}
                @else
                    <h3 class="card-title">Novo usuário</h3>
                    {!! Form::open(['route' => 'admin.user.store', 'method' => 'POST']) !!}
                @endif
            </div>
            <div class="card-body">
                {{ Form::hidden('pessoa_tipo', 'F') }}
                <div class="row form-group">
                    <div class="col-4">
                        {!! Form::label('name', 'Nome') !!}
                        {!! Form::text('name', null, ["class"=>"form-control","placeholder" => "Nome"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('email', 'E-mail') !!}
                        {!! Form::text('email', null, ["class"=>"form-control","placeholder" => "E-mail"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('cpf', 'CPF') !!}
                        {!! Form::text('cpf', null, ["class"=>"form-control maskCpf","placeholder" => "000.000.000-00"]) !!}
                    </div>
                    <div class="col-2 form-inline">
                        <div class="form-check">
                            {!! Form::checkbox('is_motorista', 1,null,["class"=>"form-check-input","id"=>"is_motorista"]) !!}
                            <label for="is_motorista" class="form-checkbox-label">Motorista</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        {!! Form::label('pessoa_id', 'Pessoa') !!}
                        <div class="input-group">
                            {!! Form::text('pessoa_id', null, ["class"=>"form-control col-3","readonly"=>"readonly"]) !!}
                            @if(isset($user->pessoa_id))
                                {!! Form::text('pessoa', $user->Pessoa->nome, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome da pessoa","autocomplete"=>"nope"]) !!}
                            @else
                                {!! Form::text('pessoa', null, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome da pessoa","autocomplete"=>"nope"]) !!}
                            @endif
                            <div id="Select1"></div>
                        </div>
                    </div>


                    <div class="col-3">
                        {!! Form::label('password', 'Senha') !!}
                        {!! Form::input('password','password', null, ["class"=>"form-control"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('password_confirmation', 'Conf. a senha') !!}
                        {!! Form::input('password','password_confirmation', null, ["class"=>"form-control"]) !!}
                    </div>

                </div>
                <br>
                <div class="row form-inline">
                    <div class="col-3">
                        <div class="form-check">
                            {!! Form::checkbox('md_animal', 1,null,["class"=>"form-check-input","id"=>"md_animal"]) !!}
                            <label for="md_animal" class="form-check-label">Módulo Animal</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            {!! Form::checkbox('md_agro', 1,null,["class"=>"form-check-input","id"=>"md_agro"]) !!}
                            <label for="md_agro" class="form-check-label">Módulo Agro</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            {!! Form::checkbox('md_pesca', 1,null,["class"=>"form-check-input","id"=>"md_pesca"]) !!}
                            <label for="md_pesca" class="form-check-label">Módulo Pesca</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            {!! Form::checkbox('md_sim', 1,null,["class"=>"form-check-input","id"=>"md_sim"]) !!}
                            <label for="md_sim" class="form-check-label">Módulo SIM</label>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Salvar</button>
            </div>
        {!! Form::close() !!}
        <!-- /.card-body -->
        </div>

    </div>
@endsection

