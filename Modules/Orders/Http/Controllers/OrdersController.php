<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;



class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::select('*')->with('vehicle.vehicle_name');
            return Datatables::of($data)
            ->editColumn('vehicle_id', function($data) {
                return $data->vehicle->vehicle_name->name;
            })

                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:"  class="edit btn btn-primary btn-sm float-start" onclick="viewOrder('.$row->id.')"><i class="fa fa-eye"></i></a>';
                        return $btn;

                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('orders::index');
    }

    public function show($id)
    {
        $order = Order::with('vehicle.vehicle_name')->find($id);
        return response()->json($order);

    }

}
