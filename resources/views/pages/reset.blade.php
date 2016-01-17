@extends('layouts.master')

@section('content')
    <br>
    <br>
    <br>
    <br>
    {!! Form::open(['route' => 'password_path', 'method' => 'POST', 'class' => 'col-md-6 col-md-offset-3']) !!}
        @include('components.error')
        <h3>{{ trans('form.heading.reset') }}</h3>
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email" class="sr-only">{{ trans('form.inputs.email') }}</label>
            <input type="email" name="email" class="form-control" placeholder="{{ trans('form.inputs.email') }}" value="{{ $email or old('email') }}" >
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">{{ trans('form.inputs.password') }}</label>
            <input type="password" name="password" class="form-control" placeholder="{{ trans('form.inputs.password') }}">
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="sr-only">{{ trans('form.inputs.password_confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('form.inputs.password_confirmation') }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-success">
                {{ trans('form.buttons.confirm') }}
            </button>
        </div>
    {!! Form::close() !!}
@stop