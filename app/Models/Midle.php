<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Midle extends Model
{
    use HasFactory;

    public static function get_survei($data)
    {
        $cek = DB::table('data_pengajuan')
            ->join('data_nasabah', 'data_pengajuan.nasabah_kode', '=', 'data_nasabah.kode_nasabah')
            ->join('data_survei', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->where('pengajuan_kode', $data)
            ->select(
                'data_pengajuan.*',
                'data_nasabah.*',
                'data_survei.*',
            )->first();

        $cek->kd_pengajuan = Crypt::encrypt($cek->kode_pengajuan);
        return $cek;
    }

    public static function get_tracking($data)
    {
        $cek = DB::table('data_pengajuan')
            ->join('data_tracking', 'data_pengajuan.kode_pengajuan', '=', 'data_tracking.pengajuan_kode')
            ->where('pengajuan_kode', $data)
            ->select(
                'data_pengajuan.*',
                'data_tracking.*',
            )->get();
        //
        return $cek;
    }
}
