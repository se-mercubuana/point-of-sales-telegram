<?php


namespace App\Console;


class ChatbotCommand extends \Illuminate\Console\Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chatbot:running';


//isikan token dan nama botmu yang di dapat dari bapak bot :
    protected $token = "955481480:AAFJtCaWTVXQeBNAUxzAZNyOxFyj3eqXSsk";
    protected $usernamebot = "@testing_gema_bot"; // sesuaikan besar kecilnya, bermanfaat nanti jika bot dimasukkan grup.


// aktifkan ini jika perlu debugging
    protected $debug = false;


    public function handle()
    {
        while (true) {
            $this->process_one();
            sleep(1);
        }
    }


// fungsi untuk mengirim/meminta/memerintahkan sesuatu ke bot
    protected function request_url($method)
    {
        $token = $this->token;
//        global $token;
        return "https://api.telegram.org/bot" . $token . "/" . $method;
    }

// fungsi untuk meminta pesan
// bagian ebook di sesi Meminta Pesan, polling: getUpdates
    protected function get_updates($offset)
    {
        $url = $this->request_url("getUpdates") . "?offset=" . $offset;
        $resp = file_get_contents($url);
        $result = json_decode($resp, true);
        if ($result["ok"] == 1)
            return $result["result"];
        return array();
    }


// fungsi untuk mebalas pesan,
// bagian ebook Mengirim Pesan menggunakan Metode sendMessage
    protected function send_reply($chatid, $msgid, $text)
    {
        global $debug;
        $data = array(
            'chat_id' => $chatid,
            'text' => $text,
            'reply_to_message_id' => $msgid   // <---- biar ada reply nya balasannya, opsional, bisa dihapus baris ini
        );
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($this->request_url('sendMessage'), false, $context);

        if ($debug)
            print_r($result);
    }

// fungsi mengolahan pesan, menyiapkan pesan untuk dikirimkan

    protected function create_response($text, $message)
    {
        $usernamebot = $this->usernamebot;
        global $usernamebot;
        // inisiasi variable hasil yang mana merupakan hasil olahan pesan
        $hasil = '';

        $fromid = $message["from"]["id"]; // variable penampung id user
        $chatid = $message["chat"]["id"]; // variable penampung id chat
        $pesanid = $message['message_id']; // variable penampung id message


        // variable penampung username nya user
        isset($message["from"]["username"])
            ? $chatuser = $message["from"]["username"]
            : $chatuser = '';


        // variable penampung nama user

        isset($message["from"]["last_name"])
            ? $namakedua = $message["from"]["last_name"]
            : $namakedua = '';
        $namauser = $message["from"]["first_name"] . ' ' . $namakedua;

        // ini saya pergunakan untuk menghapus kelebihan pesan spasi yang dikirim ke bot.
        $textur = preg_replace('/\s\s+/', ' ', $text);

        // memecah pesan dalam 2 blok array, kita ambil yang array pertama saja
        $command = explode(' ', $textur, 2); //

        // identifikasi perintah (yakni kata pertama, atau array pertamanya)
        switch ($command[0]) {

            case '/gema':
            case '/gema' . $usernamebot :
                $hasil = 'iya';
                break;
            // jika ada pesan /id, bot akan membalas dengan menyebutkan idnya user
            case '/id':
            case '/id' . $usernamebot : //dipakai jika di grup yang haru ditambahkan @usernamebot
                $hasil = "$namauser, ID kamu adalah $fromid";
                break;

            // jika ada permintaan waktu
            case '/time':
            case '/time' . $usernamebot :
                $hasil = "$namauser, waktu lokal bot sekarang adalah :\n";
                $hasil .= date("d M Y") . "\nPukul " . date("H:i:s");
                break;

            // balasan default jika pesan tidak di definisikan
            default:
//                $hasil = '';
                if ($command[0] == 'halo') {
                    $hasil = 'hai';
                }

                if ($command[0] == 'haloo') {
                    $hasil = 'hai';
                }

                if ($command[0] == 'halooo') {
                    $hasil = 'hai';
                }

//                $hasil = 'Terimakasih, pesan telah kami terima.';
                break;
        }

        return $hasil;
    }

// jebakan token, klo ga diisi akan mati
// boleh dihapus jika sudah mengerti
//if (strlen($TOKEN) < 20)
//die("Token mohon diisi dengan benar!\n");

// fungsi pesan yang sekaligus mengupdate offset
// biar tidak berulang-ulang pesan yang di dapat
    protected function process_message($message)
    {
        $updateid = $message["update_id"];
        $message_data = $message["message"];
        if (isset($message_data["text"])) {
            $chatid = $message_data["chat"]["id"];
            $message_id = $message_data["message_id"];
            $text = $message_data["text"];
            $response = $this->create_response($text, $message_data);
            if (!empty($response))
                $this->send_reply($chatid, $message_id, $response);
        }
        return $updateid;
    }

// hapus baris dibawah ini, jika tidak dihapus berarti kamu kurang teliti!
//die("Mohon diteliti ulang codingnya..\nERROR: Hapus baris atau beri komen line ini yak!\n");

// hanya untuk metode poll
// fungsi untuk meminta pesan
// baca di ebooknya, yakni ada pada proses 1
    protected function process_one()
    {
        global $debug;
        $update_id = 0;
        echo "-";

        if (file_exists("last_update_id"))
            $update_id = (int)file_get_contents("last_update_id");

        $updates = $this->get_updates($update_id);

        // jika debug=0 atau debug=false, pesan ini tidak akan dimunculkan
        if ((!empty($updates)) and ($debug)) {
            echo "\r\n===== isi diterima \r\n";
            print_r($updates);
        }

        foreach ($updates as $message) {
            echo '+';
            $update_id = $this->process_message($message);
        }

        // update file id, biar pesan yang diterima tidak berulang
        file_put_contents("last_update_id", $update_id + 1);
    }

// metode poll
// proses berulang-ulang
// sampai di break secara paksa
// tekan CTRL+C jika ingin berhenti

// metode webhook
// secara normal, hanya bisa digunakan secara bergantian dengan polling
// aktifkan ini jika menggunakan metode webhook
    /*
    $entityBody = file_get_contents('php://input');
    $pesanditerima = json_decode($entityBody, true);
    process_message($pesanditerima);
    */


    /*
     * -----------------------
     * Grup @botphp
     * Jika ada pertanyaan jangan via PM
     * langsung ke grup saja.
     * ----------------------

    * Just ask, not asks for ask..

    Sekian.

    */


}
