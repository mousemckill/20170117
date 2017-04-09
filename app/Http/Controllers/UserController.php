<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * @var UserRepo
     */
    private $repo;

    public function __construct(UserRepo $repo)
    {
        $this->repo = $repo;
    }

    public function getInfo($name)
    {
        if (Cache::has($name)) {
            $user = Cache::get($name);
        } else {
            $user = $this->repo->userOfName($name);
        }

        if ($user === null) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        Cache::put($name, $user, 15);

        return response()->json([
            'info' => $user->getInfo()
        ], 200);
    }
}
