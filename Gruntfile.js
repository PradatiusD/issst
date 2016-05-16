require('dotenv').config();

var path  = require('path');
var sites = ['2014','2015','2016'];

module.exports = function (grunt) {

  require('load-grunt-tasks')(grunt);

  var assets = grunt.file.readJSON('bower.json').assets;

  var options = {
    pkg: grunt.file.readJSON('package.json')
  };

  options.php = {
    php: {
      dev: {
        options: {
          keepalive: true,
          open: true,
          port: 5000
        }
      }
    }
  };


  /* Copy */

  options.copy = {};

  sites.forEach(function (site) {

    options.copy[site] = {
      files: [{
        expand: true,
        src: path.join(site, '**'),
        dest: process.env.WP_THEMES_DIR
      }]
    };
  });


  options['ftp-deploy'] = sites.reduce(function (obj, siteFolder){

    obj[siteFolder] = {
      src: siteFolder,
      dest: siteFolder,
      auth: {
        host: 'pradadesigners.com',
        port: 21,
        authKey: 'key'
      },
      forceVerbose: true,
      exclusions:[
        '.DS_Store',
        'favicon.ico',
        'screenshot.png',
        'img', 
        'assets',
        'lib',
        '.gitignore',
        'fonts',
        'TwitterOAuth.php',
        'TwitterException.php'
       ]
    };

    return obj;

  },{});


  options.uglify = {
    combinedScripts: {
      files: {
          'issst/js/global.min.js':       assets.issstNetwork.javascripts.global, // Global across all network
          'issst/js/homepage.min.js':     assets.issst2014.javascripts.homepage,  // Front-page for ISSST 2014
          'issst2015/js/homepage.min.js': assets.issst2015.javascripts.homepage   // Front-page for ISSST 2015
      }
    }
  };


  /* Sass */

  options.sass = {};

  sites.forEach(function (site) {

    options.sass[site] = {
      files: {}
    };

    options.sass[site].files[path.join(site,'style.css')] = path.join(site,'style.sass');

  });


  /* Watch */

  options.watch = {};

  sites.forEach(function (site) {

    options.watch[site + "sass"] = {
      files: path.join(site, 'style.sass'),
      tasks: 'sass:'+site,
      options: {
        livereload: true
      }
    };

    options.watch[site + "copy"] = {
      files: [path.join(site, "**"), path.join(site, '!style.sass')],
      tasks: ['copy:'+site],
      options: {
        livereload: true
      }
    };

  });

  options.watch.javascripts = {
    files: [
      assets.issstNetwork.javascripts.global,
      assets.issst2014.javascripts.homepage,
      assets.issst2015.javascripts.homepage
    ],
    tasks: ['uglify']
  };


  // sites.forEach(function (site) {
  //   var withoutISSST = site.replace('issst','');
  //   var deploySequence = 'ftp-deploy:'+site;

  //   grunt.registerTask(withoutISSST,    [deploySequence]);
  //   grunt.registerTask(withoutISSST+'sass',['sass:'+site,deploySequence]);
  // });

  grunt.registerTask('default',['watch']);
  grunt.initConfig(options);

};
