
#######################################################
#
# 	elasticsearch python
#
#######################################################

"""

https://pypi.org/project/elasticsearch/
https://elasticsearch-py.readthedocs.io/en/master/
https://elasticsearch-py.readthedocs.io/en/master/api.html
https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-get.html
https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-index_.html
https://www.elastic.co/guide/en/elasticsearch/reference/current/search-search.html
https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-update.html
https://www.elastic.co/guide/en/elasticsearch/reference/current/docs-delete.html
https://towardsdatascience.com/getting-started-with-elasticsearch-in-python-c3598e718380
https://tryolabs.com/blog/2015/02/17/python-elasticsearch-first-steps/

pip install elasticsearch
"""

# ------------------------------------------------------
from datetime import datetime
from elasticsearch import Elasticsearch
es = Elasticsearch()

doc = {
    'author': 'kimchy',
    'text': 'Elasticsearch: cool. bonsai cool.',
    'timestamp': datetime.now(),
}
res = es.index(index="test-index", doc_type='tweet', id=1, body=doc)
print(res['result'])

res = es.get(index="test-index", doc_type='tweet', id=1)
print(res['_source'])

es.indices.refresh(index="test-index")

res = es.search(index="test-index", body={"query": {"match_all": {}}})
print("Got %d Hits:" % res['hits']['total'])
for hit in res['hits']['hits']:
    print("%(timestamp)s %(author)s: %(text)s" % hit["_source"])

# ------------------------------------------------------
from elasticsearch import Elasticsearch

# by default we don't sniff, ever
es = Elasticsearch()

# allow up to 25 connections to each node
es = Elasticsearch(["host1", "host2"], maxsize=25)

# you can specify to sniff on startup to inspect the cluster and load
# balance across all nodes
es = Elasticsearch(["seed1", "seed2"], sniff_on_start=True)

# you can also sniff periodically and/or after failure:
es = Elasticsearch(["seed1", "seed2"],
          sniff_on_start=True,
          sniff_on_connection_fail=True,
          sniffer_timeout=60)

# ------------------------------------------------------

# Example use

>>> from datetime import datetime
>>> from elasticsearch import Elasticsearch

# by default we connect to localhost:9200
>>> es = Elasticsearch()

# create an index in elasticsearch, ignore status code 400 (index already exists)
>>> es.indices.create(index='my-index', ignore=400)
{u'acknowledged': True}

# datetimes will be serialized
>>> es.index(index="my-index", doc_type="test-type", id=42, body={"any": "data", "timestamp": datetime.now()})
{u'_id': u'42', u'_index': u'my-index', u'_type': u'test-type', u'_version': 1, u'ok': True}

# but not deserialized
>>> es.get(index="my-index", doc_type="test-type", id=42)['_source']
{u'any': u'data', u'timestamp': u'2013-05-12T19:45:31.804229'}

