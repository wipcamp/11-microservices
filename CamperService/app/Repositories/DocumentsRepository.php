<?php
namespace App\Repositories;
use App\Models\Documents;
use App\Models\Campers;
use App\Repositories\DocumentsRepositoryInterface;

class DocumentsRepository implements DocumentsRepositoryInterface
{
  public function checkDocId($wipId)
  {
    $docId = 'doc_id_'.$wipId;
    $docId = Documents::select('doc_id')->where('doc_id',$docId)->get();
    return $docId->isEmpty();
  }

  public function createDocBywipId($wipId,$path,$type)
  {
    $status = 'unsuccess'; 
    $createDoc = Documents::create([
      'doc_id' => 'doc_id_'.$wipId,
       $type => $path,
      'status' => $status,
      'reason' => null,
      'pick_location' => null,
      'size' => null
    ]);
    return $createDoc;
  }

  public function updateDoc($wipId,$path,$type)
  {
    $docId = 'doc_id_'.$wipId;
    $docId = Documents::where('doc_id',$docId)->update(array($type => $path));
    return $docId;
  }

  public function getDocumentByWipId($wipId)
  {
    $docId = 'doc_id_'.$wipId;
    $document = Documents::where('doc_id',$docId)->get()->all();
    return $document;
  }


  public function updateSize($wipId,$size)
  {
    $docId = 'doc_id_'.$wipId;
    $docId = Documents::where('doc_id',$docId)->update(array('size' => $size));
    return $docId;
  }
  public function getAllDocument()
  {
    $res = Documents::select('*')->get();
    return $res;
  }
  public function updateReson($wip_id,$status)
  {
    $res = Documents::where('doc_id','doc_id_'.$wip_id)->update(array('reason' => $status));
    return $res;
  }
public function getPreviewImageByWipId($wip_id,$type)
  {
    $res = Documents::select($type)->where('doc_id','doc_id_'.$wip_id)->get();
    return $res;
  }
public function createCampers($data)
  {
    for ($i=0; $i != count($data) ; $i++) { 
      $res = Documents::select('*')->where('reason','checked')->where('doc_id','doc_id_'.$data[$i]['wipId'])->get();
      if (!$res->isEmpty()) {
        $res = Campers::select('*')->where('wip_id',$data[$i]['wipId'])->get();
      if ($res->isEmpty()) {
        Campers::insert([
          'wip_id'=>$data[$i]['wipId'],
          'doc_id'=>'doc_id_'.$data[$i]['wipId'],
        ]);
       }        
      }
    }
    return true;
  }

  public function createDocBySize($wipId,$size)
  {
    $status = 'unsuccess'; 
    $createDoc = Documents::create([
      'doc_id' => 'doc_id_'.$wipId,
      'transcript' => null,
      'confrim' => null,
      'receipt' => null,
      'status' => $status,
      'reason' => null,
      'pick_location' => null,
      'size' => $size
    ]);
    return $createDoc;
  }

  public function createDocByLoca($wipId,$loca)
  {
    $status = 'unsuccess'; 
    $createDoc = Documents::create([
      'doc_id' => 'doc_id_'.$wipId,
      'transcript' => null,
      'confrim' => null,
      'receipt' => null,
      'status' => $status,
      'reason' => null,
      'pick_location' => $loca,
      'size' => null
    ]);
    return $createDoc;
  }

  public function updateLoca($wipId,$loca)
  {
    $docId = 'doc_id_'.$wipId;
    $docId = Documents::where('doc_id',$docId)->update(array('pick_location' => $loca));
    return $docId;
  }
  
  public function checkDataForUpdate($wipId)
  {
    $docId = 'doc_id_'.$wipId;
    $docId = Documents::where('doc_id',$docId)->update(array('status' => 'success'));
  }
}