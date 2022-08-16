###################################################
# read sqlite data in chuncks
###################################################

import os
import sqlalchemy
from sqlalchemy import create_engine

engine = create_engine(
    "sqlite:///somefile.db"
)
conn = engine.connect().execution_options(stream_results=True)

stream = os.popen('rm tmp/*.pqt')
stream.read()

kk = 0
for chunk_dataframe in pd.read_sql("SELECT * FROM table", conn, chunksize=100000):
    print(f"Got dataframe w/{len(chunk_dataframe)} rows")
    kk += 1
    chunk_dataframe.to_parquet('tmp/chunk_dataframe_' + str(kk) + '.pqt')

    # check file content
    # parquet-tools show -n5 tmp/chunk_dataframe_1.pqt

exit()
