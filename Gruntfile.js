module.exports = function(grunt) {
  // Load grunt tasks automatically
  require('load-grunt-tasks')(grunt);

  var pkg = grunt.file.readJSON('package.json');

  var options = {
    paths: {
      app: 'public',
      assets: 'public/assets',
      dist: 'public/dist',
      distAssets: 'public/dist/assets',
   /*   html: 'public/html',
      htmlTmp: '.tmp/htmlsnapshot',
      htmlAssets: 'public/html/assets',
      index: 'public/dist/index.html',
      indexDev: 'public/index.dev.html',
      indexTmp: '.tmp/html/index.html'*/
    },
    pkg: pkg
  };

  // Load grunt configurations automatically
  var configs = require('load-grunt-configs')(grunt, options);

  // Define the configuration for all the tasks
  grunt.initConfig(configs);

  grunt.registerTask('bumper', ['bump-only']);
  grunt.registerTask('css', ['sass']);
  grunt.registerTask('default', [
    'sass',
    'copy:dev',
    'connect:server',
    'watch'
  ]);

  grunt.registerTask('shared', [
    'clean:demo',
    'copy:demo',
    'sass',
    'ngconstant',
    'useminPrepare',
    'concat:generated',
    'cssmin:generated',
    'uglify:generated',
    'filerev',
    'usemin',
    'imagemin',
    'usebanner'
  ]);
/*
  grunt.registerTask('demo', [
    'shared',
    'copy:postusemin',
    'grep:demo'
  ]);*/

  grunt.registerTask('dist', [
    'shared',
    'copy:postusemin',
    'copy:dist',
    'grep:dist',
    'html',
    'compress',
    'copy:postusemin',
    'grep:demo',
  ]);

/*  grunt.registerTask('html', [
    'clean:html',
    'copy:html',
    'concat:html',
    'uglify:html',
    'cssmin:html',
  ]);*/
};
