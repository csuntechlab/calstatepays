import pandas as pd
import numpy as np

import os
from os import listdir
from os.path import isfile, join
from csuMetro_Parsing.iterateCsvFiles import IterateCsvFiles

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
    
    print( majorsCsvFiles )

    iterateCsvFiles.master_majors_csv_to_json(majorsCsvFiles)

    print( industryCsvFiles )

    # Will need to remove remove_row_of_industry 
    # and remove_temp_industry_file 
    # when danny gives us new csv

    # updateIndustry = remove_row_of_industry(industryCsvFiles)
    # iterateCsvFiles.master_industry_csv_to_json(industryCsvFiles)
    # remove_temp_industry_file(updateIndustry)
    
if __name__ == "__main__": main()
    

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
