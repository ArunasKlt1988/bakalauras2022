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
                <a href="{{action('Sveikatos_TikrinimasController@create')}}" class="btn btn-primary">Naujas paraiška</a>

                <div class="card">
                    <div class="card-header">Įrašų istorija</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <table class="table">
                            <tr>
                                <th>Pareigybė</th>
                                <th>Data</th>
                                <th>Statusas</th>
                            </tr>

                            @foreach($irasai as $irasas)
                                <tr class="positive">
                                    <td>{{$irasas->jobcode->KodoApr}}</td>
                                    <td>{{$irasas->Data}}</td>
                                    <td>{{$irasas->status->StatusoApr}}</td>
                                    <td><a href="{{url('/found/' .$irasas->Id. '/' .$irasas->Failas)}}" target="_blank">Failas</a></td>
                                    <td style="display:flex"></td>
                                    <td>
                                        <a href="{{action('Sveikatos_TikrinimasController@show', $irasas->DarboKodas)}}" class="btn btn-warning">Rodyti</a>

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




