import pandas as pd

import numpy as np
import simplejson
import json

class JsonMajor:
  def __init__(self,file,df,universityMajorDictionary):
    self.file = file
    self.df = df
    # self.createDictionary(universityMajorDictionary) 
    # self.jsonOutput(dictionary,universityMajorDictionary) 
    # self.dictionary = universityMajorDictionary
    self.jsonOutput()
    self.jsonSanitize()
	
  def createDictionary(self,universityMajorDictionary):
    output = universityMajorDictionary.to_dict(orient='record')
    
    print(output)
    
    with open (self.file+'_Dictionary.json', 'w' ) as fp:
        fp.write(simplejson.dumps(output, sort_keys=False, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
    fp.close()

    

    # with open(self.file+'.json', 'w') as outfile:
        # json.dump(output, outfile, indent=4)
    # outfile.close()
    # dict to json, file is name
    # with open ('universityMajorNorthridge.json', 'w' ) as fp:
    #     json.dump(output,fp, indent=4))
    # fp.close()
  	


  
  def jsonOutput(self):
    # data frame to dict
        output = self.df.to_dict(orient='record')

        # dict to json, file is name
        with open (self.file+'.json', 'w' ) as fp:
          fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
        fp.close()
  
  ##maybe return a  json
  # create an write json method
  def jsonSanitize(self):
    
    json_data = json.load(open(self.file+'.json'))
    for i in range(0, len(json_data)):

        # major path wage 
        if(json_data[i]["_25th_percentile_earnings"]!=None):
            json_data[i]["_25th_percentile_earnings"] = int(json_data[i]["_25th_percentile_earnings"])

        if(json_data[i]["_50th_percentile_earnings"]!=None):
            json_data[i]["_50th_percentile_earnings"] = int(json_data[i]["_50th_percentile_earnings"])

        if(json_data[i]["_75th_percentile_earnings"]!=None):
            json_data[i]["_75th_percentile_earnings"] = int(json_data[i]["_75th_percentile_earnings"])

        # Not Being used Currently   
            # if(json_data[i]["potential_number_of_students"]!=None):
            # json_data[i]["potential_number_of_students"]= int(json_data[i]["potential_number_of_students"])
            
            # if(json_data[i]["potential_number_of_students_for_each_year_out_of_school"]!=None):
            #     json_data[i]["potential_number_of_students_for_each_year_out_of_school"] = int(json_data[i]["potential_number_of_students_for_each_year_out_of_school"]) 
            # if(json_data[i]["average_earnings"]!=None):
            #     json_data[i]["average_earnings"] = int(json_data[i]["average_earnings"])

            # if(json_data[i]["number_of_students_found"]!=None):
            #     json_data[i]["number_of_students_found"] = int(json_data[i]["number_of_students_found"])    

    with open(self.file+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)
    outfile.close()


    