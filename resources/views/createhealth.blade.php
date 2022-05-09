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
                    <div class="card-header">Sveikatos patikros patvirtinimas</div>


                    <div class="container">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{action('Sveikatos_TikrinimasController@store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Data</label>
                                <input type="date" name="pass_date" class="form-control" required autocomplete="pass_date" autofocus>
                                <label for="exampleFormControlInput1">Dokumentas</label>
                                <input type="file" name="file" class="form-control" required autocomplete="file" autofocus>
                            </div>


                            <button class="btn btn-primary">Išsaugoti</button>
                            <a href="{{action('Sveikatos_TikrinimasController@index')}}" class="btn btn-primary float-sm-right">Grįžti</a>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

