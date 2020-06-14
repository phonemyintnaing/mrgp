<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patients;
use App\History;
use App\Services\Createfile;
use Illuminate\Auth\Middleware\Authenticate;
class PatientsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

    }
    

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $patients = Patients::where("name", "LIKE", "%{$request->get('search')}%")->where('user_id', auth()->user()->id)->paginate(5);      
        }else{
		// $patients = Patients::paginate(5);         
        // var_dump(auth()->user()->id);
         $patients = Patients::orderBy('name', 'ASC')->where('user_id', auth()->user()->id)->paginate(5);
        }
        return response($patients);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
       // var_dump('store',$input);
       // var_dump($input['user_id']);
       //return response($request);
        try {
         $create = Patients::create($input);
         }catch(\Exception $e){
    //Do something when query fails. 
          $input['fail'] = '1';
          $create =  $input['fail'];
         
        }
        return response($create);
    }
    public function edit($id)
    {
        $item = Patients::find($id);
        return response($item);
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        //var_dump($input['id']);
        // return response($request);
         try {
              Patients::where("id",$id)->update($input);
              $item = Patients::find($id);
        }catch(\Exception $e){
    //Do something when query fails. 
          $input['fail'] = '1';
          $item =  $input['fail'];
         
        }
        return response($item);
    }
    public function destroy($id)
    {
        return Patients::where('id',$id)->delete();
    }
    public function delete(Request $request)

    {
        echo 'in';
        $input = $request->all();
        $id = $input['id'];
       // var_dump($input['id']);
        // return response($input);
        return Patients::where('id',$id)->delete();
    }


     public function history($id)
    {
       //  $patients = Patients::where('user_id', auth()->user()->id)->paginate(5);
      //  $item = Patients::find($id);
       // echo 'in';
        $item = History::where('patient_id', $id)->paginate(5);
        return response($item);
    }

//History
     public function histories(Request $request)
    {
        $input = $request->all();
         //var_dump($input['id']);
         $thisHis = $input['id'];

        if($request->get('search')){
            $patients = History::where("name", "LIKE", "%{$request->get('search')}%")->where('user_id', auth()->user()->id)->paginate(5);      
        }else{
        // $patients = Patients::paginate(5);         
        // var_dump(auth()->user()->id);
         $patients = History::orderBy('created_at', 'DESC')->where('patient_id', $thisHis)->paginate(5);
        }
        return response($patients);
    }

     public function makehistory(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
      // var_dump($input);
      //  return response($request);
        $create = History::create($input);
        return response($create);
    }

    public function edithistory($id)
    {
        $item = History::find($id);
        return response($item);
    }

    public function updatehistory(Request $request)
    {
        $input = $request->all();
        $id = $input['id'];
        //var_dump($input['id']);
        // return response($request);
        History::where("id",$id)->update($input);
        $item = History::find($id);
        return response($item);
    }

     public function records(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $patients = History::where("patients.name", "LIKE", "%{$request->get('search')}%")->join('patients', function($join){ $join->on('histories.user_id', '=', 'patients.user_id')->on('histories.patient_id' , '=', 'patients.id');})->select('histories.id as hid','histories.*', 'patients.*')->where('histories.user_id', auth()->user()->id)->paginate(5);      
        }else{
        // $patients = Patients::paginate(5);         
        // var_dump(auth()->user()->id);
         $patients = History::orderBy('histories.id', 'DSC')->where('histories.user_id', auth()->user()->id)->leftJoin('patients', function($join){ $join->on('histories.user_id', '=', 'patients.user_id')->on('histories.patient_id' , '=', 'patients.id');})->select('histories.id as hid','histories.*', 'patients.*')->where('histories.user_id', auth()->user()->id)->paginate(5);
        }
        return response($patients);
    }

     public function callbill(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        $startDate =  $input['startDate'];
        $endDate = $input['endDate'];
        $user_id = $input['user_id'];
        $pageNumber = $input['pageNumber'];

        $sum = History::where('user_id', $user_id)->whereBetween('created_at', [$startDate, $endDate])->sum('bill');
        
        $details = History::where('histories.user_id', $user_id)->whereBetween('histories.created_at', [$startDate, $endDate])->join('patients', function($join){ $join->on('histories.user_id', '=', 'patients.user_id')->on('histories.patient_id' , '=', 'patients.id');})->paginate(5, ['*'], 'page', $pageNumber);

        $all = History::where('histories.user_id', $user_id)->whereBetween('histories.created_at', [$startDate, $endDate])->join('patients', function($join){ $join->on('histories.user_id', '=', 'patients.user_id')->on('histories.patient_id' , '=', 'patients.id');})->get();



       // var_dump($input);
        $input['sum'] = $sum;
        $input['details'] = $details;
        $input['all'] = $all;
       // var_dump($sum);
      //  return response($request);
        return response($input);
    }


    //profile shit
        public function uploadImage(Request $request){
           // echo 'in';

            $input = $request->all();

            //var_dump('input', $input);

            $file = $input['file'];

           // var_dump($file);
            $helpClass = new Createfile();

            $reply = $helpClass->uploadImage($file) ;
            $reply = json_encode($reply);
           //var_dump('svr reply', $reply);

        return response($reply);
     }

        public function uploadXray(Request $request){
           // echo 'in';

            $input = $request->all();

            //var_dump('input', $input);

            $file = $input['file'];

           // var_dump($file);
            $helpClass = new Createfile();

            $reply = $helpClass->uploadXray($file) ;
            $reply = json_encode($reply);
           //var_dump('svr reply', $reply);

        return response($reply);
     }

    public function uploadMRI(Request $request){
           // echo 'in';

            $input = $request->all();

            //var_dump('input', $input);

            $file = $input['file'];

           // var_dump($file);
            $helpClass = new Createfile();

            $reply = $helpClass->uploadMRI($file) ;
            $reply = json_encode($reply);
           //var_dump('svr reply', $reply);

        return response($reply);
     }

    public function uploadCT(Request $request){
           // echo 'in';

            $input = $request->all();

            //var_dump('input', $input);

            $file = $input['file'];

           // var_dump($file);
            $helpClass = new Createfile();

            $reply = $helpClass->uploadCT($file) ;
            $reply = json_encode($reply);
           //var_dump('svr reply', $reply);

        return response($reply);
     }

        public function uploadUS(Request $request){
           // echo 'in';

            $input = $request->all();

            //var_dump('input', $input);

            $file = $input['file'];

           // var_dump($file);
            $helpClass = new Createfile();

            $reply = $helpClass->uploadUS($file) ;
            $reply = json_encode($reply);
           //var_dump('svr reply', $reply);

        return response($reply);
     }




}
?>