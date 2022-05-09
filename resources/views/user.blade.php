@php
    if(Auth::user()->Role === 'A') {
       $layoutDirectory = 'layouts.admin';
    }  else {
       $layoutDirectory = 'layouts.employee';
    }
@endphp

@extends($layoutDirectory)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                    <div class="card">
                        <div class="card-header">Darbuotojai</div>
                        <div class="col-md-4">
                            <form action="/search" method="get">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control">
                                    <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Rasti</button>
                                </span>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



                        <table class="table">
                            <tr>
                                <th>Vardas</th>
                                <th>Pavardė</th>
                                <th>Darbo Aprašymas</th>
                                <th>El. paštas</th>
                                <th>Išdarbinimo data</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user ->Vardas}}</td>
                                    <td>{{$user ->Pavarde}}</td>
                                    <td>{{$user ->darbai->KodoApr}}</td>
                                    <td>{{$user ->email}}</td>
                                    <td>{{$user ->PabaigosData}}</td>
                                    <td style="display:flex">

                                        <a class="btn btn-primary" href="{{ url('/edit-user/'.$user->username)}}">Redaguoti</a>

                                    </td>
                                </tr>

                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
@endsection
