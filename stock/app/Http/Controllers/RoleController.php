<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
{
    public function index()
    {
        $data['roles']=DB::table('roles')
            ->where('active',1)
            ->orderBy('id','desc')
            ->paginate(config('app.row'));
        return view('roles.index',$data);
    }
    public function create()

    {
        return view('roles.create');
    }

    public function save(Request $r)
    {
            $validate=$r->validate(
                [
                    'name'=> 'required|min:3|max:200'
                   
                ]
                );
            $data = array(
                'name'=>$r->name
             
            );
          
            $i =DB::table('roles')->insert($data);
            if($i)
            {
                $r->session()->flash('success','Data has been saved!');
                return redirect('role/create');
            }
            else{
                $r->session()->flash('error','Fail to saved data!');
                return redirect('role/create')->withInpt();

            }
    }
    public function edit($id){
        $data['role']=DB::table('roles')
            ->where('id',$id)
            ->first();
        return view('roles.edit',$data);
    }
    public function update(Request $r)
    {
            $validate=$r->validate(
                [
                    'name'=> 'required|min:3|max:200'
                   
                ]
                );
            $data = array(
                'name'=>$r->name
             
            );
          
            $i =DB::table('roles')
                ->where('id',$r->id)
                ->update($data);
            if($i)
            {
                $r->session()->flash('success','Data has been saved!');
                return redirect('role/edit/'.$r->id);
            }
            else{
                $r->session()->flash('error','Fail to saved data!');
                return redirect('role/edit/'.$r->id);

            }
    }

    public function delete($id,Request $r)
    {
        DB::table('roles')
            ->where('id',$id)
            ->update(['active'=>0]);
        $r->session()->flash('success','Data has been removed!');
        return redirect('role');
    }

}
