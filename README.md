Welcome to my PHP MVC framework

This is a simple MVC framework for building web applications.

It's free and open-source.



Installation:

1 - First, download the source, or clone the repo and place it to your web server root directory

2 - create the database which is in `db` folder on the root of project

3 - rename `config-sample.php` to `config.php` and edit database configurations part inside it with your database data

    Note 1:) if you are using one of the linux distros, maybe you should edit the 'PROOT' constant on `config.php` file with your project root folder name.

    Note 2:) password for all default users is : 123456

Error Handling:

If the 'DEVELOPING_MODE' configuration on `config.php` file is set to true, full error details will be displayed in the browser, otherwise no error will be displayed.



and Word of the end:

this framework is mostly based on my personal experiences on web development.
i used of many tutorials and similar projects and patterns to build this framework.
specially 'MVC PHP Framework' youtube tutorial from 'curtis parham' (link: https://www.youtube.com/watch?v=rkaLJrYnpOM&list=PLFPkAJFH7I0keB1qpWk5qVVUYdNLTEUs3)
