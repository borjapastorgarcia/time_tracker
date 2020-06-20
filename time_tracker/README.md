# Time Tracker
Welcome to a simple time tracker, please read this documentation before start.

#### Requirements:
- php ^7.1
- composer


##### First steps before start:

This project has docker so you have to throw next command to run it.

```
docker-compose up -d
```
And next configure your .env file with the mysql access information, and throw 'task.sql' to create the tables in time_tracker database.

```
composer install
```

## Use guide

There are two different pages.  
On the one hand we have the 'home page',
which allow us to create new task or stop the current task.On the other hand, we have the 'task list page'
 where we can see a list of all the tasks we have created.

## Commands

We have two commands in this application:

```
bin/console TimeTracker:ManageTasks
```
that needs an action ('start' or 'stop') and a the name of the task.

```
bin/console TimeTracker:ResumeTasksCommand
```
that returns a list of all the tasks.

#### Potential improvements

- Create ValueObjects
- Create Tests
- Create Custom exceptions
- Implement endpoints and use ajax in forms instead of Symfony Native Forms.
