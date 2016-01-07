'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var jsFileList = [
    // 'assets/vendor/bootstrap/js/dist/alert.js',
    // 'assets/vendor/bootstrap/js/dist/button.js',
    // 'assets/vendor/bootstrap/js/dist/carousel.js',
    'assets/vendor/bootstrap/js/dist/collapse.js',
    'assets/vendor/bootstrap/js/dist/dropdown.js',
    // 'assets/vendor/bootstrap/js/dist/modal.js',
    // 'assets/vendor/bootstrap/js/dist/popover.js',
    // 'assets/vendor/bootstrap/js/dist/scrollspy.js',
    // 'assets/vendor/bootstrap/js/dist/tab.js',
    // 'assets/vendor/bootstrap/js/dist/tooltip.js',
    'assets/vendor/bootstrap/js/dist/util.js',
    'assets/vendor/social-likes/src/social-likes.js',
    'assets/js/_*.js'
  ];

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.js',
        '!dist/js/scripts.min.js',
      ]
    },
    sass: {
      dev: {
        options: {
          style: 'expanded',
        },
        files: [{
          src: 'assets/scss/style.scss',
          dest: 'assets/css/style.css'
        }],
      },
      build: {
        options: {
          sourcemap: false,
          style: 'compact'
        },
        files: [{
          src: 'assets/scss/dist.scss',
          dest: 'assets/css/style.min.css'
        },{
          src: 'assets/scss/editor-style.scss',
          dest: 'dist/css/editor-style.min.css'
        }]
      }
    },
    copy: {
      fonts: {
        src: 'assets/vendor/font-awesome/fonts/*',
        dest: 'dist/fonts/',
        flatten: true,
        expand: true,
        filter: 'isFile'
      }
    },
    imagemin: {
      images: {
        files: [{
          expand: true,
          flatten: true,
          src: ['dist/img/*.{png,jpg,gif}'],
          dest: 'dist/img/'
        }]
      }
    },
    concat: {
      js: {
        src: [jsFileList],
        dest: 'assets/js/scripts.js',
        options: {
          separator: ';'
        }
      },
      css: {
        src: [
          'assets/css/theme.css',
          'assets/css/style.min.css'
        ],
        dest: 'style.css',
      }
    },
    uglify: {
      dist: {
        files: {
          'dist/js/scripts.min.js': [jsFileList]
        }
      }
    },
    postcss: {
      dev: {
        options: {
          processors: [
            require('autoprefixer')({browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']}),
          ]
        },
        files: [{
          src: 'assets/css/style.css',
          dest: 'assets/css/style.css'
        }],
      },
      build: {
        options: {
          processors: [
            require('autoprefixer')({browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']}),
            require('cssnano')({discardComments: {removeAll: true}})
          ]
        },
        files: [{
          src: 'assets/css/style.min.css',
          dest: 'assets/css/style.min.css'
        }],
      }
    },
    watch: {
      sass: {
        files: [
          'assets/scss/*.scss'
        ],
        tasks: [
          'sass:dev'
        ],
        options: {
          spawn: false,
        },
      },
      js: {
        files: [
          jsFileList,
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'concat:js']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'assets/scss/*.scss',
          'assets/js/scripts.js',
          '**/*.php',
          '*.php'
        ]
      }
    }
  });

  // Register tasks
  grunt.registerTask('init', [
    'copy',
    'dev'
  ]);
  grunt.registerTask('default', [
    'dev'
  ]);
  grunt.registerTask('dev', [
    'jshint',
    'sass:dev',
    'concat:js'
  ]);
  grunt.registerTask('build', [
    'copy',
    'jshint',
    'uglify',
    'sass:build',
    'postcss:build',
    'concat:css',
    'imagemin'
  ]);
};
