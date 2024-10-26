<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\api\GeminiController;
use App\Http\Controllers\Controller;
use GeminiAPI\Client;
use Gemini\Laravel\Facades\Gemini;
use GeminiAPI\Resources\Parts\TextPart as PartsTextPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\Part\TextPart;

class PersonalisasiController extends Controller
{
    public function personalisasiView()
    {
        return view('pages.personalisasi');
    }

    public function personalisasiAction(Request $request)
    {
        $data = $request->validate([
            'gaji' => 'required',
            'pengeluaran' => 'required',
            'tabungan' => 'required',
            'pekerjaan' => 'required',
            'id' => 'required'
        ]);

        // Menginisialisasi Client dengan API key dari environment
        $client = new Client(env('GEMINI_API_KEY'));
        $dataUser = DB::select("SELECT * from users where id = " . $data['id']);

        // Schema dalam bentuk array
        $scheme = [
            "data" => [
                "Bulanan" => '',
                "nama1" => 'Makanan',
                "total1" => '',
                "nama2" => 'Belanja Bulanan',
                "total2" => '',
                "nama3" => 'Tagihan Bulanan',
                "total3" => '',
                "nama4" => 'Transportasi',
                "total4" => '',
                "nama5" => 'Tabungan',
                "total5" => '',
                "nama6" => 'Hiburan',
                "total6" => '',
            ],
        ];



        // $gaji = $dataUser[0]->gaji;
        // $pengeluaran = $dataUser[0]->pengeluaran;
        // $tabungan = $dataUser[0]->tabungan;
        // $pekerjaan = $dataUser[0]->pekerjaan;


        $schemeJson = json_encode($scheme);

        $attempt = 0; // Variabel untuk menghitung jumlah percobaan
        $maxAttempts = 5; // Batas maksimal percobaan

        while ($attempt < $maxAttempts) {
            $attempt++;

            // Mengirim permintaan ke API dengan menyertakan JSON schema dalam teks permintaan
            $response  = $client->geminiPro()->generateContent(
                new PartsTextPart("
                 Saya adalah seorang {$data['pekerjaan']} dengan gaji sebesar RP.
             {$data['gaji']} dan memiliki tabungan sebasar {$data['tabungan']}.
             Berikan saya rekomendasi maksimal pengeluaran dengan kategori pengluarannya.
                 Dengan keterangan nama adalah kategori pengeluaran dan
                 total adalah total maksimal keuangan.
                 tanpa tanda \n, dan juga tanpa tanda \
                 respon menerapkan format schema {$schemeJson}.
                 Respon akan diubah menjadi json dengan json_encode")
            );

            // Mengambil hasil respon dalam bentuk teks
            $answer = $response->text();

            // Periksa apakah respons dapat di-decode menjadi JSON
            $responseData = json_decode($answer, true);

            if (!is_null($responseData)) {
                DB::beginTransaction();
                DB::table('users')->where('id', $data['id'])->update([
                    'gaji' => $data['gaji'],
                    'pengeluaran' => $data['pengeluaran'],
                    'tabungan' => $data['tabungan'],
                    'pekerjaan' => $data['pekerjaan']
                ]);
                DB::commit();
            }


            // Jika $data tidak null, keluar dari loop dan kembalikan data
            if (!is_null($data)) {
                return response()->json([
                    'response' => $responseData
                ]);
            }
        }

        // Jika setelah beberapa percobaan tetap gagal, kembalikan error
        return view('pages.personalisasi', compact('data'));
    }
}
