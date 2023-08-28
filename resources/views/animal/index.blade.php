@extends('layouts.bemestar',["active"=>"animal"])

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				@include('form.busca_add',['rota'=>'bemestar.animal.pesquisa', 'listaNome'=>'Lista de Animais','rotaNovo'=>route('bemestar.animal.edit')])
				<div class="card-body table-responsive p-0">
					<table class="table table-hover table-striped">
						<thead>
						<tr>
							<th>Img</th>
							<th>@sortablelink('id')</th>
							<th>@sortablelink('nome')</th>
							<th>Dono</th>
							<th>@sortablelink('especie_id','Espécie')</th>
							<th>Castrado</th>
							<th>Ação</th>
						</tr>
						</thead>
						<tbody>	
						
						@foreach($animals as $animal)
							<tr>
								@if($animal->imagens())
									<td>
										<a href="#" data-toggle="modal" data-target="#delete{{$animal->id}}">
											<img src="/img/animals/{{$animal->id}}/p/{{$animal->imagens()[0]}}"
												 class="img-fluid mb-2" alt="white sample" width="60px">
										</a>
										@include('modal.imagem',['idModal'=>'delete'.$animal->id,'caminho'=>"/img/animals/".$animal->id."/m/".$animal->imagens()[0]])
									</td>
								@else
									@if($animal->especie_id==1)
										<td>
											<img src="/img/dog.png" class="img-fluid mb-2" alt="white sample"
												 width="60px">
										</td>
									@else
										<td>
											<img src="/img/cat.png" class="img-fluid mb-2" alt="white sample"
												 width="60px">
										</td>
									@endif

								@endif
								<td>{{$animal->id}}</td>
								<td>{{$animal->nome}}</td>
								@if(isset($animal->pessoa_id))
									<td>{{$animal->Dono->nome}}</td>
								@else
									<td></td>
								@endif

								<td>{{$animal->Especie->nome}}</td>
								@if(isset($animal->Castracao))
									@if($animal->Castracao->castrado=="S")
										<td>SIM</td>
									@else
										<td title="{{$animal->Castracao->observacao}}">NÃO</td>
									@endif
								@else
									<td>NÃO</td>
								@endif
								<td>
									<a class="edit" href="{{route('bemestar.animal.edit',$animal->id)}}"
									   title="Editar animal">
										<i class="fa  fa-edit"></i>
									</a>
									&nbsp;
									<a class="edit" href="{{route('bemestar.animal.castracao',$animal->id)}}"
									   title="Formulário de castração animal">
										<i class="fas fa-cut"></i>
									</a>
									@if(isset($animal->Castracao))
										<a class="edit"
										   href="{{route('bemestar.animal.castracao_print',$animal->Castracao->id)}}"
										   title="Impressão do formulário de castração" target="_blank">
											<i class="fas fa-print"></i>
										</a>
									@endif
									<!-- acrescentar botão de delete - Yuri -->
									<a class="edit" href="{{route('bemestar.animal.show',$animal->id)}}"
									   title="Deletar animal">
										<i class="fas fa-trash-alt"></i>
									</a>
								</td>
							</tr>
						@endforeach


						</tbody>
					</table>
					<nav class="text-center">
						{!! $animals->appends(\Request::except('page'))->render() !!}
					</nav>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>
</div>
@endsection
