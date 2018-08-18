import pandas as pd

import numpy as np
import simplejson



class DataFrame:
    def __init__(self,file):
        self.file = file
        self.df = pd.read_csv(self.file+'.csv')
        self.dataframe_builder()
        self.headerSanitizer()
        pass
    
    def dataframe_builder(self):
        self.df = self.df.rename(columns=lambda x: x.replace('#', 'number'))
        self.df = self.df.replace(['*****', np.NaN], np.NaN)

    def headerSanitizer(self):
        self.df.columns = self.df.columns.str.replace(' ','_')
        self.df.columns = self.df.columns.str.lower()
        for i,col in enumerate(self.df.columns):
            if(col[0] in '123456789'):
                self.df = self.df.rename(index=str, columns={str(col): "_"+str(col)})
    
    def dfHead(self):
        print (self.df.head())

    def giveColumnHeads(self):
        for column in self.df:
            print(column)
    
    def __str__(self):
        print(self.df)
    
     # sanitize column
    def column_sanitize_plus(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('+','')
        self.df[columnName] = self.df[columnName].str.replace(' ','')

    
    # converts to floats...
    def string_number_to_real_number(self,columnName):
        self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    def remove_dollar(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('$', '')

    def remove_hyphen(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('-','')

    def remove_comma(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace(',','')

    ### These are the common sanitizations that both jsons require
    def sanitizeCommon(self):
        self.column_sanitize_plus('entry_status')
        # need to remove plus and make into float
        self.column_sanitize_plus('hegis_at_exit')
        self.string_number_to_real_number('hegis_at_exit')

    ### Both jsons will need this method
    def dollar_column(self,columnName):
        self.remove_dollar(columnName)
        self.remove_comma(columnName)
        self.string_number_to_real_number(columnName)

class SanitizeIndustry:
    def __init__():
        pass 

class SanitizeMajor(DataFrame):
    def __init__(self,file):
        super().__init__(file)
        self.sanitizeCommon()
        self.sanitizeMajor()
        self.jsonBuilder()
        pass

    ### Temporary, will follow ur flow chart on monday ... lazy atm
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

    # for ur industry just copy something similiar to this
    def sanitizeMajor(self):
        mapper = {
            'potential_number_of_students':self.string_number_to_real_number('potential_number_of_students') ,
            'potential_number_of_students_for_each_year_out_of_school':self.string_number_to_real_number('potential_number_of_students_for_each_year_out_of_school'),
            '_25th_percentile_earnings':self.dollar_column('_25th_percentile_earnings'),
            '_50th_percentile_earnings':self.dollar_column('_50th_percentile_earnings'),
            '_75th_percentile_earnings':self.dollar_column('_75th_percentile_earnings'),
            'average_earnings':self.dollar_column('average_earnings'),
            'number_of_students_found':self.string_number_to_real_number('number_of_students_found')
        }
        for column in self.df:
            pd.Series(column).map(mapper)

    # Graveyard just in case we need but I doubt we'll need these... 
    #     # converts to floats...
    # def string_number_to_real_number(self,columnName):
    #     self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    # def remove_dollar(self,columnName):
    #     self.df[columnName] = self.df[columnName].str.replace('$', '')

    # def remove_hyphen(self,columnName):
    #     self.df[columnName] = self.df[columnName].str.replace('-','')

    # def remove_comma(self,columnName):
    #     self.df[columnName] = self.df[columnName].str.replace(',','')
    



# class CsvHelper:
#     def __init__(self,file):
#         self.file = file
#         self.df = pd.read_csv(self.file+'.csv')
#         self.dataframe_builder()
#         self.columnSanitizer()
#         pass
    
#     def dataframe_builder(self):
#         self.df = self.df.rename(columns=lambda x: x.replace('#', 'number'))
#         self.df = self.df.replace(['*****', np.NaN], np.NaN)

#     def columnSanitizer(self):
#         self.df.columns = self.df.columns.str.replace(' ','_')
#         self.df.columns = self.df.columns.str.lower()
    
#     # sanitize column
#     def column_sanitize_plus(self,columnName):
#         self.df[columnName] = self.df[columnName].str.replace('+','')
#         self.df[columnName] = self.df[columnName].str.replace(' ','')

    
#     # converts to floats...
#     def string_number_to_real_number(self,columnName):
#         self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

#     def remove_dollar(self,columnName):
#         self.df[columnName] = self.df[columnName].str.replace('$', '')

#     def remove_hyphen(self,columnName):
#         self.df[columnName] = self.df[columnName].str.replace('-','')

#     def remove_comma(self,columnName):
#         self.df[columnName] = self.df[columnName].str.replace(',','')

#     def jsonBuilder(self):
#         # data frame to dict
#         output = self.df.to_dict(orient='record')

#         # dict to json, file is name
#         with open (self.file+'.json', 'w' ) as fp:
#           fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
#         fp.close()

#         import json
#         json_data = json.load(open(self.file+'.json'))
#         for i in range(0, len(json_data)):
#             if(json_data[i]["naics"]!=None):
#                 json_data[i]["naics"]= int(json_data[i]["naics"])
#             if(json_data[i]["number_of_students_found_5_years_after_exit"]!=None):
#                 json_data[i]["number_of_students_found_5_years_after_exit"] = int(json_data[i]["number_of_students_found_5_years_after_exit"])
#             if(json_data[i]["median_annual_earnings_5_years_after_exit"]!=None):
#                 json_data[i]["median_annual_earnings_5_years_after_exit"] = int(json_data[i]["median_annual_earnings_5_years_after_exit"])
#             if(json_data[i]["average_annual_earnings_5_years_after_exit"]!=None):
#                 json_data[i]["average_annual_earnings_5_years_after_exit"] = int(json_data[i]["average_annual_earnings_5_years_after_exit"])

#         with open(self.file+'.json', 'w') as outfile:
#             json.dump(json_data, outfile, indent=4)

#     # used for debugging
#     # returns first few rows of dataframe
#     def dfHead(self):
#         print (self.df.head())
    
#     # we need column headers in each sanitization..
#     # that self.file is only used for write to and read to purposes
#     # we use inclusive or in mapping

#     def sanitizeHeaders(self):
#         mapper = {
#             'naics':self.remove_hyphen('naics') or self.string_number_to_real_number('naics'),
#             'hegis_at_exist':self.column_sanitize_plus('hegis_at_exit') or self.string_number_to_real_number('hegis_at_exit'),
#             'median_annual_earnings_5_years_after_exit':self.remove_dollar('median_annual_earnings_5_years_after_exit') or self.remove_comma('median_annual_earnings_5_years_after_exit') or self.string_number_to_real_number('median_annual_earnings_5_years_after_exit'),
#             'average_annual_earnings_5_years_after_exit':self.remove_dollar('average_annual_earnings_5_years_after_exit') or self.remove_comma('average_annual_earnings_5_years_after_exit') or self.string_number_to_real_number('average_annual_earnings_5_years_after_exit'),
#             'number_of_students_found_5_years_after_exit':self.remove_dollar('number_of_students_found_5_years_after_exit') or self.remove_comma('number_of_students_found_5_years_after_exit') or self.string_number_to_real_number('number_of_students_found_5_years_after_exit'),
#         }
#         for column in self.df:
#             print(column)
#             pd.Series(column).map(mapper)
    
#     def giveColumnHeads(self):
#         for column in self.df:
#             print(column)