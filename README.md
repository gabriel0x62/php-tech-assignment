# PHP Tech Assignment - CliqDigital :computer:

This is my proposed solution for the PHP Tech Assignment.

## Requirements

  - Docker

## Setup

For the first time setup it's necessary to create a Docker .env file. The two variables used in it are required during the Docker build to change the user and group id of the user in the container to match the host user; this allows files created in the docker environment to be read and writen on the host (and vice-versa) without encountering file permission issues.

```bash
cat >> .env.docker << TEXT
USER_ID=$(id -u)
GROUP_ID=$(id -g)
TEXT
```

The image can then be built using

```bash
docker compose --env-file .env.docker build
```

## Usage

Start the development env. The Docker container will listen on port 80: [http://localhost](http://localhost)
```
docker compose up
```

Install/update dependencies by running the command from the host
```
docker compose exec -u www-data handler composer install
```

Alternatively a bash shell can be opened on the guest to do the same and anything else
```
docker compose exec -u www-data handler bash
composer install
```

Code quality composer commands are available which can be run similarly to the `composer install` specification above. The integrated tools are PHPCodeSniffer (PSR12 coding standard), PHPMessDetector, PHPStan.

```
composer cs
composer md
composer stan
```

Tests can be run using
```
composer test
```

## Notes

- Was not sure of the main functionality required for the webhook, to collect the notifications as a webhook that would be called by external gateways or to generate the report periodically via some scheduler, so in `index.php` I implemented a very simple mechanism to save files POSTed to the webhook if running the solution in a server environment as above. The webhook requires better validation and error handling but since it didn't appear to be the main requirement I did not focus on this. The `NotificationHandlerService#handle` can still be verified using the tests or CLI logic or by uncommenting the code in `index.php`. Once the development server is running a file can be submitted via POST using curl:

```
curl -F rhcp=@payment-notifications/rhcp-gateway.xml http://localhost
curl -F nirvana=@payment-notifications/nirvana-gateway.xml http://localhost
```

- In order to not overengineer and to watch time the `NotificationHandlerService#handle` was left with hard class dependencies. In orther to achieve better decoupling and better testing support the main dependencies could be injected via the constructor later on. The `NotificationHandlerService#handle` method acts as a template method where the steps of the implementation come together. For potential reusability and scalability I chose to handle file read/writes in this method and encapsulate all other logic. `GatewayNotificationFactory` and `NotificationsReportGenerator` are thus potentially reusable. `GatewayNotificationFactory` could also use serialized input from the network.

- For simplicity `XmlSerializer` contains a slim implementation that only handles the first level of tags in a nested XML file since all the necessary properties are in this first level.

- Didn't get to write more tests for increased test coverage.

