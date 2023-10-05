<?php

namespace Modules\Modal\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Models\Modal;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;



class ModalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Modal::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       $btn = '<a href="' . route("modal.edit", $row->id) . '"  class="edit btn btn-primary btn-sm float-start"><i class="fa fa-edit"></i></a>';
      
       $btn.= '<form action="' . route("modal.destroy", $row->id) . '" method="POST" id="delete-'.$row->id.'">
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
        return view('modal::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $makes = Make::where('status',1)->get();
        return view('modal::create',compact('makes'));
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
            'make_id' => 'required',

        ]);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $user = Modal::create($input);
        return redirect()->route('modal.index')
        ->with('success','Modal created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('modal::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $modal = Modal::find($id);
        return view('modal::edit',compact('modal'));
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
        $modal = Modal::find($id);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $modal->update($input);
        return redirect()->route('modal.index')
        ->with('success','Modal update successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $modal = Modal::find($id);

        if($modal)
        {
            $modal->delete();
            return redirect()->route('modal.index')->with('success','Modal deleted successfully');
        }
    }
}
