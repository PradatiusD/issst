
module.exports = (grunt) ->
	grunt.initConfig(

		php:
			test:
				options:
					keepalive: true
					open: true
					port: 5000

		'ftp-deploy':
			sass:
				auth:
					host: 'pradadesigners.com'
					port: 21
					authKey: 'key1'
				src: 'theme'
				dest: ''
				exclusions: ['theme/*.php']
			php:
				auth:
					host: 'pradadesigners.com'
					port: 21
					authKey: 'key1'
				src: 'theme'
				dest: ''
				exclusions: ['theme/*.css','theme/lib/*']

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


	)

	grunt.loadNpmTasks('grunt-php')
	grunt.loadNpmTasks('grunt-contrib-copy')
	grunt.loadNpmTasks('grunt-ftp-deploy')
	grunt.loadNpmTasks('grunt-concurrent')
	grunt.loadNpmTasks('grunt-contrib-sass')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.registerTask('default', ['watch'])
