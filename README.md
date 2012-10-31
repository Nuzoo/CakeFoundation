CakeFoundation
==============

* CakePHP 2.2.3 with Foundation CSS 3.2 'baked' in.

* This is a bare-bones configuration of CakePHP with Foundation CSS Framework in place for all your layout and views.
I've also included basic AppModel and AppControllers along with UserController to have initial user authentication 
in place and working.  Just import users.sql into your MySQL server.  

* You'll have to allow unauthorized access to /users/add by editing the UserController's beforeFind() method.  
Just edit the line and include 'add' in the array.  Point your browser to /user/add and you should have a 
basic add user screen.  I've also included a login view as well.

* Go to http://yoursite/users/add to add your first user
