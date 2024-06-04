@extends('layouts.template')

@section('content')
    <div class="d-flex justify-content-center">
        <h2>Salsa Jaring Persada</h2>
    </div>
    <div class="d-flex justify-content-center">
        <h3>Selamat Datang Di Aplikasi ERP || ES-iOS</h3>
    </div>
    <hr>
    <div class="d-flex justify-content-center">
        <img src="{{ asset('dist/images/logo-sjp.jpg') }}" width="20%" alt="" />
    </div>
@endsection

@push('script')
    <script>
        $(function () {
            $("#example").DataTable({
                "scrollX" : true,
                "scrollY" : true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush