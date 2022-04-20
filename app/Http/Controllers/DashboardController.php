<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryRequest;
use DataTables;
use Session;
class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('backend/dashboard');
    }

    public function deliveryRequest(Request $request) {
        if ($request->ajax()) {
            return DataTables::of(DeliveryRequest::select('*')->where("payment_mode",1))
                ->addIndexColumn()
                ->addColumn('user',function($row) {
                    $data = "<p>";
                    if ($row->percletype == 'merchant') {
                        $data .= "<i class='fas fa-user fa-fw'></i> ";
                    }
                    
                    $data .= ucfirst($row->full_name) . "</p>";
                    $data .= "<p>$row->phone_number</p>";
                    return $data;

                })
                ->addColumn('pickup_date', function ($row) {
                    $time = date("H:m",strtotime($row->pickup_time));
                    return date('d/m/Y',strtotime($row->pickup_date)) . " " . $time;
                })
                ->addColumn('location', function ($row) {
                    return "<p><strong>FROM</strong> ". $row->pickup_address . " <strong>TO</strong> " . $row->drop_address;
                })
                ->addColumn('cost', function ($row) {
                    $formatter = new \NumberFormatter('en_US',  \NumberFormatter::CURRENCY);
                    $data = $formatter->formatCurrency($row->cost, 'USD');
                    return $data;
                })
                ->addColumn('estimate_time', function ($row) {
                    if (isset($row->estimate_time) && $row->estimate_time > 0) {

                        $dtF = new \DateTime('@0');
                        $dtT = new \DateTime("@$row->estimate_time");
                        $days = $dtF->diff($dtT)->format('%a');
                        $hours = $dtF->diff($dtT)->format('%h');
                        $minutes = $dtF->diff($dtT)->format('%i');
                        $seconds = $dtF->diff($dtT)->format('%s');
                        
                        return ($days > 0 ? "$days days " : "") . 
                               ($minutes > 0 ? "$minutes minutes " : "") . 
                               ($seconds > 0 ? "$seconds seconds " : "");
                    }
                    return '0 seconds';
                })
                ->addColumn('is_approve', function ($row) {
                    
                    if ($row->is_approve == 0) {
                        return '<button class="btn btn-info btn-sm">Pending</button>';
                    }

                    if ($row->is_approve == 1) {
                        return '<button class="btn btn-success btn-sm">Approve</button>';
                    }

                    if ($row->is_approve == 2) {
                        return '<button class="btn btn-danger btn-xs">Reject</button>';
                    }
                    
                })
                ->addColumn('action', function ($row) {
                    if ($row->is_approve != 0) { return;}
                    $btn = "<a href='".route('delivery.statusUpdate')."' data-id='".$row->id."' data-action='1' class='edit btn btn-primary btn-sm action'>Approve</a>";
                    $btn .= " <a href='".route('delivery.statusUpdate')."' data-id='".$row->id."' data-action='2' class='edit btn btn-primary btn-sm action'>Reject</a>";

                    return $btn;
                })
                ->rawColumns(['action','is_approve','user','location'])
                ->make(true);     
        }
        return view('backend/deliveryRequestList');
    }

    public function deliveryRequestStatusUpdate(Request $request) {
        $deliveryRequest = DeliveryRequest::find($request->id);
        if ($deliveryRequest) {
            if ($deliveryRequest->update(['is_approve' => $request->action])) {
                $isApprove = $request->action == 1 ? "approved" : "rejected";
                $msg = 'Delivery request has been ' . $isApprove;
               # Session::flash('message', $msg);
                return response()->json(['success' => true,'message' => $msg]);
            }
        }
        $msg = 'something wrong happened. please try again.';
        #Session::flash('message', $msg);
        return response()->json(['success' => false,'message' => $msg]);
    }

   
}
