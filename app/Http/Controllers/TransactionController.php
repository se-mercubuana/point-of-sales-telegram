<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Customer;
use App\CustomerAddress;
use App\Product;
use App\ProductLog;
use App\Transaction;
use App\TransactionAddress;
use App\TransactionStatus;
use Carbon\Carbon;
use \Faker\Provider\Uuid;
use App\TransactionProduct;
use App\Utility\PosUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'transactions' => Transaction::userId(Auth::user()->id)->get()
        ];

        return view('transaction.index')->with($data);
    }

    public function indexApprove()
    {
        date_default_timezone_set('Asia/Jakarta');
        $statusTransactionId = TransactionStatus::menungguPembayaran()->first()->id;

        $data = [
            'transactions' => Transaction::transactionStatusId($statusTransactionId)->orderBy('created_at', 'desc')->get()
        ];

        return view('transaction.approve.index')->with($data);
    }


    public function editApprove($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'transaction' => Transaction::find($id),
            'banks' => Bank::all()
        ];

        return view('transaction.approve.edit')->with($data);
    }

    public function confirmationApprove(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (isset($request->bank) && isset($request->transfer_date)) {
            $transaction = Transaction::find($id);
            $transactionStatusPacking = TransactionStatus::packing()->first()->id;


            $now = Carbon::now();
            $date = Carbon::parse($request->transfer_date);
            if (Carbon::parse($request->transfer_date) == Carbon::parse($now->toDateString())) {
                $date = $now;
            }


            $transaction->transfer_date = $date;
            $transaction->bank_id = $request->bank;
            $transaction->transaction_status_id = $transactionStatusPacking;
            $transaction->save();

            return redirect('/transaction/approve');
        }

        return redirect('/transaction/approve/' . $id . '/edit');
    }


    public function indexConfirmationPengiriman()
    {
        date_default_timezone_set('Asia/Jakarta');
        $statusTransactionId = TransactionStatus::packing()->first()->id;

        $data = [
            'transactions' => Transaction::transactionStatusId($statusTransactionId)->orderBy('created_at', 'desc')->get()
        ];

        return view('transaction.pengiriman.index')->with($data);
    }


    public function editConfirmationPengiriman($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $transaction = Transaction::find($id);
        $data = [
            'products' => TransactionProduct::transactionNumber($transaction->transaction_number)->get(),
            'transaction' => $transaction,
            'banks' => Bank::all(),

        ];

        return view('transaction.pengiriman.edit')->with($data);
    }

    public function putConfirmationPengiriman(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (isset($request->no_resi)) {
            $transaction = Transaction::find($id);
            $transactionStatusDikirim = TransactionStatus::dikirim()->first()->id;

            $now = Carbon::now();
            $date = Carbon::parse($request->send_date);
            if (Carbon::parse($request->send_date) == Carbon::parse($now->toDateString())) {
                $date = $now;
            }
            

            $transaction->no_resi = $request->no_resi;
            $transaction->transaction_status_id = $transactionStatusDikirim;
            $transaction->send_date = $date;
            $transaction->save();

            return redirect('/transaction/pengiriman');
        }

        return redirect('/transaction/pengiriman/' . $id . '/edit');
    }


    public function indexSuccess()
    {
        date_default_timezone_set('Asia/Jakarta');
        $statusTransactionId = TransactionStatus::dikirim()->first()->id;

        $data = [
            'transactions' => Transaction::transactionStatusId($statusTransactionId)->orderBy('created_at', 'desc')->get()
        ];

        return view('transaction.success.index')->with($data);
    }


    public function editSuccess($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $transaction = Transaction::find($id);
        $data = [
            'products' => TransactionProduct::transactionNumber($transaction->transaction_number)->get(),
            'transaction' => $transaction,
            'banks' => Bank::all(),

        ];

        return view('transaction.success.edit')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'banks' => Bank::all(),
            'products' => Product::all(),
            'customers' => Customer::all()
        ];

        return view('transaction.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        if (isset($request->customer_address) && isset($request->customer) && isset($request->product_id) && isset($request->quantity)) {


            $transactionNumber = PosUtility::getTransactionNumber();

            $productIds = $request->product_id;
            $productQuantitys = $request->quantity;

            $total = 0;
            $laba = 0;

            for ($i = 0; $i < count($request->quantity); $i++) {
                $product = Product::find($productIds[$i]);

                $productLogFind = ProductLog::productId($product->id)->name($product->name)->modal($product->modal)->price($product->price)->get();


                if (count($productLogFind) > 0) {
                    $productLogFind = $productLogFind->first();
                    $productLogId = $productLogFind->id;
                    $modal = $productLogFind->modal;
                    $price = $productLogFind->price;
                } else {
                    $productLogId = Uuid::uuid();
                    $productLog = new ProductLog();
                    $productLog->id = $productLogId;
                    $productLog->name = $product->name;
                    $productLog->modal = $product->modal;
                    $productLog->price = $product->price;
                    $productLog->product_id = $product->id;
                    $productLog->save();
                    $modal = $product->modal;
                    $price = $product->price;
                }

                $total = $total + ($price * $request->quantity[$i]);
                $laba = $laba + (($price - $modal) * $request->quantity[$i]);

                $transactionProduct = new TransactionProduct();
                $transactionProduct->id = Uuid::uuid();
                $transactionProduct->transaction_number = $transactionNumber;
                $transactionProduct->product_log_id = $productLogId;
                $transactionProduct->quantity = (int)$productQuantitys[$i];
                $transactionProduct->save();

            }

            $customerAddress = CustomerAddress::find($request->customer_address);

            $transactionAddressFind = TransactionAddress::customerId($customerAddress->customer_id)->fullName($customerAddress->full_name)->address($customerAddress->address)->city($customerAddress->city)->customerAddressId($customerAddress->id)->get();


            if (count($transactionAddressFind) > 0) {
                $transactionAddressFind = $transactionAddressFind->first();
                $transactionAddressId = $transactionAddressFind->id;
            } else {
                $transactionAddressId = Uuid::uuid();
                $transactionAddress = new TransactionAddress();
                $transactionAddress->id = $transactionAddressId;
                $transactionAddress->full_name = $customerAddress->full_name;
                $transactionAddress->address = $customerAddress->address;
                $transactionAddress->city = $customerAddress->city;
                $transactionAddress->customer_id = $customerAddress->customer_id;
                $transactionAddress->customer_address_id = $customerAddress->id;
                $transactionAddress->save();
            }


            $ongkir = intval(str_replace(',', '', $request->ongkir));

            $transactionProduct = new Transaction();
            $transactionProduct->id = Uuid::uuid();
            $transactionProduct->transaction_number = $transactionNumber;
            $transactionProduct->ongkir = $ongkir;
            $transactionProduct->total = $total + $ongkir;
            $transactionProduct->laba = $laba;
            $transactionProduct->customer_id = $request->customer;
            $transactionProduct->user_id = Auth::user()->id;
            $transactionProduct->transaction_address_id = $transactionAddressId;
            $transactionProduct->transaction_status_id = TransactionStatus::menungguPembayaran()->first()->id;
            $transactionProduct->save();

            return redirect('/transaction');
        } else {
            return redirect('/transaction/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        date_default_timezone_set('Asia/Jakarta');
        return view('transaction.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $transaction = Transaction::find($id);
        $data = [
            'products' => TransactionProduct::transactionNumber($transaction->transaction_number)->get(),
            'transaction' => $transaction,
            'banks' => Bank::all(),

        ];

        return view('transaction.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
