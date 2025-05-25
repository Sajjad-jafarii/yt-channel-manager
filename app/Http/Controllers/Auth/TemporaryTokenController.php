<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryToken;

class TemporaryTokenController extends Controller
{
    public function store(Request $request)
    {
        $token = Str::random(40);

        $temporaryToken = TemporaryToken::create([
            'user_id' => auth()->id(),
            'token' => $token,
            'expires_at' => now()->addMinutes(15),
        ]);

        return response()->json([
            'token' => $temporaryToken->token,
            'expires_at' => $temporaryToken->expires_at,
        ]);
    }
}
