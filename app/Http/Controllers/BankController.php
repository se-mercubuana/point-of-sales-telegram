<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use \Faker\Provider\Uuid;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'banks' => Bank::all()
        ];

        return view('bank.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'banks' => Bank::all()
        ];

        return view('bank.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     //memberi fungsi submit pada tools created

    public function store(Request $request)
    {
        \App\Bank::insert([
            'id' => Uuid::uuid(),
            'name' => $request->name,
            'no_rekening' => (int)$request->no_rekening,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank $bank
     * @return \Illuminate\Http\Response
     */

     //view tampilan entry per halaman
    public function show(Bank $bank)
    {
        return view('bank.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank $bank
     * @return \Illuminate\Http\Response
     */
     public function edit(Bank $bank)
         {
             $data = [
                 'bank' => $bank, //for ambil database
                 'listBanks' => Bank::all()
             ];

             return view('bank.edit')->with($data);
         }

         /**
          * Update the specified resource in storage.
          *
          * @param  \Illuminate\Http\Request $request
          * @param  \App\Bank $bank
          * @return \Illuminate\Http\Response
          */


          //untuk memberi fungsi pada submit
         public function update(Request $request, Bank $bank)
         {
             $bank->update(['name' => $request->name, 'no_rekening' => $request->no_rekening]);
             return redirect('/bank');
         }
         //untuk memberi fungsi pada submit

         /**
          * Remove the specified resource from storage.
          *
          * @param  \App\Bank $bank
          * @return \Illuminate\Http\Response
          */
          public function destroy(Bank $bank)
              {
                  Bank::find($bank->id)->delete();
                  return redirect('/bank');
              }
            }


