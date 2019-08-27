<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/08/2019
 * Time: 01.37
 */
 
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
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
	public function destroy(Customer $customer)
    {
        //
    }
}

