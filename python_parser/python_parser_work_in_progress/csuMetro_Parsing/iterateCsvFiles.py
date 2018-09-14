import pandas as pd
import numpy as np
import simplejson

from csuMetro_Parsing.CsvHelper import Data_Frame_Sanitizer
from csuMetro_Parsing.CsvHelper import Sanitize_Major
from csuMetro_Parsing.CsvHelper import Sanitize_Industry

from csuMetro_Parsing.JsonBuilder import JsonMajor
from csuMetro_Parsing.JsonBuilder import JsonIndustry
from csuMetro_Parsing.UniversityMajorJsonBuilder import hegisID

# from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer
# from csuMetro_Parsing.csvSanitizer.majorSanitizer import Sanitize_Major
# from csuMetro_Parsing.csvSanitizer.industrySanitizer import Sanitize_Industry


class IterateCsvFiles():
  
    def __init__(self):
        pass
    
    def create_hegis_code_data_frame(self,universityMajorsDataFrame,MajorsPathsDataFrame,MajorsPathWageDataFrame):
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisTable.convert_To_Json()
        
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisDataFrame = hegisTable.get_hegis_codes_table_data_frame()
        hegisTable.json_output('master_hegis_category_table',hegisDataFrame)

        hegisTable.json_output('master_majors_path_table',MajorsPathsDataFrame)
        hegisTable.json_output('master_majors_path_wage_table',MajorsPathWageDataFrame)
        hegisTable.jsonSanitize('master_majors_path_wage_table')

        # print(hegisDataFrame)
    
    def master_majors_csv_to_json(self,majorsCsvFiles):
      indexUniversityMajorsId = 1  
      indexMajorPathId = 1  
      # universityMajorsList = []
      col = ["hegis_codes" ,"university_id" ,"major","id"]
      universityMajorsDataFrame = pd.DataFrame()
      MajorsPathsDataFrame = pd.DataFrame()
      MajorsPathWageDataFrame = pd.DataFrame()

      for csv in majorsCsvFiles:
        fileName = csv.replace("_majors","")
        majorSanitize = Sanitize_Major(csv) # Object contains a dataFrame
        majorDataFrame = majorSanitize.sanitize_Major() #sanitizes major

        majorPathDf,majorPathWageDf = majorSanitize.get_Majors_Paths_Data_Frame()# get Table equiv Data Frames


# csvSanitizer.majorSanitizer = Sanitize_Major
# csvSanitizer.industrySanitizer = Sanitize_Major
        universityMajorDictionaryDf = majorSanitize.get_University_Majors_Dictionary_Data_Frame() # Returns a dictionary DF

        # majorDataFrame csvSanitizer.majorSanitizer majorSanitize.sanitize_Major
        # majorDataFrame csvSanitizer.industrySanitizer majorSanitize.sanitize_Major
        
        jsonMajor = JsonMajor(fileName,universityMajorDictionaryDf,universityMajorsDataFrame,indexUniversityMajorsId, indexMajorPathId) #Returns the Json
        
        majorPathDf,majorPathWageDf = jsonMajor.getMajorsTables(majorPathDf,majorPathWageDf)   # Sanitize majorPath Df

        MajorsPathsDataFrame = MajorsPathsDataFrame.append( majorPathDf , ignore_index=True)
        MajorsPathWageDataFrame = MajorsPathWageDataFrame.append( majorPathWageDf , ignore_index=True)

        indexUniversityMajorsId,indexMajorPathId = jsonMajor.getIndex() # gets index

        # jsonMajor.jsonOutput(fileName+"_majors_path",majorPathDf)
        # jsonMajor.jsonOutput(fileName+"_majors_path_wages",majorPathWageDf)
        # jsonMajor.jsonSanitize(fileName+"_majors_path_wages")

        universityMajorIdDf = jsonMajor.getUniversityMajorIdDf()

        universityMajorsDataFrame = universityMajorIdDf

        del majorSanitize
        del majorDataFrame
        del universityMajorDictionaryDf
        del jsonMajor
        del majorPathDf
        del majorPathWageDf
    #   print(universityMajorsDataFrame)
    
      print(MajorsPathsDataFrame)
      print(MajorsPathWageDataFrame)
      self.create_hegis_code_data_frame(universityMajorsDataFrame,MajorsPathsDataFrame,MajorsPathWageDataFrame)


    def master_industry_csv_to_json(self,industryCsvFiles):
      for csv in industryCsvFiles:
        # fileName = csv.replace("_industry","")
        fileName = csv.replace("_updated_industry","")

        industrySanitize = Sanitize_Industry(csv)      
        # get Table equiv Data Frames
        industryPathTypesDf,industryPathWagesDf,naics_titlesDf = industrySanitize.get_Industry_Data_Frame()



        # init json Industry
        jsonIndustry = JsonIndustry(fileName)
        #update Industry PathTypes
        industryPathTypesDf = jsonIndustry.getIndustryPathTypesDfTable(industryPathTypesDf)

        print(industryPathTypesDf)
        print(industryPathTypesDf.keys())
        
        # JSon Outputs 
        jsonIndustry.jsonOutput(fileName+"_industry_path",industryPathTypesDf)
        jsonIndustry.jsonOutput(fileName+"_industry_path_wages",industryPathWagesDf)
        jsonIndustry.jsonOutput(fileName+"_naics_titles",naics_titlesDf)
        jsonIndustry.jsonSanitizeWages(fileName+"_industry_path_wages")
        jsonIndustry.jsonSanitizePath(fileName+"_industry_path")
        jsonIndustry.jsonSanitizeNaics(fileName+"_naics_titles")

        del industrySanitize
        del industryDataFrame
        del industryPathTypesDf
        del industryPathWagesDf
        del naics_titlesDf
