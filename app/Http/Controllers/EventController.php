<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Subject;
use App\Models\Guest;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    public function index(){
        return view('home', [
            "title"=>"Home",
            "tamu"=>Event::limit(6)->get(),
            "guru"=>Teacher::all(),
        ]);
    }
    public function dashboard(){

        return view('dashboard', [
            "title"=>"Dashboard",
            "tamu"=>Event::all(),
            "totalTamu"=>Event::all()->count(),
            // "currSearch"=>$request,
        ]);
    }
    public function kirimData(Request $request): RedirectResponse{
        $event = new Event;
        $event->teacher_id = $request->pic;
        $event->date = $request->date;
        $event->details = $request->detailKunjungan;
        $event->name = $request->name;
        $event->email = $request->email;
        $event->photo = $request->photo;
        $event->institution = $request->institution;
        $event->status = "bb";
        $event->save();

        return redirect('/');
        // dd($name);
    }
    public function delete($id){
        $user = Event::findOrFail($id);
    
        // Delete the user
        $user->delete();
    
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully!'
        ]);
    }
}
