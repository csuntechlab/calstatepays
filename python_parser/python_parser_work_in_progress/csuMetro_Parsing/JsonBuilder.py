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
    


class JsonMajor:
  def __init__(self,file,universityMajorDictionary,universityMajorsDataFrame,indexUniversityMajorsId , indexMajorPathId ):
    self.file = file
    self.indexUniversityMajorsId = indexUniversityMajorsId 
    self.indexMajorPathId = indexMajorPathId
    self.universityMajorsDataFrame = universityMajorsDataFrame
    self.dictionary = self.createDictionary(universityMajorDictionary)

  def getUniversityMajorIdDf(self):
    return self.universityMajorsDataFrame
	
  
  def createDictionary(self,universityMajorDictionary):
    # print(universityMajorDictionary)
    output = universityMajorDictionary.to_dict(orient='record')
    
    campusId =  int(output[0]['campus'])
    
    hegisDictionary = {}

    universityMajorsId = []

    for row in output:
      hegis =  int(row['hegis_at_exit'])
      hegisDictionary[hegis] = self.indexUniversityMajorsId

      campus =  int(row['campus'])
      major =  (row['major'])
      dictRename = {'hegis_codes': hegis,'university_id':campus,'major':major,'id':self.indexUniversityMajorsId }
      universityMajorsId.append(dictRename)
      
      self.universityMajorsDataFrame = self.universityMajorsDataFrame.append( dictRename , ignore_index=True)
      
      self.indexUniversityMajorsId +=1
    del output
    
    dictionary  = {campusId:hegisDictionary}

    # print(self.file)
    
    with open('./dictionaries/'+self.file+'.json','w') as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  

    return dictionary
    
  def getIndex(self):
    return self.indexUniversityMajorsId,self.indexMajorPathId 
  
  def getMajorsTables(self, majorPathDf , majorPathWageDf ):
    
    majorPathDf['university_majors_id'] = -1

    for index,row in majorPathDf.iterrows():
      hegis = row[3]
      campus = row[4]
      uni_majors_id = self.dictionary[campus][hegis] 
      majorPathDf.ix[index,'university_majors_id'] = uni_majors_id
      majorPathDf.ix[index,'id'] = self.indexMajorPathId
      majorPathWageDf.ix[index,'major_path_id'] = self.indexMajorPathId
      self.indexMajorPathId += 1
      
    # print(majorPathDf)
    # print(majorPathWageDf)
    return majorPathDf,majorPathWageDf
    
  def jsonOutput(self,fileName, df):

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




    