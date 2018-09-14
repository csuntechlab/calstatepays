import pandas as pd

import numpy as np
import simplejson

from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer

class Sanitize_Industry(Data_Frame_Sanitizer):
    def __init__(self,file):
        super().__init__(file)
        self.sanitizeCommon()
        self.sanitize_Industry()
        self.set_values_for_data_frame()
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

    def set_values_for_data_frame(self):
        self.df['university_majors_id'] = -1
        self.df['id'] = -1
        self.df['student_background_id'] = -1

        for index,row in self.df.iterrows():
            # print(row[0]) # campus : campus-id
            # print(row[1]) # location : campus-name
            # print(row[2]) # student_path 
            # print(row[3]) # entry_stat : Entry-status
            # print(row[4]) # hegis at exit
            # print(row[5]) # major
            # print(row[6]) # major
            # print(row[7]) # estimated_time_to_degree_(years)
            # print(row[8]) # estimated_earnings_5_years_after_exit
            # print(row[9]) # fre_financial_return_on_education
            # print(row[10]) # university_majors_id
            # print(row[11]) # id
            # print(row[12]) # student_background_id
            # print("**********")

            campus = row[0]
            age_range_str = row[2]
            age_range_id = age_range[age_range_str]

            annual_earnings_str = row[4]
            annual_earnings_id = annual_earnings[annual_earnings_str]

            annual_financial_aid_str = row[5]
            annual_financial_aid_id = annual_financial_aid[annual_financial_aid_str]

            self.df.ix[index,'age_range'] = age_range_id
            self.df.ix[index,'annual_earnings_during_school'] = annual_earnings_id
            self.df.ix[index,'annual_financial_aid'] = annual_financial_aid_id

            # uni_majors_id = self.dictionary[campus][hegis] 
            # self.df.ix[index,'university_majors_id'] = uni_majors_id
            self.df.ix[index,'id'] = self.indexID
            self.df.ix[index,'student_background_id'] = self.indexID
            self.indexID += 1

    
    campus,location,student_path,entry_status,hegis_at_exit,major,industry,number_of_students_found_5_years_after_exit,median_annual_earnings_5_years_after_exit,average_annual_earnings_5_years_after_exit,number_of_students_found_10_years_after_exit,
    

    def get_Industry_Data_Frame(self):
        industryPathTypes = self.df.loc[:,['entry_status','naics','student_path']]
        industryPathTypes.loc[:,'id'] = range(1, len(industryPathTypes) + 1)
        industryPathTypes = industryPathTypes.rename(columns={'naics': 'naics_codes'})
        industryPathTypes['hegis_at_exit'] = self.df[['hegis_at_exit']]
        industryPathTypes['campus'] = self.df[['campus']]
        industryPathTypes = industryPathTypes.loc[industryPathTypes['student_path'].isin([1,2,4])]

        industryPathWages = self.df.loc[:,['average_annual_earnings_5_years_after_exit']]
        industryPathWages = industryPathWages.rename(columns={'average_annual_earnings_5_years_after_exit': 'avg_annual_wage_5'})
        industryPathWages.loc[:,'id'] = range(1, len(industryPathWages) + 1)

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