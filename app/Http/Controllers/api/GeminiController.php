<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;
use GeminiApi\GenerativeModel;
use GeminiAPI\Json;
use GeminiAPI\GenerationConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;



class GeminiController extends BaseController
{
    public function analisis($id)
    {
        // Menginisialisasi Client dengan API key dari environment
        $client = new Client(env('GEMINI_API_KEY'));
        $dataUser = DB::select("SELECT * from users where id = $id");

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



        $gaji = $dataUser[0]->gaji;
        $pengeluaran = $dataUser[0]->pengeluaran;
        $tabungan = $dataUser[0]->tabungan;
        $pekerjaan = $dataUser[0]->pekerjaan;


        $schemeJson = json_encode($scheme);

        $attempt = 0; // Variabel untuk menghitung jumlah percobaan
        $maxAttempts = 5; // Batas maksimal percobaan

        while ($attempt < $maxAttempts) {
            $attempt++;

            // Mengirim permintaan ke API dengan menyertakan JSON schema dalam teks permintaan
            $response  = $client->geminiPro()->generateContent(
                new TextPart("
                Saya adalah seorang {{$pekerjaan}} dengan gaji sebesar RP.
            {{$gaji}} dan memiliki tabungan sebasar {{$tabungan}}.
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
            $data = json_decode($answer, true);

            // Jika $data tidak null, keluar dari loop dan kembalikan data
            if (!is_null($data)) {
                return response()->json([
                    'response' => $data
                ]);
            }
        }

        // Jika setelah beberapa percobaan tetap gagal, kembalikan error
        return response()->json([
            'response' => $answer,
            'error' => 'Invalid JSON format after several attempts'
        ]);
    }
}
