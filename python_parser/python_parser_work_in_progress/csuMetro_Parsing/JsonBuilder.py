import pandas as pd

import numpy as np
import simplejson

class JsonMajor:
  
#   def __init__(self,file,df,universityMajorDictionary):
  def __init__(self,file,df):
    self.file = file
    self.df = df
    # self.universityMajorDictionary = universityMajorDictionary
    self.jsonOutput()
    self.jsonSanitize()
  
  def jsonOutput(self):
    # data frame to dict
        output = self.df.to_dict(orient='record')

        # dict to json, file is name
        with open (self.file+'.json', 'w' ) as fp:
          fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
        fp.close()
  
  def jsonSanitize(self):
    import json
    json_data = json.load(open(self.file+'.json'))
    for i in range(0, len(json_data)):
        if(json_data[i]["potential_number_of_students"]!=None):
            json_data[i]["potential_number_of_students"]= int(json_data[i]["potential_number_of_students"])
            
        if(json_data[i]["potential_number_of_students_for_each_year_out_of_school"]!=None):
            json_data[i]["potential_number_of_students_for_each_year_out_of_school"] = int(json_data[i]["potential_number_of_students_for_each_year_out_of_school"])

        if(json_data[i]["_25th_percentile_earnings"]!=None):
            json_data[i]["_25th_percentile_earnings"] = int(json_data[i]["_25th_percentile_earnings"])

        if(json_data[i]["_50th_percentile_earnings"]!=None):
            json_data[i]["_50th_percentile_earnings"] = int(json_data[i]["_50th_percentile_earnings"])

        if(json_data[i]["_75th_percentile_earnings"]!=None):
            json_data[i]["_75th_percentile_earnings"] = int(json_data[i]["_75th_percentile_earnings"])

        if(json_data[i]["average_earnings"]!=None):
            json_data[i]["average_earnings"] = int(json_data[i]["average_earnings"])

        if(json_data[i]["number_of_students_found"]!=None):
            json_data[i]["number_of_students_found"] = int(json_data[i]["number_of_students_found"])           
    with open(self.file+'.json', 'w') as outfile:
        json.dump(json_data, outfile, indent=4)
    outfile.close()


    