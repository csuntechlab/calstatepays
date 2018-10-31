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

  def json_output_by_university_path(self,filePath,df):
    print(df.head())
    aggregate = self.get_df_by_campus(df,0)
    self.convert_df_to_dictionary_then_out_put_to_json(filePath+'aggregate.json',aggregate)
    
    northridge = self.get_df_by_campus(df,70)
    self.convert_df_to_dictionary_then_out_put_to_json(filePath+'northridge.json',northridge)

  def json_output_by_university_wages(self,filePath,pathDf,df,left,right):
    print(filePath)
    print(df.head())

    aggregateWages = self.get_wages_df(pathDf,df,0,left,right)
    self.convert_df_to_dictionary_then_out_put_to_json(filePath+'aggregate.json',aggregateWages)
    
    northridgeWages = self.get_wages_df(pathDf,df,70,left,right)
    self.convert_df_to_dictionary_then_out_put_to_json(filePath+'northridge.json',northridgeWages)
  
  def convert_df_to_dictionary_then_out_put_to_json(self,filePath,df):
    dictionaryOutputOfDf = df.to_dict(orient='record')
    self.json_output_with_simple_json(filePath,dictionaryOutputOfDf )

  
  def get_wages_df(self,pathDf,df,campus_id,left,right):
    dfByCampus = self.get_df_by_campus(pathDf,campus_id)
    wages = pd.merge(dfByCampus , df,  how='left', left_on=left, right_on = right)
    return wages
  
  def get_df_by_campus(self,df,campus_id):
    print(campus_id)
    df = df.loc[df['campus'].isin([campus_id])]
    return df
