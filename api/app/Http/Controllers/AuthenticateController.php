<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthenticateController;

use Illuminate\Http\Request;
use App\Repositories\RoomRepository;
use App\Repositories\RoomRepositoryInterface;
use DB;

class AuthenticateController extends Controller
{
    protected $authen;
}
