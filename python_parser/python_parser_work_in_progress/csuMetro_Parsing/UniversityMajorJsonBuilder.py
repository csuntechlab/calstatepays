import pandas as pd
import numpy as np
import json
import simplejson

from csuMetro_Parsing.jsonOutput import JsonOutPut

class hegisID:

  def __init__(self,df):
    self.df = df
    self.jsonOutputter = JsonOutPut()
    self.sanitize()

  def head(self):
    print(self.df.head())

  def sanitize(self):
    self.df['hegis_codes'] = (self.df['hegis_codes']).astype(int)
    self.df['id'] = (self.df['id']).astype(int)
    self.df['campus'] = (self.df['campus']).astype(int)
    self.df = self.df.drop_duplicates(subset=['campus', 'hegis_codes'], keep='first')
    

  def convert_to_json(self,fileName):
    filePath = '../../database/data/universityMajorData/'+fileName+'_university_majors_table.json'
    self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePath,self.df)

  def convert_hegis_codes_table_data_json(self):
    hegisCodesTableDataFrame = self.df.loc[:,['hegis_codes','major','campus']]
    hegisCodesTableDataFrame = hegisCodesTableDataFrame.drop_duplicates(subset=['hegis_codes'], keep='first')
    # csv_rows.extend([{parsed_titles[i]:row[title[i]] for i in range( len(title))}])
    hegisCodesTableDataFrame['hegis_category_id'] = -1
    hegisCodesTableDataFrame['id'] = -1

    i = 1

    for index,row in hegisCodesTableDataFrame.iterrows():
      # print(row[4])
      hegis = (str)((int)(row[0]))
      lengthOfHegis = len(hegis)

      hegisCategoryId = '00'
      if ( lengthOfHegis == 4 ) :
        hegisCategoryId = '0'+hegis[0]
      elif ( lengthOfHegis == 5 ):
        hegisCategoryId = hegis[0:2]

      hegisCategoryId = ( int )( hegisCategoryId )
      hegisCodesTableDataFrame.ix[index,'hegis_category_id'] = hegisCategoryId
      hegisCodesTableDataFrame.ix[index,'id'] = i

      i +=1
    filePath = '../../database/data/master_hegis_category_table.json'
    self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePath,hegisCodesTableDataFrame)
  
  def json_output(self,fileName, df):
    
    output = df.to_dict(orient='record')

    with open ('../../database/data/'+fileName+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()

  def jsonSanitize(self,fileName ):
    
    json_data = json.load(open('../../database/data/'+fileName+'.json'))
    for i in range(0, len(json_data)):
       
      # major path wage 
      if(json_data[i]["_25th_percentile_earnings"]!=None):
        json_data[i]["_25th_percentile_earnings"] = int(json_data[i]["_25th_percentile_earnings"])

      if(json_data[i]["_50th_percentile_earnings"]!=None):
        json_data[i]["_50th_percentile_earnings"] = int(json_data[i]["_50th_percentile_earnings"])

      if(json_data[i]["_75th_percentile_earnings"]!=None):
        json_data[i]["_75th_percentile_earnings"] = int(json_data[i]["_75th_percentile_earnings"])
      
      if(True):
        json_data[i]["major_path_id"] = int(json_data[i]["major_path_id"])

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
      json.dump(json_data, outfile, indent=4)
    outfile.close()
  
    
