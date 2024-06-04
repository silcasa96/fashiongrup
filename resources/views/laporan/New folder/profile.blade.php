@extends('layouts.app2')

@section('content')
<div class="container">
    <body class="hold-transition register-page">
    @include('flash-message')
    <div class="register-box">
        <div class="register-logo">
            <a href=""><img src="{!! asset('ethica.png') !!}" alt="" style="height: 100px"/></a>
        </div>

        <div class="card">
            <form class="login-form" method="POST" action="{{ route('update_profile',$user->id) }}" enctype="multipart/form-data">
                @csrf
            <div class="card-body register-card-body">
                <p class="login-box-msg">Update Profile</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Full name" value="{!! $user->username !!}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" required value="{!! $user->email !!}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" minlength="6" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" placeholder="Image" id="image"  name="image">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-image"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Ubah</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
            </form>
        </div><!-- /.card -->
    </div>
    </body>
</div>
@endsection
