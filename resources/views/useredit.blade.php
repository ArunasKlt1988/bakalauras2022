@php
    if(Auth::user()->Role === 'A') {
       $layoutDirectory = 'layouts.admin';
    }  else {
       $layoutDirectory = 'layouts.employee';
    }
@endphp

@extends($layoutDirectory)

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                <div class="card">
                    <div class="card-header"><strong>Darbuotojas</strong> {{$user->Vardas}} {{$user->Pavarde}}</div>

                    <div class="container">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form method="POST" action="{{url('/edit-user/'.$user->username)}}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="exampleFormControlInput1">El. paštas</label>
                                <input type="email" value="{{old('email', $user->email)}}" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pareigybės</label>
                                <select name="DarboKodas"  class="form-control" id="exampleFormControlSelect1">
                                    @foreach($darbai as $darbas)
                                        <option value="{{$darbas->Kodas}}">{{$darbas->KodoApr}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Išdarbinimo data</label>
                                <input type="date" value="{{old('PabaigosData', $user->PabaigosData)}}" name="PabaigosData" class="form-control">
                            </div>
                            <button class="btn btn-primary">Išsaugoti</button>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

