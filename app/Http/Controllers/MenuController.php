<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(){
        $menulist = Menu::all();
        return view('menu.index', ['menulist' => $menulist]);
    }

    public function destroy(Menu $menu){
        $menu->delete();
        return redirect('/menu/index');
    }

    public function create(Request $req){
        $req->validate([
            'dining_package' => 'required',
            'items' => 'required',
            'description' => 'required',
        ]);
        $menu = new Menu;
        $menu->dining_package = $req->dining_package;
        $menu->items = $req->items;
        $menu->description = $req->description;
        $menu->save();

        return redirect('/menu/index');
    }

    public function showEdit($id){
        $menu = Menu::findOrFail($id);
        return view('menu.edit', ['menu'=>$menu]);
    }

    public function edit(Request $req){
        $req->validate([
            'dining_package' => 'required',
            'items' => 'required',
            'description' => 'required',
        ]);
        $menu = Menu::findOrFail($req->id);
        $menu->dining_package = $req->dining_package;
        $menu->items = $req->items;
        $menu->description = $req->description;
        $menu->save();

        return redirect('/menu/index');
    }

    public function getPackages(){
        $menulist = Menu::all();
        $dining_packages=[];
        foreach ($menulist as $menu) {
            array_push($dining_packages,$menu['dining_package']);
        }

        return $dining_packages;
    }

    public function getMenu(){
        $menulist = Menu::all();
        
        return $menulist;
    }
}
