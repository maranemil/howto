### Is there a way to discover all endpoints of a ReST API?

https://stackoverflow.com/questions/28993724/is-there-a-way-to-discover-all-endpoints-of-a-rest-api

```
There is no way of programmatically discovering REST services as they do not have a standard registry service.
The only option is documenting your API
```

- https://stackoverflow.blog/2020/03/02/best-practices-for-rest-api-design/
- https://www.plivo.com/docs/voice/api/endpoint#list-all-endpoints
- https://dotcms.com/docs/latest/rest-api-endpoints
- https://docs.couchbase.com/server/current/rest-api/rest-endpoints-all.html

GET https://api.plivo.com/v1/Account/{auth_id}/Endpoint/

- https://swagger.io/
- https://apiblueprint.org/
- https://en.wikipedia.org/wiki/Web_Application_Description_Language
- https://docs.microsoft.com/en-us/sharepoint/dev/sp-add-ins/working-with-lists-and-list-items-with-rest
- https://docs.microsoft.com/en-us/sharepoint/dev/sp-add-ins/complete-basic-operations-using-sharepoint-rest-endpoints
- http://www.gregreda.com/2015/02/15/web-scraping-finding-the-api/
- http://www.gregreda.com/2013/03/03/web-scraping-101-with-python/
- http://www.gregreda.com/2016/10/16/asynchronous-scraping-with-python/
- http://www.gregreda.com/2020/11/17/scraping-pages-behind-login-forms/
- https://www.smashingmagazine.com/2018/01/understanding-using-rest-api/
- https://css-tricks.com/using-fetch/
- https://ruby-doc.org/stdlib-2.4.2/libdoc/net/http/rdoc/index.html
- https://docs.python-requests.org/en/master/
- https://www.baeldung.com/swagger-2-documentation-for-spring-rest-api

### microservices

https://www.reactivemanifesto.org/
https://swagger.io/specification/

- https://stackoverflow.blog/2020/11/23/the-macro-problem-with-microservices/
- https://cloud.google.com/appengine/docs/standard/java/microservice-performance
- https://www.oreilly.com/library/view/monolith-to-microservices/9781492047834/ch04.html
- https://developers.redhat.com/blog/2016/08/02/the-hardest-part-about-microservices-your-data
- https://www.confluent.io/blog/5-things-every-kafka-developer-should-know/
- https://docs.aws.amazon.com/whitepapers/latest/microservices-on-aws/distributed-data-management.html


- https://softwareengineering.stackexchange.com/questions/373927/what-is-the-proper-way-to-synchronize-data-across-microservices
- https://hackernoon.com/migrating-to-microservices-and-event-sourcing-the-dos-and-donts-195153c7487d
- https://medium.com/@john_freeman/querying-data-across-microservices-8d7a4667668a
- https://microservices.io/patterns/data/database-per-service.html
- https://docs.microsoft.com/en-us/dotnet/architecture/microservices/architect-microservice-container-applications/distributed-data-management
- https://towardsdatascience.com/microservice-architecture-and-its-10-most-important-design-patterns-824952d7fa41
- https://auth0.com/blog/introduction-to-microservices-part-4-dependencies/
- https://www.scalyr.com/blog/microservices-communication-how-to-share-data-between-microservices
- https://thenewstack.io/selecting-the-right-database-for-your-microservices/
- https://jisajournal.springeropen.com/articles/10.1186/s13174-019-0104-0
- https://aiven.io/blog/how-are-your-microservices-talking

### Google - Best Practices for Microservice Performance

```
Turn CRUD operations into microservices
Provide batch APIs
Use asynchronous requests
Use the shortest route https://PROJECT_ID.REGION_ID
Avoid chatter during security enforcement
Trace microservice requests
```

```
Advantages:
--------------------
Microservices aren’t coupled
However, the coupling has moved up to the UI layer.

Live data
The data you get back is the current state of the supplying microservice. However, you still have to deal with eventual-consistency and the lack of transaction isolation between microservices.

Code generation support
You can generally define your remote API specification (e.g. in OpenAPI specification) then code generate the model, server and client from it.

HTTP caching
If you use this for relatively static reference data it caches really well.
```

```
Disadvantages:
--------------------
Not a solution if the low-level microservice needs to use the data internally
If you need to do this use another solution that doesn’t suffer from the same problem.

Remote services need bulk query APIs for performance
If you’re joining multiple rows of data across microservices, you’ll run into the n+1 problem. The n+1 problem is where each row in the results leads to an additional query (in this case to another microservice). One solution for this is to add a bulk query API, so you can fetch the additional data for all the rows at once.

Handwritten joins
You can’t leverage the database to do the joins for you, you have to write the joins and the associated tests. This may lead to bugs and performance issues.

Higher latency
Calls from the front-end to the back-end have higher latency than calls between microservices.

Moves work to the front-end developers
Front-end developers are often a scarcer resource than back-end developers.

Less control over the version of the front-end
Particularly a problem if you have native mobile/desktop applications. If a user can put off upgrading the application, you may have to maintain backward compatibility with several versions. This can make it very difficult to change your APIs once they’re used by the front-end. It also increases the amount of testing required.

Richer API not available to other microservices
You may find one of the other microservices needs this combination of data as well. At that point, you enhance the back-end to provide this additional data. If you end up adding the additional data to the back-end anyway, it makes performing the join in the front-end a waste of effort.
```

-------------------------------------------------------------------

### Effective Data Synchronization between Rails Microservices - Austin Story

https://www.youtube.com/watch?v=LxxcHcBU4Bk

BATCH

```php
$batch = new Batch([string $app_name,string $user, string $batch_name,int $level]);
$batch->add("INSERT",array $data);
```

IMPORTER

```php
$importer = new Importer(array $operation);
$importer->import();

class BasicImporter extends Importer{
    private array $results = [];
    public function import(){
    // boolean response status success or error
    // errors []
    // affected_ids[]
    return $this->results;
    }
}
```



