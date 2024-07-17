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
            ->leftJoin('data_nasabah', 'data_pengajuan.nasabah_kode', '=', 'data_nasabah.kode_nasabah')
            ->leftJoin('data_survei', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->leftJoin('rsc_data_pengajuan', 'rsc_data_pengajuan.pengajuan_kode', '=', 'data_pengajuan.kode_pengajuan')
            ->where('data_pengajuan.kode_pengajuan', $data)
            ->select(
                'data_pengajuan.*',
                'data_nasabah.*',
                'data_survei.*',
                'rsc_data_pengajuan.*',
            )->first();

        $cek->kd_pengajuan = Crypt::encrypt($cek->kode_pengajuan);

        return $cek;
    }

    public static function get_survei_eks($datas, $rsc)
    {
        $data = DB::table('rsc_data_survei')
            ->join('rsc_data_pengajuan', 'rsc_data_pengajuan.kode_rsc', '=', 'rsc_data_survei.kode_rsc')
            ->where('rsc_data_survei.kode_rsc', $rsc)->first();


        $data_eks = DB::connection('sqlsrv')->table('m_loan')
            ->join('m_cif', 'm_cif.nocif', '=', 'm_loan.nocif')
            ->join('setup_loan', 'setup_loan.kodeprd', '=', 'm_loan.kdprd')
            ->join('wilayah', 'wilayah.kodewil', '=', 'm_loan.kdwil')
            ->select(
                'm_loan.fnama',
                'm_cif.alamat',
            )
            ->where('noacc', $datas)->first();
        //
        $data->nama_nasabah = trim($data_eks->fnama);
        $data->alamat_ktp = trim($data_eks->alamat);
        $data->no_identitas = null;

        $data->kd_pengajuan = Crypt::encrypt($datas);
        return $data;
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
