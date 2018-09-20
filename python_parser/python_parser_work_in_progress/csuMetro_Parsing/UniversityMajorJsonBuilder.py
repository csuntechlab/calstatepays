import pandas as pd
import numpy as np
import json
import simplejson


import simplejson
import json

class hegisID:

  def __init__(self,df):
    self.df = df

  def head(self):
    print(self.df.head())

  def convert_To_Json(self):

    self.df['hegis_codes'] = (self.df['hegis_codes']).astype(int)
    self.df['id'] = (self.df['id']).astype(int)
    self.df['university_id'] = (self.df['university_id']).astype(int)

    errorDataFrame = self.df
    duplicateHegisCodeDifferentMajor = self.df

    self.df = self.df.drop_duplicates(subset=['university_id', 'hegis_codes'], keep='first')

    self.json_output('master_university_table',self.df)
    
    '''
    ERROR Data Frame code here 
    '''
    errorDataFrame = self.df

    ids = errorDataFrame["id"]
    errorBoolean = errorDataFrame.duplicated(subset=['university_id','major'], keep=False)
    errorDataFrame = errorDataFrame[ids.isin( ids[ errorBoolean ] ) ]
    
    self.json_output('master_errors_table',errorDataFrame)

    ids = duplicateHegisCodeDifferentMajor["id"]
    errorBoolean = duplicateHegisCodeDifferentMajor.duplicated(subset=['university_id','hegis_codes'], keep=False)
    duplicateHegisCodeDifferentMajor = duplicateHegisCodeDifferentMajor[ids.isin( ids[ errorBoolean ] ) ]

    self.json_output('master_duplicate_hegis_code_different_major_table',duplicateHegisCodeDifferentMajor)

  def get_hegis_codes_table_data_frame(self):
    hegisCodesTableDataFrame = self.df.loc[:,['hegis_codes','major','university_id']]
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
    
    return hegisCodesTableDataFrame
  
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
  
    
