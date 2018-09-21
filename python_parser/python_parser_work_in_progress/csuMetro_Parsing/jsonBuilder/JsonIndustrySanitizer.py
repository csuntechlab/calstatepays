import pandas as pd
import numpy as np

import simplejson
import json

class JsonIndustry:
  def __init__(self,file):
    self.file = file
    self.dictionary = self.getDictionary(file+"_Dictionary") 

  def getDictionary(self,fileName):
    jsonFile = open('./'+fileName+'.json')
    dictionary = jsonFile.read()
    dictionary = json.loads(dictionary)

    return dictionary
  
  def jsonOutput(self,fileName, df):
  
    output = df.to_dict(orient='record')

    with open ('../../database/data/'+fileName+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()
  
  def getIndustryPathTypesDfTable(self,industryPathTypesDf):
    
    industryPathTypesDf['university_majors_id'] = -1

    
    for index,row in industryPathTypesDf.iterrows():
      # print(row.hegis_at_exit)
      # print(row.campus)
      # print("********************")
      hegis = (str)(row.hegis_at_exit)
      campus = (str)(row.campus)
      uni_majors_id = self.dictionary[campus][hegis]
      industryPathTypesDf.ix[index,'university_majors_id'] = uni_majors_id

    return industryPathTypesDf
  
  def jsonSanitizePath(self,fileName):
  
    import json
    json_data = json.load(open('../../database/data/'+fileName+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["naics_codes"]!=None):
          json_data[i]["naics_codes"] = int(json_data[i]["naics_codes"])

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)
    

  
  def jsonSanitizeWages(self,fileName): 

    import json
    json_data = json.load(open('../../database/data/'+fileName+'.json'))
    for i in range(0, len(json_data)):
      json_data[i]["id"] = int(json_data[i]["id"])
      if(json_data[i]["avg_annual_wage_5"]!=None):
        json_data[i]["avg_annual_wage_5"] = int(json_data[i]["avg_annual_wage_5"])
            
    # do we need to worry about avg annual 10 year?

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
      json.dump(json_data, outfile, indent=4)



  def jsonSanitizeNaics(self,fileName):

    import json
    json_data = json.load(open('../../database/data/'+fileName+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["naics_codes"]!=None):
          json_data[i]["naics_codes"] = int(json_data[i]["naics_codes"])
          image = self.sanitizeImage(json_data[i]["naics_industry"])
          json_data[i]["images"]= image

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)

  
  def sanitizeImage(self,image):
    if( ',' in image):
      image = image.replace(',', "")
    if('&' in image):
      image = image.replace('& ',"")
    if(' ' in image):
      image = image.replace(' ',"_")
    
    image = image.lower()

    return image+".png"
    


