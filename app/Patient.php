<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //
     public $fillable = ['name','phone', 'gender', 'marriage', 'blood', 'address', 'user_id', 'bio', 'imageLink', 'nid', 'dob', 'Dad', 'Mom', 'biosocial'];
}

?>