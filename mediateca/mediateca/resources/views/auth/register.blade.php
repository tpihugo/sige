@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card font-weight-bold bg-transparente text-dark">
                <div class="card-header bg-dark text-light">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row align-items-center">
                            <div class="input-group form-group col-md-6 offset-md-3">
						        <div class="input-group-prepend">
							        <span class="input-group-text"><i class="fas fa-user"></i></span>
						        </div>
						        <input id="name" placeholder="{{ __('Name') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
					        </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row align-items-center">
                           
						        <input id="rol" placeholder="{{ __('rol') }}" type="hidden" class="form-control @error('rol') is-invalid @enderror" name="rol" value="Estudiante" required autocomplete="rol">
					       
                                @error('rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row align-items-center">
                            <div class="input-group form-group col-md-6 offset-md-3">
						        <div class="input-group-prepend">
							        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
						        </div>
						        <input placeholder="{{ __('E-Mail Address') }}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
					        </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="row align-items-center">
                            <div class="input-group form-group col-md-6 offset-md-3">
						        <div class="input-group-prepend">
							        <span class="input-group-text"><i class="fas fa-key"></i></span>
						        </div>
						        <input placeholder="{{ __('Password') }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
					        </div>
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="row align-items-center">
                            <div class="input-group form-group col-md-6 offset-md-3">
						        <div class="input-group-prepend">
							        <span class="input-group-text"><i class="fas fa-key"></i></span>
						        </div>
						        <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					        </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
