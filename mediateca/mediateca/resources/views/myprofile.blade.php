
@extends('layouts.plantillabase')
@section('titulo','Perfil')
@section('css')
@endsection
@section('contenido')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @if(Auth::user()->profile_photo_path == null)
                <img class="rounded-circle mt-5" width="150px" src="{{ asset('/img/profiles/user.png') }}">
                @else
                    <img class="rounded-circle mt-5" width="150px" src="{{ asset('/img/profiles/'.Auth::user()->profile_photo_path) }}">
                @endif
                    <span class="font-weight-bold">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="text-black-50">
                        {{ Auth::user()->email }}
                    </span>
                    <div class="row mt-2">
                        <form action="{{ route('myprofile.save') }}" method="POST" enctype="multipart/form-data" accept="image/*">
                            @csrf
                            <input id="file" name="file" type="file" class="form-control" data-allowed-file-extensions='[".jpg", ".png",  ".jpeg"]' required>
                            <button type="submit" class="btn btn-sm col-sm-5 offset-7 btn-primary mt-1">{{ __('Save Photo') }}</button>
                        </form>
                    </div>
                </div>
        </div>

        <div class="col-md-5 offset-1 border-right">
            <div class="p-3 py-5">

                <form action="{{ route('myprofile.update') }}" method="POST">
                    @csrf
                    @method('put');
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">{{ __('Profile Settings') }}</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">{{ __('Name') }}</label><input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ Auth::user()->name }}"></div>
                        </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">{{ __('Email ID') }}</label><input type="text" name="email" class="form-control" placeholder="enter email id" value="{{ Auth::user()->email }}"></div>
                    </div>

                    <div class="row mt-3">
                        <h5 class="text-right">{{ __('Change Password') }}</h5>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">{{ __('Password') }}</label><input type="password" name="pwd" class="form-control" placeholder="{{ __('Password') }}" value=""></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">{{ __('Confirm Password') }}</label><input type="password" name="rpwd" class="form-control" placeholder="{{ __('Confirm Password') }}" value=""></div>
                    </div>

                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">{{ __('Save Profile') }}</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>


@endsection


