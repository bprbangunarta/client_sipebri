<?php

namespace App\Http\Controllers;

use App\Models\Midle;
use GuzzleHttp\Client;
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
            ->whereNot('data_pengajuan.status', ['Batal', 'Dibatalkan'])
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

            $base64Image = $request->photo;
            if (strpos($base64Image, 'data:image') !== false) {
                list(, $base64Image) = explode(',', $base64Image);
            }

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
            // if ($request->file('foto')) {
            //     if ($request->oldphoto) {
            //         Storage::delete('public/image/foto_survei/' . $request->oldphoto);
            //     }
            //     $files = $cek['foto']->getClientOriginalExtension();
            //     $new = 'survei' . '_' . $request->no_identitas . '_' . $request->nama . '.' . $files;
            //     $cek['foto'] = $request->file('foto')->storeAs('image/foto_survei', $new, 'public');
            //     $cek['foto'] = $new;
            // } else {
            //     $cek['foto'] = $request->oldphoto;
            // }

            if (!is_null($request->photo)) {
                $imageData = base64_decode($base64Image);
                $imageName = 'survei' . '_' . $request->no_identitas . '_' . $request->nama . '.jpg';
                $path = 'image/foto_survei/' . $imageName;
                Storage::disk('public')->put($path, $imageData);
                $cek['foto'] = $imageName;
            } else {
                $cek['foto'] = null;
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

    public function survey_rsc()
    {
        $user = Auth::user()->code_user;
        $cek = DB::table('rsc_data_pengajuan')
            ->leftJoin('data_pengajuan', 'data_pengajuan.kode_pengajuan', '=', 'rsc_data_pengajuan.pengajuan_kode')
            ->leftJoin('data_nasabah', 'data_nasabah.kode_nasabah', '=', 'rsc_data_pengajuan.nasabah_kode')
            ->leftJoin('rsc_data_survei', 'rsc_data_pengajuan.kode_rsc', '=', 'rsc_data_survei.kode_rsc')
            ->leftJoin('v_users', 'rsc_data_survei.surveyor_kode', '=', 'v_users.code_user')
            ->where(function ($query) use ($user) {
                $query->where('rsc_data_survei.surveyor_kode', $user)
                    ->where('rsc_data_pengajuan.status', 'Proses Survei');
            })
            ->select(
                'rsc_data_pengajuan.kode_rsc',
                'rsc_data_pengajuan.pengajuan_kode',
                'rsc_data_pengajuan.status_rsc',
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
                'rsc_data_survei.surveyor_kode',
                'rsc_data_survei.tgl_survei',
                'rsc_data_survei.tgl_jadul_1',
                'rsc_data_survei.tgl_jadul_2',
                'rsc_data_survei.foto',
                'v_users.nama_user'
            );
        //
        $c = $cek->get();
        $data = $cek->paginate(30);

        //===Handle Data Eksternal===//
        foreach ($data as $value) {
            if (strpos($value->status_rsc, 'EKS') !== false) {
                $data_eks = DB::connection('sqlsrv')->table('m_loan')
                    ->join('m_cif', 'm_cif.nocif', '=', 'm_loan.nocif')
                    ->join('setup_loan', 'setup_loan.kodeprd', '=', 'm_loan.kdprd')
                    ->join('wilayah', 'wilayah.kodewil', '=', 'm_loan.kdwil')
                    ->select(
                        'm_loan.fnama',
                        'm_loan.plafond_awal',
                        'm_cif.alamat',
                        'm_loan.jkwaktu',
                        'setup_loan.ket',
                        'wilayah.ket as wil',
                    )
                    ->where('noacc', $value->pengajuan_kode)->first();
                //
                if ($data_eks) {
                    $value->nama_nasabah = trim($data_eks->fnama);
                    $value->alamat_ktp = trim($data_eks->alamat);
                    $value->plafon = trim($data_eks->plafond_awal);
                } else {
                    $value->nama_nasabah = null;
                    $value->alamat_ktp = null;
                    $value->plafon = null;
                }
            }
        }
        //===Handle Data Eksternal===//

        foreach ($data as $item) {
            $item->kd_pengajuan = Crypt::encrypt($item->pengajuan_kode);
            $item->kd_rsc = Crypt::encrypt($item->kode_rsc);
            $item->eks = $item->status_rsc;
        }

        return view('survey.rsc.index', [
            'data' => $data,
        ]);
    }

    public function edit_rsc(Request $request)
    {
        try {
            $status_rsc = $request->query('status_rsc');

            if ($status_rsc == 'EKS') {
                $enc = Crypt::decrypt($request->query('survei'));
                $enc_rsc = Crypt::decrypt($request->query('rsc'));
                $survei = Midle::get_survei_eks($enc, $enc_rsc);
                $survei->kd_rsc = $request->query('rsc');
            } else {
                $enc = Crypt::decrypt($request->query('survei'));
                $enc_rsc = Crypt::decrypt($request->query('rsc'));

                $survei = Midle::get_survei($enc);
                $survei->kd_rsc = $request->query('rsc');
            }

            return view('survey.rsc.edit', [
                'data' => $survei,
            ]);
        } catch (DecryptException $e) {
            return abort(403, 'Permintaan anda di Tolak.');
        }
    }

    public function simpan_rsc(Request $request)
    {
        try {
            $enc = Crypt::decrypt($request->query('survei'));
            $enc_rsc = Crypt::decrypt($request->query('rsc'));

            $cek = $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:10240',
            ]);

            $base64Image = $request->photo;
            if (strpos($base64Image, 'data:image') !== false) {
                list(, $base64Image) = explode(',', $base64Image);
            }

            $loc = $request->location;
            if (is_null($loc)) {
                return redirect()->back()->with('error', 'Lokasi Tidak Ditemukan');
            } elseif ($loc == " ") {
                return redirect()->back()->with('error', 'Lokasi Tidak Ditemukan');
            } elseif ($loc == "Tidak ada Lokasi") {
                return redirect()->back()->with('error', 'Lokasi Tidak Ditemukan');
            }

            $arrloc = explode(",", $loc);
            $cek['latitude'] = $arrloc[0];
            $cek['longitude'] = $arrloc[1];


            if (!is_null($request->photo)) {
                $imageData = base64_decode($base64Image);
                $imageName = 'survei_rsc' . '_' . $request->nama . '.jpg';

                try {

                    if ($request->query('status_rsc') == 'EKS') {

                        $client = new Client();
                        $endpoint = env('SIPEBRI_URL') . '/upload/survey/eks';

                        $response = $client->post($endpoint, [
                            'multipart' => [
                                [
                                    'name'     => 'kode',
                                    'contents' => $enc_rsc,
                                ],
                                [
                                    'name'     => 'foto',
                                    'contents' => $imageData,
                                    'filename' => $imageName,
                                ],
                            ],
                            'verify' => false,
                        ]);
                    } else {
                        $client = new Client();
                        $endpoint = env('SIPEBRI_URL') . '/upload/survey';

                        $response = $client->post($endpoint, [
                            'multipart' => [
                                [
                                    'name'     => 'kode',
                                    'contents' => $enc_rsc,
                                ],
                                [
                                    'name'     => 'foto',
                                    'contents' => $imageData,
                                    'filename' => $imageName,
                                ],
                            ],
                            'verify' => false,
                        ]);
                    }

                    $responseData = json_decode($response->getBody()->getContents(), true);

                    $cek['updated_at'] = now();
                    $cek['foto'] = $enc_rsc . '_' . $request->nama . '.jpg';
                    $datap['status'] = 'Proses Analisa';

                    DB::transaction(function () use ($enc_rsc, $cek, $datap) {
                        DB::table('rsc_data_survei')->where('kode_rsc', $enc_rsc)->update($cek);
                        DB::table('rsc_data_pengajuan')->where('kode_rsc', $enc_rsc)->update($datap);
                    });

                    return redirect()->back()->with('success', 'Data berhasil disimpan');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Gagal mengunggah foto: ' . $e->getMessage());
                }
            }
        } catch (DecryptException $e) {
            return abort(403, 'Permintaan anda di Tolak.');
        }
        return redirect()->back()->with('error', 'Data gagal disimpan');
    }
}
