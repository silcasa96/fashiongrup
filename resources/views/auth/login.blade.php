@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="d-flex justify-content-center">
            <img src="{{ asset('dist/images/logo-sjp.jpg') }}" style="width: 50%" alt="Image" class="img-fluid">
          </div>
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Login</h3>
              {{-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> --}}
            </div>
              @include('flash-message')
            <form action="{!! route('login') !!}" method="post">
              @csrf
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">
            
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
@endsection
