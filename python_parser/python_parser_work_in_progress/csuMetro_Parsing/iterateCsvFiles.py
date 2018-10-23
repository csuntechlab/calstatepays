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
    
    def create_hegis_code_data_frame(self,universityMajorsDataFrame,MajorsPathsDataFrame,MajorsPathWageDataFrame):
        print(universityMajorsDataFrame.head())
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisTable.convert_To_Json()
        
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisDataFrame = hegisTable.get_hegis_codes_table_data_frame()

        filePath = '../../database/data/'
        self.jsonOutputter.convert_df_to_dictionary_then_out_put_to_json(filePath+'master_hegis_category_table.json',hegisDataFrame)

        filePathMajorPath = filePath + '/majorPathData/Major_Path_'
        self.jsonOutputter.json_output_by_university_path(filePathMajorPath,MajorsPathsDataFrame)
        
        filePathMajorWages = filePath + '/majorPathWagesData/Major_Path_Wages_'
        self.jsonOutputter.json_output_by_university_wages(filePathMajorWages,MajorsPathsDataFrame,MajorsPathWageDataFrame,'id','major_path_id')
      
    def master_majors_csv_to_json(self,majorsCsvFiles):
      indexUniversityMajorsId = 1  
      indexMajorPathId = 1  
      
      universityMajorsDataFrame = pd.DataFrame()
      MajorsPathsDataFrame = pd.DataFrame()
      MajorsPathWageDataFrame = pd.DataFrame()

      MasterMajorsDataframe = pd.DataFrame()
      # powerUserDataFrame = pd.DataFrame()

      for csv in majorsCsvFiles:
        fileName = csv.replace("_majors","")
        majorSanitize = Sanitize_Major(csv) # Object contains a dataFrame
        
        majorsDataFrame =  majorSanitize.get_majors_dataframe()
        # powerUserDataFrame = powerUserDataFrame.append( powerDataFrame , ignore_index=True )
        MasterMajorsDataframe = MasterMajorsDataframe.append( majorsDataFrame , ignore_index=True )

        majorPathDf,majorPathWageDf = majorSanitize.get_Majors_Paths_Data_Frame()# get Table equiv Data Frames
        
        universityMajorDictionaryDf = majorSanitize.get_University_Majors_Dictionary_Data_Frame() # Returns a dictionary DF

        
        jsonMajor = JsonMajor(fileName,universityMajorDictionaryDf,universityMajorsDataFrame,indexUniversityMajorsId, indexMajorPathId) #Returns the Json
        
        majorPathDf,majorPathWageDf = jsonMajor.getMajorsTables(majorPathDf,majorPathWageDf)   # Sanitize majorPath Df

        MajorsPathsDataFrame = MajorsPathsDataFrame.append( majorPathDf , ignore_index=True)
        MajorsPathWageDataFrame = MajorsPathWageDataFrame.append( majorPathWageDf , ignore_index=True)

        indexUniversityMajorsId,indexMajorPathId = jsonMajor.getIndex() # gets index

        universityMajorIdDf = jsonMajor.getUniversityMajorIdDf()

        # print(universityMajorIdDf.head())

        universityMajorsDataFrame = universityMajorIdDf

        del majorSanitize
        # del majorDataFrame
        del universityMajorDictionaryDf
        del jsonMajor
        del majorPathDf
        del majorPathWageDf
    
      
      DfToCSV(MasterMajorsDataframe,'_majors')
      
      # AddUniqueId(MasterMajorsDataFrame)
      

      self.create_hegis_code_data_frame(universityMajorsDataFrame,MajorsPathsDataFrame,MajorsPathWageDataFrame)


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
      
      self.json_output('master_naics_titles',masterNaicsDataFrame)

      return naicsDictionary  

    def master_industry_csv_to_json(self,industryCsvFiles):
      naicsDictionary = self.create_industry_naics_data_frame_and_create_dictionary(industryCsvFiles)

      masterIndustry = pd.DataFrame()

      for csv in industryCsvFiles:
        fileName = csv.replace("_industry","")
        industrySanitize = Sanitize_Industry(csv)
        industrySanitize.create_industry_with_df(naicsDictionary)
        masterIndustry = masterIndustry.append( industrySanitize.returnDf() , ignore_index=True)

      DfToCSV(masterIndustry,'_industry')

      industryMasterHelper = DFHelper(masterIndustry)
      print("TEXT GOES HERE TEST")

      errorDataFrame,duplicateHegisCodeDifferentMajor = industryMasterHelper.get_errors_data_frame()
      # get Table equiv Data Frames
      
      industryPathTypesDf,industryPathWagesDf,populationTable = industryMasterHelper.get_Industry_Data_Frame()

      industryMasterHelper.create_master_dict()
      fileName = 'master_industry'

      # init json Industry
      jsonIndustry = JsonIndustry(fileName)

      self.json_output("industry_different_hegis_same_major",errorDataFrame)
      self.json_output("industry_same_hegis_different_major",duplicateHegisCodeDifferentMajor)
      #update Industry PathTypes
      industryPathTypesDf = jsonIndustry.getIndustryPathTypesDfTable(industryPathTypesDf)
      
      # JSon Outputs 
      jsonIndustry.jsonOutput(fileName+"_industry_path",industryPathTypesDf)
      jsonIndustry.jsonOutput(fileName+"_industry_path_wages",industryPathWagesDf)
      jsonIndustry.jsonOutput(fileName+"_population",populationTable)
      
      jsonIndustry.jsonSanitizeWages(fileName+"_industry_path_wages")
      jsonIndustry.jsonSanitizePath(fileName+"_industry_path")
      jsonIndustry.jsonSanitizeNaics(fileName+"_naics_titles")



    def json_output(self,fileName, df):
      output = df.to_dict(orient='record')

      with open ('../../database/data/'+fileName+'.json', 'w' ) as fp:
        fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
      fp.close()