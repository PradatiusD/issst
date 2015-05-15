var sites = ['issst','issst2015'];

module.exports = function (grunt) {
  var assets = grunt.file.readJSON('bower.json').assets;

  var config = {
    pkg: grunt.file.readJSON('package.json')
  };

  config.php = {
    php: {
      test: {
        options: {
          keepalive: true,
          open: true,
          port: 5000
        }
      }
    }
  };

  config.copy = {
    main: {
      files: [{
        expand: true,
        src: sites.map(function (site) {return site += "/**";}),
        dest: '../themes/'
      }]
    }
  };

  config['ftp-deploy'] = sites.reduce(function (obj, siteFolder){

    obj[siteFolder] = {
      src: siteFolder,
      dest: siteFolder,
      auth: {
        host: 'pradadesigners.com',
        port: 21,
        authKey: key
      }
    };

    return obj;

  },{});


  config.uglify = {
    combinedScripts: {
      files: {
          'issst/js/global.min.js':       assets.issstNetwork.javascripts.global, // Global across all network
          'issst/js/homepage.min.js':     assets.issst2014.javascripts.homepage,  // Front-page for ISSST 2014
          'issst2015/js/homepage.min.js': assets.issst2015.javascripts.homepage   // Front-page for ISSST 2015
      }
    }
  };


  config.sass = sites.reduce( function (obj, siteFolder) {
    obj[siteFolder] = {
      files: {}
    };

    var styleFilePath = siteFolder+"/style";
    obj[siteFolder].files[styleFilePath+".css"] = styleFilePath+".sass";

    return obj;
  }, {});

  config.watch = {};

  config.watch.copy = {
    files: sites.map(function (site){
        return [site+'/*','!'+site+'/style.sass'];
    }),
    tasks: ['copy'],
    options: {
      livereload: true
    }
  };

  config.watch.sass = {
    files: sites.map(function(site){
      return site+'/style.sass';
    }),
    tasks: ['sass']
  };

  config.watch.javascripts = {
    files: [
      assets.issstNetwork.javascripts.global,
      assets.issst2014.javascripts.homepage,
      assets.issst2015.javascripts.homepage
    ],
    tasks: ['uglify']
  };

  grunt.initConfig(config);

  require('load-grunt-tasks')(grunt);
  grunt.registerTask('default', ['watch']);
  grunt.registerTask('deploy',  ['ftp-deploy']);

};




