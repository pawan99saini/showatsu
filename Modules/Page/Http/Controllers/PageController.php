<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;



class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Page::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       $btn = '<a href="' . route("page.edit", $row->id) . '"  class="edit btn btn-primary btn-sm float-start"><i class="fa fa-edit"></i></a>';
      
       $btn.= '<form action="' . route("page.destroy", $row->id) . '" method="POST" id="delete-'.$row->id.'">
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
        return view('page::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('page::create');
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
            'title' => 'required',
            'content' => 'required',

        ]);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $user = Page::create($input);
        return redirect()->route('page.index')
        ->with('success','Page created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('page::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('page::edit',compact('page'));
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
            'title' => 'required',
            'content' => 'required',

        ]);
        $page = Page::find($id);
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0 ;
        $page->update($input);
        return redirect()->route('page.index')
        ->with('success','Page update successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $page = Page::find($id);

        if($page)
        {
            $page->delete();
            return redirect()->route('page.index')->with('success','Page deleted successfully');
        }
    }
}
