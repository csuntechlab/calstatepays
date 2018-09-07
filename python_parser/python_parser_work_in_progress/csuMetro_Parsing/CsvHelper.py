import pandas as pd

import numpy as np
import simplejson

class Data_Frame_Sanitizer:
    def __init__(self,file):
        '''
        This is a dataframes parent class,
        Majors and Industry dataframes are parsed in a similar manner.
        So we will parse the first couple of columns here. 
        Shared parsing functions will reside in the parent class
            dataFrame object init
                file, 
                csv general data frame
        '''
        self.file = file
        localFilePath = './csv/' + self.file+'.csv'
        self.df = pd.read_csv( localFilePath)
        # self.df.info()
        # print(self.df)
        self.sanitize_null_values()
        # self.print_column_headers()
        self.header_sanitizer()
        # self.print_column_headers()
        self.df = self.df.loc[self.df['student_path'].isin([1,2,4])]
        # print(self.df.keys())
        # print(self.df)


        # here we create the updated csv with the correct sanitizations
        # this data goes to sanitized_industries folder
        # we should probabily read these files which i swapped into csv directory
        # the caution is we'll be sanitizing it again, so maybe we can talk about this 
        # friday?
        # if "major" not in self.file: 
        #     name = self.file.replace("_updated_industry","")
        #     name = self.file.replace("_industry","")
        #     self.df.to_csv('sanitized_industries/'+name+'_industry.csv',index=False)
        pass
    
    def sanitize_null_values(self):
        '''
        Sanitizes null values
        '''
        self.df = self.df.rename(columns=lambda x: x.replace('#', 'number'))
        self.df = self.df.replace(['*****', np.NaN], np.NaN)

    def header_sanitizer(self):
        '''
        Sanitizes the header for each csv
        '''
        self.df.columns = self.df.columns.str.replace(' ','_')
        self.df.columns = self.df.columns.str.replace('#','number')
        # self.df.columns = self.df.columns.str.replace('.1','')                                                      
        self.df.columns = self.df.columns.str.lower()
        for i,col in enumerate(self.df.columns):
            if(col[0] in '123456789'):
                self.df = self.df.rename(index=str, columns={str(col): "_"+str(col)})
            elif(col == 'entry_stat'):
                self.df = self.df.rename(index=str, columns={str(col): 'entry_status'})
    
    def print_data_frame_headers(self):
        '''
        prints the header
        '''
        print (self.df.head())

    def print_column_headers(self):
        '''
        prints col headers
        '''
        for column in self.df:
            print(column)
    
    def __str__(self):
        '''
        prints dataframe
        '''
        print(self.df)
    
     # sanitize column
    def column_sanitize_plus(self,columnName):
        '''
        sanitize for col that has a plus
        '''
        self.df[columnName] = self.df[columnName].str.replace('+','')
        self.df[columnName] = self.df[columnName].str.replace(' ','')

    def column_sanitize_get_first_5(self,columnName):
        self.df[columnName] = self.df[columnName].str.slice(start=0, stop=5)
    
    # converts to floats...
    def string_number_to_real_number(self,columnName):
        self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    def remove_dollar(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('$', '')

    def remove_hyphen(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('-','')

    def remove_comma(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace(',','')

    ### These are the common sanitizations that both jsons require
    def sanitizeCommon(self):
        self.column_sanitize_plus('hegis_at_exit')
        self.column_sanitize_get_first_5('hegis_at_exit')
        self.string_number_to_real_number('hegis_at_exit')

    ### Both jsons will need this method
    def dollar_column(self,columnName):
        self.remove_dollar(columnName)
        self.remove_comma(columnName)
        self.string_number_to_real_number(columnName)

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