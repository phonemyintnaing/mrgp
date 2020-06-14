<?php

namespace App\Providers;


class AuthenticationProvider
{

 public static function getUsage(){

      // $filename = 'mrgp.txt';

        // if (file_exists($filename)) {
        //    // echo "The file $filename exists";
        //     //$random = $this->getMAC(); 
        //     //$random = Str::uuid();
        //     $user = get_current_user();
        //     try{
        //         $command="echo | wmic.exe path win32_computersystemproduct get uuid";
        //         $random=shell_exec($command);
        //     } catch (Exception $e) {
        //         echo "Thanks for using our Product.But This Computer doesnt have uid to function the software.";
        //        // exit(0);
        //     }
        //     $random =  AuthenticationProvider::getMAC();
        //     $random = preg_replace('/\s+/', '', $random);
        //    // $random = $random.'-'.$user;
        //     $random = AuthenticationProvider::getRMC($random);
        //     $randompair = file_get_contents("mrgp.txt");
        //    if ($randompair != $random){
        //     // die();
        //     echo "Thanks for your Interest in our Product.Please Register at 'Init Myanmar Softwar Co Ltd' to Get a License."."\n"."Unauthorized use/distribution of Software is a serious crime/felony charges according to Intellectual Property Right Law of Myanmar.";
        //         exit(0);
         
        //    }
        // } else {
        //     echo "Thanks for your Interest in our Product for the first time.Please Register at 'Init Myanmar Softwar Co Ltd' to Get a License."."\n"."Unauthorized use/distribution of Software is a serious crime/felony charges according to Intellectual Property Right Law of Myanmar.";               
        //     file_put_contents("mrgp.txt", '');
        //      exit(0);

        // }
    file_put_contents("mrgp.log", 'Using'.'-'.date('Y-m-d H:i:s')."\n", FILE_APPEND);

       
    }

    public static function getMAC(){
      // ob_start();
      // system('getmac');
      // $Content = ob_get_contents();
      //  ob_clean();
      //  return substr($Content, strpos($Content,'\\')-20, 17);

    	if(strtoupper(PHP_OS) == strtoupper("LINUX"))
{
 $ds=shell_exec('udevadm info --query=all --name=/dev/sda | grep ID_SERIAL_SHORT');
 $serialx = explode("=", $ds);
 $serial = $serialx[1];
}
else
{
 function GetVolumeLabel($drive) {
 if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
 $volname = ' ('.$m[1].')'; } else { $volname = ''; }
 return $volname;
 }
 $serial = str_replace("(","",str_replace(")","",GetVolumeLabel("c")));
}
return $serial;
    }

    public static function enC($str, $offset) {
        $encrypted_text = "";
        $offset = $offset % 26;
        if($offset < 0) {
            $offset += 26;
        }
        $i = 0;
        while($i < strlen($str)) {
            $c = strtoupper($str{$i}); 
            if(($c >= "A") && ($c <= 'Z')) {
                if((ord($c) + $offset) > ord("Z")) {
                    $encrypted_text .= chr(ord($c) + $offset - 26);
            } else {
                $encrypted_text .= chr(ord($c) + $offset);
            }
          } else {
              $encrypted_text .= " ";
          }
          $i++;
        }
        return $encrypted_text;
    }

    public static function getRMC($rmc){
            $random = $rmc;
             $appTitle = 'MR.GP';
            //$random = crypt($random,  $appTitle);
            //$random = hash_hmac('sha256', $random, $appTitle);
            $random = str_replace('-','', $random);
            $words = preg_replace('/[0-9]+/', '', $random);
            $numbeR = array_sum(str_split($random));

            $number = preg_replace('/[^0-9]/', '', $random);
            if ($number)
                $number = $number * 8 + $numbeR;

            $offset = 19;
            $words = AuthenticationProvider::enC($words, $offset);            
            $ram = '$5$rounds=9292$'.$appTitle.'$VJs0yjt33LptBC66tHL'.$words.'QuJ7me3ujyzGRA'.$number.'iSZTJzMj3';
            return $ram;
    }



}
?>