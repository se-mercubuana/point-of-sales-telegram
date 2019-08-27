<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Faker\Provider\Uuid;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'customers' => Customer::all()
        ];

        return view('customer.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
//    {
//        return view('customer.create');
//    }

    {
        $data = [
            'customers' => Customer::all()
        ];

        return view('customer.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $code = self::createSlug(Customer::class, 'code', $request->code);

        \App\Customer::insert([
            'id' => Uuid::uuid(),
            'code' => $code,
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);


        return redirect('/customer');
    }


    public static function createSlug($model, $field, $word)
    {
        $slug = Str::slug($word);

        $slugs = $model::where($field, 'like', "{$slug}%")->get();

        $slugs = $slugs->pluck('code')->toArray();
        if (count($slugs) !== 0 and in_array($slug, $slugs)) {
            $max = 0;

            //keep incrementing $max until a space is found
            while (in_array(($slug . '-' . ++$max), $slugs)) {
            }

            //update $slug with the appendage
            $slug .= '-' . $max;
        }

        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
