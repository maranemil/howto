```

############################
API
############################

https://apitracker.io/a/datev
https://github.com/flowground/datev-accounting-documents-connector/blob/master/lib/spec.json
```

```

############################
Domain
############################

https://login.datev.de/openid/authorize
https://login.datev.de/openidsandbox/authorize
https://api.datev.de/token
https://sandbox-api.datev.de/token
https://domain/datev/api/
https://secure8.datev.de/
```

```

############################
Endpoints
############################

/accounting/v1/clients
/accounting/v1/clients/{client-id}/document-types
/accounting/v1/clients/{client-id}/documents
/accounting/v1/clients/{client-id}/documents/{document-id}
/accounting/v1/clients/{client-id}/fiscal-years/{fiscal-year-id}/accounting-sequences
/diagnostics/v1/echo
/master-date/v1/
```
```

############################
API CAll
############################

https://www.datev-community.de/t5/Unternehmen-online/Rest-Api-Abfrage-der-Klienten-%C3%BCber-accounting-clients/td-p/256033#_=_
https://www.datev-community.de/t5/Unternehmen-online/Rest-API-Zahlungen/td-p/170902#_=_


curl --request GET \
  --url https://sandbox-api.datev.de/accounting/v1/clients \
  --header "Authorization: Bearer $TOKEN" \
  --header 'accept: application/json;charset=utf-8'

curl --request GET \
  --url https://secure8.datev.de/accounting/v1/clients \
  --header "Authorization: Bearer $TOKEN" \
  --header 'accept: application/json;charset=utf-8'




https://developer.datev.de/portal/de/hersteller-mit-online-schnittstelle
https://hilfe.brainformatik.com/content/manual/de/latest/add_ons/datev.html
https://help.hsp-software.de/hc/de/articles/360010281778-Einrichtung-von-DATEVconnect-
```
```


############################
Datev API Portal
############################

https://portal.test.datev.io/help/oauth2_authorization_code
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/api-access
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_authorization_code
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_client_credentials
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_password_grant
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_implicit_grant

https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/apis/content-api
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/apis/portal-api
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/apis/echo
https://portal.datev.pdicloud.azure-k8s.haufe.io/help/api
https://portal.datev.pdicloud.azure-k8s.haufe.io/help/application


# Accessing using an API Key
curl -H 'X-ApiKey: (your API Key)' https://api.test.datev.io/desired_api/some_endpoint


# Accessing using OAuth 2.0 Client Credentials Flow
curl -X POST --header 'Content-Type: application/x-www-form-urlencoded' -d 'grant_type=client_credentials&client_id=(your client id)&client_secret=(your client secret)' 'https://api.test.datev.io/auth/(auth method)/api/(desired api)/token'

curl --header 'Authorization: Bearer db530d89558843a99ec80f639434faa8' https://api.test.datev.io/desired_api/some_endpoint

----
Getting an Access Token
curl -X POST -d 'grant_type=password&client_id=(your client id)&client_secret=(your client secret)&username=(user email)&password=(password)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

curl -X POST -d 'grant_type=password&client_id=(your client id)&username=(user email)&password(password)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

Accessing the API
curl -H 'Authorization: Bearer (access token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/(api endpoint)


curl -X POST -H 'Content-Type: application/json' -d '{"grant_type":"refresh_token","client_id":"(your client id)","client_secret":"(your client secret)","refresh_token":"(refresh token)"}' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token


curl -X POST -H 'Content-Type: application/json' -d '{"grant_type":"refresh_token","client_id":"(your client id)","refresh_token":"(refresh token)"}' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

---

Getting an Authorization Code (confidential clients)
https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=code&scope=(space separated list of scopes)

http://your.application.com/oauth2/callback?code=(authorization code)

curl -X POST -d 'grant_type=authorization_code&client_id=(your client id)&client_secret=(your client secret)&code=(authorization code)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

Refreshing the Access Token (confidential clients)
curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&client_secret=(your client secret)&refresh_token=(refresh token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

Accessing the API
curl -H 'Authorization: Bearer (access token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/(api endpoint)


Getting an Authorization Code (public clients/using PKCE)
https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=code&scope=(space separated list of scopes)&code_challenge=(code challenge)&code_challenge_method=S256

Getting an Access Token (public clients/using PKCE)
curl -X POST -d 'grant_type=authorization_code&client_id=(your client id)&code_verifier=(unhashed code verifier)&code=(authorization code)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

Refreshing the Access Token (public browser based clients)

https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=code&scope=(space separated list of scopes)&code_challenge=(code challenge)&code_challenge_method=S256&prompt=none

Refreshing the Access Token (native/mobile)
curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&refresh_token=(refresh token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

----------------------------------------------------------------

Getting an Access Token

https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=token&scope=(space separated list of scopes)

https://app.yourcompany.com/#access_token=(access token)&expires_in=3600&token_type=bearer

Accessing the API
curl -H 'Authorization: Bearer (access token)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/(api endpoint)

https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=token&scope=(space separated list of scopes)&prompt=none
----

# Getting an Authorization Code (confidential clients)
https://api.test.datev.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=code&scope=(space separated list of scopes)

http://your.application.com/oauth2/callback?code=(authorization code)

curl -X POST -d 'grant_type=authorization_code&client_id=(your client id)&client_secret=(your client secret)&code=(authorization code)' https://api.test.datev.io/auth/(auth method id)/api/(api id)/token


curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&client_secret=(your client secret)&refresh_token=(refresh token)' https://api.test.datev.io/auth/(auth method id)/api/(api id)/token

curl -H 'Authorization: Bearer (access token)' https://api.test.datev.io/(api endpoint)

https://api.test.datev.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=code&scope=(space separated list of scopes)&code_challenge=(code challenge)&code_challenge_method=S256

curl -X POST -d 'grant_type=authorization_code&client_id=(your client id)&code_verifier=(unhashed code verifier)&code=(authorization code)' https://api.test.datev.pdicloud-test.azure-k8s.haufe.io/auth/(auth method id)/api/(api id)/token

https://api.test.datev.io/auth/(auth method id)/api/(api id)/authorize?client_id=(your client id)&redirect_uri=(redirect URI of your application)&response_type=code&scope=(space separated list of scopes)&code_challenge=(code challenge)&code_challenge_method=S256&prompt=none


curl -X POST -d 'grant_type=refresh_token&client_id=(your client id)&refresh_token=(refresh token)' https://api.test.datev.io/auth/(auth method id)/api/(api id)/token
```


```

##############################

Grundaufbau DATEVconnect in der dotSource

##############################

https://www.dotsource.de/labs/wp-content/uploads/sites/4/2019/10/Effektivit%C3%A4tssteigerung-der-Datenauswertung-durch-Implementierung-einer-Datevschnittstelle.pdf

<scheme>://<ip-addresse>:<port>/datev/api/<domain>/<domainversion>/<resource-path>

https://jds2271:58452/datev/api/
https://jds2271:58452/datev/api/master-date/v1/


clients/<client-id>/fiscal-years/
clients/<client-id>/fiscal-years/<fiscal-year-id>/costsystems/

clients/<client-id>/fiscal-years/<fiscal-year-id>/costsystems/<cost-system-id>/cost-centers/
clients/<client-id>/fiscal-years/<fiscal-year-id>/costsystems/<cost-system-id>/cost-centers/<cost-centers-id>/
```





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
clients endpoint
################################################################################

https://www.datev-community.de/t5/Unternehmen-online/Rest-Api-Abfrage-der-Klienten-%C3%BCber-accounting-clients/td-p/256033#_=_

curl --request GET \
  --url https://sandbox-api.datev.de/accounting/v1/clients \
  --header "Authorization: Bearer $TOKEN" \
  --header 'accept: application/json;charset=utf-8'
 
curl --request GET \
  --url https://secure8.datev.de/accounting/v1/clients \
  --header "Authorization: Bearer $TOKEN" \
  --header 'accept: application/json;charset=utf-8'
 
 ```

  ```


php

https://github.com/Detsieber/sfe.dico.fibureport
https://github.com/fjbender/balance-to-datev
https://github.com/nlsh/nlsh_writedatevdtvf


py

https://github.com/Fjanks/pydatev
https://github.com/jonaswitt/stripe-datev-exporter
https://github.com/draptik/2020-01-modern-linux-command-line-tools
https://www.youtube.com/watch?v=8d8-PpcLc24&t=12s
https://github.com/FrankBlabu/DatevExport
https://github.com/VinRud/DatevExport
https://github.com/MaliziaGrimm/pfb2lodas
https://github.com/FrankBlabu/DatevConvert
https://github.com/nlsh/nlsh_DatevStapelZerlegen
https://github.com/Fjanks/beancount-datev
https://github.com/renenoah/Datev_Importer
https://github.com/Marc-Bender/AmazonCSVToDatevCSVConverter


js

https://github.com/flowground/datev-accounting-documents-connector
https://github.com/BitWire/datev_extract
https://github.com/Mohamad-Hamad91/datev-export

https://developer.datev.de/portal/de/dtvf/sampledata
https://developer.datev.de/portal/de/dtvf/formate/buchungsstapel

 ```

 ```
https://github.com/metasfresh/metasfresh
https://hilfe.brainformatik.com/content/manual/de/latest/add_ons/datev.html
https://portal.test.datev.pdicloud-test.azure-k8s.haufe.io/help/oauth2_authorization_code
https://hilfe.brainformatik.com/content/manual/de/latest/add_ons/datev.html#datev-export
https://www.rexx-systems.com/dokumente/rexx_systems-datev-online-api.pdf
https://testcenter.datev.de/vpn/index.html

https://api.datev.de/userinfo
https://login.datev.de/openid/authorize
https://api.datev.de/token
http://sandbox-api.datev.de/
https://api.datev.de/openid


https://secure4.datev.de/api
https://secure6.datev.de/api
https://secure8.datev.de/api
https://secure10.datev.de/api
 ```


------------------------------------------------------------

 ```
https://login.datev.de/openidsandbox/.well-known/openid-configuration

{
  "issuer": "https://login.datev.de/openidsandbox",
  "jwks_uri": "https://sandbox-api.datev.de/certs",
  "authorization_endpoint": "https://login.datev.de/openidsandbox/authorize",
  "token_endpoint": "https://sandbox-api.datev.de/token",
  "userinfo_endpoint": "https://sandbox-api.datev.de/userinfo",
  "revocation_endpoint": "https://sandbox-api.datev.de/revoke",
  "check_session_iframe": "https://sandbox-api.datev.de/checksession",
  "end_session_endpoint": "https://sandbox-api.datev.de/endsession",
  "response_types_supported": [
    "code",
    "id_token",
    "id_token token",
    "code id_token"
  ],
  "subject_types_supported": [
    "pairwise"
  ],
  "id_token_signing_alg_values_supported": [
    "RS256"
  ]
}
 ```
------------------------------------------------------------
 ```
https://login.datev.de/openid/.well-known/openid-configuration

{
  "issuer": "https://login.datev.de/openid",
  "jwks_uri": "https://api.datev.de/certs",
  "authorization_endpoint": "https://login.datev.de/openid/authorize",
  "token_endpoint": "https://api.datev.de/token",
  "userinfo_endpoint": "https://api.datev.de/userinfo",
  "revocation_endpoint": "https://api.datev.de/revoke",
  "check_session_iframe": "https://api.datev.de/checksession",
  "end_session_endpoint": "https://api.datev.de/endsession",
  "response_types_supported": [
    "code",
    "id_token",
    "id_token token",
    "code id_token"
  ],
  "subject_types_supported": [
    "pairwise"
  ],
  "id_token_signing_alg_values_supported": [
    "RS256"
  ]
}

 ```

 ```
------------------------------------------------------------

https://www.datev-community.de/t5/Unternehmen-online/Rest-API-Zahlungen/m-p/170902
https://www.datev-community.de/t5/Technisches-zu-Software/Schnittstelle-API-Belege-Exportieren/m-p/246319
https://www.datev-community.de/t5/Technisches-zu-Software/Datev-API-accounts-receivable-filter-arbeitet-mit-Datum-nicht/m-p/136366

http://localhost:58454/datev/api/accounting/v1/clients/{client-id}/fiscal-years/{fiscal-year-id}/accounting-sequences
http://localhost:58454/datev/api/accounting/v1/clients/{client-id}/fiscal-years/{fiscal-year-id}/accounts-receivable
http://localhost:58452/datev/api/accounting/v1/Clients/{client-id}/fiscal-years/20200101/accounts-receivable/condense?select=id, account_number, date&filter=account_number eq 100610000
http://localhost:58454/datev/api/accounting/v1/clients
http://localhost:58454/datev/api/accounting/v1/clients

------------------------------------------------------------

https://www.datev-community.de/t5/Unternehmen-online/Rest-Api-Abfrage-der-Klienten-%C3%BCber-accounting-clients/m-p/256033


curl --request GET \
  --url https://sandbox-api.datev.de/accounting/v1/clients \
  --header "Authorization: Bearer $TOKEN" \
  --header 'accept: application/json;charset=utf-8'

curl --request GET \
  --url https://secure8.datev.de/accounting/v1/clients \
  --header "Authorization: Bearer $TOKEN" \
  --header 'accept: application/json;charset=utf-8'

 ```