# Documentation

This is a sample theme starter for Wordpress using Grunt & Bower.

Within the theme directory, you'll find a directory called `assets`, which contains all the front end assets.

Also, the theme directory contains a directory `inc`, which contains all the included files for the back end. It is optional to define custom post types in `inc/post-types.php` if you want to use Easy Post Types instead. However, it is highly recommended to use [Advanced Custom Fields](http://wordpress.org/plugins/advanced-custom-fields) (ACF) to define custom fields rather than Easy Post Types. ACF is significantly more powerful for that purpose.

## Back End Development

Within the theme directory, you'll find a directory called `inc`, which defines all the Wordpress defaults. These defaults include the Wordpress theme supports definitions, rewrite rules, thumbnail support, loading static assets via WP functions, and many others.

As well, in the `inc` directory you'll find a Template class, `template.php`. This class defines static methods that are used to provide commonly needed markup or functionality through out the theme.


## Front End Development

Javascript assets are provided by Grunt and Bower, and both Javascript and CSS assets are compiled and minified by Grunt. To edit CSS or Javascript, you'll need to install both Grunt and Bower. They each require installation of [nodeJS](http://nodejs.org/). 

Before you start, if you are using a Windows machine for this, you have to have Git installed so that it uses the Windows command line. You'll see an option in the Git GUI setup process to allow it to use Window CLI - you want that option selected! If you're using OSX, linux, or a Vagrant box inside Windows, you don't have to worry about this because Git uses CLI be default.

If this is your first time using Grunt and Bower, you'll need to install them. First, install Grunt:


```
#!bash
npm install -g grunt-cli
cd THEME_DIRECTORY
npm install grunt --save-dev

```
Now install Bower:

```
#!bash
npm install -g bower

```

If this is your first time editing the project, you'll need to install all the project's Grunt modules. You can do that by navigating to the theme directory, and running `npm install`. This installs all the dependencies which are defined in the `package.json` file. 

### Editing CSS 

SCSS and CSS files are located in the `assets` directory.

To edit CSS, simply run `grunt watch` after navigating to the theme directory. This command compiles & minifies files in the SCSS directory. 

Though you can run `compass compile` directly, you should never have to do that. Also, there is a `grunt compass` command that will only compile SCSS.

`grunt watch` is the basic command for compiling / watching files, as well as integrating with LiveReload:

[Firefox](http://feedback.livereload.com/knowledgebase/articles/86242-how-do-i-install-and-use-the-browser-extensions-) and [Chrome](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=en) have LiveReload extensions available. The `grunt watch` command will fire live reload, so that if you have the plugin installed, you'll get automatic pages refreshes after editing SCSS and Javascript source files. It's not required to use, but available if you want to.

To use Live Reload, simply start the watch command using `grunt watch`, then go back to your browser window and activate the plugin.

CSS files are added to the theme markup using Wordpress's [wp_enqueue_style](http://codex.wordpress.org/Function_Reference/wp_enqueue_style) function. You can see this in `inc/styles.php`. You should never add stylesheets directly in template files, adding them to `inc/styles.php` instead. Wordpress contains a huge list of [conditional tags](http://codex.wordpress.org/Conditional_Tags) so you can even include stylesheets only on pages that need them, if desired.

### Editing Javascript

The theme root contains a `Gruntfile.js` which defines all the grunt processes. You'll see one of these processes called `uglify` and that process defines which Javascript files are compiled, concatenated and minified.

The `grunt watch` command performs javascript actions and emits Live Reload, but you can call the uglify command directly by running `grunt uglify`. Both these commands build up the Javscripts in the `assets/js/source` directory and puts the compiled versions in the `assets/js/build` directory.

Just like with CSS, the Javascript files are included in the theme via the `inc/scripts.php` file. The Wordpress function [wp_enqueue_style](http://codex.wordpress.org/Function_Reference/wp_enqueue_script) is used for this, and [conditional tags](http://codex.wordpress.org/Conditional_Tags) are used to load per page javascripts.

### Adding New Javascript

Javascript is always added or edited in the `assets/js/source` directory. Add your custom javascript or plugin into this directory.

To search bower for a plugin, for example to create a slideshow:

```
#!bash
bower search slideshow

```
This command returns a list of modules using the keyword "slideshow." You can search by plugin title too, if you're looking for a popular one like select2. After you find the one you want, install it like this:

```
#!bash
bower install my-perfect-plugin

```
This command pulls in the plugin (usually from a Github repository), and deposits it into the `assets/js/source` directory. Your days of manually finding plugins and dependencies are over!

After installing the plugin from bower, just add the relevant Javascript files to one of the Grunt tasks. Build out the Javascript using `grunt uglify` or `grunt watch`.

Get rid of the plugin using `bower uninstall plugin-name`.

### Image optimization

A basic image optimization task is included in the Grunt file as well. From the theme directory, run `grunt imagemin`, and images within the `assets/images` directory will get optimized. It's probably best to do this after SCSS is compiled, if there is a sprite generated by Compass in there. It's not necessary to use this task at all; it's just an added bonus.

### Changing or Adding Grunt tasks

There are dozens of Grunt task integrations available. For example, if you wanted to use YUI instead of Uglify for javascript minification / contactentation, just switch out the uglify dependency in `package.json` with the [YUI version](https://npmjs.org/package/grunt-yui-contrib). Make sure to reinstall dependencies after changing any! `npm install`

There are many options available for Grunt tasks. For example, you can [generate a new Git tag and push it to your remote](https://npmjs.org/package/grunt-git-remote-tag). Or, maybe you'd like to [document PHP](https://npmjs.org/package/grunt-phpdocumentor).