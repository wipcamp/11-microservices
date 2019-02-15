<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\JanpuRepositoryInterface;

class JanpuController extends Controller
{
    protected $janpu;

    public function __construct(JanpuRepositoryInterface $controljanpu)
    {
        $this->janpu = $controljanpu;
    }
    public function getScore()
    {
        $score = $this->janpu->getScore();
        return response()->json($score);
    }
}
