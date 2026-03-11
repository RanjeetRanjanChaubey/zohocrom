<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Role;
use App\Models\AdminUsers;
use App\Models\AdminActivity;


class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->update($request->only('value'));

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully');
    }

    public function role()
    {
        $roles = Role::all();
        return view('admin.settings.role', compact('roles'));
    }

    //Genral Setting Start
    public function general()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.genral', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        try {
            $data = $request->except('_token');
            foreach ($data as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            AdminActivity::create([
                'admin_id' => Auth::guard('admin')->id(),
                'activity' => 'Settings Updated',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->back()->with('success', 'Settings updated successfully!');

        } catch (\Exception $e) {
            AdminActivity::create([
                'admin_id' => Auth::guard('admin')->id(),
                'activity' => 'Settings update failed: ' . $e->getMessage(),
                'ip_address' => $request->ip(),
            ]);
            return redirect()->back()->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }
    //Genral Setting End

    public function userlist ()
    {
        $users = AdminUsers::all();
         
        return view('admin.settings.userlist', compact('users'));
    }

}
