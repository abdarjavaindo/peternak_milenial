<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function edit(Pengaturan $pengaturan)
    {
        return view('pages.dashboard.pengaturan.website_form', compact('pengaturan'));
    }
    public function update(Request $request, Pengaturan $pengaturan)
    {
        $request->validate([
            'judul' => ['required'],
            'slogan' => ['required'],
            'deskripsi' => ['required'],
            'instansi' => ['required'],
            'keyword' => ['required'],
            'logo' => 'mimes:jpg,jpeg,png|max:11000',
            'ikon' => 'mimes:jpg,jpeg,png|max:1100',
            'slider' => 'mimes:jpg,jpeg,png|max:11000',
            'img_fitur' => 'mimes:jpg,jpeg,png|max:11000',
        ]);
        $pengaturan->judul = $request->judul;
        $pengaturan->slogan = $request->slogan;
        $pengaturan->deskripsi = $request->deskripsi;
        $pengaturan->instansi = $request->instansi;
        $pengaturan->keyword = $request->keyword;
        if ($request->hasFile('logo')) {
            $pengaturan->logo = $request->file('logo')->store('pengaturan', 'public');
        }
        if ($request->hasFile('ikon')) {
            $pengaturan->ikon = $request->file('ikon')->store('pengaturan', 'public');
        }
        if ($request->hasFile('slider')) {
            $pengaturan->slider = $request->file('slider')->store('pengaturan', 'public');
        }
        if ($request->hasFile('img_fitur')) {
            $pengaturan->img_fitur = $request->file('img_fitur')->store('pengaturan', 'public');
        }
        $pengaturan->save();
        return redirect()->route('pengaturan.edit', $pengaturan->id)->with('sukses', 'Anda berhasil mengubah data');
    }

    public function kontak_edit(Pengaturan $pengaturan)
    {
        return view('pages.dashboard.pengaturan.kontak_form', compact('pengaturan'));
    }
    public function kontak_update(Request $request, Pengaturan $pengaturan)
    {
        $request->validate([
            'no_telp' => ['required'],
            'email' => ['required'],
            'hari_oprasional' => ['required'],
            'jam_oprasional' => ['required'],
            'lokasi' => ['required'],
            'link_maps' => ['required'],
            'iframe_maps' => ['required'],
            'fb' => ['required'],
            'twitter' => ['required'],
            'youtube' => ['required'],
            'ig' => ['required'],
            'tiktok' => ['required'],
        ]);
        $pengaturan->no_telp = $request->no_telp;
        $pengaturan->email = $request->email;
        $pengaturan->hari_oprasional = $request->hari_oprasional;
        $pengaturan->jam_oprasional = $request->jam_oprasional;
        $pengaturan->lokasi = $request->lokasi;
        $pengaturan->link_maps = $request->link_maps;
        $pengaturan->iframe_maps = $request->iframe_maps;
        $pengaturan->fb = $request->fb;
        $pengaturan->twitter = $request->twitter;
        $pengaturan->youtube = $request->youtube;
        $pengaturan->ig = $request->ig;
        $pengaturan->tiktok = $request->tiktok;
        $pengaturan->save();
        return redirect()->route('pengaturan.kontak_edit', $pengaturan->id)->with('sukses', 'Anda berhasil mengubah data');
    }
}
