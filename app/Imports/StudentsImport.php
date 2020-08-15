<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'     => $row['nombre'],
            'dni'     => $row['dni'],
            'cuil'     => $row['cuil'],
            'fnac'     => Date::excelToDateTimeObject($row['fnac'])->format('d/m/Y'),
            'email'    => $row['email'],
            'phone'     => $row['telefono'],
            'address'     => $row['domicilio'],
            'docket' =>$row['numlegajo']
        ]);
    }
}
