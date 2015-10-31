var gulp = require('gulp');
var Elixir = require('laravel-elixir');
var Server = require('karma').Server;

Elixir.extend('karma', function (config) {
    var config = config ||  __dirname + '/karma.conf.js';
    var isStarted = false;

    new Elixir.Task('karma', function () {        
        if (!isStarted) {
            isStarted = true;

            bundle = function () {
                return new Server({
                    configFile: config
                }, function () {
                    console.log(agruments);
                }).start();
            }
            return (
                gulp
                .src('')
                .pipe(bundle()
                    .on('browser_error', function (e) {
                        
                    }))
                .on('error', function (e) {
                    new Elixir.Notification().error(e, 'Karma Failed!');
                })
            );
        }
    });    
});