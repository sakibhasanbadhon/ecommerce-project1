<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DataTables;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class RoleController extends Controller
{

    public function index()
    {
        // $role = Role::orderBy('id','desc')->get();
        // $role= Role::whereNotIn('slug', ['super-admin','client'])->get();
        // return view('backend.pages.role.index',['role'=>$role]);

        $role= Gate::authorize('app.dashboard'); //database a permission na thakle admin ke dashboard access korte dibe na.
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'Roles'=>''];
        pageTitle('Roles');
        return view('backend.pages.role.index',['role'=>$role,'breadcrumb'=>$breadcrumb]);

    }

    public function getData(Request $request){
        if ($request->ajax()) {
            $getData = Role::with('permissions')->whereNOtIn('slug',['client','super-admin'])->latest('id');

            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('operation', function($role){
                    $operation = '
                        <a href="'.route('app.roles.edit',$role->id).'" id="editBtn" class="btn-style btn-style-edit"> <i class="fa fa-edit"> </i></a>
                        <button class="btn-style btn-style-danger deleteBtn" data-id="'.$role->id.'"> <i class="fa fa-trash"></i> </button>
                    ';
                    return $operation;
                })
                ->addColumn('permission', function($role){
                    if ($role->permissions) {
                        $output = '';
                        $colors = ['primary', 'success', 'danger', 'warning', 'info', 'dark'];
                        $randomIndex = rand(0, count($colors) - 1);
                        $randomColor = $colors[$randomIndex];

                        foreach ($role->permissions as $key => $permission) {
                            $output .= '<span class="badge badge-'.$randomColor.'  mx-1">'.$permission->name.'</span>';
                        }
                    }

                    return $output;
                })
                ->addColumn('created_at', function($role){
                    return date_formats('d-m-Y',$role->created_at);
                })
                ->rawColumns(['operation','permission'])
                ->make(true);

        }
    }



    public function create()
    {
        $roleCreate= Gate::authorize('app.roles.create'); //database a permission na thakle admin ke dashboard access korte dibe na.
        $modules = Module::with('permissions')->get();
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'Roles'=>route('app.roles.index'),'Create'=>''];
        return view('backend.pages.role.create',['roleCreate'=>$roleCreate,'modules'=>$modules, 'breadcrumb'=>$breadcrumb]);
    }


    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->role,
            'slug' => Str::slug($request->role),
        ]);

        $role->permissions()->attach($request->permission);

        return back()->with('success','Role Has been saved.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $modules = Module::with('permissions')->get();
        $breadcrumb = ['Dashboard'=>route('app.dashboard'),'Roles'=>route('app.roles.index'),'Edit'=>''];
        pageTitle('Update Role');
        return view('backend.pages.role.edit',['role'=>$role,'modules'=>$modules,'breadcrumb'=>$breadcrumb]);
    }


    public function update(Request $request, $permission_id)
    {
        $role = Role::findOrFail($permission_id);
        $role->update([
            'name' => $request->role,
            'slug' => Str::slug($request->role),
        ]);

        $role->permissions()->sync($request->permission);
        return back();

    }


    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::find($request->row_id);
            if($role){
                $role->delete();
                $output = ['status'=>'success','message'=>'Role has been deleted successfully'];
            }else{
                $output = ['status'=>'error','message'=>'Something Wrong!'];
            }

            return response()->json($output);
        }
    }


}
