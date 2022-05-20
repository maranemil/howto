
```

################################################################################
The Authorization Code Grant is the most common authorization flow in OAuth2.
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_authorization_code
################################################################################

http://your.application.com/oauth2/callback?code=(authorization code)

curl -X POST -d 'grant_type=authorization_code&client_id=(your client id)&client_secret=(your client secret)&code=(authorization code)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

{
  "access_token": "(access token)",
  "refresh_token": "(refresh token)",
  "token_type": "bearer",
  "expires_in": 3600
}

Refreshing the Access Token (confidential clients)

curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&client_secret=(your client secret)&refresh_token=(refresh token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

Accessing the API

curl -H 'Authorization: Bearer (access token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/(api endpoint)

Refreshing the Access Token (native/mobile)
curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&refresh_token=(refresh token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token
```

```

################################################################################
HTTP Client in PhpStorm Overview
################################################################################
https://blog.jetbrains.com/phpstorm/2019/11/http-client-in-phpstorm-overview/
https://www.youtube.com/watch?v=n8KCuKhDSZY
https://www.jetbrains.com/help/phpstorm/exploring-http-syntax.html#use-multipart-form-data
https://www.jetbrains.com/help/phpstorm/http-client-in-product-code-editor.html#converting-curl-requests
```





