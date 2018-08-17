import os
from os import listdir
from os.path import isfile, join

import pandas as pd
import numpy as np
import simplejson

# from csuMetro_Parsing.CsvToJson import CsvToJson
from csuMetro_Parsing.CsvHelper import CsvHelper


class CsvToJson():

    def __init__(self):
        pass
    
    def master_majors_csv_to_json(self,majorsCsvFiles):
        for csv in majorsCsvFiles:
            print(csv) 
            csvSanatize = CsvHelper(csv)
            # dir (CsvHelper)
            
            # print (obj)
            # pass

    def master_industry_csv_to_json(self,industryCsvFiles):
        for csv in industryCsvFiles:
            print(csv) 
            csvSanitize = CsvHelper(csv)
            print(csvSanitize.dfHead())
            # this method is to test and see first few results in terminal
            csvSanitize.sanitizeHeaders()
            print(csvSanitize.dfHead())
            csvSanitize.jsonBuilder()


def sort_csv_files(csvFiles):
    majorsCsvFiles = []
    industryCsvFiles = []
    for csv in csvFiles:
        if 'majors' in csv:
            majorsCsvFiles.append(csv.replace('.csv',''))
        elif 'industry' in csv:
            industryCsvFiles.append(csv.replace('.csv',''))
    return majorsCsvFiles,industryCsvFiles

# def main( csvToJson = CsvToJson() ):
def main( csvToJson = CsvToJson() ):
#   able to get all csv files within working dir, 
#   sort csv's based on majors/industry
#   create json based on those csvs

    mypath = os.getcwd()
    
    csvFiles = [csvFile for csvFile in listdir(mypath) 
                 if isfile(join(mypath, csvFile)) 
                 if '.csv' in csvFile]
    
    majorsCsvFiles,industryCsvFiles = sort_csv_files(csvFiles)
    
    csvToJson.master_majors_csv_to_json(majorsCsvFiles)
    csvToJson.master_industry_csv_to_json(industryCsvFiles)
    
if __name__ == "__main__": main()
    
