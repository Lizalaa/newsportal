<?php
namespace App\Http\Controllers\Admin;

use DB;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesAndPermissionsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all users
        $roles = Role::paginate(10);
        $title = "Roles";
        return view('admin.auth.list.roles', compact('roles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Roles";
        return view('admin.auth.form.role', compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the form
        $this->validate(request(), [

            'name' => 'required',
            'label' => 'required'

            ]);

        //create and save role
        $role = new Role;

        $role->name = request('name');
        $role->label = request('label');
        $role->save();

        return redirect('/admin/roles')->with('success','Role created successfully.');
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
    public function edit(Role $role)
    {
        return view('admin.auth.form.role', compact('role'));
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
        $role = Role::find($id);
        //validate the form
        $this->validate(request(), [

            'name' => 'required',
            'label' => 'required'

            ]);

        $data = ([
            'name' => request('name'),
            'label' => request('label'),

            ]);

        Role::where('id', $id)->update($data);

        return redirect('/admin/roles')->with('success','Role updates successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $role = Role::find($id);

        if(isset($role)) {

            $affected = Role::where('id', $id)->delete();

            if($affected > 0) {

                return redirect('/admin/roles')->with('success','Role deleted successfully.');

            }
            return redirect('/admin/roles')->with('error','Role could not be deleted.');

        } else {
            //redirect
            return redirect('/admin/roles')->with('error','Role could not be deleted.');
        }
    }

    public function assign(Role $role)
    {
        $permissions = Permission::get();
        $title = "Roles";
        $assigned = $role->permissions;

        return view('admin.auth.form.assign-permission', compact('role', 'permissions', 'assigned'));
    }

    public function assignPermissions(Request $request, $id)
    {

        //validate the form
        $this->validate(request(), [

            'permissions' => 'required'

            ]);

        $role = Role::findOrFail($id);

        //delete all existing permissions of this role
        DB::table('permission_role')->where('role_id', '=', $id)->delete();

        $permissions = request('permissions');

        //assign permissions to this role
        foreach ($permissions as $permission) {
            $p = Permission::whereName($permission)->first();
            $role->givePermissionTo($p);
        }

        return redirect('/admin/roles/assign/'.$id)->with('success','Permission assigned successfully.');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        //all users
        $title = "Roles";
        $permissions = Permission::paginate(10);
        return view('admin.auth.list.permissions', compact('permissions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPermission()
    {
        $title = "Roles";
        return view('admin.auth.form.permission', compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        //validate the form
        $this->validate(request(), [

            'name' => 'required',
            'label' => 'required'

            ]);

        //create and save language
        $permission = new Permission;

        $permission->name = request('name');
        $permission->label = request('label');
        $permission->save();

        return redirect('/admin/permissions')->with('success','Permission created successfully.');
    }

    /**
     * Show the form for editing the xattr_get(filename, name)specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPermission(Permission $permission)
    {
        $title = 'Roles';
        return view('admin.auth.form.permission', compact('permission',  'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        //validate the form
        $this->validate(request(), [

            'name' => 'required',
            'label' => 'required'

            ]);

        $data = ([
            'name' => request('name'),
            'label' => request('label'),

            ]);

        Permission::where('id', $id)->update($data);

        return redirect('/admin/permissions')->with('success','Permission updates successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPermission($id)
    {
        $permission = Permission::find($id);

        if(isset($permission)) {

            $affected = Permission::where('id', $id)->delete();

            if($affected > 0) {

                return redirect('/admin/permissions')->with('success','Permission deleted successfully.');

            }
            return redirect('/admin/permissions')->with('error','Permission could not be deleted.');

        } else {
            //redirect
            return redirect('/admin/permissions')->with('error','Permission could not be deleted.');
        }
    }
}
