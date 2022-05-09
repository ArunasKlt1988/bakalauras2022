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
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif
                    @if(Auth::user()->Role === 'A')
                <a href="{{action('DarbaiController@create')}}" class="btn btn-primary">Sukurti pareigybę</a>
                    @else
                    @endif
                <div class="card">
                    <div class="card-header">Pareigybių Kodai</div>
                    <div class="col-md-4">
                        <form action="/searchjobcode" method="get">
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
                                <th>Pareigybės Kodas</th>
                                <th>Pareigybės Aprašymas</th>
                            </tr>

                            @foreach($darbai as $darbas)
                                <tr class="positive">
                                    <td>{{$darbas->Kodas}}</td>
                                    <td>{{$darbas->KodoApr}}</td>
                                    <td style="display:flex"></td>

                                    <td>
                                        <form action="{{url('/delete-jobcode/'.$darbas->Kodas)}}" method="POST">
                                            <a href="{{action('DarbaiController@show', $darbas->Kodas)}}" class="btn btn-warning">Rodyti</a>
                                            @if(Auth::user()->Role === 'A')
                                            <a href="{{action('DarbaiController@edit', $darbas->Kodas)}}" class="btn btn-primary">Redaguoti</a>

                                            {{method_field('DELETE')}}
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger" type="submit">Trinti</button></form>
                                        @else
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection




