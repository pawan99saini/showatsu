<?php

namespace Modules\Vehicle\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Engine;
use App\Models\ExteriorColor;
use App\Models\FuelType;
use App\Models\InteriorColor;
use App\Models\InteriorType;
use App\Models\Make;
use App\Models\Modal;
use App\Models\Transmission;
use App\Models\VehicleName;
use App\Models\VehicleGallary;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;
use Auth;



class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vehicle::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       $btn = '<a href="' . route("vehicle.edit", $row->id) . '"  class="edit btn btn-primary btn-sm float-start"><i class="fa fa-edit"></i></a>';
      
       $btn.= '<form action="' . route("vehicle.destroy", $row->id) . '" method="POST" id="delete-'.$row->id.'">
       '.csrf_field().'
        '.method_field("DELETE").'    
       <a href="#" class="btn btn-danger btn-sm mx-2" onclick="validateForm('.$row->id.')">
       <i class="fa fa-trash" aria-hidden="true"></i></a>
     </form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('vehicle::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $makes = Make::select('id','name')->where('status',1)->get();
        $modal = Modal::select('id','name')->where('status',1)->get();
        $engine = Engine::select('id','name')->where('status',1)->get();
        $ext_color = ExteriorColor::select('id','name')->where('status',1)->get();
        $fuel_type = FuelType::select('id','name')->where('status',1)->get();
        $int_color = InteriorColor::select('id','name')->where('status',1)->get();
        $int_type = InteriorType::select('id','name')->where('status',1)->get();
        $vehicle_name = VehicleName::select('id','name')->where('status',1)->get();
        $transmission = Transmission::select('id','name')->where('status',1)->get();
        return view('vehicle::create',compact('makes','modal','engine','ext_color','fuel_type','int_color','int_type','vehicle_name','transmission'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'make' => 'required',
            'image' => 'required',
            'model' => 'required',
            'grade' => 'required',
            'fuel_type' => 'required',
            'exterior_color' => 'required',
            'interior_color' => 'required',
            'engine' => 'required',
            'transmission' => 'required',
            'year' => 'required',
            'wheel_style' => 'required',
            'chassis_no' => 'required',
            'kilometers' => 'required',
            'drive' => 'required',
        ]);
        $input = $request->all();
        unset($input['galarry']);
        $input['accessories'] = !empty($input['accessories']) ? json_encode($input['accessories']) : NULL;
        $photo = NULL;
        if($request->file('image')) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $photo = time().'_'.$request->file('image')->getClientOriginalName();
           
        }
        $input['image'] = $photo;
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $vehicle = Vehicle::create($input);
        if ($request->file('galarry')){
            foreach($request->file('galarry') as $key => $file)
            {
                
            $galarry = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $galarry, 'public');
            $name = time().'_'.$file->getClientOriginalName();
            $data = ['name'=>$name,'vehicle_id'=>$vehicle->id];
            VehicleGallary::create($data);
            }
        }
        return redirect()->route('vehicle.index')
        ->with('success','Vehicle created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('vehicle::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $makes = Make::select('id','name')->where('status',1)->get();
        $modal = Modal::select('id','name')->where('status',1)->get();
        $engine = Engine::select('id','name')->where('status',1)->get();
        $ext_color = ExteriorColor::select('id','name')->where('status',1)->get();
        $fuel_type = FuelType::select('id','name')->where('status',1)->get();
        $int_color = InteriorColor::select('id','name')->where('status',1)->get();
        $int_type = InteriorType::select('id','name')->where('status',1)->get();
        $vehicle_name = VehicleName::select('id','name')->where('status',1)->get();
        $transmission = Transmission::select('id','name')->where('status',1)->get();
        $vehicle = Vehicle::with('gallary')->find($id);
        return view('vehicle::edit',compact('vehicle','makes','modal','engine','ext_color','fuel_type','int_color','int_type','vehicle_name','transmission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        $this->validate($request, [
            'name' => 'required',
            'make' => 'required',
            'model' => 'required',
            'grade' => 'required',
            'fuel_type' => 'required',
            'exterior_color' => 'required',
            'interior_color' => 'required',
            'engine' => 'required',
            'transmission' => 'required',
            'year' => 'required',
            'wheel_style' => 'required',
            'chassis_no' => 'required',
            'kilometers' => 'required',
            'drive' => 'required',
        ]);
        $input = $request->all();
        unset($input['galarry']);
        $input['accessories'] = !empty($input['accessories']) ? json_encode($input['accessories']) : NULL;
        $photo = NULL;
        if($request->file('image')) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');
            $photo = time().'_'.$request->file('image')->getClientOriginalName();
           
        }
        $input['image'] = $photo;
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $vehicle->update($input);
        if ($request->file('galarry')){
            foreach($request->file('galarry') as $key => $file)
            {
                
            $galarry = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $galarry, 'public');
            $name = time().'_'.$file->getClientOriginalName();
            $data = ['name'=>$name,'vehicle_id'=>$vehicle->id];
            VehicleGallary::create($data);
            }
        }
        return redirect()->route('vehicle.index')
        ->with('success','Vehicle update successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $vehicle = Vehicle::find($id);

        if($vehicle)
        {
            $vehicle->delete();
            return redirect()->route('vehicle.index')->with('success','Vehicle deleted successfully');
        }
    }

    public function fetchModal(Request $request)
    {
        $data['models'] = Modal::where("make_id", $request->make_id)
                                    ->get(["name", "id"]);
                                      
        return response()->json($data);
    }
}
