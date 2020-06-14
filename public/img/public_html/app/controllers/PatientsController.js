app.controller('AdminController', function($scope,$http){
  $scope.pools = [];
});
app.controller('PatientsController', function(dataFactory,$scope,$http, $location, $route){
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalpatientsTemp = {};
  $scope.totalpatients = 0;


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
          dataFactory.httpRequest('/patients?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalpatients = data.total;
          });
      }else{
        dataFactory.httpRequest('/patients?page='+pageNumber).then(function(data) {
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
    dataFactory.httpRequest('/create/patients','POST',{},$scope.form).then(function(data) {

      //$scope.data.push(data);
      $route.reload();

      $(".modal").modal("hide");


    });
  }
  $scope.edit = function(id){
   // dataFactory.httpRequest('patients/'+id+'/edit').then(function(data) {
     dataFactory.httpRequest('/edit/patients/'+id).then(function(data) {
   
      console.log(data);
        $scope.form = data;
    });
  }

  $scope.history = function(id){
   // dataFactory.httpRequest('patients/'+id+'/edit').then(function(data) {
     dataFactory.httpRequest('/edit/patients/'+id).then(function(data) {
   
      console.log('history', data);
      dataH = data.id+'-'+data.name+'-'+data.age+'-'+data.gender+'-'+data.blood;
      $location.path('/history/'+dataH);
      $scope.form = data;
    });
  }
  $scope.saveEdit = function(){
   // dataFactory.httpRequest('patients/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
    console.log ('form', $scope.form);
      dataFactory.httpRequest('/patients/edit','POST',{},$scope.form).then(function(data) {

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
});