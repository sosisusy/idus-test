# idus-test
백패커(아이디어스) 테스트 과제

### 구성
PHP 7.4  
Laravel 7.30.5  
MySQL 5.7  
NGINX  


### 환경 세팅
어플리케이션 구동 환경을 설정하기 위해서는 먼저 [도커](https://docs.docker.com/get-docker/)를 설치해주세요.
어플리케이션 구동 기본 환견은 로컬의 8080포트로 설정이 되어있습니다. 포트를 변경하고자 한다면 `.env` 파일 안의 `APP_PORT`를 수정해주시면 됩니다.

```zsh
sh ./setup.sh
```

### 테스트 회원
`/api/users` API 요청 권한은 테스트 회원에게만 주어집니다.
id: test  
pw: test123

### 접속 확인
<http://localhost:8080>  
<http://idus.test:8080>  

### API Documentation
<http://localhost:8080/api/docs>  
<http://idus.test:8080/api/docs>  
