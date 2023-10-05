<?php

namespace Modules\Vehicle\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use App\Models\Vehicle;
use App\Models\ExteriorColor;
use App\Models\InteriorColor;
use App\Models\Engine;
use App\Models\VehicleName;
use App\Models\Transmission;
use App\Models\InteriorType;
use App\Models\FuelType;
use App\Models\Make;
use App\Models\Modal;
use App\Models\Enquiry;
use App\Models\Order;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('vehicle::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        //return view('vehicle::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('vehicle::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

public function searchVehicle(Request $request)
{
    $name = $request->name;
    $make = $request->make;
    $model = $request->model;
    $year = $request->year;
    $transmission = $request->transmission;
    $interior_color = $request->interior_color;
    $exterior_color = $request->exterior_color;
    $interior_type = $request->interior_type;
    $chassis_no = $request->chassis_no;
    $engine = $request->engine;
    $fuel_type = $request->fuel_type;

    $data = Vehicle::with('gallary','vehicle_name','make_info','model_info','fuel_info','engine_info','transmission_info','exterior_color_info','interior_color_info','interior_type_info')->where('status',1)->
    whereHas('vehicle_name', function ($query) use ($name){
        return $query->where('name', 'like', '%'.$name.'%');
    })
    ->when($model, function ($query, $model) {
        return $query->where('model', $model);
    })
    ->when($year, function ($query, $year) {
        return $query->where('year', 'LIKE', '%' . $year . '%');
    })
    ->when($transmission, function ($query, $transmission) {
        return $query->where('transmission', $transmission);
    })
    ->when($interior_color, function ($query, $interior_color) {
        return $query->where('interior_color',$interior_color);
    })
    ->when($exterior_color, function ($query, $exterior_color) {
        return $query->where('exterior_color', $exterior_color);
    })
    ->when($interior_type, function ($query, $interior_type) {
        return $query->where('interior_type',$interior_type);
    })
    ->when($chassis_no, function ($query, $chassis_no) {
        return $query->where('chassis_no', 'LIKE', '%' . $chassis_no . '%');
    })
    ->when($engine, function ($query, $engine) {
        return $query->where('engine',$engine);
    })
    ->when($fuel_type, function ($query, $fuel_type) {
        return $query->where('fuel_type',$fuel_type);
    })
    ->orderBy('id','DESC')->get();



    if($data)
    {
        foreach($data as $value)
        {
            $value->name = $value->vehicle_name->name;
            $value->make = $value->make_info->name;
            $value->model = $value->model_info->name;
            $value->fuel_type = $value->fuel_info->name;
            $value->exterior_color = $value->exterior_color_info->name;
            $value->interior_color = $value->interior_color_info->name;
            $value->engine = $value->engine_info->name;
            $value->interior_type = $value->interior_type_info->name;
            $value->transmission = $value->transmission_info->name;
            $array = json_decode($value->accessories,true); 
            $string = implode(",",$array);
            $value->accessories = $string;
            if($value->image)
            $value->image = asset('storage/uploads/'.$value->image);
            foreach($value->gallary as $gallary)
            {
                $gallary->name = asset('storage/uploads/'.$gallary->name);
            }
            unset($value['vehicle_name']);
            unset($value['make_info']);
            unset($value['model_info']);
            unset($value['fuel_info']);
            unset($value['exterior_color_info']);
            unset($value['interior_color_info']);
            unset($value['engine_info']);
            unset($value['interior_type_info']);
            unset($value['transmission_info']);

        }
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Vehicle get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Vehicle not found.',
        ];
        return response()->json($response, 200);
    }
}


//ExteriorColors

public function ExteriorColors()
{
    $data = ExteriorColor::select('id','name')->where('status',1)->get();
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//InteriorColors

public function InteriorColors()
{
    $data = InteriorColor::select('id','name')->where('status',1)->get();
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//Engines

public function Engines()
{
    $data = Engine::select('id','name')->where('status',1)->get();
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//Transmissions

public function Transmissions()
{
    $data = Transmission::select('id','name')->where('status',1)->get();
    
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//Vechile Names

public function VechileNames()
{
    $data = VehicleName::select('id','name')->where('status',1)->get(); 
    
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}


//Vechile Interior Type

public function InteriorTypes()
{
    $data = InteriorType::select('id','name')->where('status',1)->get(); 
    
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//Vechile Fuel Type

public function FuelTypes()
{
    $data = FuelType::select('id','name')->where('status',1)->get(); 
    
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//Vechile Make
public function VechileMake()
{
    $data = Make::select('id','name')->where('status',1)->get(); 
    
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}


public function VechileModel(Request $request)
    {
        //
        $data = Modal::select('id','name','make_id')->where('make_id',$request->make_id)->get(); 
        if($data)
        {
            $response = [
                'success' => true,
                'data'    => $data,
                'message' => 'Data get Successfully',
            ];
            return response()->json($response, 200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Data not found.',
            ];
            return response()->json($response, 200);
        }
    }

//Years List

public function YearsList()
{
    $data = [];
    for($y=1991; $y< 2023; $y++)
    {
        $data[] = ['year'=>$y];
    }
    
    if($data)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

public function VehicleDetails(Request $request)
{
    $id = $request->id;
    $data = Vehicle::with('gallary','vehicle_name','make_info','model_info','fuel_info','engine_info','transmission_info','exterior_color_info','interior_color_info','interior_type_info')->find($id);
    if($data)
    {
        
            
            $data->name = $data->vehicle_name->name;
            $data->make = $data->make_info->name;
            $data->model = $data->model_info->name;
            $data->fuel_type = $data->fuel_info->name;
            $data->exterior_color = $data->exterior_color_info->name;
            $data->interior_color = $data->interior_color_info->name;
            $data->engine = $data->engine_info->name;
            $data->interior_type = $data->interior_type_info->name;
            $data->transmission = $data->transmission_info->name;
            $array = json_decode($data->accessories,true); 
            $string = implode(",",$array);
            $data->accessories = $string;
            $data->image = asset('storage/uploads/'.$data->image);
            unset($data['vehicle_name']);
            unset($data['make_info']);
            unset($data['model_info']);
            unset($data['fuel_info']);
            unset($data['exterior_color_info']);
            unset($data['interior_color_info']);
            unset($data['engine_info']);
            unset($data['interior_type_info']);
            unset($data['transmission_info']);
            foreach($data->gallary as $gallary)
            {
                $gallary->name = asset('storage/uploads/'.$gallary->name);
            }

        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'Data get Successfully',
        ];
        return response()->json($response, 200);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Data not found.',
        ];
        return response()->json($response, 200);
    }
}

//enquiry
public function Enquiry(Request $request)
{
    $validator = Validator::make($request->all(), [
        'vehicle_id' => 'required|integer',
        'email' => 'required|email',
        'phone' => 'required',
        'location' => 'required',
    ]);

    if($validator->fails()){
        $response = [
            'success' => false,
            'message' => 'Data not found.',
            'error' => $validator->errors()
        ];
        return response()->json($response, 200);
    }
    else{

        $data = $request->all();
        if(Enquiry::create($data))
        {
            $response = [
                'success' => true,
                'data'    => [],
                'message' => 'Enquiry Submitted Succefully',
            ];
            return response()->json($response, 200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Invalid Request',
            ];
            return response()->json($response, 200);
        }
    }
    }
    
    //order
    public function Order(Request $request)
{
    $validator = Validator::make($request->all(), [
        'vehicle_id' => 'required|integer',
        'email' => 'required|email',
        'name' => 'required',
        'address' => 'required',
        'zip' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'permit_no' => 'required',
        'payment_mode' => 'required',
        'destination_port' => 'required',
        'destination_country' => 'required',
    ]);

    if($validator->fails()){
        $response = [
            'success' => false,
            'message' => 'Data not found.',
            'error' => $validator->errors()
        ];
        return response()->json($response, 200);
    }
    else{

        $data = $request->all();
        if(Order::create($data))
        {
            $response = [
                'success' => true,
                'data'    => [],
                'message' => 'Order Submitted Succefully',
            ];
            return response()->json($response, 200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Invalid Request',
            ];
            return response()->json($response, 200);
        }
    }
    }

}
