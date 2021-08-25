# https://pypi.org/project/python-amazon-sp-api/
# https://github.com/saleweaver/python-amazon-sp-api
# https://pythonrepo.com/repo/saleweaver-python-amazon-sp-api
# https://github.com/amzn/selling-partner-api-docs/issues/52
# https://pythonrepo.com/repo/saleweaver-python-amazon-sp-api
# https://python-amazon-sp-api.readthedocs.io/en/latest/env_variables/

# installation of python-amazon-sp-api
# sudo apt install python3-pip
# pip install python-amazon-sp-api

import os
import datetime

from sp_api.api.orders.orders import Orders
#from sp_api.api import Orders
from sp_api.api import Reports
from sp_api.api import Feeds
from sp_api.base import SellingApiException
from sp_api.base.reportTypes import ReportType
#from datetime import datetime, timedelta


os.environ["SP_API_REFRESH_TOKEN"] = "Atzr|IQEBLzAtAhRPpMJxdwVz2Nn6f2y-tpJX2DwGqMvAdE"

os.environ["LWA_APP_ID"] = "amzn1.application-oa2-client.ae941846cdd745e9a53319f7bb98d43"
os.environ["LWA_CLIENT_SECRET"] = "41d135b2b02ce5f2fbf7643a66477c089fcc1d88d11f69d3e4a6285b"

os.environ["SP_API_ACCESS_KEY"] = "AKIA3HD5GN6XA1PA6795UKMFR9"
os.environ["SP_API_SECRET_KEY"] = "wdj657542342wdj6575423wdj6575423"

os.environ["SP_API_ROLE_ARN"] = "arn:aws:iam::xxxxxxxxx:role/SellerPartnerAPIRole"
os.environ["SP_AWS_REGION"] = "us-east-1" # eu-west-1 us-east-1 eu-central-1 us-west-2

# Credentials for user created following the docs
# request_url = 'https://sandbox.sellingpartnerapi-eu.amazon.com'

# is not authorized to perform: sts:AssumeRole on resource:

try:
    #res = Orders().get_orders(CreatedAfter=(datetime.datetime.utcnow() - datetime.timedelta(days=7)).isoformat())
    res = Orders().get_orders(CreatedAfter="2021-08-01")
    print(res.payload)  # json data
except SellingApiException as ex:
    print(ex)

"""

[AccessDenied: User: {user} is not authorized to perform: sts:AssumeRole on resource: ]
https://github.com/99designs/aws-vault/issues/706
https://github.com/amzn/selling-partner-api-docs/issues/346
https://github.com/amzn/selling-partner-api-docs/issues/346
https://githubmemory.com/@manibha-jain
https://www.gitmemory.com/issue/amzn/selling-partner-api-docs/346/803300426
https://github.com/amzn/selling-partner-api-docs/issues/402
https://forums.aws.amazon.com/thread.jspa?threadID=266814
https://stackoverflow.com/questions/68501599/clienterror-accessdenied-when-calling-the-stsassumerole-operation-for-the-aw
https://github.com/aws/copilot-cli/issues/1771
https://stackoverflow.com/questions/41337079/how-enable-access-to-aws-sts-assumerole
https://github.com/Netflix/security_monkey/issues/1222
https://forums.aws.amazon.com/thread.jspa?messageID=946825&tstart=0
https://github.com/amzn/selling-partner-api-docs/issues/290
https://stackoverflow.com/questions/64560163/access-to-requested-resource-is-denied-403-sp-api-amazon-c-sharp###########
https://github.com/amzn/selling-partner-api-docs
https://stackoverflow.com/questions/68501599/clienterror-accessdenied-when-calling-the-stsassumerole-operation-for-the-aw



[ permission policy ]
https://docs.aws.amazon.com/IAM/latest/UserGuide/reference_policies_elements_principal.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/troubleshoot_roles.html#troubleshoot_roles_cant-assume-role
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.4.2/content/aws-launch/index.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/troubleshoot_roles.html#troubleshoot_roles_cant-assume-role
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_credentials_temp_control-access_enable-create.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_roles_create_policy-examples.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_credentials_temp_control-access.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_roles_create_policy-examples.html
https://cloud.google.com/kubernetes-engine/docs/how-to/iam
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.4.2/content/aws-launch/index.html
https://newbedev.com/eks-not-able-to-authenticate-to-kubernetes-with-kubectl-user-is-not-authorized-to-perform-sts-assumerole
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.8.0/create-credential-aws/content/cb_create-credentialrole.html
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.9.0/create-credential-aws/content/cb_create-credentialrole.html
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.8.0/troubleshoot/content/cb_unable-to-create-an-iam-role-for-cloudbreak.html
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.8.0/create-credential-aws/content/cb_create-credentialrole.html
https://docs.aws.amazon.com/cli/latest/userguide/cli-configure-role.html
https://docs.aws.amazon.com/cli/latest/reference/sts/assume-role.html
https://boto3.amazonaws.com/v1/documentation/api/latest/reference/services/sts.html
https://www.vaultproject.io/docs/secrets/aws
https://www.ibm.com/docs/sv/qradar-common?topic=service-configuring-trusted-aws-account
https://boto3.amazonaws.com/v1/documentation/api/latest/reference/services/sts.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/access-analyzer-reference-policy-checks.html#access-analyzer-reference-policy-checks-error-unsupported-principal
https://aws.amazon.com/premiumsupport/knowledge-center/s3-invalid-principal-in-policy-error/
https://docs.aws.amazon.com/IAM/latest/UserGuide/reference_policies_elements_notprincipal.html
https://stackoverflow.com/questions/12750065/amazon-s3-invalid-principal-in-bucket-policy/47190341
https://docs.aws.amazon.com/de_de/IAM/latest/UserGuide/troubleshoot_roles.html
https://docs.aws.amazon.com/AmazonS3/latest/userguide/example-bucket-policies.html
https://docs.aws.amazon.com/de_de/IAM/latest/UserGuide/troubleshoot_roles.html
https://www.reddit.com/r/aws/comments/oq4ztm/clienterror_accessdenied_when_calling_the/
https://docs.aws.amazon.com/de_de/IAM/latest/UserGuide/id_credentials_mfa_configure-api-require.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_credentials_mfa_configure-api-require.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_roles_create_for-service.html
https://docs.snowflake.com/en/user-guide/data-load-s3-config-aws-iam-role.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_roles_create_for-service.html



[generator and examples]
https://docs.aws.amazon.com/AmazonS3/latest/userguide/example-bucket-policies.html
https://awspolicygen.s3.amazonaws.com/policygen.html
https://docs.aws.amazon.com/marketplace/latest/buyerguide/completing-prerequisite-steps.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_credentials_temp_enable-regions.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_session-tags.html#id_session-tags_permissions-required
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_roles_terms-and-concepts.html#term_trust-policy
https://github.com/amzn/selling-partner-api-docs/blob/main/guides/en-US/developer-guide/SellingPartnerApiDeveloperGuide.md#registering-your-selling-partner-api-application####
https://docs.aws.amazon.com/IAM/latest/UserGuide/troubleshoot_roles.html######
https://docs.aws.amazon.com/STS/latest/APIReference/API_AssumeRole.html
https://aws.amazon.com/de/blogs/security/how-to-use-trust-policies-with-iam-roles/###


"Condition": {"Bool": {"aws:MultiFactorAuthPresent": true}}
Error – Unsupported principal



// allow-aws-marketplace
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Sid": "Stmt142424631",
      "Action": "aws-marketplace:*",
      "Effect": "Allow",
      "Resource": "*"
    }
  ]
}



// allow-list-roles-principal
{
  "Version": "2012-10-17",
  "Statement": {
    "Effect": "Allow",
    "Principal": {"AWS": "ACCOUNT-B-ID"},
    "Action": "sts:AssumeRole",
    "Condition": {"Bool": {"aws:MultiFactorAuthPresent": "true"}}
  }
}




// allow-list-roles
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "listroles",
            "Effect": "Allow",
            "Action": [
                "iam:ListRoles"
            ],
            "Resource": [
                "arn:aws:iam::MYACCOUNTID:role/*"
            ]
        }
    ]
}

// allow-assume-role
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": "sts:AssumeRole",
            "Resource": "arn:aws:iam::MYACCOUNTID:role/assume-role"
        }
    ]
}



//STS-POLICY
{ 
    "Version": "2012-10-17", 
    "Statement": [
        {
            "Sid":  "VisualEditor0",
            "Effect" : "Allow",
            "Action": "sts:*",
            "Resource": "arn:aws:iam::<account_id>:user/<username>"
        }
    ]
}
//EXECUTE-API-POLICY
{ 
    "Version": "2012-10-17", 
    "Statement": [
        {
            "Sid":  "VisualEditor0",
            "Effect" : "Allow",
            "Action": "execute-api:*",
            "Resource": "arn:aws:execute-api::<account_id>:*/*/*/*"
        }
    ]
}

// ExecuteSPAPI
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": "execute-api:Invoke",
            "Resource": "arn:aws:execute-api:*:*:*"
        }
    ]
}

// Using a policy to delegate access to services
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Principal": {
        "Service": [
          "elasticmapreduce.amazonaws.com",
          "datapipeline.amazonaws.com"
        ]
      },
      "Action": "sts:AssumeRole"
    }
  ]
}


// test
{
    "Version": "2012-10-17",
    "Statement": [
    {
        "Effect": "Allow",
        "Action": [
            "sts:AssumeRole"
        ],
        "Resource": "arn:aws:iam::MYACCOUNTID:role/prod-Eks-1234-admins"
    }
]
}

// test
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Principal": {
        "AWS": "arn:aws:iam::MYACCOUNTID:root", //the roleARN need to be granted, use * for all
        "Service": [
            "s3.amazonaws.com",
            "ec2.amazonaws.com",
            "ssm.amazonaws.com"
         ]
      },
      "Action": "sts:AssumeRole"
    }
  ]
}


AccessDeniedException – I Can’t Assume a Role
https://acloudguru.com/blog/engineering/fixing-5-common-aws-iam-errors

{
 "Version": "2012-10-17",
 "Statement": [{
   "Effect": "Allow",
   "Action": ["sts:AssumeRole"],
   "Resource": "arn:aws:iam::user:role/role"
 }]
}

{
 "Version": "2012-10-17",
 "Statement": [
   {
     "Effect": "Allow",
     "Principal": {
       "AWS": "arn:aws:iam::user:user-name"
     },
     "Action": "sts:AssumeRole",
     "Condition": {}
   }
 ]
}


------------------------------------------------------------

[regions]
https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/using-regions-availability-zones.html
https://docs.aws.amazon.com/de_de/AWSEC2/latest/UserGuide/using-regions-availability-zones.html
https://docs.cloudera.com/HDPDocuments/Cloudbreak/Cloudbreak-2.4.2/content/aws-launch/index.html
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_credentials_temp_enable-regions.html

us-east-2	    US East (Ohio)	Nicht erforderlich
us-east-1	    US East (N. Virginia)	Nicht erforderlich
us-west-1	    US West (N. California)	Nicht erforderlich
us-west-2	    US West (Oregon)	Nicht erforderlich
af-south-1	    Africa (Cape Town)	Erforderlich
ap-east-1	    Asia Pacific (Hong Kong)	Erforderlich
ap-south-1	    Asia Pacific (Mumbai)	Nicht erforderlich
ap-northeast-3	Asia Pacific (Osaka)	Nicht erforderlich
ap-northeast-2	Asia Pacific (Seoul)	Nicht erforderlich
ap-southeast-1	Asia Pacific (Singapore)	Nicht erforderlich
ap-southeast-2	Asia Pacific (Sydney)	Nicht erforderlich
ap-northeast-1	Asia Pacific (Tokyo)	Nicht erforderlich
ca-central-1	Canada (Central)	Nicht erforderlich
eu-central-1	Europe (Frankfurt)	Nicht erforderlich
eu-west-1	    Europe (Ireland)	Nicht erforderlich
eu-west-2	    Europe (London)	Nicht erforderlich
eu-south-1	    Europe (Milan)	Erforderlich
eu-west-3	    Europe (Paris)	Nicht erforderlich
eu-north-1	    Europe (Stockholm)	Nicht erforderlich
me-south-1	    Middle East (Bahrain)	Erforderlich
sa-east-1	    South America (São Paulo)	Nicht erforderlich

[doc]
https://docs.aws.amazon.com/IAM/latest/UserGuide/id_roles_create_for-user.html
https://docs.developer.amazonservices.com/en_US/dev_guide/DG_Errors.html
https://developer.amazonservices.de/
https://aws.amazon.com/premiumsupport/knowledge-center/troubleshoot-iam-policy-issues/
https://stackoverflow.com/questions/37498124/accessdeniedexception-user-is-not-authorized-to-perform-lambdainvokefunction

[php]
https://packagist.org/packages/enbit/amazon-sp-api-php
https://github.com/clousale/amazon-sp-api-php
https://packagist.org/packages/clousale/amazon-sp-api-php
https://github.com/clousale/amazon-sp-api-php
https://packagist.org/packages/jlevers/selling-partner-api#3.1.2
https://github.com/jlevers/selling-partner-api
https://github.com/clousale/amazon-sp-api-php





https://jesseevers.com/spapi-php-library/
https://jesseevers.com/spapi-first-application/
https://jesseevers.com/selling-partner-api-access/

[py date]
https://stackoverflow.com/questions/12906402/type-object-datetime-datetime-has-no-attribute-datetime
https://www.codegrepper.com/code-examples/python/%27datetime.datetime%27+has+no+attribute+%27datetime%27
https://stackoverflow.com/questions/19934248/nameerror-name-datetime-is-not-defined




[aws listpolicies]
https://docs.aws.amazon.com/general/latest/gr/aws-access-keys-best-practices.html
https://docs.aws.amazon.com/general/latest/gr/root-vs-iam.html
https://docs.aws.amazon.com/cli/latest/reference/iam/list-policies.html
https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-iam-2010-05-08.html#listpolicies
https://boto3.amazonaws.com/v1/documentation/api/latest/reference/services/iam.html#IAM.Client.list_policies



[php]
https://pythonrepo.com/repo/saleweaver-python-amazon-sp-api
https://github.com/amzn/selling-partner-api-docs/issues/52
https://docs.aws.amazon.com/STS/latest/APIReference/API_AssumeRole.html
https://docs.aws.amazon.com/general/latest/gr/signature-version-4.html
https://github.com/amzn/selling-partner-api-docs/issues/290
https://stackoverflow.com/questions/64560163/access-to-requested-resource-is-denied-403-sp-api-amazon-c-sharp
https://www.gitmemory.com/issue/amzn/selling-partner-api-docs/38/731492158
https://github.com/amzn/selling-partner-api-docs
https://www.gitmemory.com/issue/amzn/selling-partner-api-docs/52/756007438
https://github.com/amzn/selling-partner-api-docs/blob/main/guides/en-US/developer-guide/SellingPartnerApiDeveloperGuide.md#self-authorization
https://github.com/clousale/amazon-sp-api-php#iam-user


composer require clousale/amazon-sp-api-php
https://packagist.org/packages/clousale/amazon-sp-api-php
https://github.com/clousale/amazon-sp-api-php

composer require jlevers/selling-partner-api
https://packagist.org/packages/jlevers/selling-partner-api#3.1.2
https://jesseevers.com/spapi-php-library/*/


"""