app.controller('AdminController', function($scope,$http){
  $scope.pools = [];
});
app.controller('ClintonController', function(dataFactory,$scope,$http, $location, $route){
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalpatientsTemp = {};
  $scope.totalpatients = 0;
  $scope.form ={};


$scope.bloodtype = ['O', 'A', 'B', 'AB'];
//$scope.form.blood = 'O';
console.log ($scope.bloodtype);
$scope.marital = ['Single', 'Married'];
$scope.sex = ['Male', 'Female'];

$scope.showTable = false;


//date check
 $scope.checkErr = function(startDate,endDate) {
  console.log ('chekc err');
        $scope.errMessage = '';
        var curDate = new Date();
        
        if(new Date(startDate) > new Date(endDate)){
          $scope.errMessage = '   Warning:End Date should be greater than start date !';
          return false;
        }
        /*
        if(new Date(startDate) < curDate){
           $scope.errMessage = 'Start date should not be before today.';
           return false;
        }
        */
    };

    $scope.callBill = function(){
     // console.log ('callBill', $scope.startDate, $scope.endDate);
      console.log ($scope.startDate, $scope.endDate);
        if($scope.startDate == null || $scope.endDate == null){
          $scope.errMessage = 'Please fill up correct date';
          return false;
        }

        if($scope.startDate > $scope.endDate){
          $scope.errMessage = '   Warning:End Date should be greater than start date !';
          return false;
        }

        $scope.form.startDate = dateToYMD($scope.startDate);
        $scope.form.endDate = dateToYMD($scope.endDate);
        $scope.form.pageNumber = 1;

        console.log ('form', $scope.form);
        
      dataFactory.httpRequest('/call/bill','POST',{},$scope.form).then(function(data) {

       // $(".modal").modal("hide");
        console.log ('orgdata', data);
       // $scope.data = apiModifyTable($scope.data,data.id,data);
       $scope.message = 'Total bill Between ' + data.startDate + '  and  ' + data.endDate + '  is ' + data.sum + ' Kyats. ';
      

        $scope.data = data.details.data;
        $scope.totalItems = data.details.total;
        $scope.showTable = true;
        $scope.allBill = data.all;


      });

    }

    function dateToYMD(date) {
      var d = date.getDate();
      var m = date.getMonth() + 1; //Month from 0 to 11
      var y = date.getFullYear();
      return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);      
    }



    $scope.testprintDiv = function(divName) {

      console.log ('printDiv');

      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;
    }

    $scope.printDivs = function(divName,loclist) {
      console.log(divName)
      console.log(loclist);

     // loclist.finalarr = loclist[loclist.length-1];
     // console.log(loclist.finalarr);
      console.log ('data', $scope.data);
      localStorage.setItem('itemKey', JSON.stringify(loclist.finalarr));
      popupWin = window.open('', '_blank');
      popupWin.document.open();
      //popupWin.document.write('<html ng-app="main-App"><head>Bill</head> <body onload="window.print();window.close()">  <table class="table table-striped responsive-utilities jambo_table bulk_action" style="font-size:10px;"><thead><tr class="headings">   <th>S.No</th><th>Tool</th></tr></thead>     <tbody>   <tr class="even pointer" ng-repeat="data in loclist">     <td>{{id}}</td><td>{{data.bill}}</td></tr>    </tbody> </table> </body></html>');
      popupWin.document.write('<html ng-app="main-App"><head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="fonts/css/font-awesome.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"><script src="script/lib/jquery-2.2.0.min.js"></script> <script src="js/angular-1.3.2/angular.min.js"></script><script src="script/lib/ngStorage.min.js"></script></head><body onload="window.print();window.close()" ><table class="table table-striped responsive-utilities jambo_table bulk_action" style="font-size:10px;"><thead><tr class="headings"> <th>S.No</th><th>Tool</th><th>Action Done</th><th>User</th><th>Assigned To</th><th>FollowUp Date</th><th>Contact Name</th><th>Company Name</th><th>Phone</th><th>City</th><th>Product</th><th>Dealing Product</th><th>Result</th><th>Action to be done</th><th>Next FollowUp</th></tr></thead><tbody><tr class="even pointer" ng-repeat="data in loclist"><td>{{$index+1}}</td><td>{{data.bill}}</td><td>{{data.followups.actiondone}}</td><td>{{data.empid}}</td><td>{{data.followups.assignedto}}</td><td>{{data.followups.followup| date: "dd MMM yyyy"}}</td><td>{{data.name}}</td><td>{{data.firmname}}</td><td>{{data.contact}}</td><td><span ng-if="data.city">{{data.city}}<span><span ng-if="!data.city">-<span></td><td>{{data.product}}</td><td>{{data.dproduct}}</td><td>{{data.followups.result}}</td><td>{{data.followups.nextaction}}</td><td>{{data.followups.nextfollowup | date: "dd MMM yyyy"}}</td></tr></tbody></table><script>var app=angular.module("dumb", ["ngStorage"]).controller("dumbconr",function($scope, $localStorage, $rootScope){ $rootScope.lli=JSON.parse(localStorage.getItem("itemKey"));})</script></body></html>');

      popupWin.document.close();
    }
 $scope.printDiv = function() {
        console.log ('data', $scope.allBill);

      popupWin = window.open('', '_blank');
      popupWin.document.open();
      popupWin.document.write('<html ng-app="main-App"><head><link href="css/bootstrap.min.css" rel="stylesheet"><script src="js/angular-1.3.2/jquery-2.1.0.min.js"></script> <script src="js/angular-1.3.2/angular.min.js"></script><script src="script/lib/ngStorage.min.js"></script></head><body onload="window.print();window.close()" ><table class="table table-striped responsive-utilities jambo_table bulk_action" style="font-size:10px;"><thead><tr class="headings"> <th>Patient Name</th><th>Patient ID</th><th>Complaint</th><th>Treatment Plan</th><th>Bill</th></tr></thead>');
      popupWin.document.write('<tbody><tr class="even pointer">');

  //popupWin.document.write('<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td> </tr>');

     //Lets loop
      for (var i = 0; i < $scope.allBill.length; i++) {
         popupWin.document.write('<tr><td>');
         popupWin.document.write($scope.allBill[i].name); 
         popupWin.document.write('</td><td>');
        popupWin.document.write($scope.allBill[i].patient_id); 
         popupWin.document.write('</td><td>');
        popupWin.document.write($scope.allBill[i].complaint); 
         popupWin.document.write('</td><td>');
        popupWin.document.write($scope.allBill[i].treatplan); 
         popupWin.document.write('</td><td>');
        popupWin.document.write($scope.allBill[i].bill); 
        popupWin.document.write('</td> </tr>');

      }

     popupWin.document.write('<tr>' + $scope.message + '</tr>');

     popupWin.document.write('</tbody></table></body></html>'); 

     popupWin.document.close();
 }

   $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
    };
    //getResultsPage(1);
    function getResultsPage(pageNumber) {
      $scope.form.pageNumber = pageNumber;
      console.log ('pageNumber', pageNumber);
      $scope.form.pageNumber = pageNumber;
      console.log ('form page', $scope.form);
      dataFactory.httpRequest('/call/bill','POST',{},$scope.form).then(function(data) {
      //  dataFactory.httpRequest('/mrgp/public/call/billpage?page='+pageNumber).then(function(data) {

       // $(".modal").modal("hide");
        console.log ('orgdatabill', data);
       // $scope.data = apiModifyTable($scope.data,data.id,data);
      // $scope.message = 'Total bill Between ' + data.startDate + '  and  ' + data.endDate + '  is ' + data.sum + ' Kyats. ';
      

        $scope.data = data.details.data;
       // $scope.totalItems = data.details.total;
        $scope.showTable = true;
       // $scope.allBill = data.all;


      });
    }



});