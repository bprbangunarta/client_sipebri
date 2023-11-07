<?php

namespace App\Http\Controllers;

use App\Models\Midle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class TrackingController extends Controller
{
    public function index()
    {
        $name = request('name');

        $query = DB::table('data_pengajuan')
            ->leftJoin('data_nasabah', 'data_pengajuan.nasabah_kode', '=', 'data_nasabah.kode_nasabah')
            ->leftJoin('data_survei', 'data_survei.pengajuan_kode', '=', 'data_pengajuan.kode_pengajuan')
            ->leftJoin('data_kantor', 'data_kantor.kode_kantor', '=', 'data_survei.kantor_kode')
            ->join('data_tracking', 'data_pengajuan.kode_pengajuan', '=', 'data_tracking.pengajuan_kode')
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
                'data_tracking.*',
            )
            ->where('data_pengajuan.status', '!=', 'Batal')
            ->where('data_pengajuan.tracking', '!=', 'Selesai')
            // ->where('data_nasabah.nama_nasabah', 'like', '%' . $name . '%')
            ->where(function ($query) use ($name) {
                $query->where('data_nasabah.nama_nasabah', 'like', '%' . $name . '%')
                    ->orWhere('data_survei.kantor_kode', 'like', '%' . $name . '%')
                    ->orWhere('data_kantor.nama_kantor', 'like', '%' . $name . '%');
            })
            ->orderBy('data_pengajuan.created_at', 'asc');
        //
        $pengajuan = $query->paginate(100);

        foreach ($pengajuan as $item) {
            $item->kd_nasabah = Crypt::encrypt($item->kd_nasabah);
            $item->kd = Crypt::encrypt($item->kode);
        }

        // dd($pengajuan);

        return view('tracking.index', [
            'data' => $pengajuan,
        ]);
    }

    public function detail(Request $request)
    {
        try {
            $enc = Crypt::decrypt($request->query('survei'));
            $data = Midle::get_tracking($enc);

            return view('tracking.detail', [
                'data' => $data[0],
            ]);
        } catch (DecryptException $e) {
            return abort(403, 'Permintaan anda di Tolak.');
        }
    }
}
