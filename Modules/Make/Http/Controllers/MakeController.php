<?php

namespace Modules\Make\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Make;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;



class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Make::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       $btn = '<a href="' . route("make.edit", $row->id) . '"  class="edit btn btn-primary btn-sm float-start"><i class="fa fa-edit"></i></a>';
      
       $btn.= '<form action="' . route("make.destroy", $row->id) . '" method="POST" id="delete-'.$row->id.'">
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
        return view('make::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('make::create');
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

        ]);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $user = Make::create($input);
        return redirect()->route('make.index')
        ->with('success','Make created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('make::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $make = Make::find($id);
        return view('make::edit',compact('make'));
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
        $this->validate($request, [
            'name' => 'required',

        ]);
        $make = Make::find($id);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $make->update($input);
        return redirect()->route('make.index')
        ->with('success','Make update successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $make = Make::find($id);

        if($make)
        {
            $make->delete();
            return redirect()->route('make.index')->with('success','Make deleted successfully');
        }
    }
}
