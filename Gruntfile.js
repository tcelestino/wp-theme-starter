'use strict';
module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    banner_name: '/*! <%= pkg.name %> - v<%= pkg.version %> */',

    compass: {
      dev: {
        options: {
          sassDir: 'src/scss/',
          cssDir: 'src/css/',
          imagesDir: 'src/images/'
        }
      },

      dist: {
        options: {
          sassDir: 'src/scss/',
          cssDir: 'assets/css/',
          imagesDir: 'assets/images/',
          noLineComments: true
        }
      }
    },

    cssmin: {
      compile: {
        options: {
          banner: '<%= banner_name %>'
        },
        files: {
          'assets/site.min.css': [
            'assets/css/**/*.css',
            '!src/assets/css/normalize.css'
            ],
          'assets/css/normalize.min.css': ['src/assets/css/normalize.css']
        }
      },
    },

    concat: {
      union: {
        options: {
          stripBanners: true,
          banner: '<%= banner_name %>'
        },
        files: {
          'assets/js/app.js': [
          'src/js/**/*.js',
          '!/src/js/vendor/*.js'
          ],
          'assets/js/vendor.js': ['src/js/vendor/*.js']
        }
      }
    },

    uglify: {
      build: {
        files: {
          'assets/vendor.min.js': 'assets/js/vendor.js',
          'assets/app.min.js': 'assets/js/app.js',
        }
      }
    },

    browserSync: {
      server: {
        bsFiles: {
          src: [
          'src/css/**/*.css',
          'src/js/**/*.js',
          '**/*.php'
          ]
        },
        options: {
          watchTask: true,
          baseDir: "."
        }
      }
    },

    watch: {
      css: {
        files: ['src/scss/{,*/}*.{scss,sass}'],
        tasks: [
          'compass:dev', 
          'cssmin'
        ]
      },
      js: {
        files: [
          'Gruntfile.js', 
          'src/js/**/*.js'
        ],
        tasks: [
          'concat', 
          'uglify'
        ]
       }
    },

  });

  grunt.registerTask('default', [
    'browserSync', 
    'watch'
  ]);

  grunt.registerTask('dev', [
   'compass:dev',
   'concat',
   'watch'
  ]);

  grunt.registerTask('build', [
   'compass:dist',
   'cssmin',
   'concat',
   'uglify'
  ]);
}