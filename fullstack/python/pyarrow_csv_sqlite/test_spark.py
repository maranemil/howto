from pyspark.sql import SparkSession
from pyspark.sql.types import *
from pyspark.sql.functions import col
import pyspark.pandas as ps
import os

spark = SparkSession \
    .builder \
    .appName("Python Spark SQL basic example") \
    .config("spark.some.config.option", "some-value") \
    .getOrCreate()

# spark is an existing SparkSession
# df = spark.read.json("people.json")
df = spark.read.parquet("base.pqt")
# Displays the content of the DataFrame to stdout
df.show(1)
df.printSchema()

# Convert all columns to integer type.
# df_parq = df.select(*(col(c).cast(IntegerType()).alias(c) for c in df.columns))
df_parq = df.select(*(col(c).cast(StringType()).alias(c) for c in df.columns))
df_parq.printSchema()
df_parq.write.parquet('tmp/sample_out3.pqt')
df_read_parq = spark.read.parquet('tmp/sample_out3.pqt')
df_read_parq.printSchema()

# df.select("buskey").show()
df.select(df['buskey'], df['buskey2']).show()
df.groupBy("buskey").count().show()
# df.filter(df['buskey'] > 0).show()

# df.createOrReplaceTempView("configuration")
# sqlDF = spark.sql("SELECT * FROM configuration")
# sqlDF.show()


# os.environ["PYARROW_IGNORE_TIMEZONE"] = "1"
# ARROW_PRE_0_15_IPC_FORMAT=1
# PYARROW_IGNORE_TIMEZONE = 1

"""
dfn = ps.read_sql(
    "ddefinition",
    con="jdbc:sqlite:{}//db.db".format(os.getcwd())
)
print(dfn.head(2))
"""
exit()

"""


https://spark.apache.org/docs/latest/sql-data-sources-jdbc.html
https://arrow.apache.org/docs/python/integration.html
https://spark.apache.org/docs/3.0.0-preview/sql-pyspark-pandas-with-arrow.html
https://spark.apache.org/docs/latest/sql-data-sources-jdbc.html
https://spark.apache.org/docs/latest/api/python/user_guide/pandas_on_spark/from_to_dbms.html
https://spark.apache.org/docs/2.3.1/sql-programming-guide.html#sql
https://stackoverflow.com/questions/56958949/is-there-a-way-to-convert-few-1000-columns-from-string-to-integer-while-saving
https://arrow.apache.org/docs/python/parquet.html#finer-grained-reading-and-writing
https://spark.apache.org/docs/3.1.1/api/python/reference/api/pyspark.sql.SparkSession.createDataFrame.html
https://sparkbyexamples.com/pyspark/pyspark-sql-types-datatype-with-examples/
https://spark.apache.org/docs/2.1.0/api/python/pyspark.sql.html?highlight=sparksession#pyspark.sql.SparkSession
https://spark.apache.org/docs/2.0.0-preview/api/python/pyspark.sql.html#pyspark.sql.DataFrame
https://spark.apache.org/docs/latest/sql-data-sources-parquet.html
https://sparkbyexamples.com/spark/spark-read-write-dataframe-parquet-example/
https://sparkbyexamples.com/pyspark/pyspark-read-and-write-parquet-file/
"""
