app.controller('AdminController', function($scope,$http){
  $scope.pools = [];
});
app.controller('HistoriesController', function(dataFactory,$scope,$http,$routeParams, $route){



console.log ('routepa', $routeParams);
 $scope.hid = $routeParams.hid.split('-');

 console.log ('split', $scope.hid);
 $scope.id = $scope.hid[0];
 $scope.name= $scope.hid[1];
 $scope.age= $scope.hid[2];
 $scope.gender= $scope.hid[3];
 $scope.blood= $scope.hid[4];
 $scope.bio= $scope.hid[5];

 console.log ($scope.age);

 //Start Here

  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalpatientsTemp = {};
  $scope.totalpatients = 0;
  $scope.form = {};

  $scope.clearform = function(){
    console.log ('clearform');
    $scope.form ={};
  }


  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };
  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest('/history?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalpatients = data.total;
          });
      }else{
          dataFactory.httpRequest('/histories?id='+$scope.id+'&page='+pageNumber).then(function(data) {
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
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
  	$scope.form.patient_id = $scope.id;
    dataFactory.httpRequest('/create/histories','POST',{},$scope.form).then(function(data) {

     // $scope.data.push(data);
     $route.reload();
     
      $(".modal").modal("hide");
    });
  }
  $scope.edit = function(id){
   // dataFactory.httpRequest('patients/'+id+'/edit').then(function(data) {
     dataFactory.httpRequest('/edit/history/'+id).then(function(data) {
   
    	console.log(data);
      	$scope.form = data;
    });
  }

  $scope.history = function(id){
   // dataFactory.httpRequest('patients/'+id+'/edit').then(function(data) {
     dataFactory.httpRequest('/edit/patients/'+id).then(function(data) {
   
      console.log('history', data);
      dataH = data.id+'-'+data.name+'-'+data.age+'-'+data.gender+'-'+data.blood+'-'+data.bio;
      $location.path('/history/'+dataH);
      $scope.form = data;
    });
  }
  $scope.saveEdit = function(){
   // dataFactory.httpRequest('patients/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
    console.log ('form', $scope.form);
      dataFactory.httpRequest('/history/edit','POST',{},$scope.form).then(function(data) {

      	$(".modal").modal("hide");
        console.log ('data', data);
        $scope.data = apiModifyTable($scope.data,data.id,data);
    });
  }
  $scope.remove = function(patient,index){
    var result = confirm("Are you sure delete this patient?");
   	if (result) {
     // dataFactory.httpRequest('patients/'+patient.id,'DELETE').then(function(data) {
      dataFactory.httpRequest('/patients/delete','POST',{},patient).then(function(data) {

          $scope.data.splice(index,1);
      });
    }
  }

//Upload related images
      $scope.uploadXray = function(files) {
        var formData = new FormData();
        formData.append("file", files[0]);
        
        
       response = $http.post('/upload/xray', formData, {
          headers: {'Content-Type': undefined },
          transformRequest: angular.identity
        }).success(function(data) {
          if(data.success){
            $scope.showLoader = false;
          } 
            //console.log('reply link', data);
            //var imageData= JSON.parse(data);
            //console.log ('jsonparse',data.original.imageLink);

            $scope.form.xRayLink = data.original.imageLink;
            $scope.form.xRayLink =   $scope.form.xRayLink.split('public').pop();
            console.log('Xray',$scope.form.xRayLink);


        });

     }

      $scope.uploadMRI = function(files) {
        var formData = new FormData();
        formData.append("file", files[0]);
        
        
       response = $http.post('/upload/mri', formData, {
          headers: {'Content-Type': undefined },
          transformRequest: angular.identity
        }).success(function(data) {
          if(data.success){
            $scope.showLoader = false;
          } 
            //console.log('reply link', data);
            //var imageData= JSON.parse(data);
            //console.log ('jsonparse',data.original.imageLink);

            $scope.form.mriLink = data.original.imageLink;
            $scope.form.mriLink =   $scope.form.mriLink.split('public').pop();
            console.log('MRI',$scope.form.mriLink);


        });

     }

      $scope.uploadCT = function(files) {
        var formData = new FormData();
        formData.append("file", files[0]);
        
        
       response = $http.post('/upload/ct', formData, {
          headers: {'Content-Type': undefined },
          transformRequest: angular.identity
        }).success(function(data) {
          if(data.success){
            $scope.showLoader = false;
          } 
            //console.log('reply link', data);
            //var imageData= JSON.parse(data);
            //console.log ('jsonparse',data.original.imageLink);

            $scope.form.ctLink = data.original.imageLink;
            $scope.form.ctLink =   $scope.form.ctLink.split('public').pop();
            console.log('CT',$scope.form.ctLink);


        });

     }

      $scope.uploadUS = function(files) {
        var formData = new FormData();
        formData.append("file", files[0]);
        
        
       response = $http.post('/upload/us', formData, {
          headers: {'Content-Type': undefined },
          transformRequest: angular.identity
        }).success(function(data) {
          if(data.success){
            $scope.showLoader = false;
          } 
            //console.log('reply link', data);
            //var imageData= JSON.parse(data);
            //console.log ('jsonparse',data.original.imageLink);

            $scope.form.usLink = data.original.imageLink;
            $scope.form.usLink =   $scope.form.usLink.split('public').pop();
            console.log('US',$scope.form.usLink);


        });

     }

     $scope.changeLabel = function(label){ 
        switch(label){
          case '0':
            $scope.popImage = $scope.form.xRayLink;
           // $scope.label = 'X-Ray Image';
            $scope.label = 'Lab Result Photo Document(LRP1)';

          break;
          case '1':
            $scope.popImage = $scope.form.mriLink;
           // $scope.label = 'MRI Image';
            $scope.label = 'Lab Result Photo Document(LRP2)';

          break;
          case '2':
            $scope.popImage = $scope.form.ctLink;
           // $scope.label = 'CT Image';
            $scope.label = 'Radiology  Photo Document(RPD1)';

          break;
          case '3':
            $scope.popImage = $scope.form.usLink;
           // $scope.label = 'Ultrasound Image';
            $scope.label = 'Radiology  Photo Document(RPD2)';

          break; 

          default:
            $scope.popImage = '0';
            $scope.label = 'No Image';


        }

        console.log ('label', label);
     }







});