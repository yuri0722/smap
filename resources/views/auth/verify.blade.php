@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7" style="margin-top: 2%">
                <div class="box">
                    <h3 class="box-title" style="padding: 2%">Verify Your Email Address</h3>

                    <div class="box-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Um novo link de verificação foi enviado para
                                Seu endereço de email
                            </div>
                        @endif
                        <p>Antes de prosseguir, verifique se há um link de verificação em seu e-mail. Se você não recebeu
                            o e-mail,</p>
                        <a href="{{ route('verification.resend') }}">clique aqui para solicitar outro</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
