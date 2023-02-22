<h1 style="font-size: 50px; text-align: center">  Step By Step Laravel API and Docker </h1>
 <img src="https://user-images.githubusercontent.com/43582900/220145262-be67808d-fd31-444f-ab83-695931de7a29.png" alt="Paris" class="center"> 

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
- solving error `sail artisan make:resource V1\customerResource` work for windows creating folder V1 and inside it create the file while in ubuntu it will not work right so instead we use `sail artisan make:resource V1/customerResource` with path or back slash 
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

- query parameters are separated but `&` and begins after `?` and if no filters just after `?` to be `?includeInvoices=true` where `?` is mean query
- so we can request other parameter such as `includeInvoices=true` after `$` such as `&includeInvoices=true` so the link become `http://localhost/api/v1/customers?postalCode%5Bgt%5D=30000&includeInvoices=true`
- in order to make clean code notre that `where([])` is same effect as no where so we can instead of checking for query to add where we can call where whicjh if null will not filter and  give the same result so instead of that code template that still needs including invoices
```sh
public function index(Request $request)
    {
        $filter = new CustomerFilter();
        $queryItems=$filter->transform($request); //[['column','operator','value']]
        if(count($queryItems)==0){
            return new customerCollection(Customer::paginate());
        }else{
            $customers = Customer::where($queryItems)->paginate();
            return new CustomerCollection($customers->appends($request->query()));
        }

    }
```
- we can use this that also calls invoices and clean code
```sh
public function index(Request $request)
    {
        $filter = new CustomerFilter();
        $filterItems=$filter->transform($request); //[['column','operator','value']]
        $includeInvoices= $request->query('includeInvoices');
        $customers = Customer::where([$filterItems]);

        if($includeInvoices){
            $customers=$customers->with('invoices');
        }
        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }
```
- including invoices is just use with to our eloquent and call the method in our model that join hasMany invoices to customer
- here we get that error when using `http://localhost/api/v1/customers?postalCode[gt]=30000&type[%27eq%27]=I&includeInvoices=true`
```sh
SQLSTATE[42S22]: Column not found: 1054 Unknown column '0' in 'where clause' (SQL: select count(*) as aggregate from `customers` where ((`0` = postal_code and `1` = > and `2` = 30000))) 
```
- that is because wrapping $filters in an array where it is acutely array it self 
# But Why we do not get the invoices with the customer?
- the reason is that the result collections that are send is controlled by the `CustomerResource` and `CustomerCollection` which not include 'invoice' in its returned fields od data as shown 
```sh
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'type'=>$this->type,
            'email'=>$this->email,
            'address'=>$this->address,
            'city'=>$this->city,
            'state'=>$this->state,
            'postalCode'=>$this->postal_code,
        ];
    }
```
- so we need to add `'invoices'` but what is the data that will be assigned to that key as value actually it is not value it is a function in invoice model o it will be `'invoices'=>InvoiceResource::collection($this->whenLoaded('invoices')),`
```sh

```
# adding invoices for the individual customers (show)
- before anything if we browse `http://localhost/api/v1/customers/5`  the result will be
```sh
data
    id	5
    name	"Stroman Group"
    type	"B"
    email	"santina.hahn@gmail.com"
    address	"806 Boyle Park Suite 378"
    city	"West Gracie"
    state	"South Dakota"
    postalCode	"19803-8714"
```
- no invoices even we try `http://localhost/api/v1/customers/5?includeInvoices=true` it will be the same result
- we will use `with` as before but with some deferences check the code first
```sh
  public function show(Customer $customer)
    {
        $includeInvoices= request()->query('includeInvoices');
        if($includeInvoices){
            return new customerResource($customer->loadMissing('invoices'));
        }

        return new customerResource($customer);
    }
```
- first of all we use `request()` instead of `$request` where we do not have here request argument so we can insert it or simply we can just use  request function `request()` as shown
- second what is `LoadMissing` it is [lazy eager loading](https://laravel.com/docs/5.5/eloquent-relationships#lazy-eager-loading) method that load the data from database just before usage while normal lazy loading as call it from model is call when called not before all of these are methods for loading database just as before usage and be ready as a bulk eager loading that reduce number of requests where it calls all bulk of data and work on it but requires large ram or just call when need lazy loading that require a lot of delayed time but low ram size or lazy eager that prepare data not all bulk but data before use for more information check laravel [docs](https://laravel.com/docs/5.2/eloquent-relationships)
- now we get the user with its invoices and if we don't want invoices just do not add `&includeInvoices=true`
# Creating Data with POst Method 
- for that issue we need `HTTP Client` to send requests so we can use `post man` or `http thunder` vscode extension
- we should create a request class to custom our request for api
- we will use `Customer::create($request->all())` by the eloquent model create power to store new record may be we return new Resource of that created data as response in store as follows
```sh
  public function store(StoreCustomerRequest $request)
    {
        return new customerResource(Customer::create($request->all()));
    }
```
- first to allow save in model we need to create `protected fillable array of that fields`
- if we our input argument request is standard request we need to `sail artisan make request V1/StoreCustomerRequest`
- custom request has two objectives the first is authentication and second is validation rules
- edit the file for auth and rules
- as i use thunder extension
- select POST method then Body then json then add 
```sh
{
  "name":"Mostafa Adawy",
  "type":"z",
  "email":"mostafa@laravel.com",
  "address":"124 cairo st",
  "city":"cairo",
  "state":"cairo",
  "postalCode":"124578"
}
```
- where `type` is error entry to check validation rules
- when error it returns index page when error 
- to not redirect and to see the error we have to modify our request `header` where in default in `accept` it accepts everything `*/*` so to see the returned messages we need to edit our header accept to `*/*` to be `application/json`
- now we can read the error return back massage and not redirected to index page
- here was the url was not for create we edited it to be `http://localhost/api/v1/customers/` so we get the result
```sh
{
  "message": "The given data was invalid.",
  "errors": {
    "type": [
      "The selected type is invalid."
    ]
  }
}
```
- when we write the right validated json we get the result
```sh
{
  "data": {
    "id": 231,
    "name": "Mostafa Adawy",
    "type": "I",
    "email": "mostafa@laravel.com",
    "address": "124 cairo st",
    "city": "cairo",
    "state": "cairo",
    "postalCode": "124578"
  }
}
```
# Updating with put and patch
- the deference between put and patch is put must apply all fields of the record while patch only apply the required field to be changed and for sure id is required in both cases
- in controller update both put and patch will be handel
- if we do not have our update custom request we create it using `sail artisan make request V1/UpdateCustomerRequest`
- it will based on fillable created for store and also on same rules we made for validation especially we didn't add uniqueness rule
- edit the include to match both put and patch
```sh
    public function rules()
    {
        $method= $this->method();
        if($method=="PUT"){
            return [
                'name'=>['required'],
                'type'=>['required', Rule::in(['I','B','i','b'])], //I individual B business
                'email'=>['required', 'email'],
                'address'=>['required'],
                'city'=>['required'],
                'state'=>['required'],
                'postalCode'=>['required'],
            ];
        }
        else{
            return [
                'name'=>['sometimes','required'],
                'type'=>['sometimes','required', Rule::in(['I','B','i','b'])], //I individual B business
                'email'=>['sometimes','required', 'email'],
                'address'=>['sometimes','required'],
                'city'=>['sometimes','required'],
                'state'=>['sometimes','required'],
                'postalCode'=>['sometimes','required'],
            ];
        }
    }
```
- where `sometimes` will validate according to the rules if exists
- and `$method= $this->method();` where `$this` returns to the request so calling its method to check it
- in thunder change the method from POST to put and change the data as we need
- do not forget to set the body json to the required change with same id
- our link have to be `http://localhost/api/v1/customers/231`
```sh
{
    "name": "Mostafa Ahmed Adawy",
    "type": "B",
    "email": "mostafaAdawy@laravel.com",
    "address": "1244 cairo st",
    "city": "new cairo",
    "state": "Cairo",
    "postalCode": "1245789"
  }
  ```
  - and request header to not redirect `accept` to `application/json`
  - method to `PUT`
  - result will 200
  - in order to test patch do the same but in json reduce it to the only require fields
  ```sh
  {
    "name": "Mostafa Adawy",
    "type": "I",
    "state": "Cai"
  }
  ```
- note remove the `,` in last json item it causes error in json may be php do not care but json care
- we get error
```sh
"message": "SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'postal_code' cannot be null (SQL: update `customers` set `name` = Mostafa Adawy, `type` = I, `state` = Cai, `postal_code` = ?, `customers`.`updated_at` = 2023-02-20 18:49:48 where `id` = 231)",
```
- that means also sometimes but prepareForValidation function merges that value to postal_code so it will be exited in patch even with null value when we do not send it and that is cause error in database where it must be not null it is not nullable the solution is to merge on
# Bulk Insertion
- for bulk insertion just as adding some invoices to certain customer
- first we need to add validation for that bulk of invoices same as we did for customer but with some deference some of them returns to invoice fields and others for the bulk or the array of data 
- first we create custom bulk request that uses prefix ` '*.`for the fields of validation when we have array of objects
- and in `prepareForValidation` because it is mre than one element to merge we have to create array to be merged
- check the code
```sh
<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // if our data of objects in data:[] so instead of *.filedName use data.*.filedName
        return [
            '*.customerID'=>['required','integer'],
            '*.amount'=>['required','numeric'],
            '*.status'=>['required', Rule::in(['P','B','V','p','b','v'])],
            '*.billedDate'=>['required', 'date_format:Y-m-d H:i:s','nullable'],
            '*.paidDate'=>['required', 'date_format:Y-m-d H:i:s','nullable'],
        ];
    }
    protected function prepareForValidation(){
        $data=[];
        foreach($this->toArray() as $obj){
            $obj['customer_id']=$obj['customerID']??null;
            $obj['billed_date']=$obj['billedDate']??null;
            $obj['paid_date']=$obj['paidDate']??null;
            $data[]=$obj;
        }
        $this->merge($data);
    }
}
```
- in invoice controller we need to create the function bulkStore
- use the custom request
- we can be fall in error where we will use method `insert(array)` and it defers from create where it is not neglected the redundant fields that are not fillable just as `billedDate paidDate customerId` while after merge we will have these and `billed_date paid_date customer_i_d` so to solve this issue we need to filter these fields by `map` and that can be done by converting to `collection` then remove unwanted fields then return to array
- check the code
```sh
public function bulkStore(Request $request)
    {
        $bulk= collect($request->all())->map(function($arr,$key){
            return Arr::except($arr,['customerId','billedDate','paidDate']);
        });
        Invoice::insert($bulk->toArray());
    }
```
- create rout `oute::POST('invoices/bulk',['sues'=>'InvoiceController@bulkStore']);` on api.php
- on thunder create post method header accept application/json body contains array of invoices with url `http://localhost/api/v1/invoices/bulk`
- body json
```sh
[{
        "customerId":	"1",
        "amount":	"4400",
        "status":	"B",
        "billedDate":	"2017-07-12 09:23:26",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"52444",
        "status":	"B",
        "billedDate":	"2015-04-27 18:37:12",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"9646",
        "status":	"P",
        "billedDate":	"2017-05-03 03:06:40",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"6266",
        "status":	"V",
        "billedDate":	"2016-05-30 19:47:28",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"7426",
        "status":	"P",
        "billedDate":	"2019-10-21 12:04:43",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"706",
        "status":	"P",
        "billedDate":	"2016-07-23 12:44:11",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"13984",
        "status":	"P",
        "billedDate":	"2018-11-06 07:35:43",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"18865",
        "status":	"P",
        "billedDate":	"2020-04-07 21:32:22",
        "paidDate":	"2018-11-06 07:35:43"
    },{
        "customerId":	"1",
        "amount":	"4324",
        "status":	"B",
        "billedDate":	"2017-12-07 23:15:15",
        "paidDate":	null
    },{
        "customerId":	"1",
        "amount":	"10957",
        "status":	"B",
        "billedDate":	"2022-11-22 05:35:15",
        "paidDate":	"2018-11-06 07:35:43"
}]
```
- when we try to induce an error like send null and string instead of integer to required fields we get msg to define where the error exactly
```sh
{
  "message": "The given data was invalid.",
  "errors": {
    "8.amount": [
      "The 8.amount must be a number."
    ],
    "5.billedDate": [
      "The 5.billedDate field is required."
    ]
  }
}
```
- where index begins from 0 
# Authentication with Sanctum
- sanctum token for an api authenticate and single page authentication
- it is easy to use
- sanctum is installed by default we can check our composer.json if not we need to require `composer require laravel/sanctum` it and publish it `sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"` to reach service provider `sail or php` docker or local machine then migrate `sail artisan migrate` to add tokens table 
# adding phpmyadmin service to docker
- check the code after update and notice the phpadminservice
```sh
# For more information: https://laravel.com/docs/sail
version: '3'
services:
    laravel.test:
        build:
            context: ./vendor/laravel/sail/runtimes/8.2
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: sail-8.2/app
        extra_hosts:
            - 'host.docker.internal:host-gateway'
        ports:
            - '${APP_PORT:-80}:80'
            - '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
        environment:
            WWWUSER: '${WWWUSER}'
            LARAVEL_SAIL: 1
            XDEBUG_MODE: '${SAIL_XDEBUG_MODE:-off}'
            XDEBUG_CONFIG: '${SAIL_XDEBUG_CONFIG:-client_host=host.docker.internal}'
        volumes:
            - '.:/var/www/html'
        networks:
            - sail
        depends_on:
            - mysql
    mysql:
        image: 'mysql/mysql-server:8.0'
        ports:
            - '${FORWARD_DB_PORT:-3306}:3306'
        environment:
            MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ROOT_HOST: "%"
            MYSQL_DATABASE: '${DB_DATABASE}'
            MYSQL_USER: '${DB_USERNAME}'
            MYSQL_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ALLOW_EMPTY_PASSWORD: 1
        volumes:
            - 'sail-mysql:/var/lib/mysql'
            - './vendor/laravel/sail/database/mysql/create-testing-database.sh:/docker-entrypoint-initdb.d/10-create-testing-database.sh'
        networks:
            - sail
        healthcheck:
            test: ["CMD", "mysqladmin", "ping", "-p${DB_PASSWORD}"]
            retries: 3
            timeout: 5s
    phpmyadmin:
        depends_on:
            - mysql
        image: phpmyadmin/phpmyadmin
        environment:
            - PMA_HOST=mysql
            - PORT=3306
        networks:
            - sail
        ports:
            - 9000:80

networks:
    sail:
        driver: bridge
volumes:
    sail-mysql:
        driver: local
```
- <p style="color:red"> note that it depends on mysql and we get ready maid image then we defined the environment host and port then the networks that connects all services together then it is by default connects to port 80 so we forward it to 9000</p>
- <p style="color:red"> note also we can instead of sail or docker-compose we can do container commends from docker desk top container select cli or terminal and now this terminal is called from our docker</p>

<img src="https://user-images.githubusercontent.com/43582900/220573678-efad7006-7132-42a2-9b96-05ae4a025ebc.jpg" alt="Paris" class="center"> 
<img src="https://user-images.githubusercontent.com/43582900/220573767-a5044ecd-9192-496d-be31-cfd2ab3c378d.jpg" alt="Paris" class="center"> 

# to access phpmyadmin from browser we need login
- from `.env` file that pass through mysql pw and username

|username|password|
|--|--|
|sail|password|

- to have token we should have user to make this in standard form using `composer require laravel/ui`to add user frontend interface for login and registration and `sail artisan ui vue --auth` then `migrate`
- then create user and then authenticate it 
- for simplest and just testing functionality we will add the user if not exists and if exists will authunatectate it and give him atoken and return it to use in `routes web.php` as follows
```sh
Route::get('/setup',function(){
    $credentials=[
        'email'=>'admin@dockinglaravel.com',
        'password'=>'password',
    ];
    if(!Auth::attempt($credentials)){
        $user=new \App\Models\User();
        $user->name='Admin';
        $user->email='admin@dockinglaravel.com';
        $user->password='password';
        $user->save();
    }else{
        $user=Auth::user();
        $adminToken=$user->createToken('admin-token',['create','update','delete']);
        $updateToken=$user->createToken('update-token',['create','update']);
        $basicToken=$user->createToken('basic-token');
    }
    return [
        'admin'=>$adminToken->plainTextToken,
        'update'=>$updateToken->plainTextToken,
        'basic'=>$basicToken->plainTextToken,
    ];
});
```
- we can see from the above code we create user and we can get its tokens
- if not created will create it for test
- we check if it is exist we create its token where we can define the permissions which will be every thing `'create','update','delete'` while nothing in basic we get the palintext of that token to be used with our sanctum middleware
- note that this creation function place is not in routes it have to be in controller login but this is for simplesity while the part of creation is in registration 
