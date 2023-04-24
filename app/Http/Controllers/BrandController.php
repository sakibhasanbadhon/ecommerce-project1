<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        pageTitle('Brand List');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'Brands'=>''];
        return view('backend.pages.brand.index',['breadcrumb'=>$breadcrumb]);
    }



    /**
     * DataTables
     */

     public function getData(Request $request){
        if ($request->ajax()) {
            $getData = Brand::orderBy('id','desc');

            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('operation', function($brands){
                    $operation = '
                        <a href="'.route('app.brands.edit',$brands->id).'" id="editBtn" class="btn-style btn-style-edit"> <i class="fa fa-edit"> </i></a>
                        <button class="btn-style btn-style-danger deleteBtn" data-id="'.$brands->id.'"> <i class="fa fa-trash"></i> </button>
                    ';
                    return $operation;
                })

                ->addColumn('status', function($brands){
                    $status ='';
                    if($brands->status == 1){
                        $status .= '<span class="badge rounded-pill bg-success">Active</span>';
                    }
                    else{
                        $status .= '<span class="badge rounded-pill bg-danger">Pending</span>';
                    }
                    return $status;
                })




                ->addColumn('created_at', function($brands){
                    return date_formats('d-m-Y',$brands->created_at);
                })
                ->rawColumns(['operation','status'])
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
        pageTitle('Brand List');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'Brands'=>route('app.brands.create'),'create'=>''];
        return view('backend.pages.brand.create',['breadcrumb'=>$breadcrumb]);
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
            'brand_name'   => 'required',
            'image'        => 'required',
            'brand_status' => 'required',
        ]);

        // image upload

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('backend/assets/img/brand/',$imageName);
        }

        $brands = Brand::create([
            'name'   => $request->brand_name,
            'slug'   => Str::slug($request->brand_name),
            'image'  => $imageName,
            'status' => $request->brand_status,
        ]);

        return back()->with('success','Brand has been Saved');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
