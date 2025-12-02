<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function generateSlugWithRandom($nama, $number = null)
    {
        // slug dasar dari nama produk
        $slug = Str::slug($nama);
        // karakter random (huruf besar + angka)
        if ($number) {
            $random = strtoupper(Str::random($number));
        }else {
            $random = strtoupper(Str::random(6));
        }
        return $slug . '-' . $random;
    }
}
