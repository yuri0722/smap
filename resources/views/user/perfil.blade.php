@extends('layouts.smap')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if($user->nomeFotoPerfil()!="")
                            <img class="profile-user-img img-fluid img-circle" src="/img/users/{{$user->id}}/l/{{$user->nomeFotoPerfil()}}" >

                        @else
                            <img class="profile-user-img img-fluid img-circle" src="/img/avatarm.png" >
                        @endif
                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->cargo }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                       <!-- <li class="list-group-item">
                            <b>Cargo</b> <a class="float-right">0</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="float-right">13,287</a>
                        </li>-->
                    </ul>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                @if(isset($user))
                    {!! Form::model($user, ['route' => ['smap.perfil.update', $user->id], 'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
                @endif
                <div class="card-body">
                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ["class"=>"form-control","placeholder" => "Nome","required"=>"required"]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Cargo</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('cargo', null, ["class"=>"form-control","placeholder" => "Cargo"]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('email', null, ["class"=>"form-control","placeholder" => "Nome","required"=>"required"]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Senha</label>
                                    <div class="col-sm-10">
                                        {!! Form::input('password','password', null, ["class"=>"form-control"]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label" title="Confirme a senha">Conf. a senha</label>
                                    <div class="col-sm-10">
                                        {!! Form::input('password','password_confirmation', null, ["class"=>"form-control"]) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file"  name="imagem" id="imagem" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>


                </div><!-- /.card-body -->
            </div>
                {!! Form::close() !!}
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection
