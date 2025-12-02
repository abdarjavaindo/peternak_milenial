<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function generateSlugWithRandom($nama)
    {
        // slug dasar dari nama produk
        $slug = Str::slug($nama);
        // karakter random (huruf besar + angka)
        $random = strtoupper(Str::random(6)); // contoh: AABBD7
        return $slug . '-' . $random;
    }
}
