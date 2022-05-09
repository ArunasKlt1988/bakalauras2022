<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Darbai;
use App\PavojingiDarbai;
use App\Pilnas_Poveiksimis_medziaga;

class DarbaiController extends Controller
{

    public function index() {
        $darbai = Darbai::all();
        return view('createjobcode',compact('darbai'));
    }

    public function searchjobcode(Request $request)
    {


        $darbai = Darbai::where('Kodas', 'like', '%'.$request->search.'%')
            ->orWhere('KodoApr', 'like', '%'.$request->search.'%')->get();
        return view('createjobcode',['darbai' => $darbai]);
    }


    public function show($Kodas) {
        $darbai = Darbai::with('pavojingidarbai')
            ->where('Kodas', '=', $Kodas)->get();
        $medziagos = Darbai::with('medziagos')
            ->where('Kodas', '=', $Kodas)->get();
        return view('showjobcode',compact('darbai', 'medziagos'));
    }

    public  function delete($Kodas){
        try {
            Darbai::find($Kodas)->delete();
            return redirect()->back();
        }
        catch ( \Illuminate\Database\QueryException $e) {
            // show custom view
            //Or
            return redirect()->back()->with('message', 'Egzistuoja darbuotojai turintys šią pareigybę');
        }
    }

    public  function create(){
        return view('newjobcode');
    }

    public  function store(Request $request)
    {
        $kodas = $request->get('kodas');
        $apr = $request->get('apr');
        $receivers = DB::insert('insert into Darbai(Kodas,KodoApr)values(?,?)', [$kodas, $apr]);
        if ($receivers) {
            $red = redirect('/createjobcode')->with('message', 'Cargo inserted');
        } else {
            $red = redirect('/createjobcode')->with('message', 'Input failed');
        }
        return $red;
    }

    public function edit($Kodas) {
        $pavojingidarbai = PavojingiDarbai::all();
        $pavojingosmedziagos = Pilnas_Poveiksimis_medziaga::all();
        $darbai = Darbai::with('pavojingidarbai')
            ->where('Kodas', '=', $Kodas)->get();
        $medziagos = Darbai::with('medziagos')
            ->where('Kodas', '=', $Kodas)->get();
        return view('editjobcode',compact('darbai', 'medziagos', 'pavojingidarbai','pavojingosmedziagos'));
        }

    public  function destroymedz($Kodas,$Id)
    {
        $darbai = Darbai::find($Kodas);
        $darbai->medziagos()->detach($Id);
        return redirect()->back();
    }

    public  function destroypavdarbas($Kodas,$Id)
    {
        $darbai = Darbai::find($Kodas);
        $darbai->pavojingidarbai()->detach($Id);
        return redirect()->back();
    }

    public  function addpavdarbas(Request $request, $Kodas)
    {
        $pavdarbai = $request->get('pavdarbai');
        $receivers = DB::insert('insert into Darbai_PavojingiDarbai(Kodas, DarboKodas)values(?,?)', [$Kodas, $pavdarbai]);
        if ($receivers) {
            $red = redirect()->back()->with('message', 'Naujas kodas sukurtas');
        } else {
            $red = redirect()->back()->with('message', 'Nepavyko sukurti naujo kodo');
        }
        return $red;
    }

    public  function addpavmedziaga(Request $request, $Kodas)
    {
        $pavmedziagos = $request->get('pavmedziagos');
        $receivers = DB::insert('insert into Darbai_Poveiksmis_medziaga(Kodas, DarboKodas)values(?,?)', [$Kodas, $pavmedziagos]);
        if ($receivers) {
            $red = redirect()->back()->with('message', 'Naujas kodas sukurtas');
        } else {
            $red = redirect()->back()->with('message', 'Nepavyko sukurti naujo kodo');
        }
        return $red;
    }


}
