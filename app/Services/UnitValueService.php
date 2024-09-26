<?php
namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;
use Illuminate\Http\Request;

class UnitValueService{
    protected $unitValuesRepository;
    public function __construct(UnitValueRepositoryInterface $unitValuesRepository){
        $this->unitValuesRepository = $unitValuesRepository;
    }
}
