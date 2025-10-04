<?php

namespace App\Http\Controllers\Rust;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rust\TreasureRequest;
use App\Models\Rust\Log;
use App\Models\Rust\Treasure;
use App\Models\Rust\User;

class RustController extends Controller
{

    public function treasure()
    {
        return view('rust.treasure');
    }

    public function findTreasure(TreasureRequest $request, Treasure $treasureModel, Log $rustLog, User $rustUser)
    {
        $mainTreasure = $treasureModel->where('code_quest', $request->input('code'))->first();
        $user = $rustUser->where('code', $request->input('user_code'))->first();

        if (!$mainTreasure) {
            $rustLog->create([
                'user_id' => $user->id,
                'status' => 'failed',
            ]);

            return redirect()->back()->withErrors(['code' => 'گنجینه پیدا نشد.']);
        }

        $rustLog->firstOrcreate([
            'user_id' => $user->id,
            'treasure_id' => $mainTreasure->id,
        ], ['status' => 'success']);

        $userTreasures = $user->load([
            'logs' => function ($q) {
                $q->whereHas('treasure');
            },
            'logs.treasure',
        ]);

        $othersTreasures = $rustLog->where('user_id', '!=', $user->id)
            ->with(['user', 'treasure'])
            ->whereHas('treasure')
            ->get();

        return view('rust.treasure', compact('mainTreasure', 'userTreasures', 'othersTreasures'));
    }

    public function logs(User $rustUser)
    {
        $users = $rustUser->with('logs.treasure')->get();

        return view('rust.logs', compact('users'));
    }

    public function map(Log $rustLog)
    {

        $logs = $rustLog->with('treasure')
            ->where('status', 'success')
            ->get();

        $locations = $logs->map(fn($log) => $log->treasure->location)
            ->unique()
            ->toArray();

        return view('rust.map', compact('locations'));
    }
}
