# idus-test
백패커(아이디어스) 테스트 과제

### 구성
PHP 7.4  
Laravel 7.*  
MySQL 5.7  
NGINX  


### 환경 세팅
어플리케이션 구동 환경을 설정하기 위해서는 먼저 [도커](https://docs.docker.com/get-docker/)를 설치해주세요.

```zsh
# 도커 환경 구동
docker-compose up -d

# PHP 패키지 설치
docker-compose exec php-fpm composer install

# 환경 파일 복사
cp .env.example .env

# 어플리케이션 키 생성
php artisan key:generate

# 테이블 생성
php artisan migrate --seed
```
