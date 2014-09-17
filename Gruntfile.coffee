
module.exports = (grunt) ->

	deployUnit = (folderName) ->
		config =
			'src' : folderName
			'dest': folderName
			'auth':
				'host': 'pradadesigners.com'
				'port': 21
				'authKey': 'key1'
			'exclusions': [
				"#{folderName}/lib/*"
				"#{folderName}/TwitterOAuth/*"
				"#{folderName}/*.sass"
				'.DS_Store'
				'favicon.ico'
				'.gitignore'
				"#{folderName}/screenshot.png"
			]

		if !grunt.option('css')
			config.exclusions.push("#{folderName}/*.css")
			config.exclusions.push("#{folderName}/*.map")

		if !grunt.option('php')
			config.exclusions.push("#{folderName}/*.php")

		if !grunt.option('img')
			config.exclusions.push("#{folderName}/img/*")

		if !grunt.option('js')
			config.exclusions.push("#{folderName}/js/*")

		return config

	assets = grunt.file.readJSON('bower.json').assets

	grunt.initConfig(
		pkg: grunt.file.readJSON('package.json')
		php:
			test:
				options:
					keepalive: true
					open: true
					port: 5000

		'ftp-deploy':
			issst:     deployUnit('issst')
			issst2015: deployUnit('issst2015')
		copy:
			main:
				files: [{
					expand: true
					src: ['issst/**']
					dest: '../themes/'}
				]

		sass:      
			issst:                            
				options:
					style: 'expanded'
				files:
					'issst/style.css': 'issst/style.sass'
			issst2015:                            
				options:
					style: 'expanded'
				files:
					'issst2015/style.css': 'issst2015/style.sass'

		watch:
			issst:
				files: ['issst/*.css','issst/*.php'] 
				tasks: ['ftp-deploy:issst']
			issst2015:
				files: ['issst2015/*', '!issst2015/style.sass','issst2015/twitter.php']
				tasks: ['ftp-deploy:issst2015']
			sassissst:
				files: ['issst/*.sass']
				tasks: ['sass:issst']
			sassissst2015:
				files: ['issst2015/*.sass']
				tasks: ['sass:issst2015']				
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
	grunt.registerTask('deployAll',  ['ftp-deploy'])
	grunt.registerTask('deployMain', ['ftp-deploy:issst'])
	grunt.registerTask('deploy',     ['ftp-deploy:issst2015'])
