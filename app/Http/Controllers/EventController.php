<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Subject;
use App\Models\Guest;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(){
        $eventRecordsLimit = Event::limit(6)->get();
        $teacherRecords = Teacher::all();
        return view('home', [
            "title"=>"Home",
            "events"=>$eventRecordsLimit,
            "teachers"=>$teacherRecords,
        ]);
    }
    public function dashboard(){
        $eventRecords = Event::all();
        $teacherRecords = Teacher::all();
        return view('dashboard', [
            "title"=>"Dashboard",
            "events"=>$eventRecords,
            "teachers"=>$teacherRecords,
            // "currSearch"=>$request,
        ]);
    }
    public function kirimData(Request $request):RedirectResponse{
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // validating image
            'institution' => 'required|string|max:255',
            'date' => 'required|date',
            'details' => 'required|string',
        ]);

        // Check if the photo is uploaded
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null; // if no photo, set it to null
        }

        Event::create([
            'teacher_id' => $validatedData['teacher_id'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'photo' => $photoPath, // save the path of the image
            'institution' => $validatedData['institution'],
            'date' => $validatedData['date'],
            'details' => $validatedData['details'],
            'status' => 'bb',
        ]);
        return redirect('/');
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
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'institution' => 'required|string|max:255',
            'date' => 'required|date',
            'details' => 'required|string',
            'status' => 'required|in:bb,sb',
        ]);

        // Find the record by ID
        $record = Event::findOrFail($id);

        // Handle the image upload if there's a new photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($record->photo) {
                Storage::disk('public')->delete($record->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = $record->photo; // Keep the old photo if no new one is uploaded
        }

        // Update the record with the validated data
        $record->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'photo' => $photoPath,
            'institution' => $validatedData['institution'],
            'date' => $validatedData['date'],
            'details' => $validatedData['details'],
            'status' => $validatedData['status'],
        ]);

        return response()->json(['success' => 'Record updated successfully!']);
    }
}
