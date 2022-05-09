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
                <a href="{{action('DarbaiController@index')}}" class="btn btn-primary">Grįžti</a>

                <div class="card" style="width: 60rem;">
                    <div class="card-header">Pareigybių Kodai</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

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
                                </tr>

                            @endforeach
                        </table>

                            <form method="POST" action="{{url('/add-pavdarbas/'.$darbas->Kodas)}}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pavojingas Darbas</label>
                                    <select name="pavdarbai"  class="form-control" id="exampleFormControlSelect1">
                                        @foreach($pavojingidarbai as $pavojingidarbas)
                                            <option value="{{$pavojingidarbas->Id}}">{{$pavojingidarbas->DarboApr}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary">Išsaugoti</button>
                            </form>

                            <form method="POST" action="{{url('/add-pavmedziaga/'.$darbas->Kodas)}}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pavojinga Medžiaga</label>
                                    <select name="pavmedziagos"  class="form-control" id="exampleFormControlSelect1">
                                        @foreach($pavojingosmedziagos as $pavojingosmedziaga)
                                            <option value="{{$pavojingosmedziaga->Id}}">{{$pavojingosmedziaga->Veiksnio_MedziagosApr}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary">Išsaugoti</button>
                            </form>


                            <h5><strong>Pavojingi darbai</strong></h5>
                            <table class="table">
                                @foreach($darbas->pavojingidarbai as $pavdarbai)
                                    <tr class="positive">
                                        <td>{{$pavdarbai->DarboApr}}</td>

                                        <td style="display:flex"></td>
                                        <td>
                                            <form action="{{url('/delete-pavdarbas/'.$darbas->Kodas.'/'.$pavdarbai->Id)}}" method="POST">

                                                {{method_field('DELETE')}}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger" type="submit">-</button></form>
                                        </td>
                                    </tr>

                                @endforeach
                            </table>


                            <h5><strong>Pavojingi veiksniai</strong></h5>
                            <table class="table">
                                @foreach($darbas->medziagos as $pav)
                                    <tr class="positive">
                                        <td>{{$pav->Veiksnio_MedziagosApr}}</td>

                                        <td style="display:flex"></td>
                                        <td>
                                            <form action="{{url('/delete-medziaga/'.$darbas->Kodas.'/'.$pav->Id)}}" method="POST">

                                                {{method_field('DELETE')}}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger" type="submit">-</button></form>
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




