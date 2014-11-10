/* global module, require */
module.exports = function(grunt) {

  'use strict';

  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    bannerName: '/*! <%= pkg.name %> - v<%= pkg.version %> */',

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
          banner: '<%= bannerName %>',
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
          banner: '<%= bannerName %>'
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
          banner: '<%= bannerName %>'
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
          'assets/js/vendor.min.js': 'assets/js/vendor.js',
          'assets/js/app.min.js': 'assets/js/app.js',
        }
      }
    },

    imagemin: {
      optimize: {
        options: {
          optimizationLevel: 3
        },
        files: [{
          expand: true,
          cwd: 'src/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'assets/images/'
        }]
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
          baseDir: '.'
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
          'concat'
        ]
       }
    },

  });

  grunt.registerTask('default', [
    'browserSync',
    'watch'
  ]);

  grunt.registerTask('dev', [
    'browserSync',
    'compass:dev',
    'concat',
    'watch'
  ]);

  grunt.registerTask('build', [
   'compass:dist',
   'cssmin',
   'imagemin',
   'concat',
   'uglify'
  ]);
};