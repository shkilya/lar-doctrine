#Lar doctrine

## Installation

### Declare Docker network
```bash
docker network create -d bridge --subnet 192.168.82.0/24 --gateway 192.168.82.1 lar_doctrine
```

### Docker Up
```bash
docker-compose up -d
```


### Composer install
```bash
./composer.sh install
```

### DB migration
```bash
./artisan.sh migrate
```


### MYSQL
```yaml
Host: 127.0.0.1
Port: 3310
User: developer
Pass: password
```
