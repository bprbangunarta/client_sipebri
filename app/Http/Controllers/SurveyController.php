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
    public function index(Request $request)
    {
        $name = request('name');

        $user = Auth::user()->code_user;
        $cek = DB::table('data_pengajuan')
            ->leftJoin('data_nasabah', 'data_pengajuan.nasabah_kode', '=', 'data_nasabah.kode_nasabah')
            ->leftJoin('data_survei', 'data_pengajuan.kode_pengajuan', '=', 'data_survei.pengajuan_kode')
            ->leftJoin('data_kantor', 'data_survei.kantor_kode', '=', 'data_kantor.kode_kantor')
            ->leftJoin('users', 'data_survei.surveyor_kode', '=', 'users.code_user')
            ->where(function ($query) use ($user) {
                $query->where('data_survei.surveyor_kode', '=', $user)
                    ->Where('data_pengajuan.tracking', '=', 'Proses Survei');
                    // ->orWhere('data_pengajuan.tracking', '=', 'Proses Analisa');
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
                'data_kantor.kode_kantor',
                'data_kantor.nama_kantor',
                'data_survei.surveyor_kode',
                'data_survei.tgl_survei',
                'data_survei.foto',
                'data_survei.tgl_jadul_1',
                'data_survei.tgl_jadul_2',
                'users.name'
            )
            ->where(function ($query) use ($name) {
                $query->where('data_nasabah.nama_nasabah', 'like', '%' . $name . '%')
                    ->orWhere('data_survei.kantor_kode', 'like', '%' . $name . '%')
                    ->orWhere('data_kantor.nama_kantor', 'like', '%' . $name . '%');
            })
            ->orderBy('data_pengajuan.created_at', 'asc');
        //
        $c = $cek->get();
        $count = count($c);
        $data = $cek->paginate(10);
        for ($i = 0; $i < $count; $i++) {
            if ($data->isNotEmpty()) {
                $data[$i]->kd_pengajuan = Crypt::encrypt($data[$i]->kode_pengajuan);
            }
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
            // dd($survei);
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
            $arrloc = explode(",", $loc);
            $cek['latitude'] = $arrloc[0];
            $cek['longitude'] = $arrloc[1];

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
