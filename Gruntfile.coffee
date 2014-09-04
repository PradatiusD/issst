deployUnit = (folderName) ->
	return {
		'src' : folderName
		'dest': "wp-content/themes/#{folderName}"
		'auth':
			'host': 'pradadesigners.com'
			'port': 21
			'authKey': 'key1'
		'exclusions': [
			"#{folderName}/lib/*"
			"#{folderName}/img/*"
			"#{folderName}/TwitterOAuth/*"
			"#{folderName}/js/*"
			"#{folderName}/*.sass"
			# "#{folderName}/*.css"
			'.DS_Store'
			'favicon.ico'
			'.gitignore'
			"#{folderName}/screenshot.png"
		]
	}

module.exports = (grunt) ->
	grunt.initConfig(

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
				files: ['issst2015/*', '!issst2015/style.sass']
				tasks: ['ftp-deploy:issst2015']
			sassissst:
				files: ['issst/*.sass']
				tasks: ['sass:issst']
			sassissst2015:
				files: ['issst2015/*.sass']
				tasks: ['sass:issst2015']				
			homepageJS:
				files: 'issst/js/homepage/*.js'
				tasks: ['uglify']

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
	grunt.registerTask('deployAll', ['sass','ftp-deploy'])
	grunt.registerTask('deploy', ['sass',   'ftp-deploy:issst2015'])
