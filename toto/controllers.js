app.controller('TotoCtrl', function($http) {

    console.log('okaaaa');

    $http.get("http://127.0.0.1:8000/api/users").success(function(datas){
        console.log(datas);
    })
});
