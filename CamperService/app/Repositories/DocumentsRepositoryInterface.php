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
    public function getPreviewImageByWipId($wip_id,$type);
    public function updateReson($wip_id,$status);
    public function getAllDocument();
    public function createCampers($data);
    public function updateCamper($data);
    

}