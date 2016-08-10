<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0-rc2/angular-material.min.css">
<link rel="stylesheet" href="deviceGen.css"/>
<style>
    .tabsdemoDynamicHeight md-content {
  background-color: transparent !important; }
  .tabsdemoDynamicHeight md-content md-tabs {
    background: #f6f6f6;
    border: 1px solid #e1e1e1; }
    .tabsdemoDynamicHeight md-content md-tabs md-tabs-wrapper {
      background: white; }
  .tabsdemoDynamicHeight md-content h1:first-child {
    margin-top: 0; }</style>
</head>
<body ng-app="notesHome" ng-cloak>
    <div class="logo-sweet">Notes</div>
<div ng-cloak>
  <md-content>
    <md-tabs md-dynamic-height md-border-bottom>
      <md-tab label="Login">
        <md-content class="md-padding">
           <md-input-container class="md-block" flex-gt-sm>
            <label>E-mail</label>
            <input  type="email" name="clientEmail" ng-model="project.clientEmail"
               minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" />
        <div ng-messages="projectForm.clientEmail.$error" role="alert">
          <div ng-message-exp="[ 'minlength', 'maxlength', 'pattern']">
            Your email must be between 10 and 100 characters long and look like an e-mail address.
          </div>
        </div>
            
          </md-input-container>
               <md-input-container class="md-block" flex-gt-sm>
            <label>Password</label>
            <input type="password" ng-model="user.Password">
            
          </md-input-container>
          <div align="center">
                <md-checkbox ng-model="ctrl.disableParentScroll">Remember me</md-checkbox>
</div>
            <div align="center" >
                  <md-button ng-click="showAlert($event)" class="md-raised md-primary" >Login</md-button>
</div>
        </md-content>
      </md-tab>
          <md-tab label="Create Account">
                <md-input-container class="md-block" flex-gt-sm>
            <label>Name</label>
            <input  type="text" name="userName" ng-model="project.userName"
               minlength="2" maxlength="20"  />
        <div ng-messages="projectForm.clientEmail.$error" role="alert">
          <div ng-message-exp="[ 'minlength', 'maxlength']">
            Name must be between 2 and 20 characters long.
          </div>
        </div>
             <md-input-container class="md-block" flex-gt-sm>
            <label>E-mail</label>
            <input  type="email" name="clientEmail" ng-model="project.clientEmail"
               minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" />
        <div ng-messages="projectForm.clientEmail.$error" role="alert">
          <div ng-message-exp="[ 'minlength', 'maxlength', 'pattern']">
            Your email must be between 10 and 100 characters long and look like an e-mail address.
          </div>
        </div>
            
          </md-input-container>
               <md-input-container class="md-block" flex-gt-sm>
            <label>Password</label>
            <input type="password" ng-model="user.Password">
            
          </md-input-container>

               <md-input-container class="md-block" flex-gt-sm>
            <label>Confirm Password</label>
            <input type="password" ng-model="user.Password">
            
          </md-input-container>
            
          </md-input-container>
        </md-content>
      </md-tab>
    </md-tabs>
  </md-content>
</div>
</div>
<div class="footer-info">Desktop</div>

  <!-- Angular Material requires Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0-rc2/angular-material.min.js"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    
    /**
     * You must include the dependency on 'ngMaterial' 
     */
    angular.module('notesHome', ['ngMaterial']);
        angular.module('tabsDemoDynamicHeight', ['ngMaterial']);

  </script>
</body>
</html>