<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
     public function savePatient($data)
	{
        $this->user_id = auth()->user()->id;
        $this->name = $data['name'];
        $this->bio = $data['bio'];
        $this->sex = $data['sex'];
         $this->phone = $data['phone'];
        $this->save();
        return 1;
	}


	public function updatePatient($data)
	{
		file_put_contents('abc.log', 'here');
        $patient = $this->find($data['id']);
        $patient->user_id = auth()->user()->id;
        $patient->name = $data['name'];
        $patient->bio = $data['bio'];
        $patient->save();
        return 1;
	}
}
