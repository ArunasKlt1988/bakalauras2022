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
                    <div class="card-header">Sukruti darbo kodą</div>

                    <div class="container">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{action('DarbaiController@store')}}">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="exampleFormControlInput1">Darbo kodas</label>
                                <input type="text"  name="kodas" class="form-control" required autocomplete="kodas" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Darbo aprašymas</label>
                                <input type="text" name="apr" class="form-control" required autocomplete="apr" autofocus>
                            </div>

                            <button class="btn btn-primary">Išsaugoti</button>
                            <a href="{{action('DarbaiController@index')}}" class="btn btn-primary float-sm-right">Grįžti</a>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

