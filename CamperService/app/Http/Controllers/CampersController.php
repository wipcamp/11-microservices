<?php

namespace App\Http\Controllers;


use App\Http\Controllers\CampersController;
use App\Repositories\CampersRepository;
use App\Repositories\CampersRepositoryInterface;
use Aws\StorageGateway\StorageGatewayClient;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Storage;


class CampersController extends Controller
{
  
    protected $campers;
    public function __construct(CampersRepositoryInterface $camp)
    {
        $this->campers = $camp;
    }
    public function getCampers(Request $req)
  {
     $camps = $this->campers->getCampers();

    return response()->json(['test' => $camps]);
  }
  public function getFile()
  {
   $s = Storage::disk('minio')->files('mockupjaa/');
    dd($s);
    return  response()->json($presignedUrl, 200);
  }
}

