##############################################################
#
#   main py script PYTHON - using 4x parallel processes with Tensorflow CPU
#
##############################################################

from multiprocessing import Pool
import random
from random import shuffle
import os
import codecs, json
import numpy as np
import pandas as pd

import sys
import argparse
FLAGS = None

def benchmark(x):
  return int(random.randint(1, 5)) * int(random.random() * 5) * pow(x,2)

def start_batch(file,intPipeline):
      cmd = 'php parser.php  ' + file + ' ' + str(intPipeline)
      print(cmd)
      os.system(cmd)

if __name__ == '__main__':

  parser = argparse.ArgumentParser()
  parser.add_argument(
      '--pipeline',
      type=int,
      default='',
      help='Pipeline ID'
  )

  args = parser.parse_args()
  print (args)

  os.system("rm *.json")

  iPipeRef=args.pipeline
  if(iPipeRef == 0):
    sys.exit("no pipeline argument")

  iProc = 4
  print("run pipeline case: " + str(iPipeRef))

  #dir_path = os.path.dirname(os.path.realpath(__file__))
  #cwd = os.getcwd()

  cmd = "prepare_list.php 12345678"
  os.system(cmd)

  with open('prepare_list.json') as file:
      dir_list = json.load(file)
  print("total images for batch: " + str(len(dir_list)))
  splitted_list = np.array_split(dir_list,4) # increase number for more batches

  #print("total files for batch: " + str(len(splitted_list)))

  pool = Pool(processes=4)  # start 4 worker processes
  for idx,list in enumerate(splitted_list):
      pd_list = pd.Series(list).to_json(orient='values');
      batch_file_name = 'batch_data_'+str(idx)+'.json'
      json.dump(pd_list, codecs.open(batch_file_name, 'w', encoding='utf-8'),
     	 separators=(',', ':'), sort_keys=True, indent=4)
      ### this saves the array in .json format
      result = pool.apply_async(start_batch, [batch_file_name,12345678])

      #result = pool.apply_async(benchmark, [10])
      #print (result.get(timeout=1))       	# prints "100" unless your computer is *very* slow
      #print (pool.map(start_batch, range(10)))      	# prints "[0, 1, 4,..., 81]"

  #pool.terminate()
  pool.close()
  pool.join()
  print("Done!")

  # https://docs.python.org/2/library/argparse.html
  # http://www.grun1.com/utils/timeDiff.cfm

