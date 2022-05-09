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
                    <div class="card-header">Sąrašas</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                        <table class="table">
                            <tr>
                                <th>Darbuotojas</th>
                                <th>Pareigybė</th>
                                <th>Data</th>
                                <th>Statusas</th>
                            </tr>

                            @foreach($irasai as $irasas)
                                <tr class="positive">
                                    <td>{{$irasas->users->Vardas}} {{$irasas->users->Pavarde}}</td>
                                    <td>{{$irasas->jobcode->KodoApr}}</td>
                                    <td>{{$irasas->Data}}</td>
                                    <td>{{$irasas->status->StatusoApr}}</td>
                                    <td><a href="{{url('/found/' .$irasas->Id. '/' .$irasas->Failas)}}" target="_blank">Failas</a></td>
                                    <td style="display:flex"></td>
                                    <td>
                                        <form action="{{ route('rejectform', $irasas->Id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Atmesti</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('approveform', $irasas->Id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">Patvirtinti</button>
                                        </form>
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




