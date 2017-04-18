# Act Native
This is the PHP codebase of the Act Native project.

## Setup development environment
Run

    composer install

Also configure a new vhost in your webserver

    <VirtualHost *:8000>
        ServerName act-native.dev
        DocumentRoot "~/dev/act-native/public"
    </VirtualHost>

## Run the environment
Point your browser to http://act-native.dev:8000