<?php

namespace App\Imports;

use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
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
            'fnac'     => $row['fnac'],
            'email'    => $row['email'],
            'phone'     => $row['telefono'],
            'address'     => $row['domicilio'],
            'docket' =>$row['numlegajo']

        ]);
    }

    public function rules(): array
    {
        // return [
        //     '1' => Rule::in(['patrick@maatwebsite.nl']),


        // ];
    }
}
