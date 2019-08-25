<?php

namespace App\Utility;

use App\Transaction;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use stdClass;

class PosUtility
{
    public static function returnPrice($price, $returnPlain = false)
    {
        if ($returnPlain)
            return number_format($price, 0, ',', ',');
        else
            return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public static function getTransactionNumber()
    {
        if (Transaction::all()->count() > 0) {
            $transaction = Transaction::orderBy('transaction_number', 'desc')->first();
            return $transaction->transaction_number + 1;
        }
        return 1000;
    }

    public static function returnIndoDate($date, $printDay = false)
    {
        $day = array(1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $month = array(1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $date = \Carbon\Carbon::parse($date)->format('d-m-Y');

        $split = explode('-', $date);
        $indoDate = $split[0] . ' ' . $month[(int)$split[1]] . ' ' . $split[2];

        if ($printDay) {
            $num = date('N', strtotime($date));
            return $day[$num] . ', ' . $indoDate;
        }
        return $indoDate;
    }


}