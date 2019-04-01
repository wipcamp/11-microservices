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
    dd($filename);
    $destinationPath = 'WIPID'.$wip_id.'/'.$filename;
    $created = Storage::disk('minio')->put($destinationPath,file_get_contents($file->getRealPath()));
    $url = Storage::cloud()->temporaryUrl($destinationPath, \Carbon\Carbon::now()->addDays(7));
    $check = $this->doc->checkDocId($wip_id);
    if($check){
      $createdDoc = $this->doc->createDocBywipId($wip_id,$destinationPath,$path);
    }else{
      $updateDoc = $this->doc->updateDoc($wip_id,$destinationPath,$path);
    }
    return  response()->json(['url_file' => $url], 200);
  }

  public function getDocumentByWipId(Request $request)
  {
    $wipId = $request->all()['wip_id'];
    $document = $this->doc->getDocumentByWipId($wipId);
    return response()->json($document, 200);
  }

  public function updateSize(Request $request)
  {
    $wipId = $request->all()['wip_id'];
    $size = $request->all()['size'];
    $check = $this->doc->checkDocId($wipId);
    if($check){
      $size = $this->doc->createDocBySize($wipId,$size);
    }else {
      $size = $this->doc->updateSize($wipId,$size);
    }
    return response()->json(["message" => true], 200);
  }

  public function updateLocation(Request $request)
  {
    $wipId = $request->all()['wip_id'];
    $loca = $request->all()['location'];
    $check = $this->doc->checkDocId($wipId);
    if($check){
      $size = $this->doc->createDocByLoca($wipId,$loca);
    }else {
      $size = $this->doc->updateLoca($wipId,$loca);
    }
    return response()->json(["message" => true], 200);
  }
  
  
  public function confirmCamper(Request $request)
  {
    $wipId = $request->all()['wip_id'];
    $document=$this->doc->getDocumentByWipId($wipId);
    $document = json_decode($document[0]);
    if ($document->transcript!=null&&$document->confrim!=null&&$document->receipt!=null&&$document->size!=null&&$document->pick_location!=null) {
    $res = $this->doc->checkDataForUpdate($wipId);
    return  response()->json(["message" => true], 200);
    }else{
      return  response()->json(["status" => false], 200);
    }
  }
}

