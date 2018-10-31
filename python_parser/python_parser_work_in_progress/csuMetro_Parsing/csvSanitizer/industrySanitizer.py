import pandas as pd
import numpy as np
import json
import simplejson
import os
from os import listdir
from os.path import isfile, join
from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer

class Sanitize_Industry(Data_Frame_Sanitizer):
    def __init__(self,file,globalIndex):
        super().__init__(file)
        self.print_column_headers()
        self.globalIndex = globalIndex
        self.renameNewCsvs()
        self.sanitizeCommon()
        self.header_sanitizer()
        self.sanitize_Industry()
        self.dictionaryUniId = self.get_dictionary(file.replace('_industry','')) 
        self.dictionary = self.get_this_university_major_dictionary(self.file.replace("_industry",""))
        self.update_table_with_university_majors_id()
        self.update_majors_based_on_same_hegis_different_majors()
        # print(self.df)

    def set_index(self):
        lenOfDf = len(self.df) + self.globalIndex
        self.df.loc[:,'id'] = range(self.globalIndex,lenOfDf) 
        self.df.loc[:,'population_sample_id'] = range(self.globalIndex,lenOfDf) 
        self.globalIndex = lenOfDf
    
    def get_index(self):
        return self.globalIndex

    def get_dictionary(self,fileName):
        jsonFile = open('./dictionaries/'+fileName+'.json')
        dictionary = jsonFile.read()
        dictionary = json.loads(dictionary)
        return dictionary
    
    def update_table_with_university_majors_id(self):
        self.df['university_majors_id'] = -1

        for index,row in self.df.iterrows():
            hegis = (str)(row.hegis_at_exit)
            campus = (str)(row.campus)
            uni_majors_id = self.dictionaryUniId[campus][hegis]
            # print(uni_majors_id)
            self.df.ix[index,'university_majors_id'] = uni_majors_id
    

    def get_this_university_major_dictionary(self,file):
        print(self.file)
        jsonFile = open('./hegisToMajorDictionary/'+file+'.json')
        dictionary = jsonFile.read()
        dictionary = json.loads(dictionary)
        return dictionary
    
    
    def update_majors_based_on_same_hegis_different_majors(self):
        if not bool(self.dictionary):
            for idx, row in self.df.iterrows():
                hegis = self.df.at[idx,'hegis_at_exit']
                strHegis = str(hegis).replace('.0',"")
                if strHegis in self.dictionary:
                    self.df.at[idx,'major'] = self.dictionary[strHegis]
        
        # print(self.df)

    def sanitize_Industry(self):
        mapper = {
            'median_annual_earnings_5_years_after_exit':self.dollar_column('median_annual_earnings_5_years_after_exit'),
            'average_annual_earnings_5_years_after_exit':self.dollar_column('average_annual_earnings_5_years_after_exit'),
            'median_annual_earnings_10_years_after_exit':self.dollar_column('median_annual_earnings_10_years_after_exit'),
            'average_annual_earnings_10_years_after_exit':self.dollar_column('average_annual_earnings_10_years_after_exit'),
        }
        for column in self.df:
            pd.Series(column).map(mapper)
        self.rename_columns()
        self.set_index()
    
    def rename_columns(self):
        self.df = self.df.rename(columns={'naics': 'naics_codes','industry':'naics_industry'})
        self.df = self.df.rename(columns={'average_annual_earnings_5_years_after_exit': 'avg_annual_wage_5'})
        self.df = self.df.rename(columns={'number_of_students_found_5_years_after_exit': 'population_found_5'})
        self.df = self.df.rename(columns={'median_annual_earnings_5_years_after_exit': 'median_annual_wage_5'})


    def create_industry_with_df(self,naics_dict):
        # TODO: REMOVE NAICS ROWS WITH NO WAGES (OR OR ) Wages - No NAICS Code!!!!!!!!!
        self.df['naics'] = 0
        # print(self.df.head())
        # print(self.print_column_headers())
        for idx, row in self.df.iterrows():
            temp = naics_dict.get(self.df.at[idx,'naics_industry'])
            self.df.at[idx,'naics_codes'] = temp
            # if temp == 19 or temp == 20:
                # self.df = self.df.drop(idx)
    
    def returnDf(self):
        return self.df
    
    def get_Industry_Data_Frame(self):
        industryPathTypes = self.df.loc[:,['entry_status','naics_codes','naics_industry','student_path','hegis_at_exit','population_sample_id','campus','id','university_majors_id']]
        
        industryPathWages = self.df.loc[:,['median_annual_wage_5','id']]

        populationTable = self.df.loc[:,['population_found_5','id']]

        # populationTable['population_found_5'] = populationTable['population_found_5'].astype('float')
        
        return industryPathTypes,industryPathWages,populationTable

class DFHelper():
    def __init__(self,Dataframe):
        
        Dataframe.loc[:,'id'] = range(1, len(Dataframe) + 1)

        Dataframe.loc[:,'population_sample_id'] = range(1, len(Dataframe) + 1)
        
        Dataframe = Dataframe.rename(columns={'naics': 'naics_codes','industry':'naics_industry'})
        Dataframe = Dataframe.rename(columns={'average_annual_earnings_5_years_after_exit': 'avg_annual_wage_5'})
        Dataframe = Dataframe.rename(columns={'number_of_students_found_5_years_after_exit': 'population_found_5'})
        self.df = Dataframe

    def get_Industry_Data_Frame(self):
        industryPathTypes = self.df.loc[:,['entry_status','naics_codes','naics_industry','student_path','hegis_at_exit','population_sample_id','campus','id']]
        
        industryPathWages = self.df.loc[:,['avg_annual_wage_5','id']]

        populationTable = self.df.loc[:,['population_found_5','id']]

        # populationTable['population_found_5'] = populationTable['population_found_5'].astype('float')
        
        return industryPathTypes,industryPathWages,populationTable

    def get_dict(self):
        path = os.getcwd() + '/dictionaries'
        dictFiles = [csvFile for csvFile in listdir(path) 
                    if isfile(join(path, csvFile)) ]

        return dictFiles

    def create_master_dict(self):
        dictFiles = self.get_dict()
        masterDict = {}
        
        for dictFile in dictFiles:
            with open(os.getcwd() + '/dictionaries/'+dictFile) as f:
                data = json.load(f)
                masterDict = {**masterDict, **data}

        fileName = './master_industry_dictionary.json'
        with open (fileName, 'w' ) as fp:
            fp.write(simplejson.dumps(masterDict, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
        fp.close()

    def get_errors_data_frame(self):
        '''
        ERROR Data Frame code here 
        '''
    
        differentHegisSameMajor = self.df.loc[:,['campus','hegis_at_exit','major','student_path','entry_status'] ]
        differentHegisSameMajor = differentHegisSameMajor.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
        differentHegisSameMajor.loc[:,'id'] = range(1, len(differentHegisSameMajor) + 1) 
        sameHegisDifferentMajor = differentHegisSameMajor

        print(differentHegisSameMajor.head())

        ids = differentHegisSameMajor["id"]
        errorBoolean = differentHegisSameMajor.duplicated(subset=['campus','major'], keep=False)
        differentHegisSameMajor = differentHegisSameMajor[ids.isin( ids[ errorBoolean ] ) ]
        # self.json_output('master_errors_table',differentHegisSameMajor)
        
        ids = sameHegisDifferentMajor["id"]       
        errorBoolean = sameHegisDifferentMajor.duplicated(subset=['campus','hegis_at_exit'], keep=False)
        sameHegisDifferentMajor = sameHegisDifferentMajor[ids.isin( ids[ errorBoolean ] ) ]

        return differentHegisSameMajor,sameHegisDifferentMajor
        # self.json_output('master_duplicate_hegis_code_different_major_table',sameHegisDifferentMajor)
        pass



