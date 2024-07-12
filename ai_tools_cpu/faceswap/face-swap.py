import json
from datetime import datetime

now = int(datetime.utcnow().timestamp()*1e3)


with open("face-swap.json") as json_file:
    json_data = json.load(json_file)
    print(json_data['output'])


f = open("face-swap"+str(now)+".html", "a")
f.write("<img src='" + json_data['output'] + "'>")
f.close()