<?php

namespace App\Traits;

use App\Job;
use Illuminate\Support\Str;
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
            $request->file->move($path, $nameFile);
            return $ubicacion . '/' . $nameFile;
        } else return null;
    }

    public static function storeFotos($request, $ubicacion, $nombre)
    {
        $auxNombre = strtr($nombre, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U'
        ]);
        $path = public_path($ubicacion);
        $auxFotos = [];
        $fotos = $request->allFiles('fotos');
        foreach ($fotos['fotos'] as $item) {
            $nameFile = Str::random(30) . '.' . $item->getClientOriginalExtension();
            $image = Image::make($item);
            $image->orientate();
            $width = 720;
            $height = 640;
            if ($image->width() < $width) {
                $width = $image->width();
            }
            if ($image->height() < $height) {
                $height = $image->height();
            }
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($path . '/' . $nameFile, 50);
            $auxFotos[] = $ubicacion . '/' . $nameFile;
            unset($nameFile);
        }
        $job = Job::find($request->job);
        $pdf = app('dompdf.wrapper')->loadView('createEntregaPDF', compact('auxFotos', 'auxNombre', 'job'))->setPaper('A4');
        $archivo = time() . '_' . $auxNombre . '.pdf';
        $pdf->save($ubicacion . '/' . $archivo);
        foreach ($auxFotos as $item) {
            unlink($item);
        }
        return $ubicacion . '/' . $archivo;
    }

    public static function updateFotos($request, $ubicacion, $nombre, $objeto)
    {
        $eliminar = $objeto->file_path;
        if (file_exists($eliminar)) {
            @unlink($eliminar);
        }
        return static::storeFotos($request, $ubicacion, $nombre);
    }

    public static function update($request, $ubicacion, $nombre, $objeto)
    {
        $eliminar = $objeto->file_path;
        if (file_exists($eliminar)) {
            @unlink($eliminar);
        }
        return static::store($request, $ubicacion, $nombre);
    }
}
