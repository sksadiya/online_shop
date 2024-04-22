<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Validator;
class PageController extends Controller
{
    public function index(Request $request) {
        $pages = Page::latest();
        if(!empty($request->get('search'))) {
         $pages = $pages->where('name', 'like', '%'.$request->get('search').'%');
         $pages = $pages->where('slug', 'like', '%'.$request->get('search').'%');
        }
       $pages = $pages->paginate(10); 
        return view('admin.pages.list',compact('pages'));
    }
    public function create() {
        return view('admin.pages.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all() ,[
            'name' => 'required',
            'slug' => 'required|unique:pages',
            'status' => 'required',
        ]);
        if($validator->passes() ) {
            $page = new Page();
            $page->name = $request->name;
            $page->slug = $request->slug;
            $page->status = $request->status;
            $page->content = $request->content;
            $page->save();
            $request->session()->flash('success', 'page created successfully');
            return response()->json([
                'status' => true,
                'message' => 'page created successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id) {
        $page = Page::find($id);
        if(empty($page)) {
            session()->flash('error' ,'page not found');
            return response()->json([
                'status' => false,
                'notFound' => true ,
                'message' =>'page not found'    
            ]);
        }
               return view('admin.pages.edit',compact('page'));   
    }

    public function update(Request $request ,$id) {
        $page = Page::find($id);
        if (empty ($page)) {
            $request->session()->flash('error', 'page not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'page not found'
            ]);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:pages,slug,' . $page->id . ',id',
            'status' => 'required',
        ]);
        if($validator->passes()) {
            $page->name = $request->name;
            $page->status = $request->status;
            $page->slug = $request->slug;
            $page->content = $request->content;
            $page->save();
            $request->session()->flash('success', 'page updated successfully');
            return response()->json([
                'status' => true,
                'notFound' => false,
                'message' => 'page updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function destroy(Request $request, $id)
    {
        $page = Page::find($id);
        if (empty ($page)) {
            $request->session()->flash('error', 'page not found');
 
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }
        
 
        $page->delete();
        $request->session()->flash('success', 'page deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'page deleted successfully'
        ]);
    }
}
