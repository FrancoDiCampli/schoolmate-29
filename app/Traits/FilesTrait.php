<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait FilesTrait
{
    public static function store($request, $ubicacion, $nombre)
    {
        $aux = strtr($nombre, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U'
        ]);
        $path = public_path($ubicacion);
        if ($request->hasFile('file')) {
            $nameFile = time() . '_' . $aux . '.' . $request->file->getClientOriginalExtension();
            if ($request->file->getClientOriginalExtension() == 'jpg' || $request->file->getClientOriginalExtension() == 'png') {
                $image = Image::make($request->file);
                $image->resize(1024, 768, function ($constraint) {
                    $constraint->upsize();
                });
                $image->save($path . '/' . $nameFile, 100);
            } else {
                $request->file->move($path, $nameFile);
            }
            return $ubicacion . '/' . $nameFile;
        } else return null;
    }

    public static function update($request, $ubicacion, $nombre, $objeto)
    {
        $aux = strtr($nombre, [
                'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
                'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U'
            ]);
        if ($request->hasFile('file')) {
            $path = public_path($ubicacion);
            $nameFile = time() . '_' . $aux . '.' . $request->file->getClientOriginalExtension();
            $eliminar = $objeto->file_path;
            if ($request->file->getClientOriginalExtension() == 'jpg' || $request->file->getClientOriginalExtension() == 'png') {
                $image = Image::make($request->file);
                $image->resize(1024, 768, function ($constraint) {
                    $constraint->upsize();
                });
                $image->save($path . '/' . $nameFile, 100);
                if (file_exists($eliminar)) {
                    @unlink($eliminar);
                }
            } else {
                $request->file->move($path, $nameFile);
                if (file_exists($eliminar)) {
                    @unlink($eliminar);
                }
            }
            return $ubicacion . '/' . $nameFile;
        } return $objeto->file_path;
    }
}
