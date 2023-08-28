@extends('layouts.bemestar',["active"=>"home"])

@section('content')
<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$countAnimal}}</h3>

                    <p>Total de Animais</p>
                </div>
                <div class="icon">
                    <i class="fa fa-paw"></i>
                </div>
                <a href="{{ route('bemestar.animal') }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
					<h3 title="{{ round ((($countCastracao/$countAnimal)*100),2) }}">{{$countCastracao}} </h3>
                    <p>Animais castrados</p>

                </div>
                <div class="icon">
                    <i class="fa fa-file-invoice"></i>
                </div>
                <a href="{{ route('bemestar.animal.castrado','S') }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$countPessoa}}</h3>

                    <p>Pessoas cadastradas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('bemestar.pessoas') }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$countEmpresa}}</h3>

                    <p>cadastro de empresas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-building"></i>
                </div>
                <a href="{{ route('bemestar.empresas') }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-purple">
                <div class="inner">
                    <h3>{{$countDog}}</h3>

                    <p>Cachorros</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dog"></i>
                </div>
                <a href="{{ route('bemestar.animal.por_especie',1) }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$countCat}}</h3>

                    <p>Gatos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cat"></i>
                </div>
                <a href="{{ route('bemestar.animal.por_especie',2) }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3 title="{{ round ((($countNaoCastracado/$countAnimal)*100),2) }}% dos animais">{{ ($countAnimal - $countCastracao) }} </h3>
                    <p>NÃO castrados</p>

                </div>
                <div class="icon">
                    <i class="fa fa-file-invoice"></i>
                </div>
                <a href="{{ route('bemestar.animal.castrado','N') }}" class="small-box-footer">Mais informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
</div>
@endsection
