<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Auth\Events\Validated;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        pageTitle('Product List');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'), 'Product'=>''];

        return view('backend.pages.product.index', ['breadcrumb'=>$breadcrumb]);
    }



    /**
     * DataTables
     */

     public function getData(Request $request){
        if ($request->ajax()) {
            $getData = Product::latest('id');

            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('operation', function($product){
                    $operation = '
                        <a href="'.route('app.products.edit',$product->id).'" id="editBtn" class="btn-style btn-style-edit"> <i class="fa fa-edit"> </i></a>
                        <button class="btn-style btn-style-danger deleteBtn" data-id="'.$product->id.'"> <i class="fa fa-trash"></i> </button>
                    ';
                    return $operation;
                })

                ->addColumn('image', function($product) {
                    $image = '<img width="80px" height="80px" src="'. asset("backend/assets/img/product/$product->image").'" alt="">';
                    return $image;
                })

                ->addColumn('status', function($product){
                    $status ='';
                    if($product->status == 1){
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
                ->rawColumns(['operation','status','created_at','image'])
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
        $data = [
            'brands'=>Brand::latest('id')->where('status',1)->get(),
            'categories'=>Category::latest('id')->where('status',1)->get()
        ];



        $breadcrumb =['Dashboard'=> route('app.dashboard'),'Product'=>route('app.products.index'),'Create'=>''];
        pageTitle('Product Create');

        //return $data['categories'];
        return view('backend.pages.product.create',['data'=>$data, 'breadcrumb'=>$breadcrumb]);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'image'       => 'required',
            'details'     => 'required',
            'price'       => 'required',
            'author'      => 'required',
            'brand_id'    => 'required',
            'category_id' => 'required',
            'status'      => 'required',
        ]);

        $data = $request->except('_token','image_gallery');
        $data['slug']= Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $this->file_upload($request->file('image'), 'backend/assets/img/Product/');
        }
        $product=Product::create($data);

    return back()->with('success','Save Successfully');



        // $data = Product::create($data);
        // $gallery_count=count($request->image_gallery[]);

        // for($i=0; $i<$gallery_count; $i++){
        //     $gallery_data['galary_image'] =$request->image_gallery[$i];
        //     $gallery_data['product_id'] = $data->id;
        //     Gallery::create($gallery_data);

        // }



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
    public function edit($product_id)
    {
        $data = [
            'brands'=>Brand::latest('id')->where('status',1)->get(),
            'categories'=>Category::latest('id')->where('status',1)->get()
        ];

        $breadcrumb =['Dashboard'=>route('app.dashboard'),'Product'=>route('app.products.index'),'Edit'=>''];
        $product = Product::findOrFail($product_id);
        pageTitle('Product Edit');

        return view('backend.pages.product.edit',['data'=>$data,'product'=>$product,'breadcrumb'=>$breadcrumb]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$product_id)
    {

        $request->validate([
            'image'  => 'image|mimes:jpg,jpeg,png',
        ]);

        // $data = $request->except('_token');
        // $data['slug']= Str::slug($request->slug);

        // $product = Product::findOrFail($product_id);
        // if ($request->hasFile('image')) {
        //     $data['image'] = $this->file_update($request->file('image'),'backend/image/product/',$product->image);

        // }else {
        //     $product_image_name = $product->image;
        // }

        $product = Product::findOrFail($product_id);
         // image upload
         if ($request->has('image')) {
            file_exists('backend/assets/img/product/'.$product->image) ? unlink('backend/assets/img/product/'.$product->image) : false;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('backend/assets/img/product/',$imageName);
        }else{
            $imageName = $product->image;
        }


        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'image'       => $imageName,
            'details'     => $request->details,
            'price'       => $request->price,
            'author'      => $request->author,
            'brand_id'    => $request->brand_id,
            'category_id' => $request->category_id,
            'status'      => $request->status,
        ]);


        return back()->with('success','Brand has been Updated.');




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
            $product = Product::find($request->row_id);
            unlink('backend/assets/img/product/'.$product->image);

            if ($product) {
                $product->delete();
                $output = ['status'=>'success', 'message'=>'Product has been deleted successfully'];
            }else {
                $output = ['status'=>'error','message'=>'Something Wrong!'];

            }
            return response()->json($output);

        }

    }
}
