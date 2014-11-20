sites = ['issst','issst2015']


module.exports = (grunt) ->

	assets = grunt.file.readJSON('bower.json').assets

	grunt.initConfig(

		pkg: grunt.file.readJSON('package.json')
		

		php:
			test:
				options:
					keepalive: true
					open: true
					port: 5000


		'ftp-deploy': sites.reduce((obj, siteFolder) ->
			obj[siteFolder] = {
				'src': siteFolder
				'dest': siteFolder
				'auth':
					'host': 'pradadesigners.com'
					'port': 21
					'authKey': 'key'
			}
			return obj
		,{})


		copy:
			main:
				files: [{
					'expand': true
					'src':    sites.map((site) -> "#{site}/**")
					'dest':   '../themes/'
				}]


		sass: sites.reduce((obj, siteFolder) ->
				obj[siteFolder] = {
					files: {}
				}
				obj[siteFolder].files["#{siteFolder}/style.css"] = "#{siteFolder}/style.sass"
				return obj
			, {})


		watch:
			copy:
				'files': sites.map((site) -> 
					return ["#{site}/*","!#{site}/style.sass"]
				)
				'tasks': ['copy']
				'options':
					'livereload': true

			sass:
				files: sites.map((site) -> 
					return "#{site}/style.sass"
				)
				tasks: ['sass']
			javascripts:
				files: [
					assets.issstNetwork.javascripts.global
					assets.issst2014.javascripts.homepage
					assets.issst2015.javascripts.homepage
				]
				tasks: ['uglify']


		uglify:
			combinedScripts:
				files:
					'issst/js/global.min.js':       assets.issstNetwork.javascripts.global # Global across all network
					'issst/js/homepage.min.js':     assets.issst2014.javascripts.homepage  # Front-page for ISSST 2014
					'issst2015/js/homepage.min.js': assets.issst2015.javascripts.homepage  # Front-page for ISSST 2015
	)

	grunt.loadNpmTasks('grunt-php')
	grunt.loadNpmTasks('grunt-ftp-deploy')
	grunt.loadNpmTasks('grunt-concurrent')
	grunt.loadNpmTasks('grunt-contrib-copy')
	grunt.loadNpmTasks('grunt-contrib-sass')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-contrib-uglify')
	grunt.registerTask('default', ['watch'])
	grunt.registerTask('deploy',  ['ftp-deploy'])