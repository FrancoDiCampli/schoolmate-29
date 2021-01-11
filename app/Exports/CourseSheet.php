<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Enrollment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CourseSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    public $curso;

    public function __construct($curso)
    {
        $this->curso = $curso;
    }

    public function query()
    {
        return Enrollment::query()->where('course_id', $this->curso->id);
    }

    public function map($matricula): array
    {
        if (Carbon::hasFormat($matricula->student['fnac'], 'd/m/Y')) {
            $aux = Carbon::createFromFormat('d/m/Y', $matricula->student['fnac']);
        } elseif (Carbon::hasFormat($matricula->student['fnac'], 'Y-m-d')) {
            $aux = new Carbon($matricula->student['fnac']);
        } else {
            $aux = new Carbon('1990-01-01');
        }

        return [
            $matricula->student['name'],
            $matricula->student['dni'],
            $matricula->student['cuil'],
            Date::dateTimeToExcel($aux),
            $matricula->student['phone'],
            $matricula->student['email'],
            $matricula->student['address'],
            $matricula->student['docket'],
        ];
    }

    public function headings(): array
    {
        return [
            'nombre',
            'dni',
            'cuil',
            'fnac',
            'telefono',
            'email',
            'domicilio',
            'numlegajo'
        ];
    }

    public function title(): string
    {
        return $this->curso->name;
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
