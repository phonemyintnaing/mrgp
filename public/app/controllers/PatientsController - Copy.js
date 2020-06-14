app.controller('AdminController', function($scope,$http){
  $scope.pools = [];
});
app.controller('PatientsController', function(dataFactory,$scope,$http, $location, $route){
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalpatientsTemp = {};
  $scope.totalpatients = 0;
  $scope.form = {};


$scope.bloodtype = ['O', 'A', 'B', 'AB'];
//$scope.form.blood = 'O';
//console.log ($scope.bloodtype);
$scope.marital = ['Single', 'Married'];
$scope.sex = ['Male', 'Female'];
  
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };
  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest('/mrgp/public/patients?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalpatients = data.total;
             console.log ('ser data',$scope.data);
          });
      }else{
        dataFactory.httpRequest('/mrgp/public/patients?page='+pageNumber).then(function(data) {
          $scope.data = data.data;
          $scope.totalItems = data.total;
          // $scope.data.age = getAge($scope.data.dob);
            console.log ('elsedata',$scope.data);
        });
      }

         //  $scope.data.age = getAge($scope.data.dob);
           
  }



  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalpatientsTemp = $scope.totalpatients;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalpatients = $scope.totalpatientsTemp;
              $scope.libraryTemp = {};
          }
      }
  }
  $scope.saveAdd = function(){
  //  dataFactory.httpRequest('patients','POST',{},$scope.form).then(function(data) {
    if ($scope.form.dob != null)
       $scope.form.dob = dateToYMD($scope.form.dob);
     console.log ('save form', $scope.form);
   // return;
      dataFactory.httpRequest('/mrgp/public/create/patients','POST',{},$scope.form).then(function(data) {

        console.log ('save err', data);
        if (data == '1'){
          alert ('This Phone No. is Already Registered! , Please use different Phone No.');
          return;
        }


      //$scope.data.push(data);
     // data.age = getAge(data.dob);
      console.log (data);
      $route.reload();

      $(".modal").modal("hide");
    });



  }
  $scope.edit = function(id){
   // dataFactory.httpRequest('patients/'+id+'/edit').then(function(data) {
     dataFactory.httpRequest('/mrgp/public/edit/patients/'+id).then(function(data) {
      data.dob = new Date(data.dob);
    	console.log(data);
      if(data.imageLink != null) {
       data.imageLink = data.imageLink.split('public').pop();
     }
      	$scope.form = data;

    });
  }

  $scope.history = function(id){
   // dataFactory.httpRequest('patients/'+id+'/edit').then(function(data) {
     dataFactory.httpRequest('/mrgp/public/edit/patients/'+id).then(function(data) {
   
      console.log('history', data);
      data.age = $scope.getAge(data.dob);
      dataH = data.id+'-'+data.name+'-'+data.age+'-'+data.gender+'-'+data.blood;
      $location.path('/history/'+dataH);
      $scope.form = data;
    });
  }
  $scope.saveEdit = function(){
   // dataFactory.httpRequest('patients/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
    $scope.form.dob = dateToYMD($scope.form.dob);
    console.log ('form', $scope.form);
      dataFactory.httpRequest('/mrgp/public/patients/edit','POST',{},$scope.form).then(function(data) {

      	$(".modal").modal("hide");
        console.log ('data', data);
        $scope.data = apiModifyTable($scope.data,data.id,data);
    });
  }
  $scope.remove = function(patient,index){
    var result = confirm("Are you sure delete this patient?");
   	if (result) {
     // dataFactory.httpRequest('patients/'+patient.id,'DELETE').then(function(data) {
      dataFactory.httpRequest('/mrgp/public/patients/delete','POST',{},patient).then(function(data) {

          $scope.data.splice(index,1);
      });
    }
  }

// Its been months, lets try upload image files and finish this shit


    $scope.uploadImage = function(files) {
      var formData = new FormData();
      formData.append("file", files[0]);
      //$scope.showLoader = true;
      
     // console.log (files[0]);

     // $scope.form.pimage = files[0];

     // console.log ($scope.form);


      
      
     response = $http.post('/mrgp/public/upload/image', formData, {
        headers: {'Content-Type': undefined },
        transformRequest: angular.identity
      }).success(function(data) {
        if(data.success){
          $scope.showLoader = false;
        } 
          //console.log('reply link', data);
          //var imageData= JSON.parse(data);
          //console.log ('jsonparse',data.original.imageLink);

          $scope.form.imageLink = data.original.imageLink;
          $scope.form.imageLink =   $scope.form.imageLink.split('public').pop();
          console.log('image_source',$scope.form.imageLink);


      });

  /*  dataFactory.httpRequest('/mrgp/public/upload/image','POST',{},$scope.form).then(function(data) {

      //$scope.data.push(data);
      //$route.reload();

      $(".modal").modal("hide");


    }); */

    }

    //Date to YMd
    function dateToYMD(date) {
      var d = date.getDate();
      var m = date.getMonth() + 1; //Month from 0 to 11
      var y = date.getFullYear();
      return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);      
    }



$scope.getAge = function(birthday){
 // console.log ('in', birthday);
     if ( birthday == null)
      return null;
    var birthday = birthday;
    var birthday = new Date(birthday);
    var today = new Date();
    var age = ((today - birthday) / (31557600000));
    var age = Math.floor( age );

   // console.log('this age', age);
    return age;
  }








});
