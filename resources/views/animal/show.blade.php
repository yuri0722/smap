<!-- arquivo acrescentado para visualização informações do animal antes da exclusão-->

@extends('layouts.bemestar',["active"=>"animal"])

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                @if(isset($animal))
                    <h3 class="card-title">Deletar {{$animal->nome}}</h3>
                    {!! Form::model($animal, ['route' => ['bemestar.animal.destroy', $animal], 'method' => 'delete','enctype'=>'multipart/form-data']) !!}
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
                                {!! Form::text('pessoa', $animal->Dono->nome, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome do dono","autocomplete"=>"off", "readonly"=>"readonly"]) !!}
                            @else
                                {!! Form::text('pessoa', null, ["class"=>"form-control filtraNomeAjax","placeholder" => "Nome do dono","autocomplete"=>"off", "readonly"=>"readonly"]) !!}
                            @endif
                            <div id="Select1"></div>
                        </div>
                    </div>
                    <div class="col-4">
                        {!! Form::label('nome', 'Nome do animal') !!}
                        {!! Form::text('nome', null, ["class"=>"form-control","placeholder" => "Nome", "readonly"=>"readonly"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('situacao', 'Animal de:') !!}
						{!! Form::select('situacao',[ 'P' => 'Proprietário','R' => 'Rua','C'=>'Cuidador(a)'], null, ['class'=>'form-control boxed', 'disabled', 'selected']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        {!! Form::label('especie_id', 'Espécie') !!}
                        {!! Form::select('especie_id', $especieAnimal, null, ["class"=>"form-control", 'disabled', 'selected']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('porte_id', 'Porte') !!}
                        {!! Form::select('porte_id', $porteAnimal, null, ["class"=>"form-control", 'disabled', 'selected']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('sexo', 'Sexo') !!}
                        {!! Form::select('sexo',[ 'M' => 'Macho','F' => 'Fêmea'], null, ['class'=>'form-control boxed', 'disabled', 'selected']) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('raca', 'Raça') !!}
                        {!! Form::text('raca', null, ["class"=>"form-control","placeholder" => "Raça", "readonly"=>"readonly"]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <legend>Peso</legend>
                        <div class="input-group">
                            <div class="col-6">
                                {!! Form::label('kilos', 'Kilos') !!}
                                {!! Form::number('kilos', null, ["class"=>"form-control","min"=>"0", "readonly"=>"readonly"]) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('gramas', 'Gramas') !!}
                                {!! Form::number('gramas', null, ["class"=>"form-control","min"=>"0", "readonly"=>"readonly"]) !!}

                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <legend class="">Idade</legend>
                        <div class="input-group">
                            <div class="col-6">
                                {!! Form::label('anos', 'Anos') !!}
                                {!! Form::number('anos', null, ["class"=>"form-control","min"=>"0", "readonly"=>"readonly"]) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('meses', 'Meses') !!}
                                {!! Form::number('meses', null, ["class"=>"form-control","min"=>"0", "readonly"=>"readonly"]) !!}

                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-3">
                        {!! Form::label('chip', 'CHIP') !!}
                        {!! Form::text('chip', null, ["class"=>"form-control","placeholder" => "CHIP", "readonly"=>"readonly"]) !!}
                    </div>
                    <div class="col-3">
                        {!! Form::label('pelagem', 'Pelagem') !!}
                        {!! Form::text('pelagem', null, ["class"=>"form-control","placeholder" => "Pelagem", "readonly"=>"readonly"]) !!}
                    </div>
                    <div class="col-4">
                        {!! Form::label('caracteristicas', 'Sinais característicos') !!}
                        {!! Form::text('caracteristicas', null, ["class"=>"form-control","placeholder" => "Sinais característicos", "readonly"=>"readonly"]) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::label('castrado', 'Castrado') !!}
                        {!! Form::select('castrado',[ 'N' => 'Não','S' => 'Sim'], null, ['class'=>'form-control', 'disabled', 'selected']) !!}
                    </div>

                </div>
                
            </div>
			@if(isset($animal->Castracao))
				@if($animal->Castracao->castrado == 'S')
					<div class="card-footer">
						<label><font color="red">ANIMAL NÃO PODE SER DELETADO POIS É CASTRADO</font></label>
					</div>
				@else
					<form action="{{ route('bemestar.animal.destroy', $animal->id) }}" method="post">
						@csrf
						<div class="card-footer">
							<button type="submit" class="btn btn-danger float-right">Deletar</button>
						</div>
					</form>
				@endif
			@else
				<form action="{{ route('bemestar.animal.destroy', $animal->id) }}" method="post">
					@csrf
					<div class="card-footer">
						<button type="submit" class="btn btn-danger float-right">Deletar</button>
					</div>
				</form>
			@endif
			
        {!! Form::close() !!}
        <!-- /.card-body -->
        </div>

    </div>
@endsection

