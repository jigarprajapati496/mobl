<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Session;
use DataTables;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Merchant::paginate(10);
        if ($request->ajax()) {
            return DataTables::of(Merchant::select('*')->orderBy("id","desc"))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = "<a href='".route('merchant.edit',$row->id)."' class='edit btn btn-primary btn-sm'>Edit</a>";
                    $btn .= " <a href='".route('merchant.destroy',$row->id)."' class='edit btn btn-primary btn-sm delete'>Delete</a>";

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);     
        }
        return view('backend/merchant/list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchant = new Merchant;
        return view('backend/merchant/create', compact('merchant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:50',
            'phone_number' => 'required',
            'merchant_code' => 'required|unique:merchants|max:20',
            'password' => 'required',
            'pickup_address' => 'required',
        ]);

        $requestArr = $request->all();
        $requestArr['password'] = md5($requestArr['password']);

        if (Merchant::create($requestArr)) {
            return redirect()->route('merchant.index')
                ->with(['message' => 'Merchant Created successfully.!!', 'alert-class' => 'alert-success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merchant = Merchant::find($id);
        return view('backend/merchant/edit', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|max:50',
            'phone_number' => 'required',
            'merchant_code' => 'required|max:20|unique:merchants,merchant_code,' . $id,
            // 'password' => 'required',
            'pickup_address' => 'required',
        ]);

        $requestArr = $request->all();
        $merchant = Merchant::find($id);
        if (isset($requestArr['password']) && $requestArr['password'] != "") {
            $requestArr['password'] = md5($requestArr['password']);
        } else {
            unset($requestArr['password']);
        }

        if ($merchant->update($requestArr)) {
            return redirect()->route('merchant.index')
                ->with(['message' => 'Merchant updated successfully.!!', 'alert-class' => 'alert-success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Merchant::find($id)->delete($id);
        Session::flash('message', 'Merchant has been delete successfully!');

        return response()->json([
            'success' => true,
            'message' => 'Record deleted successfully!'
        ]);
    }
}
