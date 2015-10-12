<?php
/**
 * Created by PhpStorm.
 * User: hungphongbk
 * Date: 10/12/15
 * Time: 5:52 PM
 */

namespace app\Http\Controllers\Views;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PaginateContent
 * @package app\Http\Controllers\Views
 */
trait PaginateContent
{
    /**
     * @param Collection $originalData
     * @return LengthAwarePaginator
     */
    protected function createPaginator($originalData){
        $perPage=property_exists($this,'perPage')?$this->perPage:10;
        $paginatorPath=property_exists($this,'paginatorPath')?$this->paginatorPath:'/';

        $currentPage=request()->query('page',1);
        $p=new LengthAwarePaginator(
            $originalData->forPage($currentPage,$perPage),
            count($originalData),
            $perPage);
        $p->setPath($paginatorPath);
        return $p;
    }
}