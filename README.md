## Project requirements
- This project require install Docker

## Setting environment

### Run the following command to build the containers. Project will be available in http://localhost:8000/quotation:
- docker-compose up -d --build

### Enter to the app container and install the packages
- docker-compose exec app bash
- composer install

### Run migrations
- docker-compose exec app php artisan migrate



## Create credentials for API Token

A service has been created to facilitate adding users to test the API easily. To register, go to http://localhost:8000/api/auth/register and send a request with the following JSON:
```
{
	"name": "user_test",
	"email": "test@test.com",
	"password": "12345678"
}
```
Also, reeplace in the environment API_EMAIL_CREDENTIAL and API_PASSWORD_CREDENTIAL with the user email and password created and remember reemplace the .env with the content of .env.example which has all the env needed to run the project.

## API URL

### Get new API token
- Service: http://localhost:8000/api/auth/login
- Request
```
{
	"email": "test@test.com",
	"password": "12345678"
}
```

### Create quotation using the API
- Service: http://localhost:8000/api/quotation/save
- Request
```
{
	"age": "20,40",
	"currency_id": "EUR",
	"start_date": "2020-10-01",
	"end_date": "2020-10-30"
}
```

### Get all quotations
- Service: http://localhost:8000/api/quotation/all
- Request
```
{}
```
