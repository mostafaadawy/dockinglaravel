<h1 style="font-size: 200px; text-align: center">  Step By Step Laravel API and Docker </h1>
 <img src="https://user-images.githubusercontent.com/43582900/220145262-be67808d-fd31-444f-ab83-695931de7a29.png" alt="Paris" class="center"> 

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Using Docker with Laravel
in this project we will create rest api application based docker

we can do this in many ways the most forwarded is to use `curl -s https://laravel.build/example-app | bash` asd explained in laravel [documentation](https://laravel.com/docs/9.x/installation#laravel-and-docker)

we  will use other methodology which is step by step

- create new laravel project `composer create-project laravel/laravel dockinglaravel`
- to dock our laravel project we can make it using `docker-compose.yml` and creating `dockerfile`then use `docker-compose up` or we can use sail package to help us docking our project
- we will use [sail](https://laravel.com/docs/9.x/sail) where it is not prevented using normal docking methods and it helps us creating template for our project 
- require sail `composer require laravel/sail --dev`
- After Sail has been installed, you may run the sail:install Artisan command. This command will publish Sail's docker-compose.yml file to the root of your application `php artisan sail:install`
- it require from us to select which actually the required services beside web from database mysql redes or other for our issue we select mysql `0`
- also .env will be edited to have the connection with database service
- now we can use sail to compose up our docker Finally, you may start Sail. To continue learning how to use Sail, please continue reading the remainder of this documentation: `./vendor/bin/sail up`
- it doesn't work over gitbash terminal even it gives `Unsupported operating system [MINGW64_NT-10.0-19045]. Laravel Sail supports macOS, Linux, and Windows (WSL2).`
# important for sail on windows
- to solve this problem we can install ubuntu inside windows as wsl from microsoft store 
- the only  issue is that we have to use ubuntu terminal 
- from terminal after installing ubuntu `ubuntu2204`

other problem is that the path of terminal is not the seen our project

- the solution is to `pwd and ls` to configure where are we then return to the root then enter the hard disk `mnt` to reach to our project directory as shown
```sh
cd ../../
cd mnt/c/wamp/www/dockinglaravel/
./vendor/bin/sail up
```

after sailing up we got the third problem `Attaching to dockinglaravel-laravel.test-1, dockinglaravel-mysql-1 Error response from daemon: Ports are not available: exposing port TCP 0.0.0.0:3306 -> 0.0.0.0:0: listen tcp 0.0.0.0:3306: bind: Only one usage of each socket address (protocol/network address/port) is normally permitted.`

- the solution is to change this port from 3306 to 3307 in `env` and `docker-compose.yml`

# important note
- from this point and previous points we will work on ubuntu terminal

# complete the project
- solving to open the browser we can't use `0.0.0.0:80` link redirection from terminal but instead use `localhost:80` instead 
- second when we open the browser to our site we found error need of key generation
- we can solve this issue by `php artisan key:generate`

# [DevContainer](https://docs.github.com/en/codespaces/setting-up-your-project-for-codespaces/adding-a-dev-container-configuration/introduction-to-dev-containers) 
-If you would like to develop within a Devcontainer, you may provide the `--devcontainer` option to the sail:install command. The `--devcontainer` option will instruct the sail:install command to publish a default .devcontainer/devcontainer.json file to the root of your application:`php artisan sail:install --devcontainer`
- but what is `Devcontainer` it is a container for development environment for more reading [DevContainer](https://docs.github.com/en/codespaces/setting-up-your-project-for-codespaces/adding-a-dev-container-configuration/introduction-to-dev-containers)

# FOrget service and want to add
`php artisan sail:add` and select the service then publish

# Configuring A Shell Alias
However, instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a shell alias that allows you to execute Sail's commands more easily:`alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'` To make sure this is always available, you may add this to your shell configuration file in your home directory, such as ~/.zshrc or ~/.bashrc, and then restart your shell.

Once the shell alias has been configured, you may execute Sail commands by simply typing sail. The remainder of this documentation's examples will assume that you have configured this alias: `sail up`

so now ctrl c  to shut down sail in ubuntu terminal then in ubuntu search in home files for `~/.bashrc` and add this line `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`

this can't be found in home by `ls` but you can find it by `ls -al` to see hidden files

```sh
vim .bashrc
```

add by insert button

```sh
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

use esc then `:wq` to save and write then `exit` 
- may need to start terminal many time till see the docker may also needs docker desktop to be up and ruining 
- now we can use `sail up` instead of `vendor/bin/sail`
- To start all of the Docker containers in the background, you may start Sail in "detached" mode: `sail up -d`
- To stop all of the containers, you may simply press Control + C to stop the container's execution. Or, if the containers are running in the background, you may use the stop command: `sail stop`

# [Executing Commands](https://laravel.com/docs/9.x/sail)

- When using Laravel Sail, your application is executing within a Docker container and is isolated from your local computer. However, Sail provides a convenient way to run various commands against your application such as arbitrary PHP commands, Artisan commands, Composer commands, and Node / NPM commands.
- When reading the Laravel documentation, you will often see references to Composer, Artisan, and Node / NPM commands that do not reference Sail. Those examples assume that these tools are installed on your local computer. If you are using Sail for your local Laravel development environment, you should execute those commands using Sail:`sail artisan queue:work` instead of `php artisan queue:work` the onlu defference is that when using sail we use php on our isolated container while in the typical case we use our php on our machine
- to check the php version we often need to open and sail up in ubuntu terminal and do not forget the path `cd ../../mnt/c/wamp/www/dockinglaravel/` then and keep docker desktop opened and if not work `exit` and open the terminal again where it sometimes needs restart and `exit` in our terminal may permit this. then in other terminal use `sail php --version` to check the docker php version 
- to execute `composer` command to add package in our project docker we can prefix the composer command by `sail` such as `sail composer require laravel/sanctum`

# for more sail commands and more information [read more](https://laravel.com/docs/9.x/sail)
- we can also write `sail` in our terminal to see sail commands that we can use where sail will detect the environment which in our case is laravell and write the helper commands
```sh
mostafa@DESKTOP-4OCKN06:/mnt/c/wamp/www/dockinglaravel$ sail
Laravel Sail

Usage:
  sail COMMAND [options] [arguments]

Unknown commands are passed to the docker-compose binary.

docker-compose Commands:
  sail up        Start the application
  sail up -d     Start the application in the background
  sail stop      Stop the application
  sail restart   Restart the application
  sail ps        Display the status of all containers

Artisan Commands:
  sail artisan ...          Run an Artisan command
  sail artisan queue:work

PHP Commands:
  sail php ...   Run a snippet of PHP code
  sail php -v

Composer Commands:
  sail composer ...                       Run a Composer command
  sail composer require laravel/sanctum

Node Commands:
  sail node ...         Run a Node command
  sail node --version

NPM Commands:
  sail npm ...        Run a npm command
  sail npx            Run a npx command
  sail npm run prod

Yarn Commands:
  sail yarn ...        Run a Yarn command
  sail yarn run prod

Database Commands:
  sail mysql     Start a MySQL CLI session within the 'mysql' container
  sail mariadb   Start a MySQL CLI session within the 'mariadb' container
  sail psql      Start a PostgreSQL CLI session within the 'pgsql' container
  sail redis     Start a Redis CLI session within the 'redis' container

Debugging:
  sail debug ...          Run an Artisan command in debug mode
  sail debug queue:work

Running Tests:
  sail test          Run the PHPUnit tests via the Artisan test command
  sail phpunit ...   Run PHPUnit
  sail pest ...      Run Pest
  sail pint ...      Run Pint
  sail dusk          Run the Dusk tests (Requires the laravel/dusk package)
  sail dusk:fails    Re-run previously failed Dusk tests (Requires the laravel/dusk package)

Container CLI:
  sail shell        Start a shell session within the application container
  sail bash         Alias for 'sail shell'
  sail root-shell   Start a root shell session within the application container
  sail root-bash    Alias for 'sail root-shell'
  sail tinker       Start a new Laravel Tinker session

Sharing:
  sail share   Share the application publicly via a temporary URL

Binaries:
  sail bin ...   Run Composer binary scripts from the vendor/bin directory

Customization:
  sail artisan sail:publish   Publish the Sail configuration files
  sail build --no-cache       Rebuild all of the Sail containers
mostafa@DESKTOP-4OCKN06:/mnt/c/wamp/www/dockinglaravel$
```
# Now after we prepared our docker lets start the API app
- create model controller faker and migration in one step for Customer `php artisan make:model Customer --all`
- the previous line will make it by the power of our local machine php and according to its version while to use the docker php we have to use `sail artisan make:model Customer --all`
- the result
```sh
mostafa@DESKTOP-4OCKN06:/mnt/c/wamp/www/dockinglaravel$ sail artisan make:model Customer --all
Model created successfully.
Factory created successfully.
Created Migration: 2023_02_18_121629_create_customers_table
Seeder created successfully.
Request created successfully.
Request created successfully.
Controller created successfully.
Policy created successfully.
mostafa@DESKTOP-4OCKN06:/mnt/c/wamp/www/dockinglaravel$ 
```
- we can do the same for Invoice
- create hasmany invoices in model
- create customer belongsto invoice in Customer model
- edit migration customer
- edit migration invoice
- edit factory  customer
- edit factory invoice
- edit seeder  customer
- edit database seeder call
```sh
$this->call([
            CustomerSeeder::class,
        ]);
```
# important notes related to mysql service sticking

|problem|cause|solution|
|--|--|--|
|the problem is that docker is not running|docker desktop is not running|start it and permanent solution it to make it start with windows|
|sail is not located|our current directory is not the project|cd ../../mnt/c/wamp/www/dockinglaravel/|
|migration failed connection failed|port 3306 is busy|we tried many solutions first change the port in `docker-compose.yml` and it `does not work` the `solution was` to remove mysql installation and use only wamp services on other port except 3306 and for avoiding any interfere we exit wamp but keep it installed for other undocked projects|
sail down --rmi all -v

# return back to project
- we migrate the data and importing seeds `sail artisan migrate --seed`
- editing typo error in customer faker
# developing api
- it is recommended to have multiple versions where old users use 
- create folder api
- create folder v1 for version 1
- editing the name spaces and paths according to our changes in voice and customer controller 
- create the rout in api.php in route 
- solving error as we use `'namespace'=>'App\Http\Controllers\Api\V1'` we shouldn't use controllers as import
- the convention of api json is camel case
- removing created at and updated at Extra Fields from model
- authentication also is required
- laravel gives us something called resource that allow us to transform an eloquent model to api json `sail artisan make:resource V1\customerResource` with two notes first sail can be replaced by `php` for normal projects withouts dockers. second we add `V1\` where it might be later changes for deferent versions
# note for me ubuntu pw is my normal pw
- solving error `sail artisan make:resource V1\customerResource` work for windows createing folder V1 and inside it create the file while in ubuntu it will not work right so instead we use `sail artisan make:resource V1/customerResource` with path or back slash 
- lets first implement our customer show method 
- now if we add `\id` to our link we get the customer data 
```sh
public function show(Customer $customer)
    {
        return $customer;
    }
```
- it is so simple when we pindling customer not id in our controller
- when we use our resource to return certain item/items check the CustomerResource change
```sh
 return [
            'id'=>$this->id,
        ];
```
- and use it in our show method 
```sh
  public function show(Customer $customer)
    {
        // return $customer;
        return new customerResource($customer);
    }
```
- so we filtered or change the data to the way we need through resource conversions
- editing other resource field as the figure we want it 
- we are explicitly put data in the shape we want and filter iit and this is the purpose of the resource
- same way we will create anther resource for index method `sail artisan make:resource V1/customerCollection` note that we replaced `Resource` with `Collection` where it is specific to deal with collection of objects/things
- thanks to auto add that if not exist we need to import use of class
- in controller 
```sh
 public function index()
    {
        // return Customer::all();
        return new customerCollection(Customer::all());
    }
```
- now if we checked our index link we will find that without defining the fields as we did for resource it is already flittered and converted and that is because it inherits its array from resource for the same controller model `class customerCollection extends ResourceCollection`
as we can see in customer collections it extends resource so we begin with the resource and it extends collection
- actually and by default if we just instead of `all` call `paginate` collection insert pagination 
- now in our browser we will find that we got theses new data for pagination
```sh
links	
    first	"http://localhost/api/v1/customers?page=1"
    last	"http://localhost/api/v1/customers?page=16"
    prev	null
    next	"http://localhost/api/v1/customers?page=2"
meta	
    current_page	1
    from	1
    last_page	16
links	
    0	
    url	null
    label	"&laquo; Previous"
    active	false
    1	
    url	"http://localhost/api/v1/customers?page=1"
    label	"1"
    active	true
    2	
    url	"http://localhost/api/v1/customers?page=2"
    label	"2"
    active	false
    3	
    url	"http://localhost/api/v1/customers?page=3"
    label	"3"
    active	false
    .
    .
    .
```
- so now in the link of our browser if we require page number 2 for example just call one of the allowed links `http://localhost/api/v1/customers?page=2`
- do the same thing resources and collection for invoice

# Now Lets use dynamic data /queries and Data filtering
# Step by Step Search and Adapt eloquent Query
- first of all lets understand what is the issue what is the objective
- In Api the url reading is an important issue it is not just routing to place but must be interpreted to handel the required data in order to forward the request represented in url to get the accurate data required
- taking link for search as an example and see how to transform it such as `http://localhost/api/v1/customers?postalCode[gt]=30000&type[%27eq%27]=I`
- the interpretation of this link as follows -> it is required to search for customers that has `postalCode` `greater than` `30000` and with `type` of `I` where `&` is used to add another filter on data and there is no or but for or we have to custom our request
- Search deferent from index and show
- how to parse and make system understand the request and how laravel helps in that issue
- we should do it in index function after defining a filter query that if it is none it just return all as the default of index and if not null return the the research filter after we transform it.
- create folder for services then create folder V1
- create file `CustomerQuery` class 
- this class should interpret the link and transform it to query argument `[['column','operator','value']]`
- array inside array where it will be collection
- class should contains `protected $safeParms` that contains in its key the field required and its value the `['eq']` or other required operator
class should also contains `columnMap` to map fields that has deferent names than in database and adjusted to match api conventions such as `postalCode` to `postal_code` 
- as we have mapper for columns with deferent names we should have mapper to map the value of the parameters for example`eq` to `=`
- finally with the help of these parameter key and value and its interpreters  mappers we can create transform  function
- the objective of transform function is to loop over our saved parameters keys -values and when it finds match uses the interpreters mappers to generate eloquent `column/field operator, and value`
- inside the loop searching for match inside the request to key and value in saved parameters if not found `continue` to skip and begin by other key and value that requires also another loop to loop inside the request then map all where argument and add it in the container array to contain all where in arrays to be executed by where array eloquent check the code
```sh
<?php
namespace App\Services\V1;
use Illuminate\Http\Request;
class CustomerQuery{
    protected $safeParms=[
        'name'=>['eq'],
        'type'=>['eq'],
        'email'=>['eq'],
        'address'=>['eq'],
        'city'=>['eq'],
        'state'=>['eq'],
        'postalCode'=>['eq','gt','lt'],
    ];
    protected $columnMap=[
        'postalCode'=>'postal_code',
    ];
    protected $operatorMap=[
        'eq'=>'=',
        'gt'=>'>',
        'gte'=>'>=',
        'lt'=>'<',
        'lt'=>'<=',
    ];
    public function transform(Request $request){
        $eloQuery=[];
        foreach($this->safeParms as $parm=>$operators){
            $query=$request->query($parm);
            if(!isset($query)){
                continue;
            }
            $column= $this->columnMap[$parm]??$parm;
            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[]=[$column, $this->operatorMap[$operator],$query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
```
- that is just example that means we have to adapt it by the same way to other requests shape 
- inside the controller index function we have to call the transform function check the code
```sh
 public function index(Request $request)
    {
        // return Customer::all();
        $filter = new CustomerQuery();
        $queryItems=$filter->transform($request); //[['column','operator','value']]
        if(count($queryItems)==0){
            return new customerCollection(Customer::paginate());
        }else{
            return new customerCollection(Customer::where($queryItems)->paginate());
        }

    }
```
- now we created a class that can implement a filter on a result
- we want to implement a class that not just can implement a filter for any other model such as invoice
- to make it globally lets first rename `Services` to `Filters` to not interfere with other services where services issues is not just filtering
- edit the path in controller and nameSpace in Customer Query
- we need a basic class to be extended for all query filter classes
- change the name of the class to customer filter
- note we can use `facade` or service to inject our filter base class in order to not insensate an object of the class ` $filter = new CustomerFilter();` but let it later 
- creating invoice filter take care no need for transform function where it is same in all and exists from extended ApiFilter
- add the same logics as in customer index function to invoice index function with the nesseceraly changes
- we can test it by the link `localhost/api/v1/invoices?status[ne]=P&amount[gte]=1000` will return invoices greater than 1000 and paid
- small error exists that when use the pagination filter not work where the auto generated link from pagination option is not contains the filter effect
- and to fix that we need to attach or append that return with the request query so we use this code 
```sh
public function index(Request $request)
    {
        $filter = new InvoiceFilter();
        $queryItems=$filter->transform($request); //[['column','operator','value']]
        if(count($queryItems)==0){
            return new InvoiceCollection(Invoice::paginate());
        }else{
            $invoices = Invoice::where($queryItems)->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }
```
- instead of that code
```sh
public function index(Request $request)
    {
        $filter = new InvoiceFilter();
        $queryItems=$filter->transform($request); //[['column','operator','value']]
        if(count($queryItems)==0){
            return new InvoiceCollection(Invoice::paginate());
        }else{
            return new InvoiceCollection(Invoice::where($queryItems)->paginate());
        }
    }
```
- so the link will be 1url	`"http://localhost/api/v1/invoices?status%5Bne%5D=P&amount%5Bgte%5D=1000&page=10"` instead of  `url	"http://localhost/api/v1/invoices?page=10"`
- fix the bug in customer also
- so the links will be edit to be `url	"http://localhost/api/v1/customers?postalCode%5Bgt%5D=30000&type%5B%27eq%27%5D=I&page=3"` instead of `url	"http://localhost/api/v1/customers?page=3"`
# How to include data such as Customers with their Invoices
