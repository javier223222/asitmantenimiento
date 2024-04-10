<?php

namespace App\Http\Controllers;

use App\Models\ImagenProducto;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class ImagenProductoController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function index()
    {
        $imagenes = ImagenProducto::all();
        return response()->json($imagenes);
    }

    public function store(Request $request)
    {
        $file = $request->file('url_imagen');
        $uploadedFile = $this->cloudinary->uploadApi()->upload($file->getRealPath());

        $imagen = new ImagenProducto();
        $imagen->url_imagen = $uploadedFile['secure_url'];
        $imagen->id_producto = $request->id_producto;
        $imagen->save();

        return response()->json($imagen, 201);
    }

    public function show($id)
    {
        $imagen = ImagenProducto::findOrFail($id);
        return response()->json($imagen);
    }

    public function destroy($id)
    {
        ImagenProducto::destroy($id);
        return response()->json(null, 204);
    }
}
