<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Bookingtable;
use Illuminate\Support\Facades\Auth;

class BookingtableController extends Controller
{
    public function index(){
        $bookingtables = Bookingtable::all();
        return view('bookingtable.index', ['bookingtables' => $bookingtables]);
    }

    public function destroy(Bookingtable $bookingtable){
        $bookingtable->delete();
        return redirect('/bookingtables/index');
    }

    public function create(Request $req){
        $req->validate([
            'table_number' => 'required',
            'seats' => 'required | integer | between:1,8',
        ]);
        $bookingtable = new Bookingtable;
        $bookingtable->booking_id = $req->booking_id;
        $bookingtable->table_number = $req->table_number;
        $bookingtable->seats = $req->seats;
        $bookingtable->save();

        return redirect('/bookingtables/index');
    }

    public function showEdit($id){
        $bookingtable = Bookingtable::findOrFail($id);
        return view('bookingtable.edit', ['bookingtable'=>$bookingtable]);
    }

    public function edit(Request $req){
        $req->validate([
            'table_number' => 'required',
            'seats' => 'required | integer | between:1,8',
        ]);
        $bookingtable = Bookingtable::findOrFail($req->id);
        $bookingtable->table_number = $req->table_number;
        $bookingtable->seats = $req->seats;
        $bookingtable->save();

        return redirect('/bookingtables/index');
    }
}
