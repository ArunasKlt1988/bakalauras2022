<?php

namespace App\Console\Commands;

use app\User;
use App\DatosSkaiciuokle;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotifyUser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EmailInactiveUsers extends Command
{

    protected $signature = 'email:users';

    protected $description = 'Priminimo laiškas';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $inactive_user = DB::select('select a.* from users a
join DatosSkaiciuokle b on a.username = b.Vartotojas
where dienos = -14');



        foreach ($inactive_user as $user) {
            $user->notify(new NotifyUser());
        }
        return true;
    }
}

