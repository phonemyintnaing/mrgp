<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::where('user_id', auth()->user()->id)->get();
        
        return view('patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $data = $this->validate($request, [
            'name'=>'required',
            'bio'=> 'required',
            'sex' => 'required',
            'phone' => 'required'
        ]);
       
        $patient->savePatient($data);
        return redirect('/home')->with('success', 'New Patient has been added! Wait sometime to get resolved');
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
    public function edit($id)
    {
        $patient = Patient::where('user_id', auth()->user()->id)
                        ->where('id', $id)
                        ->first();

        return view('patients.edit', compact('patient', 'id'));
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
        $patient = new Patient();
        $data = $this->validate($request, [
            'bio'=>'required',
            'name'=> 'required'
        ]);
        $data['id'] = $id;
        $patient->updatePatient($data);

        return redirect('/home')->with('success', 'New Patient has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();

        return redirect('/home')->with('success', 'Patient has been deleted!!');
    }
}

?>
