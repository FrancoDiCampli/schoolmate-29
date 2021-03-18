@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="flex flex-row justify-center">
        <div class="">
            <div class="">
                <div class="text-xl font-bold">{{ __('Confirm Password') }}</div>

                <div class="">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="flex flex-wrap my-5">
                            <label for="password" class="">{{ __('Password') }}</label>

                            <div class="w-full md:w-full md:mb-0 mb-6">
                                <input id="password" type="password"
                                    class="form-input w-full block @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                <span class="flex italic text-red-600  text-sm" role="alert" id="titleError">
                                    {{$errors->first('password')}}
                                </span>
                            </div>
                        </div>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
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