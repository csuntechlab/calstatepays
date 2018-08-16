import pandas as pd

import numpy as np
import simplejson

class CsvHelper(object):
    def __init__(self,file):
        self.file = file
        self.df = pd.read_csv(self.file+'.csv')
        pass
    
    def dataframe_builder(self):
        self.df = self.df.rename(columns=lambda x: x.replace('#', 'number'))
        self.df = self.df.replace(['*****', np.NaN], np.NaN)

    def columnSanitizer(self):
        self.df.columns = self.df.columns.str.replace(' ','_')
        self.df.columns = self.df.columns.str.lower()
    
        # sanitize column
    def column_sanitize_plus(self):
        self.df[self.file] = self.df[self.file].str.replace('+','')
        self.df[self.file] = self.df[self.file].str.replace(' ','')

    
    # converts to floats...
    def string_number_to_real_number(self):
        self.df[self.file] = pd.to_numeric(self.df[self.file], errors='coerce')

    def remove_dollar(self):
        self.df[self.file] = self.df[self.file].str.replace('$', '')
        string_number_to_real_number(self.df,self.file)

    def remove_hypthen(self):
        self.df[self.file] = self.df[self.file].str.replace('-','')
        string_number_to_real_number(self.df,self.file)
    
    def jsonBuilder(self):
        # data frame to dict
        output = self.df.to_dict(orient='record')

        # dict to json, file is name
        with open (self.file+'.json', 'w' ) as fp:
          fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
        fp.close()

        import json
        json_data = json.load(open(self.file+'.json'))
        for i in range(0, len(json_data)):
            if(json_data[i]["naics"]!=None):
                json_data[i]["naics"]= int(json_data[i]["naics"])
            if(json_data[i]["number_of_students_found"]!=None):
                json_data[i]["number_of_students_found"] = int(json_data[i]["number_of_students_found"])
            if(json_data[i]["median_annual_earnings"]!=None):
                json_data[i]["median_annual_earnings"] = int(json_data[i]["median_annual_earnings"])
            if(json_data[i]["average_annual_earnings"]!=None):
                json_data[i]["average_annual_earnings"] = int(json_data[i]["average_annual_earnings"])

        with open(self.file+'.json', 'w') as outfile:
            json.dump(json_data, outfile, indent=4)
            