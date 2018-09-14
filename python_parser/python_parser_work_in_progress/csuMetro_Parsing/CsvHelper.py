import pandas as pd

import numpy as np
import simplejson

from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer

class Sanitize_Industry(Data_Frame_Sanitizer):
    def __init__(self,file):
        super().__init__(file)
        self.sanitizeCommon()
        pass
    
    # i just realized we are not using 10 year
    # so most of the code i did today was useless...
    def sanitize_Industry(self):
        mapper = {
            'median_annual_earnings_5_years_after_exit':self.dollar_column('median_annual_earnings_5_years_after_exit'),
            'average_annual_earnings_5_years_after_exit':self.dollar_column('average_annual_earnings_5_years_after_exit'),
            'median_annual_earnings_10_years_after_exit':self.dollar_column('median_annual_earnings_10_years_after_exit'),
            'average_annual_earnings_10_years_after_exit':self.dollar_column('average_annual_earnings_10_years_after_exit'),
        }
        for column in self.df:
            pd.Series(column).map(mapper)
    

    def get_Industry_Data_Frame(self):
        # TODO: i dont remember how to get naics from this dataframe
        # when script fails, always have to remove all updated csvs in python_parser_WIP directory
        # is hegis at exist == naics? I dont remember
        industryPathTypes = self.df.loc[:,['entry_status','naics','student_path']]
        industryPathTypes.loc[:,'id'] = range(1, len(industryPathTypes) + 1)
        industryPathTypes = industryPathTypes.rename(columns={'naics': 'naics_codes'})
        industryPathTypes['hegis_at_exit'] = self.df[['hegis_at_exit']]
        industryPathTypes['campus'] = self.df[['campus']]
        industryPathTypes = industryPathTypes.loc[industryPathTypes['student_path'].isin([1,2,4])]

        industryPathWages = self.df.loc[:,['average_annual_earnings_5_years_after_exit']]
        industryPathWages = industryPathWages.rename(columns={'average_annual_earnings_5_years_after_exit': 'avg_annual_wage_5'})
        industryPathWages.loc[:,'id'] = range(1, len(industryPathWages) + 1)

        # i dont remember why we had naics slice, it doesnt exist in the csvs as a header
        naics_titles = self.df[['naics','industry']]
        naics_titles = naics_titles.rename(columns={'naics': 'naics_codes','industry':'naics_industry'})
        naics_titles = naics_titles.drop_duplicates(subset=['naics_codes'], keep='first')
        naics_titles['images'] = ""


        return industryPathTypes,industryPathWages,naics_titles


class Sanitize_Major(Data_Frame_Sanitizer):
    def __init__(self,file):
        super().__init__(file)
        self.sanitizeCommon()
        self.df = self.df.loc[self.df['year'].isin([2,5,10,15])]
        # print(self.df)
        pass

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
        return self.df
    
    def get_University_Majors_Dictionary_Data_Frame(self):
        UnivMajorDictionaryDf = self.df.loc[:,['campus','hegis_at_exit','major'] ]
        UnivMajorDictionaryDf = UnivMajorDictionaryDf.drop_duplicates(subset=['campus', 'hegis_at_exit','major'], keep='first')
        UnivMajorDictionaryDf['campus'] = UnivMajorDictionaryDf['campus'].astype('float')
        UnivMajorDictionaryDf['hegis_at_exit'] = UnivMajorDictionaryDf['hegis_at_exit'].astype('float')
        
        return UnivMajorDictionaryDf
        

    def get_Majors_Paths_Data_Frame(self):
        MajorPathDf = self.df.loc[:,['student_path','entry_status','year','hegis_at_exit','campus']]
        MajorPathDf.loc[:,'id'] = range(1, len(MajorPathDf) + 1) # TODO: May have messed up here
        MajorPathWageDf = self.df.loc[:,['_25th_percentile_earnings','_50th_percentile_earnings','_75th_percentile_earnings']]
        # MajorPathWageDf.loc[:,'major_path_id'] = MajorPathDf.loc[:,['id']] # TODO: May Have messed up here
        MajorPathWageDf.loc[:,'major_path_id'] = range(1, len(MajorPathDf) + 1) # TODO: May Have messed up here
        # print(MajorPathDf)
        # print(MajorPathWageDf)
        return MajorPathDf,MajorPathWageDf