<?php 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::where('user_id', auth()->user()->id)->get();
        
       return view('home',compact('patients'));
        //return view('home');
    }

    public function getUsage(){

      $filename = 'laravel.txt';

        if (file_exists($filename)) {
            dd "The file $filename exists";
      //  
            $random = $this->getMAC();
            $appTitle = '$5$rounds=786$MR.GP$';
            $random = crypt($random,  $appTitle);
            $random = $appTitle;
            //echo "The file $filename does not exist";
            file_put_contents("laravel.txt", $random);
           $randompair = file_get_contents("laravel.txt");
           //if ($randompair != $random)
           //   die();
      } else {
      	dd('file');
            file_put_contents("laravel.txt", '');

        }
    file_put_contents("mrgp.log", 'Using'.'-'.date('Y-m-d H:i:s')."\n", FILE_APPEND);

       
    }

    public function getMAC(){
      ob_start();
      system('getmac');
      $Content = ob_get_contents();
       ob_clean();
       return substr($Content, strpos($Content,'\\')-20, 17);
    }

}
?>