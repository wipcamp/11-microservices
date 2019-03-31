<?php
namespace App\Repositories;
interface DocumentsRepositoryInterface {
    public function ctreateDocBywipId($wipId,$path,$type);
    public function updateDoc($wipId,$path,$type);
    public function checkDocId($wipId);
}