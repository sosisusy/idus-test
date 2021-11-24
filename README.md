# idus-test
백패커(아이디어스) 테스트 과제

### 구성 환경
PHP 7.4  
Laravel 7.*  
Docker  


### 초기 세팅


```zsh
# 도커 환경 구동
docker-compose up -d

# PHP 패키지 설치
docker-compose exec php-fpm composer install

# 테이블 생성
php artisan migrate --seed
```
