import pandas as pd
import numpy as np
import simplejson

from csuMetro_Parsing.csvSanitizer.majorSanitizer import Sanitize_Major

from csuMetro_Parsing.jsonBuilder.JsonMajorSanitizer import JsonMajor
from csuMetro_Parsing.jsonBuilder.JsonIndustrySanitizer import JsonIndustry


from csuMetro_Parsing.UniversityMajorJsonBuilder import hegisID

from csuMetro_Parsing.naicsdataFrameMaker import create_naics_dataFrame

from csuMetro_Parsing.csvSanitizer.industrySanitizer import Sanitize_Industry
from csuMetro_Parsing.csvSanitizer.industrySanitizer import DFHelper

from csuMetro_Parsing.dataframeToCSV import DfToCSV
from csuMetro_Parsing.jsonOutput import JsonOutPut
# from csuMetro_Parsing.addUniqueIdentifier import AddUniqueId

class IterateCsvFiles():
  
    def __init__(self):
      self.jsonOutputter = JsonOutPut()
      self.globalIndex = 1
    
    def create_hegis_code_data_frame(self,universityMajorsDataFrame):
        print(universityMajorsDataFrame.head())
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisTable.convert_hegis_codes_table_data_json()
      
    def master_majors_csv_to_json(self,majorsCsvFiles):
      indexUniversityMajorsId = 1  
      filePath = '../../database/data/'
      # universityMajorsDataFrame = pd.DataFrame()
      MasterUni = pd.DataFrame()

      for csv in majorsCsvFiles:
        fileName = csv.replace("_majors","")
        majorSanitize = Sanitize_Major(csv,self.globalIndex,indexUniversityMajorsId) # Object contains a dataFrame

        majorPathDf,majorPathWageDf = majorSanitize.get_Majors_Paths_Data_Frame()# get Table equiv Data Frames
        
        universityMajorDictionaryDf = majorSanitize.get_University_Majors_Dictionary_Data_Frame() # Returns a dictionary DF

        self.globalIndex = majorSanitize.get_global_index()
        indexUniversityMajorsId = majorSanitize.get_index_of_university_majors_id()
        
        jsonMajor = JsonMajor(fileName,universityMajorDictionaryDf) #Returns the Json
        
        majorPathDf,majorPathWageDf = jsonMajor.getMajorsTables(majorPathDf,majorPathWageDf)   # Sanitize majorPath Df
        
        filePathMajorPath = filePath + '/majorPathData/Major_Path_'+ fileName+'.json'
        self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePathMajorPath,majorPathDf)
        
        filePathMajorWages = filePath + '/majorPathWagesData/Major_Path_Wages_'+ fileName+'.json'
        self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePathMajorWages,majorPathWageDf)

        MasteruniversityMajorIdDf = jsonMajor.getUniversityMajorIdDf()
        print("***************************")
        print(MasteruniversityMajorIdDf.head())
        universityMajorsIDf = hegisID(MasteruniversityMajorIdDf)
        universityMajorsIDf.convert_to_json(fileName)

        # print(universityMajorIdDf.head())

        MasterUni = MasterUni.append( MasteruniversityMajorIdDf , ignore_index=True)

        del majorSanitize
        del MasteruniversityMajorIdDf
        del universityMajorDictionaryDf
        del jsonMajor
        del majorPathDf
        del majorPathWageDf
      
      self.create_hegis_code_data_frame(MasterUni)


    def create_industry_naics_data_frame_and_create_dictionary(self,industryCsvFiles):
      '''
      loop through the csvs only extracting a for industry and appending it the previous data frame
      '''
      masterNaicsDataFrame = pd.DataFrame()
      for csv in industryCsvFiles:
        naicsObj = create_naics_dataFrame(csv)
        naicsDF = naicsObj.getDataFrame()
        masterNaicsDataFrame = masterNaicsDataFrame.append( naicsDF , ignore_index=True)

      masterNaicsDataFrame = masterNaicsDataFrame.drop_duplicates(subset=['industry'], keep='first')

      masterNaicsDataFrame.loc[:,'id'] = range(1, len(masterNaicsDataFrame) + 1)

      masterNaicsDataFrame,naicsDictionary = naicsObj.getImages(masterNaicsDataFrame)
      
      filePath = '../../database/data/master_naics_titles.json'
      self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePath,masterNaicsDataFrame)

      return naicsDictionary  

    def master_industry_csv_to_json(self,industryCsvFiles):
      naicsDictionary = self.create_industry_naics_data_frame_and_create_dictionary(industryCsvFiles)
      
      self.globalIndex = 1
      filePath = '../../database/data/'

      for csv in industryCsvFiles:
        fileName = csv.replace("_industry","")
        industrySanitize = Sanitize_Industry(csv,self.globalIndex)
        industrySanitize.create_industry_with_df(naicsDictionary)
        self.globalIndex = industrySanitize.get_index()

        industryPathTypes,industryPathWages,populationTable = industrySanitize.get_Industry_Data_Frame()

        filePathIndustryPath = filePath + '/industryPathTypesData/Industry_Path_Types_'+fileName+'.json'
        self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePathIndustryPath,industryPathTypes)
        filePathIndustryWages = filePath + '/industryPathWagesData/Industry_Path_Wages_'+fileName+'.json'
        self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePathIndustryWages,industryPathWages)
        filePathPopulation = filePath + '/populationData/Industry_Population_'+fileName+'.json'
        self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePathPopulation,populationTable)
