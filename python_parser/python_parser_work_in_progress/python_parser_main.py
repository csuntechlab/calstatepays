import pandas as pd
import numpy as np

import os
from os import listdir
from os.path import isfile, join
from csuMetro_Parsing.iterateCsvFiles import IterateCsvFiles

#from csuMetro_Parsing.iterateAggregate import AggregateCsvFiles

from csuMetro_Parsing.UniversityMajorsTable import UniversitiesDataFrameErrorChecker



def get_csv_files_in_this_directory():
	'''
	sort all the csv files to two lists
	have a list for majors csv files
	have a list for industry csv files
	'''
	majorsCsvFiles = []
	industryCsvFiles = []
	pfreCsvFiles = []

	path = os.getcwd() + '/csv'
  
	csvFiles = [csvFile for csvFile in listdir(path) 
				 if isfile(join(path, csvFile)) 
				 if '.csv' in csvFile]
	
	for csv in csvFiles:
		if 'majors' in csv:
			majorsCsvFiles.append(csv.replace('.csv',''))
		elif 'industry' in csv:
			industryCsvFiles.append(csv.replace('.csv',''))
		elif 'pfre' in csv:
  			pfreCsvFiles.append(csv.replace('.csv',''))
	
	return majorsCsvFiles,industryCsvFiles,pfreCsvFiles


def main( iterateCsvFiles = IterateCsvFiles() ):
	'''
	send list of files to be parsed
	'''
	majorsCsvFiles,industryCsvFiles,pfreCsvFiles = get_csv_files_in_this_directory()
	
	lol = UniversitiesDataFrameErrorChecker(majorsCsvFiles,'majors','')
	lol = UniversitiesDataFrameErrorChecker(industryCsvFiles,'industry','_doNotUse')
	del lol
	
	print( majorsCsvFiles )
	iterateCsvFiles.master_majors_csv_to_json(majorsCsvFiles)

	print( industryCsvFiles )
	iterateCsvFiles.master_industry_csv_to_json(industryCsvFiles)

	print( pfreCsvFiles )
	iterateCsvFiles.master_pfre_csv_to_json(pfreCsvFiles)
	
if __name__ == "__main__": main()
	

