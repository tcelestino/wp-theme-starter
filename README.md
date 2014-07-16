# WordPress Themes Starter

Scaffold to WordPress themes

#How to usage

```sh
git clone url-repo your-theme
cd your-theme
sudo npm install
sudo bower install
```

#Tecnologies

- [WordPress](http://wordpress.org/) - software you can use to create a beautiful website or blog
- [node js](http://nodejs.org/) - platform built on Chrome's JavaScript runtime for easily building fast, scalable network applications
- [Grunt](http://gruntjs.com/) - the javascript task runner.
- [bower](http://bower.io/) - a package manager for the web

#Grunt

##tasks

- [load-grunt-tasks](https://github.com/sindresorhus/load-grunt-tasks)
- [grunt-contrib-compass](https://github.com/gruntjs/grunt-contrib-compass)
- [grunt-contrib-cssmin](https://github.com/gruntjs/grunt-contrib-cssmin)
- [grunt-contrib-concat](https://github.com/gruntjs/grunt-contrib-concat)
- [grunt-contrib-uglify](https://github.com/gruntjs/grunt-contrib-uglify)
- [grunt-browser-sync](https://github.com/shakyShane/grunt-browser-sync)
- [grunt-contrib-watch](https://github.com/gruntjs/grunt-contrib-watch)

##How to usage grunt tasks

```sh
//development
cd your-theme
grunt develop
```

```sh
//build
cd your-theme
grunt develop
```

#Bower

- [modernizr](https://github.com/Modernizr/Modernizr)
- [jquery](https://github.com/jquery/jquery)

#Wordpress plugins

- [Force Regenerate Thumbnails](https://wordpress.org/plugins/force-regenerate-thumbnails/) - regenerate the thumbnails for your image attachments
- [YOAST WordPress SEO](https://yoast.com/wordpress/plugins/seo/) - write better content and have a fully optimized WordPress
- [Advanced Custom Fields](http://www.advancedcustomfields.com/) - create custom fields customizes

#Questions

* Porque está usando uma versão antiga do jQuery?

  Infelizmente, nem todos os clientes ou projetos que estamos envolvidos tem que rodar em browsers modernos. A versão mais atual do jQuery não mantêm suporte para as versões 6,7,8 do Internet Explorer. [Para maiores informações, clique aqui](http://jquery.com/download/)

#Features

* Gulp version
* Add [Travis](https://travis-ci.org/)

#Version
0.1.0