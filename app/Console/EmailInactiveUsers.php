<?php

namespace App\Console\Commands;

use App\User;
use App\DatosSkaiciuokle;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotifyUser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EmailInactiveUsers extends Command
{

    protected $signature = 'email:users';

    protected $description = 'Email to Inactive Users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $inactive_user = User::all()
            ->where('username', '=', 'jonukas');



        foreach ($inactive_user as $user) {
            $user->notify(new NotifyUser());
        }
        return true;
    }
}

