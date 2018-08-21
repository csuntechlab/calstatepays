import pandas as pd

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

    with open (fileName+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()
  
  def getIndustryPathTypesDfTable(self,industryPathTypesDf):
    
    industryPathTypesDf['university_majors_id'] = -1

    
    for index,row in industryPathTypesDf.iterrows():
      hegis = (str)(row[4])
      campus = (str)(row[5])
      print(hegis)
      uni_majors_id = self.dictionary[campus][hegis]
      print(uni_majors_id) 
      industryPathTypesDf.ix[index,'university_majors_id'] = uni_majors_id

    return industryPathTypesDf
  
  def jsonSanitizeWages(self,fileName): 

    import json
    json_data = json.load(open(self.file+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["naics"]!=None):
            json_data[i]["naics"]= int(json_data[i]["naics"])
        if(json_data[i]["number_of_students_found_5_years_after_exit"]!=None):
            json_data[i]["number_of_students_found_5_years_after_exit"] = int(json_data[i]["number_of_students_found_5_years_after_exit"])
        if(json_data[i]["median_annual_earnings_5_years_after_exit"]!=None):
            json_data[i]["median_annual_earnings_5_years_after_exit"] = int(json_data[i]["median_annual_earnings_5_years_after_exit"])
        if(json_data[i]["average_annual_earnings_5_years_after_exit"]!=None):
            json_data[i]["average_annual_earnings_5_years_after_exit"] = int(json_data[i]["average_annual_earnings_5_years_after_exit"])

    with open(self.file+'.json', 'w') as outfile:
      json.dump(json_data, outfile, indent=4)

  def jsonSanitizeNaics(self,fileName):

    import json
    json_data = json.load(open(self.file+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["naics"]!=None):
            json_data[i]["naics"]= int(json_data[i]["naics"])

    with open(self.file+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)

  def masterPathWagesToJson(self):
    with open (self.file+'_Dictionary.json', 'w' ) as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  
  return
    


class JsonMajor:
  def __init__(self,file,df,universityMajorDictionary):
    self.file = file
    self.df = df
    self.dictionary = self.createDictionary(universityMajorDictionary) 
	
  
  def createDictionary(self,universityMajorDictionary):
    output = universityMajorDictionary.to_dict(orient='record')

    hegisDictionary = {}
    index = 1
    for row in output:
        # campus = int(row['campus'])
        hegis =  int(row['hegis_at_exit'])
        hegisDictionary[hegis] = index
        index +=1
    del output
    dictionary  = {70:hegisDictionary}
    
    with open (self.file+'_Dictionary.json', 'w' ) as fp:
        fp.write(simplejson.dumps(dictionary, sort_keys=False,indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()  

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

    with open (fileName+'.json', 'w' ) as fp:
      fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()
  
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
        
       

    with open(fileName+'.json', 'w') as outfile:
      json.dump(json_data, outfile, indent=4)
    outfile.close()


    