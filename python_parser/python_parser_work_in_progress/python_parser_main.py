import pandas as pd
import numpy as np

import os
from os import listdir
from os.path import isfile, join

import pandas as pd
import numpy as np
import simplejson
from csuMetro_Parsing.CsvHelper import Data_Frame_Sanitizer
from csuMetro_Parsing.CsvHelper import Sanitize_Major
from csuMetro_Parsing.CsvHelper import Sanitize_Industry

from csuMetro_Parsing.JsonBuilder import JsonMajor
from csuMetro_Parsing.JsonBuilder import JsonIndustry
from csuMetro_Parsing.UniversityMajorJsonBuilder import hegisID

class IterateCsvFiles():
  
    def __init__(self):
        pass
    
    def create_hegis_code_data_frame(self,universityMajorsDataFrame):
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisTable.convert_To_Json()
        
        hegisTable = hegisID(universityMajorsDataFrame)
        hegisDataFrame = hegisTable.get_hegis_codes_table_data_frame()
        hegisTable.json_output('master_hegis_category_table',hegisDataFrame)
        # print(hegisDataFrame)
    
    def master_majors_csv_to_json(self,majorsCsvFiles):
      index = 1  
      # universityMajorsList = []
      col = ["hegis_codes" ,"university_id" ,"major","id"]
      universityMajorsDataFrame = pd.DataFrame()

      for csv in majorsCsvFiles:
        fileName = csv.replace("_majors","")
        majorSanitize = Sanitize_Major(csv) # Object contains a dataFrame
        majorDataFrame = majorSanitize.sanitize_Major() #sanitizes major

        majorPathDf,majorPathWageDf = majorSanitize.get_Majors_Paths_Data_Frame()# get Table equiv Data Frames

        universityMajorDictionaryDf = majorSanitize.get_University_Majors_Dictionary_Data_Frame() # Returns a dictionary DF
        
        jsonMajor = JsonMajor(fileName,universityMajorDictionaryDf,universityMajorsDataFrame,index) #Returns the Json
        
        majorPathDf = jsonMajor.getMajorsTables(majorPathDf)   # Sanitize majorPath Df

        index = jsonMajor.getIndex() # gets index

        jsonMajor.jsonOutput(fileName+"_majors_path",majorPathDf)
        jsonMajor.jsonOutput(fileName+"_majors_path_wages",majorPathWageDf)
        jsonMajor.jsonSanitize(fileName+"_majors_path_wages")

        universityMajorIdDf = jsonMajor.getUniversityMajorIdDf()

        universityMajorsDataFrame = universityMajorIdDf

        del majorSanitize
        del majorDataFrame
        del universityMajorDictionaryDf
        del jsonMajor
        del majorPathDf
        del majorPathWageDf
    #   print(universityMajorsDataFrame)
      self.create_hegis_code_data_frame(universityMajorsDataFrame)


    def master_industry_csv_to_json(self,industryCsvFiles):
      for csv in industryCsvFiles:
        # fileName = csv.replace("_industry","")
        fileName = csv.replace("_updated_industry","")

        industrySanitize = Sanitize_Industry(csv)
        industryDataFrame = industrySanitize.sanitize_Industry()         
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

# i got bored and created this weird way to combat the awkward first two rows in the industry csvs
# notice the first two rows, it seems awkward to not do this I think
def remove_row_of_industry(industryFiles):
    industryUpdated = []
    for csv in industryFiles:
        df1 = pd.read_csv(csv+'.csv', skiprows=1)
        fileName = csv.replace("_industry","")
        fileName = fileName + '_updated_industry'

        # sorry for the n^2 wasn't able to think of a easier way to combat this dumb header problem

        mapper = {
            '# of Students Found':df1.rename(columns={'# of Students Found': '# of Students Found 5 years after exit'}, inplace=True),
            'Median Annual Earnings':df1.rename(columns={'Median Annual Earnings': 'Median Annual Earnings 5 years after exit'}, inplace=True),
            'Average Annual Earnings':df1.rename(columns={'Average Annual Earnings': 'Average Annual Earnings 5 years after exit'}, inplace=True),
            '# of Students Found.1':df1.rename(columns={'# of Students Found.1': '# of Students Found 10 years after exit'}, inplace=True),
            'Median Annual Earnings.1':df1.rename(columns={'Median Annual Earnings.1': 'Median Annual Earnings 10 years after exit'}, inplace=True),
            'Average Annual Earnings.1':df1.rename(columns={'Average Annual Earnings.1': 'Average Annual Earnings 10 years after exit'}, inplace=True),
        }
        for column in df1:
            pd.Series(column).map(mapper)

        df1.to_csv(fileName+'.csv',index = False)
        industryUpdated.append(fileName)
        
    return industryUpdated

def remove_temp_industry_file(industryFiles):
    for csv in industryFiles:
        if os.path.exists(csv+'.csv'):
            os.remove(csv+'.csv')
            print('delted')
    else:
        print("The file does not exist")

# I think its best not to wait for the client to update us with the major column
# I assume the 
# def frankensteinDominguez():
#     dfMajor = pd.read_csv('')


def get_csv_files_in_this_directory():
    '''
    sort all the csv files to two lists
    have a list for majors csv files
    have a list for industry csv files
    '''
    majorsCsvFiles = []
    industryCsvFiles = []

    path = os.getcwd() + '/csv'
  
    csvFiles = [csvFile for csvFile in listdir(path) 
                 if isfile(join(path, csvFile)) 
                 if '.csv' in csvFile]
    
    for csv in csvFiles:
        if 'majors' in csv:
            majorsCsvFiles.append(csv.replace('.csv',''))
        elif 'industry' in csv:
            industryCsvFiles.append(csv.replace('.csv',''))

    return majorsCsvFiles,industryCsvFiles


def main( iterateCsvFiles = IterateCsvFiles() ):
    '''
    send list of files to be parsed
    '''
    majorsCsvFiles,industryCsvFiles = get_csv_files_in_this_directory()

    # iterateCsvFiles.master_majors_csv_to_json(majorsCsvFiles)

    # updateIndustry = remove_row_of_industry(industryCsvFiles)
    iterateCsvFiles.master_industry_csv_to_json(industryCsvFiles)
    # remove_temp_industry_file(updateIndustry)
    
if __name__ == "__main__": main()
    
