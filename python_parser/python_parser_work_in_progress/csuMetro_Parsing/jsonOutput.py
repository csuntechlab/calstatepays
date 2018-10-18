import pandas as pd
import numpy as np
import json
import simplejson
import os
from os import listdir
from os.path import isfile, join

class JsonOutPut:
  def __init__(self):
    pass

  def json_output_with_simple_json(self,filePath,df):
    '''
        :rtype: str
        :rtype: dataframe
    '''
    with open (filePath, 'w' ) as fp:
      fp.write(simplejson.dumps(df, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()