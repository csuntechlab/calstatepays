import pandas as pd
import numpy as np
import simplejson
import os
from os import listdir
from os.path import isfile, join
from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer

class Sanitize_Industry(Data_Frame_Sanitizer):
    def __init__(self,file):
        super().__init__(file)
        self.renameNewCsvs()
        self.sanitizeCommon()
        self.sanitize_Industry()
        self.header_sanitizer()

    def sanitize_Industry(self):
        mapper = {
            'median_annual_earnings_5_years_after_exit':self.dollar_column('median_annual_earnings_5_years_after_exit'),
            'average_annual_earnings_5_years_after_exit':self.dollar_column('average_annual_earnings_5_years_after_exit'),
            'median_annual_earnings_10_years_after_exit':self.dollar_column('median_annual_earnings_10_years_after_exit'),
            'average_annual_earnings_10_years_after_exit':self.dollar_column('average_annual_earnings_10_years_after_exit'),
        }
        for column in self.df:
            pd.Series(column).map(mapper)

    def create_industry_with_df(self,naics_dict):
        # TODO: REMOVE NAICS ROWS WITH NO WAGES (OR OR ) Wages - No NAICS Code!!!!!!!!!
        self.df['naics'] = 0
        for idx, row in self.df.iterrows():
            temp = naics_dict.get(self.df.at[idx,'industry'])
            self.df.at[idx,'naics'] = temp
            if temp == 19 or temp == 20:
                self.df = self.df.drop(idx)
    
    def returnDf(self):
        return self.df

class DFHelper():
    def __init__(self,Dataframe):
        
        Dataframe.loc[:,'id'] = range(1, len(Dataframe) + 1)

        Dataframe.loc[:,'population_sample_id'] = range(1, len(Dataframe) + 1)
        
        Dataframe = Dataframe.rename(columns={'naics': 'naics_codes','industry':'naics_industry'})
        Dataframe = Dataframe.rename(columns={'average_annual_earnings_5_years_after_exit': 'avg_annual_wage_5'})
        Dataframe = Dataframe.rename(columns={'number_of_students_found_5_years_after_exit': 'population_found_5'})
        self.df = Dataframe

    def get_errors_data_frame(self):
        '''
        ERROR Data Frame code here 
        '''
    
        errorDataFrame = self.df.loc[:,['campus','hegis_at_exit','major','student_path','entry_status'] ]
        errorDataFrame = errorDataFrame.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
        errorDataFrame.loc[:,'id'] = range(1, len(errorDataFrame) + 1) 
        duplicateHegisCodeDifferentMajor = errorDataFrame

        print(errorDataFrame.head())

        ids = errorDataFrame["id"]
        errorBoolean = errorDataFrame.duplicated(subset=['campus','major'], keep=False)
        errorDataFrame = errorDataFrame[ids.isin( ids[ errorBoolean ] ) ]
        # self.json_output('master_errors_table',errorDataFrame)
        
        ids = duplicateHegisCodeDifferentMajor["id"]       
        errorBoolean = duplicateHegisCodeDifferentMajor.duplicated(subset=['campus','hegis_at_exit'], keep=False)
        duplicateHegisCodeDifferentMajor = duplicateHegisCodeDifferentMajor[ids.isin( ids[ errorBoolean ] ) ]

        return errorDataFrame,duplicateHegisCodeDifferentMajor
        # self.json_output('master_duplicate_hegis_code_different_major_table',duplicateHegisCodeDifferentMajor)
        pass

    def get_Industry_Data_Frame(self):
        industryPathTypes = self.df.loc[:,['entry_status','naics_codes','naics_industry','student_path','hegis_at_exit','population_sample_id','campus','id']]
        industryPathTypes['hegis_at_exit'] = self.df[['hegis_at_exit']]
        industryPathTypes['campus'] = self.df[['campus']]
        
        industryPathWages = self.df.loc[:,['avg_annual_wage_5','id']]

        populationTable = self.df.loc[:,['population_found_5','id']]

        # populationTable['population_found_5'] = populationTable['population_found_5'].astype('float')
        
        return industryPathTypes,industryPathWages,populationTable

    def get_dict(self):
        dictionary = []
        path = os.getcwd() + '/dictionaries'
    
        dictFiles = [csvFile for csvFile in listdir(path) 
                    if isfile(join(path, csvFile)) ]

        return dictFiles

    def create_master_dict(self):
        dictFiles = self.get_dict()
        masterDict = {}
        import json

        # concatenate dicts
        for dictFile in dictFiles:
            with open(os.getcwd() + '/dictionaries/'+dictFile) as f:
                data = json.load(f)
                masterDict = {**masterDict, **data}

        with open ('./master_industry_Dictionary.json', 'w' ) as fp:
            fp.write(simplejson.dumps(masterDict, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
        fp.close()

        return masterDict



