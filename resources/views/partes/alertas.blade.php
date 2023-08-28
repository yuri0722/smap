@unless($errors->isEmpty())
    <div class="card bg-danger text-white">
        @foreach($errors->getMessages() as $error)
            <div class="card-body">{{ $error[0] }}</div>
        @endforeach
    </div>
@endunless

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success') }}
    </div>
@elseif (Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('error') }}
    </div>
@elseif(Session::has('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('warning') }}
    </div>
@endif

@if(Session::has('duploLogin'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('duploLogin') }}
    </div>
    <?php Session::forget('duploLogin'); ?>
@endif
