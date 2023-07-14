# UCLAN Merch API

This API is being created to provide the functionality of a training pseudo online merchandise store from my university, UCLan (University of Central Lancashire). This is part of the backend, the front is being implemented based on my gradually growing project [@limarkdl/frontend-main-practice-own](https://github.com/limarkdl/frontend-main-practice-own) in my repository on a private account [@limarkdl-private/uclan-merch-shop](https://github.com/uclan-merch-shop). The plans are to implement all the basic authentication functionality and go deeper to learn more about the internals in order to initially create secure and fast interfaces.

> **Note:** There is no sensitive data published, it's all hidden with .htaccess, .gitignore and other techniques.

## Structure


<pre><span style="color:#12488B"><b>.</b></span>
├── <span style="color:#12488B"><b>config</b></span>
│   └── Database.php
├── <span style="color:#12488B"><b>controllers</b></span>
│   └── UserController.php
├── <span style="color:#12488B"><b>models</b></span>
│   ├── Offer.php
│   ├── Order.php
│   ├── Product.php
│   └── User.php
├── <span style="color:#12488B"><b>public</b></span>
│   ├── <span style="color:#12488B"><b>api</b></span>
│   │   ├── <span style="color:#12488B"><b>delete</b></span>
│   │   │   └── index.php
│   │   ├── <span style="color:#12488B"><b>getAllUsers</b></span>
│   │   │   └── index.php
│   │   ├── <span style="color:#12488B"><b>login</b></span>
│   │   │   └── index.php
│   │   ├── <span style="color:#12488B"><b>logout</b></span>
│   │   │   └── index.php
│   │   └── <span style="color:#12488B"><b>signup</b></span>
│   │       └── index.php
│   ├── index.css
│   └── index.html
└── <span style="color:#12488B"><b>tests</b></span>
    └── <span style="color:#12488B"><b>Integration</b></span>
        ├── <span style="color:#12488B"><b>controllers</b></span>
        │   └── UserController.test.php
        ├── <span style="color:#12488B"><b>Database</b></span>
        │   └── getConnection.test.php
        └── Report.php
</pre>


## Methods

![Methods Image](about/Methods.png)

## Functionality

![Functionality Image](about/Functionality.png)

## Report Example

![Report Image](about/Report.png)


