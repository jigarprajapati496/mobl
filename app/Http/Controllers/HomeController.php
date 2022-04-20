<?php

namespace App\Http\Controllers;

use App\Models\DeliveryRequest;
use App\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend/index');
    }

    public function store(Request $request)
    {
        try {

            $validationArr = [
                "pickup_date" => 'required',
                "pickup_time" => 'required',
                "pickup_address" => 'required',
                "drop_address" => 'required',
            ];

            if ($request->percletype === 'merchant') {
                $validationArr["merchant_code"] = "required";
                $validationArr["merchant_password"] = "required";
                $validationArr["merchant_id"] = "required";
            }

            if ($request->percletype === 'customer') {
                $validationArr["full_name"] = "required";
                $validationArr["phone_number"] = "required";
            }

            $request->validate($validationArr);

            $requestArr = $request->all();
            $requestArr['pickup_date'] = date("Y-m-d", strtotime($requestArr['pickup_date']));
            $requestArr['is_approve'] = 0;
            //$requestArr['estimate_time'] = 0;
            // $requestArr['cost'] = 0;
            $requestArr['payment_mode'] = 0;

            $deliveryData = DeliveryRequest::create($requestArr);
            if ($deliveryData) {
                $successUrl = route('payment.status') . "?type=success&session={CHECKOUT_SESSION_ID}";
                $cancelUrl = route('payment.status') . "?type=cancel&session={CHECKOUT_SESSION_ID}";
                $listItems = [];
                $price = $requestArr['cost'];//number_format($requestArr['cost'], 2);
                $listItems[] = [
                    "price_data" => [
                        "product_data" => [
                            'name' => "Delivery Request from " . $request['pickup_address'] . " to " . $request['drop_address'],
                        ],
                        "currency" => "USD",
                        "unit_amount" => $price * 100
                    ],
                    "quantity" => 1
                ];
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                $session = \Stripe\Checkout\Session::create([
                    //'payment_method_types' => 'cards',
                    'line_items' => $listItems,
                    'mode' => 'payment',
                    'success_url' => $successUrl,
                    'cancel_url' => $cancelUrl,
                ]);
                $deliveryData->session_id = $session->id;
                $deliveryData->save();
                return response()->json(['message' => "delivery request hasn been sent.!", "session_id" => $session->id], 200);
            }
            return response()->json(['message' => "something wrong.! please try again"], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    function merchantAuth(Request $request)
    {
        $merchant = null;
        if ($request->merchant_code && $request->password) {
            $merchant = Merchant::where('merchant_code', $request->merchant_code)->where("password", md5($request->password))->first();
            if ($merchant) {
                return response()->json(['success' => true, 'data' => $merchant]);
            }
        }


        return response()->json(['success' => false, 'message' => 'Invalid merchant code or password.']);
    }

    function redirectionPage(Request $request)
    {
        try {
            $session_id = $request->session;
            $deliveryData = DeliveryRequest::where("session_id", $session_id)->first();
            $route = '';
            if ($request->type == 'success') {
                $deliveryData->payment_mode = 1;
                $route = 'success.page';
            } else if ($request->type == 'cancel') {
                $deliveryData->payment_mode = 2;
                $route = 'cancel.page';
            }

            if ($deliveryData->save()) {
                return redirect()->route($route, ['session_id' => $session_id]);
            } else {
                return redirect()->route('home')
                    ->with(['message' => 'Something wrong happened please try again.!!', 'alert-class' => 'alert-danger']);
            }
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with(['message' => 'Something wrong happened please try again.!!', 'alert-class' => 'alert-danger']);
        }
    }

    function successPage($session_id)
    {
        try {
            $deliveryData = DeliveryRequest::where("session_id", $session_id)->where('payment_mode', 1)->first();
            if ($deliveryData) {
                $status = 'completed';
                return view('frontend/deliveryRequestStatus', compact('deliveryData', 'status'));
            } else {
                return redirect()->route('home')->with(['message' => 'Something wrong happened please try again.!!', 'alert-class' => 'alert-danger']);
            }
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with(['message' => 'Something wrong happened please try again.!!', 'alert-class' => 'alert-danger']);
        }
    }

    function cancelPage($session_id)
    {
        try {
            $deliveryData = DeliveryRequest::where("session_id", $session_id)->where('payment_mode', 2)->first();
            if ($deliveryData) {
                $status = 'incompleted';
                return view('frontend/deliveryRequestStatus', compact('deliveryData', 'status'));
            } else {
                return redirect()->route('home')->with(['message' => 'Something wrong happened please try again.!!', 'alert-class' => 'alert-danger']);
            }
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with(['message' => 'Something wrong happened please try again.!!', 'alert-class' => 'alert-danger']);
        }
    }
}
