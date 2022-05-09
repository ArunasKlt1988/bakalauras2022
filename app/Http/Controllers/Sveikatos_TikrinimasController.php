<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Darbai;
use App\PavojingiDarbai;
use App\Pilnas_Poveiksimis_medziaga;
use App\User;
use Auth;
use App\Sveikatos_Tikrinimas;
use Carbon\Carbon;

class Sveikatos_TikrinimasController extends Controller
{
    public function found($Id, $Failas) {
        $puslapis = "http://localhost/bakalauras/storage/app/public/{$Id}/{$Failas}";
        return redirect($puslapis);
    }

    public function index() {
        $username = Auth::user()->username;
        $irasai = Sveikatos_Tikrinimas::with('jobcode')->with('status')
        ->where('Naudotojas','=',$username)->orderby('Data', 'DESC')->get();
        return view('health',compact('irasai'));
    }

    public function index2() {
        $irasai = Sveikatos_Tikrinimas::with('jobcode')->with('status')->with('users')
            ->where('Statusas', '=','P')
          ->orderby('Data', 'ASC')->get();
        return view('employessforadmin',compact('irasai'));
    }

    public  function create(){
        return view('createhealth');
    }

    public function store(Request $request){
        $username = Auth::user()->username;
        $jobcode = Auth::user()->DarboKodas;
        $createdate = Carbon::now()->toDateString();
        $date = $request->get('pass_date');
        $status = 'P';
        //$receivers = DB::insert('insert into Sveikatos_Tikrinimas(Naudotojas,Sveikatos_Tikrinimas.Data,Statusas,DarboKodas,Sukurta)values(?,?,?,?,?)', [$username, $date,$status,$jobcode,$createdate]);
        $receivers = Sveikatos_Tikrinimas::create([
            'Naudotojas' => $username,
                'Data' => $date,
                'Statusas' =>$status,
                'DarboKodas' =>$jobcode,
                'Sukurta' => $createdate

    ]
        );
        if (request()->hasFile('file')) {
            $file = request()->file('file')->getClientOriginalName();
            request()->file('file')->storeAs( 'public', $receivers-> Id . '/' . $file, '');
            $receivers->update(['Failas'=>$file]);
        }


        if ($receivers) {
            $red = redirect('/health')->with('message', 'Įrašas sėkmingai užregistruotas');
        } else {
            $red = redirect('/health')->with('message', 'Nepavyko išsaugoti įrašo');
        }
        return $red;
    }

    public function show($Kodas) {
        $darbai = Darbai::with('pavojingidarbai')
            ->where('Kodas', '=', $Kodas)->get();
        $medziagos = Darbai::with('medziagos')
            ->where('Kodas', '=', $Kodas)->get();
        return view('showjobcodeforemployee',compact('darbai', 'medziagos'));
    }

    public function deny($Id) {
        $status = 'A';
        $receivers = DB::update('update Sveikatos_Tikrinimas set Statusas = ? where Id = ?' ,[$status, $Id]);
        if ($receivers) {
            $red = redirect()->back()->with('message', 'Atmesta');
        } else {
            $red = redirect()->back()->with('message', 'Nepavyko išsaugoti įrašo');
        }
        return $red;

    }

    public function approve($Id) {
        $status = 'T';
        $receivers = DB::update('update Sveikatos_Tikrinimas set Statusas = ? where Id = ?' ,[$status, $Id]);
        if ($receivers) {
            $red = redirect()->back()->with('message', 'Patvirtinta');
        } else {
            $red = redirect()->back()->with('message', 'Nepavyko išsaugoti įrašo');
        }
        return $red;

    }


}
