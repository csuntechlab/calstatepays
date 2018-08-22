import pandas as pd
import shutil

import numpy as np
import simplejson
import json

class JsonIndustry:
  def __init__(self,file):
    self.file = file
    # self.df = df
    self.dictionary = self.getDictionary(file+"_Dictionary") 

  def getDictionary(self,fileName):
    jsonFile = open( fileName+'.json')
    dictionary = jsonFile.read()
    dictionary = json.loads(dictionary)

    return dictionary
  
  def jsonOutput(self,fileName, df):
  
    output = df.to_dict(orient='record')

    with open ('../../database/data/'+fileName+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()
  
    # shutil.move(fileName+'.json', "../../database/data/")

  
  def getIndustryPathTypesDfTable(self,industryPathTypesDf):
    
    industryPathTypesDf['university_majors_id'] = -1

    
    for index,row in industryPathTypesDf.iterrows():
      hegis = (str)(row[4])
      campus = (str)(row[5])
      # print(hegis)
      uni_majors_id = self.dictionary[campus][hegis]
      # print(uni_majors_id) 
      industryPathTypesDf.ix[index,'university_majors_id'] = uni_majors_id

    return industryPathTypesDf
  
  def jsonSanitizePath(self,fileName):
  
    import json
    json_data = json.load(open(fileName+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["naics_codes"]!=None):
          json_data[i]["naics_codes"] = int(json_data[i]["naics_codes"])

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)
    
    # shutil.move(fileName+'.json', "../../database/data/")

  
  def jsonSanitizeWages(self,fileName): 

    import json
    json_data = json.load(open(fileName+'.json'))
    for i in range(0, len(json_data)):
      json_data[i]["id"] = int(json_data[i]["id"])
      if(json_data[i]["avg_annual_wage_5"]!=None):
        json_data[i]["avg_annual_wage_5"] = int(json_data[i]["avg_annual_wage_5"])
            

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
      json.dump(json_data, outfile, indent=4)

    # shutil.move(fileName+'.json', "../../database/data/")


  def jsonSanitizeNaics(self,fileName):

    import json
    json_data = json.load(open(fileName+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["naics_codes"]!=None):
          json_data[i]["naics_codes"] = int(json_data[i]["naics_codes"])
          image = self.sanitizeImage(json_data[i]["naics_industry"])
          json_data[i]["images"]= image

    with open('../../database/data/'+fileName+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)

    # shutil.move(fileName+'.json', "../../database/data/")


  # def masterPathWagesToJson(self):
  #   with open (self.file+'_Dictionary.json', 'w' ) as fp:
  #       fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
  #   fp.close()  
  
  def sanitizeImage(self,image):
    if( ',' in image):
      image = image.replace(',', "")
    if('&' in image):
      image = image.replace('&',"")
    if(' ' in image):
      image = image.replace(' ',"_")
    return image+".png"
    


class JsonMajor:
  def __init__(self,file,df,universityMajorDictionary):
    self.file = file
    self.df = df
    self.dictionary = self.createDictionary(universityMajorDictionary) 
	
  
  def createDictionary(self,universityMajorDictionary):
    output = universityMajorDictionary.to_dict(orient='record')
    
    campusId =  int(output[0]['campus'])
    
    hegisDictionary = {}
    universityMajorsId = {}
    index = 1
    for row in output:
        # campus = int(row['campus'])
        hegis =  int(row['hegis_at_exit'])
        campus =  int(row['campus'])
        dictRename = {'hegis_codes': hegis,'university_id':campus }

        hegisDictionary[hegis] = index
        universityMajorsId[index] = dictRename

        index +=1
    del output

    

    dictionary  = {campusId:hegisDictionary}
    
    with open (self.file+'_Dictionary.json', 'w' ) as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  

    with open ('../../database/data/'+self.file+'_university_majors_id.json', 'w' ) as fp:
        fp.write(simplejson.dumps(universityMajorsId, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close() 

    # shutil.move(self.file+'_university_majors_id.json', "../../database/data/")

    return dictionary
    
    
  
  def getMajorsTables(self, majorPathDf ):
    
    majorPathDf['university_majors_id'] = -1
    
    for index,row in majorPathDf.iterrows():
      hegis = row[3]
      campus = row[4]
      uni_majors_id = self.dictionary[campus][hegis] 
      majorPathDf.ix[index,'university_majors_id'] = uni_majors_id

    return majorPathDf
    
  def jsonOutput(self,fileName, df):

    output = df.to_dict(orient='record')

    with open ('../../database/data/'+fileName+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()

    # shutil.move(fileName+'.json', "../../database/data/")


  def jsonSanitize(self,fileName ):
    
    json_data = json.load(open( fileName+'.json'))
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

    # shutil.move(fileName+'.json', "../../database/data/")



    