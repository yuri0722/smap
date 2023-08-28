<div class="card-header">
    <h3 class="card-title">{{$listaNome}}</h3>

    <div class="card-tools">
      {{ Form::open(['route' => $rota, 'method' => 'GET']) }}
        <div class="input-group input-group-sm" style="width: 290px;">
            <input type="text" name="busca" class="form-control float-right" placeholder="Busca">

            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="input-group-append">
                <a href="{{$rotaNovo}}" class="btn btn-default text-success">
                    <i class="fas fa-2x fa-plus-circle"></i>
                </a>
            </div>

        </div>
     {{ Form::close() }}
    </div>
</div>
<!-- /.card-header -->
