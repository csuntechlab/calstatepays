import pandas as pd
import numpy as np

import simplejson
import json

from csuMetro_Parsing.jsonOutput import JsonOutPut

class JsonMajor:
  def __init__(self,file,universityMajorDictionary):
    self.jsonOutputter = JsonOutPut()
    self.file = file
    self.universityMajorsDataFrame =  pd.DataFrame()
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
      hegisDictionary[hegis] = row['id']
      campus =  int(row['campus'])
      major =  (row['major'])
      dictRename = {'hegis_codes': hegis,'campus':campus,'major':major,'id':row['id']}
      universityMajorsId.append(dictRename)
      
      self.universityMajorsDataFrame = self.universityMajorsDataFrame.append( dictRename , ignore_index=True)

    del output
    
    dictionary  = {campusId:hegisDictionary}
    filePath = './dictionaries/'+self.file+'.json'
    self.jsonOutputter.json_output_with_simple_json(filePath,dictionary)
    return dictionary
  
  def getMajorsTables(self, majorPathDf , majorPathWageDf ):
    
    majorPathDf['university_majors_id'] = -1

    for index,row in majorPathDf.iterrows():
      hegis = row['hegis_at_exit']
      campus = row['campus']
      uni_majors_id = self.dictionary[campus][hegis] 
      majorPathDf.ix[index,'university_majors_id'] = uni_majors_id
      
    # print(majorPathDf)
    # print(majorPathWageDf)
    return majorPathDf,majorPathWageDf