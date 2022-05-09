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
                <a href="{{action('Sveikatos_TikrinimasController@index')}}" class="btn btn-primary">Grįžti</a>

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
                            <h5><strong>Pavojingi darbai</strong></h5>
<table class="table">

    <tr>
        <ul>
                @foreach($darbas->pavojingidarbai as $pav)
                <li><strong>Darbo aprašymas:</strong></li>
                    <ul>{{$pav->DarboApr}}</ul>
                    <ul><strong>Terminas:</strong></ul>
                    <ul>{{$pav->Periodas}} metai</ul>
                <ul><strong>Pirmo lygio patikra: </strong></ul>
                <ul>{{$pav->SveikatosTikrintojai1}} </ul>
                <ul><strong>Antro lygio patikra: </strong></ul>
                <ul>{{$pav->SveikatosTikrintojai2}}</ul>
                <ul><strong>Privalomi tyrimai:  </strong></ul>
                <ul>{{$pav->PivalomiTyrimai}}</ul>
                <ul><strong>Papildomos kontraindikacijos: </strong></ul>
                <ul>{{$pav->PapildomosKontraindikacijos}}</ul>
                @endforeach
            </ul>
    </tr>


</table>
                            <h5><strong>Pavojingi veiksniai</strong></h5>
                            <table class="table">


                            <tr>
                                <ul>
                                    @foreach($darbas->medziagos as $pav)
                                        <li><strong>Medžiaga-veiksnys:</strong></li>
                                        <ul>{{$pav->Veiksnio_MedziagosApr}}</ul>
                                        <ul><strong>Terminas:</strong></ul>
                                        <ul>{{$pav->Periodas}} metai</ul>
                                        <ul><strong>Veiksniai: </strong></ul>
                                        <ul>{{$pav->VeiksnioApr}}</ul>
                                        <ul><strong>Pobūdis: </strong></ul>
                                        <ul>{{$pav->Pobudis}}</ul>
                                        <ul><strong>Pirmo lygio patikra: </strong></ul>
                                        <ul>{{$pav->SveikatosTikrintojai1}} </ul>
                                        <ul><strong>Antro lygio patikra: </strong></ul>
                                        <ul>{{$pav->SveikatosTikrintojai2}}</ul>
                                        <ul><strong>Privalomi tyrimai:  </strong></ul>
                                        <ul>{{$pav->PivalomiTyrimai}}</ul>
                                        <ul><strong>Papildomos kontraindikacijos: </strong></ul>
                                        <ul>{{$pav->PapildomosKontraindikacijos}}</ul>
                                    @endforeach
                                </ul>
                            </tr>


                            </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection




