<?php

namespace App\Imports;

use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
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
