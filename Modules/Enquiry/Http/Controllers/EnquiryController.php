<?php

namespace Modules\Enquiry\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;



class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Enquiry::select('*')->with('vehicle.vehicle_name');
            return Datatables::of($data)
            ->editColumn('vehicle_id', function($data) {
                return $data->vehicle->vehicle_name->name;
            })

                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('enquiry::index');
    }

}
