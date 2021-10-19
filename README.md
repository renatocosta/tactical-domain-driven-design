# Sustainable Software Development

## Getting Started

This boilerplate gathering most of building blocks for Sustainable Software Development which are:
### Building blocks under Domain-Driven Design
```
Entity  
Aggregate  
Aggregate Root  
Value Objects  
Domain Services  
Repositories  
Domain Event  
Specification  
Policy
``` 
### Building blocks under Clean Architecture
```
Use cases  
Ports and Adapters  
``` 

## How To Use

```bash
# Clone this repository
git clone https://github.com/TidyDaily/sustainable-software-development.git

# Go into the repository
cd sustainable-software-development/Common/Framework
composer install

### Starting the Web Server
php -S localhost:8010 -t public

## Unit testing
```
Host Properties: ./vendor/bin/phpunit
```