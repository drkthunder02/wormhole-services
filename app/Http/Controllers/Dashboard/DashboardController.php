<?php

namespace App\Http\Controllers\Dashboard;

//Internal Libraries
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;

//Application Library
use App\Library\Esi\Esi;
use App\Library\Helpers\StructureHelper;

//Models
use App\Models\Esi\EsiScope;
use App\Models\Esi\EsiToken;
use App\Models\User\UserPermission;
use App\Models\User\UserRole;
use App\Models\SRP\SRPShip;
use App\Models\User\UserAlt;
use App\Models\MiningTax\Invoice;
use App\Models\MiningTax\Ledger;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:User');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function removeAlt(Request $request) {
        $this->validate($request, [
            'character' => 'required',
        ]);

        UserAlt::where([
            'main_id' => auth()->user()->character_id,
            'character_id' => $request->character,
        ])->delete();

        return redirect('/dashboard');
    }
}
