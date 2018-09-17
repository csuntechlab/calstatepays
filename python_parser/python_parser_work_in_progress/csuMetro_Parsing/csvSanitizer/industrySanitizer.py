import pandas as pd
import numpy as np
import simplejson

# Why was there two of these?
# from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer
from csuMetro_Parsing.csvSanitizer.dataFrameSanitizer import Data_Frame_Sanitizer

class Sanitize_Industry(Data_Frame_Sanitizer):
    def __init__(self,file):
        super().__init__(file)
        self.sanitizeCommon()
        self.sanitize_Industry()
        # print(self.df.columns)
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

    def create_industry_with_df(self,naics_dict):
        self.df['naics'] = 0
        # print(naics_dict)
        for idx, row in self.df.iterrows():
            if row.industry in naics_dict:
                self.df.at[idx,'naics'] = naics_dict.get(self.df.at[idx,'industry'])

            # print((idx, row.industry))
        # print(naics_dict)
        # dfBuilder = self.df(['campus', 'location', 'student_path', 'entry_status', 'hegis_at_exit','major', 'industry'])
        # print(pd.DataFrame(naics_dict))
    

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

        # i dont remember why we had naics slice, it doesnt exist in the csvs as a header
        naics_titles = self.df[['naics','industry']]
        naics_titles = naics_titles.rename(columns={'naics': 'naics_codes','industry':'naics_industry'})
        naics_titles = naics_titles.drop_duplicates(subset=['naics_codes'], keep='first')
        naics_titles['images'] = ""


        return industryPathTypes,industryPathWages,naics_titles

