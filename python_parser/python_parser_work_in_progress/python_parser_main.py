import os
from os import listdir
from os.path import isfile, join

import pandas as pd
import numpy as np
import simplejson
from csuMetro_Parsing.CsvHelper import DataFrame
from csuMetro_Parsing.CsvHelper import SanitizeMajor
from csuMetro_Parsing.CsvHelper import SanitizeIndustry

from csuMetro_Parsing.JsonBuilder import JsonMajor
# from csuMetro_Parsing.IterateCsvFiles import IterateCsvFiles

class IterateCsvFiles():
  
    def __init__(self):
        pass
    
    def master_majors_csv_to_json(self,majorsCsvFiles):
      for csv in majorsCsvFiles:
        # print(csv)  
        fileName = csv.replace("_majors","")
        majorSanitize = SanitizeMajor(csv) # Object contains a dataFrame
        majorDataFrame = majorSanitize.sanitizeMajor() #sanitizes major
        majorPathDf,majorPathWageDf = majorSanitize.getMajorPathsDF()

        universityMajorDictionary = majorSanitize.getUniversityMajorDictionary() # Returns a dictionary
        # print(universityMajorDictionary)
        # 
        jsonMajor = JsonMajor(csv,majorDataFrame,universityMajorDictionary) #Returns the Json
        majorPathDf = jsonMajor.getMajorsTables(majorPathDf)
        jsonMajor.jsonOutput(fileName+"_majors_path",majorPathDf)
        jsonMajor.jsonOutput(fileName+"_majors_path_wages",majorPathWageDf)
        jsonMajor.jsonSanitize(fileName+"_majors_path_wages")
        # majorPathTb,majorPathWageTb = jsonMajor.getMajorsTables(majorPathDf,majorPathWageDf)
        # jsonMajor = JsonMajor(csv,majorDataFrame) #Returns the Json

        del majorSanitize
        del majorDataFrame
        del universityMajorDictionary
        del jsonMajor
        del majorPathDf
        del majorPathWageDf
        # del majorPathTb
        # del majorPathWageTb

    def master_industry_csv_to_json(self,industryCsvFiles):
      for csv in industryCsvFiles:
        print(csv)  
        industrySanitize = SanitizeIndustry(csv)
        del industrySanitize
        # # csvSanitize = CsvHelper(csv)
        # print(csvSanitize.dfHead())
        # # this method is to test and see first few results in terminal
        # csvSanitize.sanitizeHeaders()
        # print(csvSanitize.dfHead())
        # csvSanitize.jsonBuilder()

def sort_csv_files(csvFiles):
    majorsCsvFiles = []
    industryCsvFiles = []
    for csv in csvFiles:
        if 'majors' in csv:
            majorsCsvFiles.append(csv.replace('.csv',''))
        elif 'industry' in csv:
            industryCsvFiles.append(csv.replace('.csv',''))
    return majorsCsvFiles,industryCsvFiles

def main( iterateCsvFiles = IterateCsvFiles() ):
#   able to get all csv files within working dir, 
#   sort csv's based on majors/industry
#   

    mypath = os.getcwd()
    
    csvFiles = [csvFile for csvFile in listdir(mypath) 
                 if isfile(join(mypath, csvFile)) 
                 if '.csv' in csvFile]
    
    majorsCsvFiles,industryCsvFiles = sort_csv_files(csvFiles)
    
    iterateCsvFiles.master_majors_csv_to_json(majorsCsvFiles)
    # iterateCsvFiles.master_industry_csv_to_json(industryCsvFiles)
    
if __name__ == "__main__": main()
    
