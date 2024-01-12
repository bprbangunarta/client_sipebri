<?php

namespace App\Http\Controllers;

use App\Models\Midle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class SurveyController extends Controller
{
    public function index()
    {
        $user = Auth::user()->code_user;
        $cek = DB::table('data_pengajuan')
            ->Join('data_nasabah', 'data_pengajuan.nasabah_kode', '=', 'data_nasabah.kode_nasabah')
            ->Join('data_survei', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->Join('users', 'data_survei.surveyor_kode', '=', 'users.code_user')
            ->where(function ($query) use ($user) {
                $query->where('data_survei.surveyor_kode', $user)
                    ->where('data_pengajuan.on_current', '=', '0')
                    ->where(function ($subquery) {
                        $subquery->where('data_pengajuan.tracking', 'Proses Survei');
                    });
            })
            ->select(
                'data_pengajuan.kode_pengajuan',
                'data_pengajuan.tracking',
                'data_pengajuan.status',
                'data_pengajuan.plafon',
                'data_pengajuan.created_at',
                'data_pengajuan.kategori',
                'data_pengajuan.produk_kode',
                'data_pengajuan.metode_rps',
                'data_nasabah.kode_nasabah',
                'data_nasabah.nama_nasabah',
                'data_nasabah.alamat_ktp',
                'data_nasabah.kelurahan',
                'data_nasabah.kecamatan',
                'data_pengajuan.plafon',
                'data_survei.surveyor_kode',
                'data_survei.tgl_survei',
                'data_survei.tgl_jadul_1',
                'data_survei.tgl_jadul_2',
                'data_survei.foto',
                'users.name'
            );
        //
        $c = $cek->get();
        $data = $cek->paginate(30);
        foreach ($data as $item) {
            $item->kd_pengajuan = Crypt::encrypt($item->kode_pengajuan);
        }

        return view('survey.index', [
            'data' => $data,
        ]);
    }

    public function edit(Request $request)
    {
        try {
            $enc = Crypt::decrypt($request->query('survei'));
            $survei = Midle::get_survei($enc);

            return view('survey.edit', [
                'data' => $survei,
            ]);
        } catch (DecryptException $e) {
            return abort(403, 'Permintaan anda di Tolak.');
        }
    }

    public function simpan(Request $request)
    {
        try {
            $enc = Crypt::decrypt($request->query('survei'));
            $cek = $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:10240',
            ]);


            $loc = $request->location;
            if (is_null($loc)) {
                return redirect()->back()->with('error', 'Lokasi Tidak Ditemukan');
            } elseif ($loc === "") {
                return redirect()->back()->with('error', 'Lokasi Tidak Ditemukan');
            } elseif ($loc === "Tidak ada Lokasi") {
                return redirect()->back()->with('error', 'Lokasi Tidak Ditemukan');
            } elseif (!is_null($loc)) {
                $arrloc = explode(",", $loc);
                $cek['latitude'] = $arrloc[0];
                $cek['longitude'] = $arrloc[1];
            }

            // $cek['latitude'] = null;
            // $cek['longitude'] = null;

            //Cek Photo
            if ($request->file('foto')) {
                if ($request->oldphoto) {
                    Storage::delete('public/image/foto_survei/' . $request->oldphoto);
                }
                $files = $cek['foto']->getClientOriginalExtension();
                $new = 'survei' . '_' . $request->no_identitas . '_' . $request->nama . '.' . $files;
                $cek['foto'] = $request->file('foto')->storeAs('image/foto_survei', $new, 'public');
                $cek['foto'] = $new;
            } else {
                $cek['foto'] = $request->oldphoto;
            }
            $cek['updated_at'] = now();
            $dt['proses_survey'] = now();
            $datap['tracking'] = 'Proses Analisa';

            DB::transaction(function () use ($enc, $cek, $datap, $dt) {
                DB::table('data_survei')->where('pengajuan_kode', $enc)->update($cek);
                DB::table('data_pengajuan')->where('kode_pengajuan', $enc)->update($datap);
                DB::table('data_tracking')->where('pengajuan_kode', $enc)->update($dt);
            });
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (DecryptException $e) {
            return abort(403, 'Permintaan anda di Tolak.');
        }
        return redirect()->back()->with('success', 'Data gagal disimpan');
    }
}
