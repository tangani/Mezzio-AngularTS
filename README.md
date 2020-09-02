Three folders for three different applications.
1. Angular is currently being developed as the front end with a main application displaying projects and elements.
    
    1.1 The element's application is simply displays data hosted in the back end and does not require any user login.
    
    1.2 The Projects application requires authentication in every page the user goes to. {this functionality is still in development.}
    
2. The Mezzio Application folder contains a middleware that intercepts the user request, authenticates and displays data stored in the database. There are two main middleware sessions, one for elements and the other for projects. 
    
    2.1 Currently, the element's middleware does not make use of any authentication and there are open APIs for users.
    
    2.2 The project middleware allows reading and writing for user registration, login, and project reading. However, before designing the middleware  for editing the current projects, focus will be given to authentication on every page. {the pun is on code hosted on a public platform}
        
3. Valarcci application will be loaded as soon as possible as it will be for a separate standalone SPA which will also require its own middleware.

The Application uses Laminas instead of Zend as they are both the same thing on different versions. For more information visit [Official documentation].

[Me]: https://framework.zend.com/blog/2020-01-24-laminas-launch