<?php

namespace App\Traits;
use  \Illuminate\Pagination\LengthAwarePaginator;

trait HasPagination
{ 

    private function paginate(LengthAwarePaginator $result){
        return [
            'total'         =>  $result->total(),
            'per_page'      =>  $result->perPage(),
            'current_page'  =>  $result->currentPage(),
            'last_page'     =>  $result->lastPage()
        ];   
    }
}