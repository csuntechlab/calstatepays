import pandas as pd
import numpy as np

import simplejson
import json

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
      # print(row['hegis_at_exit'])
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




    