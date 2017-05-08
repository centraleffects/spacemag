function WorkersTodoCtrl($scope, shopService, workerTodoService, $timeout, $http, $rootScope) {
    $scope.todos = [];
    $scope.markAll = false;
    $scope.shops = [];
    $scope.selectedShop = window.selectedShop;
    $scope.shopworkers = [];
    

    // Here is a naive implementation for matching first name, last name, or full name
    $scope.localSearch = function(str) {
        var matches = [];
        $scope.selectedShop.workers.forEach(function(person) {
            var fullName = person.first_name + ' ' + person.last_name;
            if ((person.first_name.toLowerCase().indexOf(str.toString().toLowerCase()) >= 0) ||
                (person.last_name.toLowerCase().indexOf(str.toString().toLowerCase()) >= 0) ||
                (fullName.toLowerCase().indexOf(str.toString().toLowerCase()) >= 0)) {
                matches.push(person);
            }
        });
        return matches;
    };

    $scope.init = function() {
        $timeout(function () {
            $scope.updateShopList();
        }, 1000);
    }

    $scope.updateShopList = function(){

        shopService.userShopList(window.user.id, window.user.api_token).then(function(response) {
            console.log(response);
            $scope.shops = response.data.data;
        });
    }

    $scope.assignTodo = function(entry){
        // console.log(entry.originalObject);
        if( entry.originalObject && entry.originalObject.id ){
            var selectedWorker = entry.originalObject;
            $rootScope.focusTodo.owner = selectedWorker;

            workerTodoService.assignTodo(selectedWorker.id, $rootScope.focusTodo.id).then(function (response){
                if( response.data.success ){
                    window.reBuy.toast(response.data.msg);
                }else{
                    window.reBuy.alert(response.data.msg);
                    $rootScope.focusTodo.owner = null;
                }

                // $scope.updateShopList();

            }, function (response){
                // error
                $rootScope.focusTodo.owner = null;
                console.warn(response);
                window.reBuy.alert("Whoops, something went wrong.");
            });
        }
    };

    $scope.addTodo = function() {
        if(event.keyCode == 13 && $scope.todoText){
            
            var todo = {
                description: $scope.todoText,
                done: false,
                user_id: window.user.id,
                shop_id: $scope.selectedShop.id
            };

            $scope.todos.push(todo);
            
            workerTodoService.addNew(todo).then(function (response){
                if( response.data.success ){
                    $scope.todoText = '';
                }else{
                    window.reBuy.alert(response.data.msg);
                }
            })
        }
    };

    $scope.getTodos = function(index) {
        $scope.selectedShop = $scope.shops[index];
        $scope.todos = $scope.selectedShop.all_tasks;
        for (var i = $scope.todos.length - 1; i >= 0; i--) {
            $scope.todos[i].done = $scope.todos[i] == 1 ? true : false;
        }
    }

    $scope.isTodo = function(){
        return $scope.todos.length > 0;  
    }

    $scope.toggleEditMode = function(){
        $(event.target).closest('li').toggleClass('editing');
    };

    $scope.editOnEnter = function(todo){
        if(event.keyCode == 13 && todo.description){
            $scope.toggleEditMode();
        }
    };

    $scope.remaining = function() {
        var count = 0;
        angular.forEach($scope.todos, function(todo) {
            count += todo.done ? 0 : 1;
        });
        return count;
    };

    $scope.hasDone = function() {
        return ($scope.todos.length != $scope.remaining());
    }    

    $scope.itemText = function() {
        return ($scope.todos.length - $scope.remaining() > 1) ? "items" : "item";     
    };

    $scope.toggleMarkAll = function() {
        angular.forEach($scope.todos, function(todo) {
            todo.done = $scope.markAll;
        });
    };

    $scope.toggleDone = function (index){
        workerTodoService.markAsDone($scope.todos[index].id).then(function (response){
            if( response.data.success ){
                window.reBuy.toast(response.data.msg);
            }else{
                window.reBuy.alert(response.data.msg);
            }

        }, function (response){
            window.reBuy.alert(response.data.msg);
        });
    };

    $scope.clear = function() {
        var oldTodos = $scope.todos;
        $scope.todos = [];
        angular.forEach(oldTodos, function(todo) {
            if (!todo.done) $scope.todos.push(todo);
        });
    };

    $scope.unAssignTask = function(todo) {
        workerTodoService.unAssign(todo.id).then(function (response){
            console.log(response);
            if( response.data.success == 1){
                todo.owner = null;
            }
        }, function (response){
            window.reBuy.alert("Something went wrong. Please try again later.");
        });
    }

    $scope.init();

}


app.controller('WorkersTodoController', WorkersTodoCtrl);
