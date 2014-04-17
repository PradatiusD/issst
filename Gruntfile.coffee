
module.exports = (grunt) ->
	grunt.initConfig(

		php:
			test:
				options:
					keepalive: true
					open: true
					port: 5000

		'ftp-deploy':
			dev:
				auth:
					host: 'pradadesigners.com'
					port: 21
					authKey: 'key1'
				src: 'issst'
				dest: 'wp-content/themes/issst'
				exclusions: ['issst/lib/*','issst/img/*', '.DS_Store','favicon.ico']

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
			sassy:
				files: 'style.sass'
				tasks: ['sass','copy']

		uglify:
			homepage:
				files:
					'issst/js/homepage.min.js': [
						'bower_components/maximage/lib/js/jquery.cycle.all.js',
						'bower_components/maximage/lib/js/jquery.maximage.js'
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
	grunt.registerTask('deploy', ['ftp-deploy'])
