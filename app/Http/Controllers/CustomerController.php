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
    public function edit(Customer $customer)
    {
        $data = [
            'customer' => $customer,
            'customer_address' => CustomerAddress::customerId($customer->id)->get()
        ];

        return view('customer.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update(['name' => $request->name, 'updated_at' => Carbon::now()]);
        return redirect('/customer');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function createCustomerAddress($id)
    {
        $data = [
            'customer_id' => $id,
        ];
        return view('customer.address.create')->with($data);
    }

    public function postCustomerAddress(Request $request, $id)
    {
        \App\CustomerAddress::insert([
            'id' => Uuid::uuid(),
            'full_name' => $request->full_name,
            'address' => $request->address,
            'city' => $request->city,
            'customer_id' => $request->customer_id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);


        return redirect('/customer/'. $id . '/edit');
    }


    public function listCustomerAddress($customerId)
    {

        $customerAddress = CustomerAddress::customerId($customerId)->get();

        $output = "";



        $output .= ' <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Customer Address
                                </label>
                                <div class="col-sm-9">';
        $output .= '<select class="select2 form-control custom-select customer-select"
                                            style="width: 100%; height:36px;" name="customer_address" required>';
        $output .= '<option value=""> - </option>';

        foreach ($customerAddress as $address) {
            $output .= '<option value="' . $address->id . '">' . $address->full_name . ' - ' . $address->city . ', '. $address->address . '</option>';
        }

        $output .= '</select>';

        $output .= '</div></div>';

        return $output;

    }

    public function putCustomerAddress(Request $request, $id)
    {
        $customerAddress = CustomerAddress::find($id);
        $customerAddress->update(['full_name' => $request->full_name, 'address' => $request->address, 'city' => $request->city, 'updated_at' => Carbon::now()]);
        return redirect('/customer/' . $customerAddress->customer_id . '/edit');
    }

    public function editCustomerAddress($id)
    {
        $data = [
            'customer_address' => CustomerAddress::find($id)
        ];

        return view('customer.address.edit')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
