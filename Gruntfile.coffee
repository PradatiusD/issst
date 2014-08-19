deployUnit = (folderName) ->
	this.src  = folderName
	this.dest = "wp-content/themes/#{folderName}"
	this.auth =
		host: 'pradadesigners.com'
		port: 21
		authKey: 'key1'
	this.exclusions = [
		'issst/lib/*'
		'issst/img/*'
		'.DS_Store'
		'favicon.ico'
		'issst/screenshot.png'
	]
	return this


module.exports = (grunt) ->
	grunt.initConfig(

		php:
			test:
				options:
					keepalive: true
					open: true
					port: 5000

		'ftp-deploy':
			issst:  new deployUnit('issst')
			issst2015: new deployUnit('issst2015')
		copy:
			main:
				files: [{
					expand: true
					src: ['issst/**']
					dest: '../themes/'}
				]

		sass:                              
			dist:                            
				options:                       
					style: 'expanded'
				files:
					'issst/style.css': 'style.sass'

		watch:
			theme:
				files: 'issst/*.php'
				tasks: ['copy']
			issst2015:
				files: 'issst2015/**'
				tasks: ['ftp-deploy:issst2015']
			sassy:
				files: 'style.sass'
				tasks: ['sass','copy']
			homepageJS:
				files: 'issst/js/homepage/*.js'
				tasks: ['uglify','copy']

		uglify:
			homepage:
				files:
					'issst/js/homepage.min.js': [
						'bower_components/maximage/lib/js/jquery.cycle.all.js'
						'bower_components/maximage/lib/js/jquery.maximage.js'
						'issst/js/homepage/mailchimp-form.js'
						'issst/js/homepage/google-map.js'
						'issst/js/homepage/slider-anim.js'
					]
			global:
				files:
					'issst/js/global.min.js': ['issst/lib/*.js']
	)

	grunt.loadNpmTasks('grunt-php')
	grunt.loadNpmTasks('grunt-ftp-deploy')
	grunt.loadNpmTasks('grunt-concurrent')
	grunt.loadNpmTasks('grunt-contrib-copy')
	grunt.loadNpmTasks('grunt-contrib-sass')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-contrib-uglify')
	grunt.registerTask('default', ['watch'])
	grunt.registerTask('deploy', ['sass','ftp-deploy'])
