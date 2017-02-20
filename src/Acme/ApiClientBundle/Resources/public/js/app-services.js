angular.module('ApiClient.services', ['ngCookies'])
    .factory('Base64', function () {
        var keyStr = 'ABCDEFGHIJKLMNOP' +
            'QRSTUVWXYZabcdef' +
            'ghijklmnopqrstuv' +
            'wxyz0123456789+/' +
            '=';
        return {
            encode: function (input) {
                var output = "";
                var chr1, chr2, chr3 = "";
                var enc1, enc2, enc3, enc4 = "";
                var i = 0;

                do {
                    chr1 = input.charCodeAt(i++);
                    chr2 = input.charCodeAt(i++);
                    chr3 = input.charCodeAt(i++);

                    enc1 = chr1 >> 2;
                    enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                    enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                    enc4 = chr3 & 63;

                    if (isNaN(chr2)) {
                        enc3 = enc4 = 64;
                    } else if (isNaN(chr3)) {
                        enc4 = 64;
                    }

                    output = output +
                        keyStr.charAt(enc1) +
                        keyStr.charAt(enc2) +
                        keyStr.charAt(enc3) +
                        keyStr.charAt(enc4);
                    chr1 = chr2 = chr3 = "";
                    enc1 = enc2 = enc3 = enc4 = "";
                } while (i < input.length);

                return output;
            },

            decode: function (input) {
                var output = "";
                var chr1, chr2, chr3 = "";
                var enc1, enc2, enc3, enc4 = "";
                var i = 0;

                // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
                var base64test = /[^A-Za-z0-9\+\/\=]/g;
                if (base64test.exec(input)) {
                    alert("There were invalid base64 characters in the input text.\n" +
                        "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
                        "Expect errors in decoding.");
                }
                input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

                do {
                    enc1 = keyStr.indexOf(input.charAt(i++));
                    enc2 = keyStr.indexOf(input.charAt(i++));
                    enc3 = keyStr.indexOf(input.charAt(i++));
                    enc4 = keyStr.indexOf(input.charAt(i++));

                    chr1 = (enc1 << 2) | (enc2 >> 4);
                    chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                    chr3 = ((enc3 & 3) << 6) | enc4;

                    output = output + String.fromCharCode(chr1);

                    if (enc3 != 64) {
                        output = output + String.fromCharCode(chr2);
                    }
                    if (enc4 != 64) {
                        output = output + String.fromCharCode(chr3);
                    }

                    chr1 = chr2 = chr3 = "";
                    enc1 = enc2 = enc3 = enc4 = "";

                } while (i < input.length);

                return output;
            }
        };
    })
    .factory('TokenHandler', ['$http', 'Base64', function ($http, Base64) {
        var tokenHandler = {};
        var token = 'none';

        tokenHandler.set = function (newToken) {
            token = newToken;
        };

        tokenHandler.get = function () {
            return token;
        };

        // Generate random string of length
        tokenHandler.randomString = function (length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < length; i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            return text;
        };

        tokenHandler.getCredentials = function (username, secret) {
            // Generate nonce
            var nonce = tokenHandler.randomString(30);

            // Creation time of the token
            var created = formatDate(new Date());

            // Generating digest from secret, creation and nonce
            var hash = CryptoJS.SHA1(nonce + created + secret);
            var digest = hash.toString(CryptoJS.enc.Base64);

            // Base64 Encode digest
            var b64nonce = Base64.encode(nonce);

            //console.log(username);
            //console.log(digest);
            //console.log(b64nonce);
            //console.log(created);
            // Return generated token
            return 'UsernameToken Username="' + username + '", PasswordDigest="' + digest + '", Nonce="' + b64nonce + '", Created="' + created + '"';
        };

        // Date formater to UTC
        var formatDate = function (d) {
            // Padding for date creation
            var pad = function (num) {
                return ("0" + num).slice(-2);
            };

            return [d.getUTCFullYear(),
                    pad(d.getUTCMonth() + 1),
                    pad(d.getUTCDate())].join("-") + "T" +
                [pad(d.getUTCHours()),
                    pad(d.getUTCMinutes()),
                    pad(d.getUTCSeconds())].join(":") + "Z";
        };

        return tokenHandler;
    }])
    .factory('AuthHandler', ['$cookies', '$window', function ($cookies, $window) {

        var authHandler = {};
        // If not authenticated, go to login
        if (typeof $cookies.get('username') == "undefined" || typeof $cookies.get('secret') == "undefined") {
            $window.location = '#/login';
        }

        authHandler.username = function() {
            return $cookies.get('username');
        };

        authHandler.secret = function() {
            return $cookies.get('secret');
        };

        return authHandler;

    }])
    .factory('Digest', ['$q', function ($q) {
        var factory = {
            // Symfony SHA512 encryption provider
            cipher: function (secret, salt) {
                var deferred = $q.defer();

                var salted = secret + '{' + salt + '}';
                var digest = CryptoJS.SHA512(salted);
                for (var i = 1; i < 5000; i++) {
                    digest = CryptoJS.SHA512(digest.concat(CryptoJS.enc.Utf8.parse(salted)));
                }
                digest = digest.toString(CryptoJS.enc.Base64);

                deferred.resolve(digest);
                return deferred.promise;
            },
            // Default Symfony plaintext encryption provider
            plain: function (secret, salt) {
                var deferred = $q.defer();

                var salted = secret + '{' + salt + '}';
                var digest = salted;

                deferred.resolve(digest);
                return deferred.promise;
            }
        };
        return factory;
    }])
    
    .factory('spinnerService', function () {
        var spinners = {};
        return {
          _register: function (data) {
            if (!data.hasOwnProperty('name')) {
              throw new Error("Spinner must specify a name when registering with the spinner service.");
            }
            spinners[data.name] = data;
          },
          _unregister: function (name) {
            if (spinners.hasOwnProperty(name)) {
              delete spinners[name];
            }
          },
          _unregisterGroup: function (group) {
            for (var name in spinners) {
              if (spinners[name].group === group) {
                delete spinners[name];
              }
            }
          },
          _unregisterAll: function () {
            for (var name in spinners) {
              delete spinners[name];
            }
          },
          show: function (name) {
            var spinner = spinners[name];
            if (!spinner) {
              throw new Error("No spinner named '" + name + "' is registered.");
            }
            spinner.show();
          },
          hide: function (name) {
            var spinner = spinners[name];
            if (!spinner) {
              throw new Error("No spinner named '" + name + "' is registered.");
            }
            spinner.hide();
          },
          showGroup: function (group) {
            var groupExists = false;
            for (var name in spinners) {
              var spinner = spinners[name];
              if (spinner.group === group) {
                spinner.show();
                groupExists = true;
              }
            }
            if (!groupExists) {
              throw new Error("No spinners found with group '" + group + "'.")
            }
          },
          hideGroup: function (group) {
            var groupExists = false;
            for (var name in spinners) {
              var spinner = spinners[name];
              if (spinner.group === group) {
                spinner.hide();
                groupExists = true;
              }
            }
            if (!groupExists) {
              throw new Error("No spinners found with group '" + group + "'.")
            }
          },
          showAll: function () {
            for (var name in spinners) {
              spinners[name].show();
            }
          },
          hideAll: function () {
            for (var name in spinners) {
              spinners[name].hide();
            }
          }
        };
      })
    .directive('spinner', function () {
        return {
          restrict: 'EA',
          replace: true,
          transclude: true,
          scope: {
            name: '@?',
            group: '@?',
            show: '=?',
            imgSrc: '@?',
            register: '@?',
            onLoaded: '&?',
            onShow: '&?',
            onHide: '&?'
          },
          template: [
            '<span ng-show="show">',
            '  <img ng-show="imgSrc" ng-src="{{imgSrc}}" />',
            '  <span ng-transclude></span>',
            '</span>'
          ].join(''),
          controller: function ($scope, spinnerService) {

            // register should be true by default if not specified.
            if (!$scope.hasOwnProperty('register')) {
              $scope.register = true;
            } else {
              $scope.register = !!$scope.register;
            }

            // Declare a mini-API to hand off to our service so the 
            // service doesn't have a direct reference to this
            // directive's scope.
            var api = {
              name: $scope.name,
              group: $scope.group,
              show: function () {
                $scope.show = true;
              },
              hide: function () {
                $scope.show = false;
              },
              toggle: function () {
                $scope.show = !$scope.show;
              }
            };

            // Register this spinner with the spinner service.
            if ($scope.register === true) {
              spinnerService._register(api);
            }

            // If an onShow or onHide expression was provided,
            // register a watcher that will fire the relevant
            // expression when show's value changes.
            if ($scope.onShow || $scope.onHide) {
              $scope.$watch('show', function (show) {
                if (show && $scope.onShow) {
                  $scope.onShow({
                    spinnerService: spinnerService,
                    spinnerApi: api
                  });
                } else if (!show && $scope.onHide) {
                  $scope.onHide({
                    spinnerService: spinnerService,
                    spinnerApi: api
                  });
                }
              });
            }

            // This spinner is good to go.
            // Fire the onLoaded expression if provided.
            if ($scope.onLoaded) {
              $scope.onLoaded({
                spinnerService: spinnerService,
                spinnerApi: api
              });
            }
          }
        };
      });
