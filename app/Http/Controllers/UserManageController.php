<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use DataTables;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role= Gate::authorize('app.dashboard');
        $user = User::with('role')->whereNotIn('role_id',[1,3])->get();
        pageTitle('User List');
        $breadcrumb = ['Dashboard'=>route('app.dashboard'), 'User'=>''];
        return view('backend.pages.user.index',['users'=>$user,'breadcrumb'=>$breadcrumb]);
    }


    /**
     * DataTables
     */

     public function getData(Request $request){
        if ($request->ajax()) {
            $getData = User::with('role')->whereNOtIn('role_id',[1,3])->latest('id');

            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('operation', function($user){
                    $operation = '
                        <a href="'.route('app.users.edit',$user->id).'" id="editBtn" class="btn-style btn-style-edit"> <i class="fa fa-edit"> </i></a>
                        <button class="btn-style btn-style-danger deleteBtn" data-id="'.$user->id.'"> <i class="fa fa-trash"></i> </button>
                    ';
                    return $operation;
                })
                ->addColumn('role', function($user){
                    return $user->role ? $user->role->name : 'N/A';
                })



                ->addColumn('created_at', function($user){
                    return date_formats('d-m-Y',$user->created_at);
                })
                ->rawColumns(['operation'])
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
        $role_id = Role::whereNotIn('id',[1,3])->get();
        return view('backend.pages.user.create',['roles'=>$role_id]);
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
            'role_id'    => 'required',
            'first_name' => 'required|',
            'last_name'  => 'required',
            'email'      => 'required|email|max:50|nullable',
            'password'   => 'required|min:6|max:20|confirmed',
            'phone'      => 'required',

        ]);


        $role = User::create([
            'role_id'    => $request->role_id,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => $request->password,
            'password'   => Hash::make($request->password),
            'phone'      => $request->phone
        ]);


        return back()->with('success','Brand Has been saved.');



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
        $users = User::findOrFail($id);
        // $hash = Hash::make($users->password);
        // return $hash;
        $role_id = Role::whereNotIn('id',[1,3])->get();
        // $role_id = Role::latest('id')->where('id',$id)->get();

        $modules = Module::with('permissions')->get();
        $breadcrumb = ['Dashboard'=> route('app.dashboard'), 'Users'=>route('app.users.index'), 'Edit'=>''];
        return view('backend.pages.user.edit', ['users'=>$users, 'roles'=>$role_id, 'modules'=>$modules, 'breadcrumb'=>$breadcrumb]);
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
    public function destroy(Request $request)
    {
        //return $request;

        if ($request->ajax()) {
            $user = User::find($request->row_id);
            if($user){
                $user->delete();
                $output = ['status'=>'success','message'=>'Role has been deleted successfully'];
            }else{
                $output = ['status'=>'error','message'=>'Something Wrong!'];
            }

            return response()->json($output);
        }
    }
}
