<p align="center"><img src="https://cloud.githubusercontent.com/assets/25624431/24885399/ed475422-1de9-11e7-9f83-6d4ab65a1a3c.png"></p>

## Maps for Change Event Map

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/Maps-For-Change/events-map)

Map for presenting data from events-etl and OSDI

## Getting Started

### Prerequisites
* Docker
* Node/NPM

### Setup
```
git clone git@github.com:Maps-for-Change/events-map.git
cd events-map
npm install
cp .env.example .env
docker-composer up
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

Visit http://0.0.0.0:8000

### Importing events
1. Create an account on the [management dashboard](http://0.0.0.0:8000/register) and 
2. Select format "events-etl"
3. Import from `http://dnb6leangx6dc.cloudfront.net/raw/indivisible.json`
4. Truncate & import

