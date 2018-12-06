import pandas as pd

import numpy as np
import json
import simplejson

from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer

class Sanitize_Major(Data_Frame_Sanitizer):
    def __init__(self,file,globalIndex,indexUniversityMajorsId):
        super().__init__(file)
        self.sanitizeCommon()
        
        self.dictionary = self.get_this_university_major_dictionary(self.file.replace("_majors",""))
        self.update_majors_based_on_same_hegis_different_majors()

        self.globalIndex = globalIndex
        self.indexUniversityMajorsId = indexUniversityMajorsId

        # TODO: UNCOMMENT FOR CAL STATE PAYS DATA
        self.df = self.df.loc[self.df['year'].isin([2,5,10,15])]
        self.sanitize_Major()
    
    def get_this_university_major_dictionary(self,file):
        # print(self.file)
        jsonFile = open('./hegisToMajorDictionary/'+file+'.json')
        dictionary = jsonFile.read()
        dictionary = json.loads(dictionary)
        return dictionary
    
    
    def update_majors_based_on_same_hegis_different_majors(self):
        for idx, row in self.df.iterrows():
            hegis = self.df.at[idx,'hegis_at_exit']
            strHegis = str(hegis).replace('.0',"")
            if strHegis in self.dictionary:
                self.df.at[idx,'major'] = self.dictionary[strHegis]

    
    def get_majors_dataframe(self):
        return self.df
    
    def sanitize_Major(self):
        '''
        Sanitizes these Majors CSV Specific Columns
        '''
        mapper = {
            'potential_number_of_students':self.string_number_to_real_number('potential_number_of_students') ,
            'potential_number_of_students_for_each_year_out_of_school':self.string_number_to_real_number('potential_number_of_students_for_each_year_out_of_school'),
            '_25th_percentile_earnings':self.dollar_column('_25th_percentile_earnings'),
            '_50th_percentile_earnings':self.dollar_column('_50th_percentile_earnings'),
            '_75th_percentile_earnings':self.dollar_column('_75th_percentile_earnings'),
            'average_earnings':self.dollar_column('average_earnings'),
            'number_of_students_found':self.string_number_to_real_number('number_of_students_found')
        }
        for column in self.df:
            pd.Series(column).map(mapper)

        self.set_index()

        # print(self.df.head())
    
    def set_index(self):
        lenOfDf = len(self.df) + self.globalIndex
        self.df.loc[:,'id'] = range(self.globalIndex,lenOfDf) 
        self.globalIndex = lenOfDf
    
    def get_global_index(self):
        return self.globalIndex
    
    def get_index_of_university_majors_id(self):
        return self.indexUniversityMajorsId
    
    def get_University_Majors_Dictionary_Data_Frame(self):
        UnivMajorDictionaryDf = self.df.loc[:,['campus','hegis_at_exit','major','student_path','entry_status'] ]
        UnivMajorDictionaryDf = UnivMajorDictionaryDf.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
        UnivMajorDictionaryDf['campus'] = UnivMajorDictionaryDf['campus'].astype('float')
        UnivMajorDictionaryDf['hegis_at_exit'] = UnivMajorDictionaryDf['hegis_at_exit'].astype('float')
        lenOfDf = len(UnivMajorDictionaryDf) + self.indexUniversityMajorsId 
        UnivMajorDictionaryDf.loc[:,'id'] = range(self.indexUniversityMajorsId,lenOfDf) 
        self.indexUniversityMajorsId = lenOfDf

        # print(UnivMajorDictionaryDf.head())
        
        return UnivMajorDictionaryDf
        

    def get_Majors_Paths_Data_Frame(self):
        MajorPathDf = self.df.loc[:,['id','student_path','entry_status','year','hegis_at_exit','campus']]
        MajorPathWageDf = self.df.loc[:,['id','_25th_percentile_earnings','_50th_percentile_earnings','_75th_percentile_earnings']]
        return MajorPathDf,MajorPathWageDf




