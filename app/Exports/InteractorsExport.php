<?php

namespace App\Exports;

use App\EventInterators;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class InteractorsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EventInteractors::all();
        // return EventInteractors::select(['name','class','eventTitle'])->get();
    }
    public function headings():array{
        return[
            'name',
            'class',
            'eventTitle'];
    }
}