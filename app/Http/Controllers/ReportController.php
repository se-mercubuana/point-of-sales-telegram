<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Product;
use App\Transaction;
use App\TransactionStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Faker\Provider\Uuid;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionSuccess()
    {

        date_default_timezone_set('Asia/Jakarta');
        $statusTransactionId = TransactionStatus::dikirim()->first()->id;

        $data = [
            'transactions' => Transaction::transactionStatusId($statusTransactionId)->orderBy('created_at', 'desc')->get()
        ];

        return view('report.transaction-success')->with($data);
    }

    public function transactionSuccessExport()
    {
        return Excel::download(new TransactionsExport(), 'transactions.xlsx');
    }
}
