<?php
namespace App\Repositories;
use App\Models\Documents;
use App\Repositories\DocumentsRepositoryInterface;

class DocumentsRepository implements DocumentsRepositoryInterface
{
  public function ctreateDocBywipId($wipId,$path)
  {
    dd($wipId,$path);
    $createDoc = Camper::insert('wip_id','doc_id');
  }
}