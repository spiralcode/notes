<!doctype html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="glide.css"/>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
<script src = "engine.js"></script>
</head>
<body  ng-app="BlankApp" ng-cloak>
<div class="allSlot">
<div class="optionSlot"><div class="option" type="addItem" onclick="core.pushItem();"></div>
<div class="option" type="chooseDate"></div>
</div>
</div>
</div>
<div class="day"><md-datepicker ng-model="myDate" md-placeholder="Enter date"></md-datepicker></div>
<div class="ring" id="ring">

<div class="item">
<div class="tick"><input type="checkbox"/>
<span class="saveEdit">

<button type="button" >Edit</button>
</span></div>
<div class="contentBox" >
There are some things in the universe that are constant like love.There are some things in the universe that are constant like love.
There are some things in the universe that are constant like love.
There are some things in the universe that are constant like love.
There are some things in the universe that are constant like love.
There are some things in the universe that are constant like love.
There are some things in the universe that are constant like love.

</div>
</div>
</div>



<div class="companyBabe"></div>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    
    /**
     * You must include the dependency on 'ngMaterial' 
     */
    angular.module('BlankApp', ['ngMaterial']);
    HTMLJSCSS
angular.module('datepickerBasicUsage',
    ['ngMaterial', 'ngMessages']).controller('AppCtrl', function($scope) {
  $scope.myDate = new Date();
  $scope.minDate = new Date(
      $scope.myDate.getFullYear(),
      $scope.myDate.getMonth() - 2,
      $scope.myDate.getDate());
  $scope.maxDate = new Date(
      $scope.myDate.getFullYear(),
      $scope.myDate.getMonth() + 2,
      $scope.myDate.getDate());
  $scope.onlyWeekendsPredicate = function(date) {
    var day = date.getDay();
    return day === 0 || day === 6;
  };
});
  </script>
</body>
</html>