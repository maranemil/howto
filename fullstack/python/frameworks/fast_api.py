##############################################
# FastAPI Tutorial for Beginner
##############################################

# https://www.youtube.com/watch?v=dglcDIUTSsY
# https://github.com/MariyaSha/Simple_API_Example
# https://fastapi.tiangolo.com/#create-it


from fastapi import FastAPI, HTTPException

catalog =  {
 "tomatoes": {
    "units":"boxes",
    "qty": 1111
    }
}

app = FastAPI (title = "app")
#@app.get("/warehouse/tomatos")
@app.get("/warehouse/{product}")

async def load_truck(product, order_qty):
    available = catalog[product]["qty"]
    if(int(order_qty)) > int(available):
        raise HTTPException(status_code=400, detail=f"only {available} units available")

    return { "product": product, "order_qty": order_qty , "units": catalog[product]["units"]}



"""

conda create -n api_env python=3.12
conda activate api_env
#conda deactivate
pip install fastapi uvicorn
cd simple_api
nj_server.py
nj_client.py
uvicorn nj_server:app --reload
http://127.0.0.1:8000
http://127.0.0.1:8000/warehouse/tomatoes?order_qty=2
uvicorn nj_client:app --reload --port 8001

"""