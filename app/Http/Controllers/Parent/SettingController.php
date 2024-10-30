<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDOException;

class SettingController extends Controller
{
    public function formSetting()
    {
        return view("parent.settings.form");
    }

    public function formSettingSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:admins,name,' . Auth::guard('parent')->user()->id,
            'email' => 'required|unique:admins,email,' . Auth::guard('parent')->user()->id,
        ]);

        $changed = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->passsword)
        {
            $changed['password'] = Hash::make($request->passwrod);
        }

        try{
            Admin::where('id',Auth::guard('parent')->user()->id)->update($changed);
            return redirect()->back()->with('Success','Update Done');
        }catch(PDOException $e){
            return redirect()->back()->with('Error',$e->getMessage());
        }
    }
}
