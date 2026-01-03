<?php

namespace App\Http\Controllers;

use App\Models\UserKursusProgres;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CronCrontroller extends Controller
{
    public function cek_kursus_progres()
    {
        $now = Carbon::now();

        // Ambil semua progres yang masih 'progres' tapi sudah lewat batas waktu
        $expiredProgres = UserKursusProgres::where('status', 'progres')
            ->where('harus_selesai_tgl', '<', $now)
            ->get();

        foreach ($expiredProgres as $progres) {
            $progres->update([
                'status' => 'do',
            ]);
        }

        return response()->json(['message' => 'Progress telah diperbarui']);
    }
}
