@extends('admin.layouts.auth')
@section('title') {{__('text.login')}} @endsection

@section('content')
    <div class="row page-header justify-content-center no-gutters py-4">
        <div class="col-6 text-center mb-0">
            <h3 class="page-title">{{__('text.administration_page')}}</h3>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{__('text.login')}}</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('login')}}" novalidate>
                        @csrf

                        <div class="form-group form-row">
                            <label for="email" class="col-2 col-form-label text-right">
                                {{__('text.email')}}
                            </label>
                            <div class="col-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{old('email')}}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="password" class="col-2 col-form-label text-right">
                                {{__('text.password')}}
                            </label>
                            <div class="col-10">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group form-row mb-0">
                            <div class="col-10 offset-2">
                                <button type="submit" class="btn btn-primary">
                                    {{__('text.login')}}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{route('password.request')}}">
                                        {{__('text.forgot_password')}}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
