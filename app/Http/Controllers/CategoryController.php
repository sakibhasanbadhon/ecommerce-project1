<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        pageTitle('Category List');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'Category'=>''];
        return view('backend.pages.category.index',['breadcrumb'=>$breadcrumb]);
    }



    /**
     * DataTables
     */

     public function getData(Request $request){
        if ($request->ajax()) {
            $getData = Category::orderBy('id','desc');

            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('operation', function($category){
                    $operation = '
                        <a href="'.route('app.categories.edit',$category->id).'" id="editBtn" class="btn-style btn-style-edit"> <i class="fa fa-edit"> </i></a>
                        <button class="btn-style btn-style-danger deleteBtn" data-id="'.$category->id.'"> <i class="fa fa-trash"></i> </button>
                    ';
                    return $operation;
                })

                ->addColumn('image', function($category) {
                    $image = '<img width="80px" height="80px" src="'. asset("backend/assets/img/category/$category->image").'" alt="">';
                    return $image;
                })

                ->addColumn('status', function($category){
                    $checked = $category->status == 1 ? 'checked':'' ;
                    return '<div class = "toggle-switch">
                                <label class="switch-label" for="status'.$category->id.'">
                                <input type = "checkbox" name="status" class="input-status" data-id="'.$category->id.'" id="status'.$category->id.'"'.$checked.'>
                                    <span class = "pr-2 text-right switch_slider"> <span style="padding-right:15px">OFF</span> </span>
                                    <span class = "switch_slider">ON</span>
                                </label>
                            </div> ';
                })




                ->addColumn('created_at', function($category){
                    return date_formats('d-m-Y',$category->created_at);
                })
                ->rawColumns(['operation','status','image'])
                ->make(true);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        pageTitle('Category Create');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'category'=>route('app.categories.index'),'create'=>''];
        return view('backend.pages.category.create',['breadcrumb'=>$breadcrumb]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validation = $request->validate([
            'category_name'   => 'required',
            'image'           => 'required',
            'category_status' => 'required',
        ]);

        // image upload

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('backend/assets/img/category/',$imageName);
        }

        $category = Category::create([
            'name'   => $request->category_name,
            'slug'   => Str::slug($request->category_name),
            'image'  => $imageName,
            'status' => $request->category_status,
        ]);

        return back()->with('success','Category has been Saved');
    }



       /***
     * status
    */
    public function status(Request $request)
    {
        if($request->ajax()){

            $status = Category::find($request->row_id);
            $status->update([
                'status' => $request->status_id,
            ]);
            $output =['status'=>'success','message'=>'Category status update successfully'];
            return response()->json($output);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        pageTitle('Category Edit');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'category'=>route('app.categories.index'),'Edit'=>''];
        return view('backend.pages.category.edit', ['categories'=>$category,'breadcrumb'=>$breadcrumb]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'category_name'   => 'required',
            'image'           => 'image|mimes:jpg,jpeg,png',
            'category_status' => 'required',
        ]);


        // image upload
        $category = Category::findOrFail($id);

        if ($request->has('image')) {
            file_exists('backend/assets/img/category/'.$category->image) ? unlink('backend/assets/img/category/'.$category->image) : false;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('backend/assets/img/category/',$imageName);

        }else {
            $imageName = $category->image;
        }

        $category->update([
            'name'   => $request->category_name,
            'slug'   => Str::slug($request->category_name),
            'image'  => $imageName,
            'status' => $request->category_status,
        ]);

        return back()->with('success','category has been Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::find($request->row_id);
            unlink('backend/assets/img/category/'.$category->image);

            if ($category) {
                $category->delete();
                $output = ['status'=>'success', 'message'=>'category has been deleted successfully'];
            }else {
                $output = ['status'=>'error','message'=>'Something Wrong!'];

            }
            return response()->json($output);
        }
    }
}
