<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class DateFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $whereDate = $this->dateMethodMap($property);
        $query->$whereDate('created_at', $value);
    }

    private function dateMethodMap(string $dateType): string
    {
        switch ($dateType) {
            case 'dia':
                return 'whereDay';

            case 'mes':
                return 'whereMonth';

            case 'ano':
                return 'whereYear';
        }
        return 'erro';
    }
}
