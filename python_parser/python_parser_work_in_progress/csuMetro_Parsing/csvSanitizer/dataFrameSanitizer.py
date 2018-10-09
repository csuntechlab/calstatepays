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
        self.df = pd.read_csv( localFilePath )
        self.sanitize_null_values()
        self.header_sanitizer()

        #TODO: COMMENT THIS OUT FOR ERROR CHECKING
        # self.df = self.df.loc[self.df['student_path'].isin([1,2,4])]
        # self.df = self.df.loc[self.df['entry_status'].isin(['FTF + FTT'])]
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
    
    def column_sanitize_get_first_9(self,columnName):
        self.df[columnName] = self.df[columnName].str.slice(start=0, stop=9)
    
    # converts to floats...
    def string_number_to_real_number(self,columnName):
        self.remove_comma(columnName) 
        self.df[columnName] = pd.to_numeric(self.df[columnName], errors='coerce')

    def remove_dollar(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('$', '')

    def remove_hyphen(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace('-','')

    def remove_comma(self,columnName):
        self.df[columnName] = self.df[columnName].str.replace(',','')

    ### These are the common sanitizations that both jsons require
    def sanitizeCommon(self):
        self.df['hegis_at_exit'] = self.df['hegis_at_exit'].astype(str)
        self.column_sanitize_plus('hegis_at_exit')
        if self.df['campus'][1] == 0:
            self.column_sanitize_get_first_9('hegis_at_exit')
        else:
            self.column_sanitize_get_first_5('hegis_at_exit')
        self.string_number_to_real_number('hegis_at_exit')

    ### Both jsons will need this method
    def dollar_column(self,columnName):
        self.remove_dollar(columnName)
        self.remove_comma(columnName)
        self.string_number_to_real_number(columnName)
    
    def renameNewCsvs(self):
        # for industries...
        self.df = self.df.rename(columns={'median_annual_earnings':'median_annual_earnings_5_years_after_exit', 'average_annual_earnings': 'average_annual_earnings_5_years_after_exit'})
        self.df = self.df.rename(columns={'median_annual_earnings.1':'median_annual_earnings_10_years_after_exit', 'average_annual_earnings.1': 'average_annual_earnings_10_years_after_exit'})
        self.df = self.df.rename(columns={'number_of_students_found.1':'number_of_students_found_10_years_after_exit', 'number_of_students_found': 'number_of_students_found_5_years_after_exit'})
        print('updated')
        # print(self.df.columns)




