<?php

namespace App\Http\Controllers\Api;

//import Model "Attendance"
use App\Models\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "AttendanceResource"
use App\Http\Resources\AttendanceResource;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{

    public function show($id)
    {
        return new AttendanceResource(Attendance::findOrFail($id));
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all attendances
        $attendances = Attendance::latest()->paginate(5);

        //return collection of attendances as a resource
        return new AttendanceResource(true, 'List Data Attendances', $attendances);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'token' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $token = $request->input('token');

        if ($token != 'aQgcMrG1WBW4YjFkBW') {
            return response()->json(['message' => 'Server down'], 400);
        }

        // Check if a file was uploaded
        if ($request->hasFile('photo')) {
          // Store the file and get its path
          $path = $request->file('photo')->store('images', 'public');

          // Add the path to the request data
          $requestData['photo'] = $path;
        }

        $attendance = Attendance::create($requestData);

        //return response
        return new AttendanceResource($attendance);
    }
}