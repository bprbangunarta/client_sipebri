<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->code_user;
        $pengajuan = DB::table('data_survei')->where('surveyor_kode', '=', $user)->count();

        $disetujui = DB::table('data_survei')
            ->join('data_pengajuan', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->where('data_pengajuan.status', 'Disetujui')
            ->where('data_survei.surveyor_kode', '=', $user)
            ->count();
        
        $penolakan = DB::table('data_survei')
            ->join('data_pengajuan', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->where('data_pengajuan.status', 'Ditolak')
            ->where('data_survei.surveyor_kode', '=', $user)
            ->count();

        $pembatalan = DB::table('data_survei')
            ->join('data_pengajuan', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->where('data_pengajuan.status', 'Dibatalkan')
            ->where('data_survei.surveyor_kode', '=', $user)
            ->count();

        $query = DB::table('data_pengajuan')
            ->leftJoin('data_nasabah', 'data_pengajuan.nasabah_kode', '=', 'data_nasabah.kode_nasabah')
            ->leftJoin('data_survei', 'data_survei.pengajuan_kode', '=', 'data_pengajuan.kode_pengajuan')
            ->leftJoin('data_kantor', 'data_kantor.kode_kantor', '=', 'data_survei.kantor_kode')
            ->leftJoin('data_tracking', 'data_pengajuan.kode_pengajuan', '=', 'data_tracking.pengajuan_kode')
            ->join('users', 'users.code_user', '=', 'data_survei.surveyor_kode')
            ->select(
                'data_pengajuan.kode_pengajuan as kode',
                'data_pengajuan.produk_kode',
                'data_pengajuan.nasabah_kode as kd_nasabah',
                'data_pengajuan.id as id',
                'data_pengajuan.plafon as plafon',
                'data_pengajuan.jangka_waktu as jk',
                'data_nasabah.nama_nasabah as nama',
                'data_nasabah.kelurahan',
                'data_nasabah.kecamatan',
                'data_nasabah.no_telp',
                'data_nasabah.alamat_ktp as alamat',
                'data_pengajuan.status',
                'data_pengajuan.tracking',
                'data_pengajuan.kategori',
                'data_nasabah.is_entry as entry',
                'data_kantor.nama_kantor',
                'data_survei.kantor_kode as kantor',
                'data_pengajuan.created_at as tanggal',
                'users.username as surveyor'
            )
            ->where('data_pengajuan.status', 'Disetujui')
            ->whereDate('data_tracking.selesai', now()->format('Y-m-d'))
            ->where('data_pengajuan.on_current', '1')
            ->orderBy('data_pengajuan.created_at', 'asc');
        //
        $dt = $query->get();
        $tak = [];
        for ($i = 0; $i < count($dt); $i++) {
            $tak[] = $dt[$i]->plafon ?? 0;
        }
        $total = array_sum($tak);
        $realisasi = $query->paginate(100);

        return view('dashboard', [
            'pengajuan' => $pengajuan,
            'disetujui' => $disetujui,
            'ditolak' => $penolakan,
            'dibatalkan' => $pembatalan,
            'data' => $realisasi,
            'total' => $total,
        ]);
    }
}
