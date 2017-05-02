app.directive('escKey', function () {
  return function (scope, element, attrs) {
    element.bind('keydown keypress', function (event) {
      if(event.which === 27) { // 27 = esc key
        console.log("ESC is pressed!");
        scope.$apply(function (){
          scope.$eval(attrs.escKey);
        });

        event.preventDefault();
      }
    });
  };
})