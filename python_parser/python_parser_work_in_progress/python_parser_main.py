import os
from os import listdir
from os.path import isfile, join

# from csuMetro_Parsing.CsvToJson import CsvToJson
from csuMetro_Parsing.CsvHelper import CsvHelper


class CsvToJson():
    def __init__(self):
        pass
    
    def master_major_csv_to_json(self,majorCsvFiles):
        for csv in majorCsvFiles:
            print(csv) 
            pass
            # obj = CsvHelper(csv)
            # print (obj)

    def master_industry_csv_to_json(self,industryCsvFiles):
        for csv in industryCsvFiles:
            print(csv) 


def sort_csv_files(csvFiles):
    majorCsvFiles = []
    industryCsvFiles = []
    for csv in csvFiles:
        if 'major' in csv:
            majorCsvFiles.append(csv.replace('.csv',''))
        elif 'industry' in csv:
            industryCsvFiles.append(csv.replace('.csv',''))
    return majorCsvFiles,industryCsvFiles

# def main( csvToJson = CsvToJson() ):
def main( csvToJson = CsvToJson() ):
#   able to get all csv files within working dir, 
#   sort csv's based on major/industry
#   create json based on those csvs

    mypath = os.getcwd()
    
    csvFiles = [csvFile for csvFile in listdir(mypath) 
                 if isfile(join(mypath, csvFile)) 
                 if '.csv' in csvFile]
    
    majorCsvFiles,industryCsvFiles = sort_csv_files(csvFiles)
    
    csvToJson.master_major_csv_to_json(majorCsvFiles)
    csvToJson.master_industry_csv_to_json(industryCsvFiles)
    
if __name__ == "__main__": main()
    
