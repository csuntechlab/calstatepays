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

  def json_output_by_university(self,filePath,df):
    print(df.head())
    aggregate = df.loc[df['campus'].isin([0])]
    self.convert_df_to_dictionary_then_out_put_to_json(filePath+'aggregate.json',aggregate)
    
    northridge = df.loc[df['campus'].isin([70])]
    self.convert_df_to_dictionary_then_out_put_to_json(filePath+'northridge.json',northridge)
  
  def convert_df_to_dictionary_then_out_put_to_json(self,filePath,df):
    dictionaryOutputOfDf = df.to_dict(orient='record')
    self.json_output_with_simple_json(filePath,dictionaryOutputOfDf )
    