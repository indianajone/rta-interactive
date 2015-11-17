@extends('layouts.cms')

@section('content')

<div class="col-md-4 col-md-offset-4">
    <h2 class="text-center">Please login</h2>
    <form>
        <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address">
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password address</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-lg btn-block btn-success">Login</button>
    </form>
</div>

@stop