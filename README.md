nodb-blog
=========

A simple blogging platform without a database.

Features:

* Displays blog posts in time order.
* Supports tags.


TODO
========

* Create a way to add posts via a web interface.
* Create example site.
* Allow nodb_blog() to handle http GET vars and work out what to display depending on that instead of making the developer do it.
* Add option for folder display to show what folder is being displayed.
* Add function to display all tags in list form.



Installation
============

Installing nodb-blog is meant to be as simple as possible. That is the goal of the project after all!

First of all, you must have a website writtain in PHP and a web server which supports PHP.

Steps to installing are as follows:

* Clone nodb-blog's git repo into the same directory as the index page of your website (commonly /var/www/)
* Create the folders "posts" and "tags" in the same directory as the nodb-blog folder.
* Add include directives to nodb-blog/src/php/blog.php onto every page you wish to display content from a nodb-blog on.
* Add calls to the function nodb-blog() to the pages where you wish to display blog content. You should put this call inside a <div> tag because nodb-blog does not style its self.
The following is a list of parameters you can give the nodb-blog function to get it to output different content:
 
  * calling nodb_blog(1, "") or nodb_blog("blog","") = displays all posts, takes max posts as as second, optional argument. If no second argument is passed all posts found are displayed.
  * calling nodb_blog(2, "") or nodb_blog("folder", "") =  displays a list of posts in any given folder. The folder to display is given by http GET vars dir, or tags. If the var "dir" is used, then the directory is taken as a subdirectory of the posts_dir defined in the config file.
  If the var "tag" is used then the folder is taken as a subdirectory of the tags directory as defined in the config file. If both dir and tag GET vars are empty, the the function just displays all posts it can find in the default post directory.
  * calling nodb_blog(3, "") or nodb_blog("post", "") = Displays a specific post given as a second argument. The post name must be the full file name. 

* You must have a page which has the appropriate nodb_blog() to be able to handle taking a specific post as an http GET var, or a folder name and being able to display the folder or post as when posts are displayed they will link back to that page.
* Explore the file nodb-blog/src/php/conf.php and set the settings there to what you would like.
  
