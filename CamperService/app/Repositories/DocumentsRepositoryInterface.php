<?php
namespace App\Repositories;
interface DocumentsRepositoryInterface {
    public function createDocBywipId($wipId,$path,$type);
    public function updateDoc($wipId,$path,$type);
    public function checkDocId($wipId);
    public function getDocumentByWipId($wipId);
    public function createDocBySize($wipId,$size);
    public function updateSize($wipId,$size);
    public function createDocByLoca($wipId,$loca);
    public function updateLoca($wipId,$loca);
    public function checkDataForUpdate($wipId);
    

}