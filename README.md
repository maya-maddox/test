# Challenge/Test

These challenges are based on a subsection of our main codebase, Swytch Tools. We have removed excess functionality to simplify your experience. The 3 tasks below are 3 small tasks which have been taken from our historic tasks & backlog to give an accurate representation of small pieces of work which we carry out and which can be achieved in a reasonable amount of time.

We don't expect the task to take more than 3 hours in total.

Please get in touch if you have any technical problems or queries. Note that some areas have been left deliberately vague and for you to use your best judgement on! We encourage you to use Google, the Laravel documentation and other resources to complete these tasks.

---


## 1. Upsell Pricing Data

### Task

Historically, our orders have come through a 3rd party system called CrowdOx. Some products have already been paid for (rewards), and some are sold as extras in CrowdOx (extras). 

Marketing would like some data to analyse the income from products which are upsold from CrowdOx. Currently we do not import this data. Your task is to modify the importer to collect this data and to add these incomes to the order line data viewer. We’d like to collect the product price, the shipping price, and the total price.



### Data

Pricing data is found at the order-line level. An example JSON order-line provided by crowdox is:
```json
{
    "id": "4468240",
    "type": "order-lines",
    "attributes": {
        "line-type": "extra",
        "price-data": {
            "type": "default",
            "prices": [
                {
                    "type": "product",
                    "reference": "product_bundle",
                    "amount_cents": 45000
                },
                {
                    "type": "shipping",
                    "reference": "product_bundle_shipping",
                    "amount_cents": 5000
                }
            ],
            "reference": {
                "date_added": 1575748344,
                "shipping_country_id": 1
            }
        },
        "sort-order": 2,
        "price-cents": 50000
    },
    "relationships": {
        "order": {
            "data": {
                "id": "2640641",
                "type": "orders"
            }
        },
        "project": {
            "data": {
                "id": "107029",
                "type": "projects"
            }
        },
        "product-bundle": {
            "data": {
                "id": "170212",
                "type": "products"
            }
        }
    }
}
```


An sqlite database is provided under `database/database.sqlite`. We recommend using a tool such as [https://sqlitebrowser.org/](https://sqlitebrowser.org/)  to have an explore of the database and its schema.



You can view the data which will be processed for the import in `storage\dummy-data\crowdox-orders-inclusive.json`. This represents an example response that we would get from the CrowdOx orders API. Note that this also includes all the order data, as-well as the order-line data.



If you need to refresh this database you can run:

`./vendor/bin/sail artisan migrate:fresh` to clear and recreate the database tables

`./vendor/bin/sail artisan import-jobs:crowdox-orders` to import the CrowdOx data

`./vendor/bin/sail artisan import-jobs:prepare-service-center` to import the service centre data



### Codebase

We have provided a small Laravel Application based of our larger Swytch Tools Application which imports some dummy CrowdOx data. You will need to:

- Modify the crowd_ox_order_lines table to add additional fields for pricing data
    - [https://laravel.com/docs/10.x/migrations](https://laravel.com/docs/10.x/migrations) Database Migrations

- Add the new fields to the CrowdOxOrderLine model
    - The model can be found in `app/CrowdOxOrderLine.php`

- Locate and save the new values in the converter
    - The converter can be found in `app/Ingestors/CrowdOx/Transformers/OrderLine.php`

- Modify the data table to show the correct fields
    - The data table can be viewed here [http://localhost/stores/crowdox/orderlines](http://localhost/stores/crowdox/orderlines)

Add columns for the new price data, and for the line type (extra/reward/manual)



### Running

#### Hosting

##### Hosting Locally with Sail

We recommend running the application using https://laravel.com/docs/10.x/sail, Laravel Sail. Laravel sail allows for very simple hosting of a Laravel application inside a default docker environment.

To get started, in the code repository, with docker installed on your Unix machine, run

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

To install the Laravel sail dependencies. 

Copy the `.env.example` file into `.env`

Next run `./vendor/bin/sail up` to boot the platform at `http://localhost`

You may need to run

`./vendor/bin/sail artisan key:generate` to create an application key

`./vendor/bin/sail artisan migrate` to run your database migration

`./vendor/bin/sail npm install` to install front-end dependencies

`./vendor/bin/sail npm run production` to compile the front-end components

`./vendor/bin/sail artisan test` to run the phpunit tests

##### Hosting Locally without Sail

To host locally without sail, you will need to copy the relvant files into your web root directory (e.g. `\var\www\html`). See [https://laravel.com/docs/10.x/deployment](https://laravel.com/docs/10.x/deployment) for more information on deploying

##### Hosting Remotely

If required, we can set up a server with Laravel Sail already set up and functioning for you. Please let us know if you require this.

#### Running the Importer

To run the importer, with sail up running in another terminal (or daemonized), run the command `./vendor/bin/sail artisan import-jobs:crowdox-orders`. This will run the import job.



---

## 2. Returns Log SKU Suggestions

### Task

The service centre is a part of the company which receives faulty or returned kits, diagnoses them, and repair, return to stock, or throw away as appropriate. The process is tracked using the ‘service centre returns log' as part of the wider Swytch Tools platform.

When kits are checked in, a SKU (Stock Keeping Unit, a unique identifier for a part or assembly) is saved to identify the kit which has been checked in. During the kit processing step, this SKU is broken into its component parts and each part is added as a component by the technician. The service centre team have tasked you with optimising this task. They’d like it so that the component parts of the SKU are auto-suggested.



### Reference

#### SKU Mapping

A typical Kit SKU may be something like `KIT-ECO-NAR-622-S`. This translates to an *ECO* Kit with a *NAR*row wheel of size *622*, in colour *S*ilver.

A typical powerpack (either standalone, or as part of a kit) has an SKU such as `PAC-ECO-NAR-349`. Powerpacks are identified by the size (*ECO* or *PRO*), and wheelsize they support (*NAR-349*). Powerpacks are split by wheel size because they also contain the controller. This controller is programmed for a specific wheelsize’s torque and speed map.

##### Example Kit SKUs

|        SKU        |    Power pack   |   Wheel   |
|:-----------------:|:---------------:|:---------:|
| KIT-ECO-NAR-349-S | PAC-ECO-NAR-349 | NAR-349-S |
| KIT-ECO-REG-559-B | PAC-ECO-REG-559 | REG-559-B |
| KIT-PRO-REG-622-S | PAC-PRO-REG-662 | REG-662-S |

##### Accessories

Products may also contain other accessories/component parts. A non-exhaustive list is:

- `BRACKET-V7` (the bracket which the power pack attaches on to)

- `PAS-UNI` (Universal pedal assist sensor)

- `PAS-BRO` (Brompton pedal assist sensor)

- `PLUG-EU` (EU Plug)

- `CHARGER-2A` (2Amp charging block)

- `THRO-THUMB` (Thumb throttle)

#### SKUs

A list of SKUs provided in the database under the skus table. An export can be found in the provided `storage/dummy-data/skus.json` file in the repository root. 



### Data

A list of the returns log is loaded into the provided sqlite database. We encourage you to use a database explorer such as [https://sqlitebrowser.org/](https://sqlitebrowser.org/) to explore the historic data. The relevant tables are:

- returns

- return_items

- skus



### Codebase

#### Backend

The backend is in Laravel and set up using an API framework. An method for retrieving the suggested SKUs has been started in `app/Http/Controllers/Api/Tools/ServiceCenter/ReturnsLog/ReturnsLogController.php` which is called at the URL `http://localhost/tools/servicecenter/1/returnslog/{returns_log_id}/edit` e.g. [http://localhost/tools/servicecenter/1/returnslog/1188/edit](http://localhost/tools/servicecenter/1/returnslog/1188/edit or [http://localhost/tools/servicecenter/1/returnslog/1228/edit](http://localhost/tools/servicecenter/1/returnslog/1228/edit),
which can be accessed from the returns log index [http://localhost/tools/servicecenter/1/returnslog/index](http://localhost/tools/servicecenter/1/returnslog/index)

#### Frontend

The frontend is in Vue.js and has been prewritten for you. `resources/js/Tools/ServiceCenter/ReturnsLog/ReturnComponents/TestingComponents.vue`

In the event you want/need to compile the frontend you will need to run `sail npm run dev`, or use `sail npm run watch` to keep the compiled front-end files continuously updated.



### Running

#### Hosting

If running locally, you may need to run `./vendor/bin/sail artisan import-jobs:prepare-service-center` to import data for the service centre.

#### Testing

This task is in the same codebase as before.

- Navigate to `http://localhost/tools/servicecenter/1/returnslog/index`

- Check-in a new item with a given kit SKU (e.g. `KIT-ECO-NAR-349-S`)

- Start processing the item

- (Your task) Auto-suggestions provided within the UI to fill suggested components.

---

## 3. Returns log bug fix

### Task

The service centre team have reported a bug which is preventing them from deleting item from the returns log. They have said that when they navigate to the `/edit` page for a returns log item and try to delete it, the item is not removed from the database. They have asked you to investigate and fix this issue.

### Running

This task is in the same codebase as before.

- Navigate to `http://localhost/tools/servicecenter/1/returnslog/index`

- Check-in a new item with a given kit SKU (e.g. `KIT-ECO-NAR-349-S`)

- Start processing the item

- (Your task) Fix the delete button so that it removes the item from the database


---

## Codebase Review

Congratulations! At Swytch one of our core values is constantly improving our process and procedures, from our products to logistics and finance, and from codebases to interviewing and assessment. Please take 5-10 minutes to help us by answering the following questions.

- If your first job was to improve this codebase as it currently is, what would you do?

I would fix a fatal bug with the Crowd Ox seeder (which I did [here](https://github.com/maya-maddox/test/commit/135a71aa00e21d5bc419d4b6921feec8963930a9)).

I would use template literals, instead of concatenating with `+` which can be difficult to read.

I would look for opportunities to replace `with()` with the more concise `compact()` when passing data to a view.

I would consider having multiple route files, instead of categorising them in a [single file](https://github.com/maya-maddox/test/blob/main/routes/web.php) with comments.

When you try to delete a selected SKU whilst processing a return, I would fix the delete button shifting when it asks for confirmation.

- If you had to re-create this codebase from scratch, what would you do differently?

It's a solid codebase from what I can tell from my limited experience with it, but if I **had** to answer this:

I would consider adding TypeScript for type safety, but there's an argument to be made that it's *another* thing to learn and could slow down development.

I would consider adding a tool like [Laravel Telescope](https://laravel.com/docs/11.x/telescope) to help with debugging, I tried to install it whilst debugging the Crowd Ox seeder but ran into issues around package versions.

- How did you find these tasks?

Pretty fun, the second task was the hardest. I'm still not sure what an order line is, either!

- Are there any areas of your programming you would have like to have been tested on but haven’t gotten to show yet?

For this position, I think Vue could've played a bigger role.

- Do you have any other projects you'd like to share with us to showcase your technical skills?

Unfortunately not.