# MVC Framework

This project is based on the material from the MVC course in the Web Programming Distance program at Blekinge Tekniska Högskola.

![How we learn to handle MVC frameworks](img/mvc.jpeg)

## Table of Contents

1. [Description](#description)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Configuration](#configuration)

## Description

The MVC course is designed to teach us about frameworks in web development. What we have learned previously is databases, design, and the code that connects them. The idea behind this course is to connect these elements, Model-View-Controller, which is communication between views, controllers, and database models. It serves as a summary and a way to tie together what we have learned throughout this academic year and build upon what we have learned.

## Installation

To get started with the project, follow these steps:

1. Clone this repository to your local machine using the following command:

    ```bash
    git clone git@github.com:racoontwo/mvc.git
    ```

2. Navigate to the cloned directory:

    ```bash
    cd mvc
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Configure the web server to point to the public directory (e.g., `public` or `htdocs` depending on the server configuration).

## Usage

Model:

- Represents data and business logic.
- Interacts with the database or other data sources.
- Typically implemented as PHP classes in Symfony.

View:

- Presents data to the user.
- Generates HTML, XML, JSON, etc., for the user interface.
- Implemented using Twig, a template engine in Symfony, to create reusable templates and integrate dynamic content.

Controller:

- Handles user requests and determines the appropriate response.
- Acts as an intermediary between the model and the view.
- Contains action methods corresponding to different user actions, coordinating the flow of the application and enforcing business rules.

Summary:
In Symfony's MVC framework, models encapsulate data and business logic, interacting with the database through Doctrine ORM. Views are responsible for presenting data to users, generating the necessary markup through Twig templates. Controllers serve as the traffic directors of the application, receiving user requests, processing inputs, and orchestrating the interaction between models and views. Together, these components facilitate a structured and organized approach to building web applications, promoting separation of concerns and maintainability. Through this architecture, Symfony provides a robust foundation for developing scalable and maintainable web applications.

## Prerequisites

Before getting started, make sure you have the following installed:

- PHP
- Composer
