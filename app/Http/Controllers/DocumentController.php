<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function subirArchivo(Request $request)
    {
        if ($request->hasFile('documento_documentos')) {
            // Guardar el archivo en la carpeta 'documentos' en 'storage/app/public'
            $path = $request->file('documento_documentos')->store('documentos', 'public');

            return response()->json([
                'success' => true,
                'ruta' => $path
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se ha subido ningún archivo.'
        ]);
    }
    public function eliminarArchivo(Request $request)
    {
        $ruta = $request->input('ruta');

        if ($ruta && Storage::disk('public')->exists($ruta)) {
            // Eliminar el archivo del almacenamiento
            Storage::disk('public')->delete($ruta);

            return response()->json([
                'success' => true,
                'message' => 'Archivo eliminado correctamente.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se ha podido encontrar el archivo para eliminarlo.'
        ]);
    }

    public function createFolder(Request $request)
    {
        $folderName = $request->input('folderName');

        // Crear la carpeta en el almacenamiento
        $folderPath = 'public/' . $folderName;
        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        return response()->json(['success' => true, 'folderPath' => $folderPath]);
    }
}
