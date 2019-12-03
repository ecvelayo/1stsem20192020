<?php

namespace App\Exports;

use App\Doctors_Progress_Notes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;

class PnotesExport implements FromCollection, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Doctors_Progress_Notes::query()->get(['date_time', 'notes']);
    }

    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('images\logo.png'));
        $drawing->setCoordinates('F2');
        $drawing->setHeight(90);

        return $drawing;
    }

}
