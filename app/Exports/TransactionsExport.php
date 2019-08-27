<?php

namespace App\Exports;

use App\Transaction;
use App\TransactionStatus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExport implements FromView
{


    public function view(): View
    {
        $statusTransactionId = TransactionStatus::dikirim()->first()->id;

        $transactionSuccess = Transaction::transactionStatusId($statusTransactionId)->orderBy('created_at', 'desc')->get();
        return view('report.excel.transaction-success', [
            'transactions' => $transactionSuccess
        ]);
    }
}
