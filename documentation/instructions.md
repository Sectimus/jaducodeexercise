# Instructions

This project can be run on either bare-metal or containerized via docker.

## Run with Docker

### Prerequisites
Before you begin, ensure you have met the following requirements:
- Docker installed on your local machine.
- Docker-compose installed on your local machine *(optional)*.

### Installation
To build and run the Docker container for this project, follow these steps:

1. Clone the repository to your local machine:
    ```sh
    git clone git@github.com:Sectimus/jaducodeexercise.git
    ```

2. Navigate to the project directory:
    ```sh
    cd jaducodeexercise
    ```

3. Build the Docker container using the Dockerfile for the symfony service:
    ```sh
    docker-compose build
    ```

4. Start the Docker container using docker-compose:
    ```sh
    docker-compose up -d
    ```

## Run locally

If you prefer to build and run the project without Docker, you can follow these steps to set up your local environment:

### Prerequisites
Before you begin, ensure you have met the following requirements:
- PHP 8.3 installed on your local machine.
- Apache web server installed and configured.
- Composer installed on your local machine.

### Installation
To build and run the project locally, follow these steps:

1. Clone the repository to your local machine:
    ```sh
    git clone git@github.com:Sectimus/jaducodeexercise.git
    ```

2. Navigate to the project directory:
    ```sh
    cd jaducodeexercise
    ```

3. Install dependencies using Composer:
    ```sh
    composer install
    ```

4. Set up Apache configuration:
    - Copy the `apache.conf` file to your Apache configuration directory.
    - Update the Apache configuration to point to your project directory if needed.
    - Ensure URL rewriting is enabled

5. Start Apache web server:
    - Start or restart Apache web server to apply the new configuration.

6. Access the application:
    1. Start the symfony web application with `symfony server:start`, additionally you can stop with `symfony server:stop`
    2. Once Apache is running, you can access the application by navigating to `http://localhost:8080` in your web browser. You should be welcomed by a default symfony landing page. This application is developed as an API and as such, does not offer a friendly GUI as it was not within scope of the project.

## Usage
Once the application is running, you can interact with it using an API development tool like [Postman](https://www.postman.com/) - There is a provided collection within the repository: [jaducodeexercise.postman_collection.json](/jaducodeexercise.postman_collection.json) that you can use to import some handy prewritten requests.

### Palindrome
POST `http://{{host}}:{{port}}/palindrome/validate` - The provided JSON body should include a "word" key.
EX.:
```
{
    "word": "anna"
}
```

> The word: "anna" is a palindrome.


```
{
    "word": "Bark"
}
```

> The word: "Bark" is NOT a palindrome.

### Anagram
POST  `http://{{host}}:{{port}}/anagram/validate` - The provided JSON body should include the keys: "word" and "comparison"
EX.:
```
{
    "word": "coalface",
    "comparison": "cacao elf"
}
```

> The word: "coalface" is an anagram of "cacao elf".


```
{
    "word": "coalface",
    "comparison": "dark elf"
}
```

> The word: "coalface" is NOT an anagram of "dark elf".

### Pangram
POST  `http://{{host}}:{{port}}/pangram/validate` - The provided JSON body should include a "phrase" key.
EX.:
```
{
    "phrase": "The quick brown fox jumps over the lazy dog"
}
```

> The phrase: "The quick brown fox jumps over the lazy dog" is a pangram.


```
{
    "phrase": "The British Broadcasting Corporation (BBC) is a British public service broadcaster."
}
```

> The phrase: "The British Broadcasting Corporation (BBC) is a British public service broadcaster." is NOT a pangram.

## Testing
All test cases are grouped as either `unit` or `integration`. Both types of tests can be run sequentially via:
```
php bin/phpunit
``` 
### Unit tests
If you want to just execute unit tests:
```
php bin/phpunit --group unit
```
### Integration tests
If you want to just execute integration tests:
```
php bin/phpunit --group integration
```


## License
This project is licensed under the [MIT License](/LICENSE).
