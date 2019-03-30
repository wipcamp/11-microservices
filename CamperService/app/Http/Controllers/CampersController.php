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
  public function uploadFile(Request $request,$path)
  {
    $wip_id = $request->all()['wip_id'];
    $file = $request->file('files');
    $filename = ($wip_id.'_'.$path);
    $destinationPath = 'WIPID'.$wip_id.'/'.$filename;
    $created = Storage::disk('minio')->put($destinationPath,file_get_contents($file->getRealPath()));
    $url = Storage::cloud()->temporaryUrl($destinationPath, \Carbon\Carbon::now()->addMinutes(10));
    return  response()->json($url, 200);
  }
  public function getFile()
  {
   $s = Storage::disk('minio')->files('mockupjaa/');
    dd($s);
    return  response()->json($presignedUrl, 200);
  }
}

