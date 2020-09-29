<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authId = auth()->id();

        $users = User::with(["rating" => function($query) use($authId){
            $query->where("user_id", auth()->id());
        }])
            ->where("id", "!=", $authId)
            ->get();

        return view('home')
            ->with("users", $users);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function rate(RateRequest $request, User $user)
    {
        $user->ratings()->updateOrCreate([
            "user_id" => auth()->id()
        ],[
            "rate" => $request->input("rate")
        ]);

        return response()->json([
            "message" => "Congratulations!",
            "total" => round($user->ratings->avg("rate"))
        ]);
    }
}
