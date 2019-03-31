<?php

namespace App\Http\Controllers;


use App\Http\Controllers\DocumentsController;
use App\Repositories\DocumentsRepository;
use App\Repositories\DocumentsRepositoryInterface;
use Aws\StorageGateway\StorageGatewayClient;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Storage;


class DocumentsController extends Controller
{
  
    protected $doc;
    public function __construct(DocumentsRepositoryInterface $docRepo)
    {
        $this->doc = $docRepo;
    }

  public function uploadFile(Request $request,$path)
  {
    $wip_id = $request->all()['wip_id'];
    $file = $request->file('files');
    $filename = ($wip_id.'_'.$path);
    $destinationPath = 'WIPID'.$wip_id.'/'.$filename;
    $created = Storage::disk('minio')->put($destinationPath,file_get_contents($file->getRealPath()));
    $url = Storage::cloud()->temporaryUrl($destinationPath, \Carbon\Carbon::now()->addDays(7));
    $createdDoc = $this->doc->ctreateDocBywipId($wip_id,$destinationPath);
    return  response()->json($url, 200);
  }

}

