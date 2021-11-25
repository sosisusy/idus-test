
# 환경 파일 복사
cp .env.example .env

# 도커 환경 구동
docker-compose up -d

# PHP 패키지 설치
docker-compose exec php-fpm composer install

# 어플리케이션 키 생성
docker-compose exec php-fpm php artisan key:generate

# 테이블 생성
docker-compose exec php-fpm php artisan migrate --seed
