<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DateFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $whereDate = $this->getDateFunction($property);
        $query->$whereDate('created_at', $value);
    }

    private function getDateFunction(string $dateType)
    {
        switch ($dateType) {
            case 'dia':
                return 'whereDay';
                break;

            case 'mes':
                return 'whereMonth';
                break;

            case 'ano':
                return 'whereYear';
                break;
        }
    }
}
