@extends('errors::illustrated-layout')

@section('title', __('Invalid Certificate'))
{{--@section('code', '400')--}}
@section('message', __('Invalid Certificate. The provided verification link is invalid'))
@section('image')
    <div style="background-image: url({{ asset('images/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
