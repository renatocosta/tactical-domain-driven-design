# Sustainable Software Development

## Getting Started

This boilerplate consider most of building blocks for Sustainable Software Development which are:
### Building blocks under Domain-Driven Design
![Image](Common/assets/DDDBuildingBlocks.png?raw=true)

[Entity](Domains/HostProperties/Domain/Model/Property)  
[Aggregate](Domains/HostProperties/Domain/Model/Property)  
[Value Objects](Domains/HostProperties/Domain/Model/Property)  
[Domain Services](Domains/HostProperties/Domain/Services)    
[Repositories](Domains/HostProperties/Domain/Model/Property)    
[Domain Events](Domains/HostProperties/Domain/Model/Property/Events)  
[Specification](Domains/HostProperties/Domain/Model/Property/Specifications)  
[Policy](Domains/HostProperties/Domain/Model/Property/Policies)

### Building blocks under Clean Architecture
![Image](Common/assets/clean-architecture.png?raw=true)

[Use Cases or Ports](Domains/HostProperties/Application/UseCases)  
[Adapters](Domains/HostProperties/Interfaces)  
  

## How To Use

```bash
# Clone this repository
git clone https://github.com/TidyDaily/sustainable-software-development.git

# Go into the repository
cd sustainable-software-development/Common/Framework
composer install

### Starting the Web Server
php -S localhost:8010 -t public
```

## Unit testing
```
Host Properties: ./vendor/bin/phpunit
```